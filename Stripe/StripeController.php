<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PaymentModel;
use App\Models\StripeModel;
use App\Models\UserModel;
use Stripe\Stripe;

class StripeController extends BaseController
{
    protected $stripe; 

    public function __construct() {
        $this->stripe = new \Stripe\StripeClient(STRIPE_API_KEY);
    }
    public function index()
    {
        //
    }

    public function create_checkout_session($orderId)
    {
        $userData = (new UserModel())->where('id', session()->get('id'))->first();

        $customer = $this->stripe->customers->create([
            'name'  => $userData['first_name'] . ' ' . $userData['last_name'],
            'email' => $userData['email'],
        ]);

        $stripeCustmoerId = $customer->id;
        $session = $this->stripe->checkout->sessions->create([
            'payment_method_types' => ['card'],
            'mode' => 'setup',
            'customer' => $stripeCustmoerId,
            'success_url' => base_url(route_to('stripe_checkout_success')) . '?session_id={CHECKOUT_SESSION_ID}&id='.$orderId,
            'cancel_url' => base_url(route_to('stripe_checkout_cencel')),
        ]);

        return redirect()->to($session->url);
    }

    public function success_checkout_session()
    {
        $sessionId = $this->request->getVar('session_id');
        $orderId = $this->request->getVar('id');
        $sessions = $this->stripe->checkout->sessions->retrieve(
            $sessionId,
            ['expand' => ['setup_intent']]
        );
        if ($sessions) {



            // save setup_intent
            $queryData = [
                'payment_user_id'       => session()->get('id'),
                'payment_order_id'      => $orderId,
                'stripe_customer_id'    => $sessions->customer,
                'stripe_setup_intent'   => $sessions->setup_intent->id,
                'stripe_payment_method' => $sessions->setup_intent->payment_method,
                'stripe_payment_status' => 0,
                'created_at'            => date('Y-m-d H:i:s'),
                'updated_at'            => date('Y-m-d H:i:s'),
                'deleted_at'            => null
            ];
            (new PaymentModel())->insert($queryData);
            return view('frontend/confirm_view', ['setup_intent' => '$sessions->id']);
        } else {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }

    public function cancel_checkout_session()
    {
        return view('frontend/cancel_payment_view');
    }

    public function create_payment($orderId, $amount)
    {
        $paymentModel = new PaymentModel();
        $paymentData = $paymentModel->where('payment_order_id', $orderId)->first();

        $paymentIntent = $this->stripe->paymentIntents->create([
            'customer'       => $paymentData['stripe_customer_id'],
            'payment_method' => $paymentData['stripe_payment_method'],
            'amount'         => $amount,
            'currency'       => 'usd',
            'confirm'        => true,
        ]);

        $queryData = [
            'stripe_payment_intent' => $paymentIntent->id,
            'stripe_amount'         => $paymentIntent->amount,
            'stripe_payment_status' => ($paymentIntent->status == 'succeeded') ? 1 : 2,
            'updated_at'            => ''
        ];
        $paymentModel->update($paymentData['id'], $queryData);

        if($paymentIntent->status == 'succeeded'){
            return true;
        }else{
            return false;
        }
    }
}
