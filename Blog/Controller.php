<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class ServiceController extends BaseController
{
    public function index()
    {
        $serviceModel = new ServiceModel();
        $serviceData = $serviceModel->where('deleted_at', null)->findAll();
        $data['pageData'] = $serviceData;
        return view("{{ViewPath}}", $data);
    }

    public function add_service()
    {
        $serviceModel = new ServiceModel();
        $rules = [
            'title'     => 'required|min_length[3]|max_length[170]|is_unique[]', // Write unique condiition
            'excerpt'   => 'required|min_length[3]|max_length[255]',
            'img'       => '' // Do file upload vlaidation
        ];
        $errors = [
            // Customer Errors
        ];
        if ($this->validate($rules, $errors)) {
            $formData = [
                'slug'                  => url_title($this->request->getPost('title')),
                'title'                 => $this->request->getPost('title'),
                'excerpt'               => $this->request->getPost('title'),
                'body'                  => $this->request->getPost('body'),
                'client_name'           => $this->request->getPost('client_name'),
                'category'              => $this->request->getPost('category'),
                'value'                 => $this->request->getPost('value'),
                'img'                   => '', // 
                'gallary_imgs'          => '', //
                'is_featured'           => '', //
                'related_service_ids'   => '', // muct be in this format ['1','2','3'] 
                'meta_title'            => $this->request->getPost('meta_title'),
                'meta_desc'             => $this->request->getPost('meta_desc'),
                'meta_keywords'         => $this->request->getPost('meta_desc'),
            ];
            $serviceModel->insert($formData);
            session()->setFlashdata('success', 'Role Successfully Added');
            return redirect()->to(route_to('')); // link
        } else {
            $data['validation'] = $this->validator;
        }

        return view('{{PanelView}}');
    }

    public function edit_service($id)
    {
        $serviceModel = new ServiceModel();
        $rules = [
            'title'     => 'required|min_length[3]|max_length[170]|is_unique[]', // Write unique condiition
            'excerpt'   => 'required|min_length[3]|max_length[255]',
            'img'       => '' // Do file upload vlaidation
        ];
        $errors = [
            // Customer Errors
        ];
        if ($this->validate($rules, $errors)) {
            $formData = [
                'slug'                  => url_title($this->request->getPost('title')),
                'title'                 => $this->request->getPost('title'),
                'excerpt'               => $this->request->getPost('title'),
                'body'                  => $this->request->getPost('body'),
                'client_name'           => $this->request->getPost('client_name'),
                'category'              => $this->request->getPost('category'),
                'value'                 => $this->request->getPost('value'),
                'img'                   => '', // 
                'gallary_imgs'          => '', //
                'is_featured'           => '', //
                'related_service_ids'   => '', // muct be in this format ['1','2','3'] 
                'meta_title'            => $this->request->getPost('meta_title'),
                'meta_desc'             => $this->request->getPost('meta_desc'),
                'meta_keywords'         => $this->request->getPost('meta_desc'),
            ];
            $serviceModel->insert($formData);
            session()->setFlashdata('success', 'Role Successfully Added');
            return redirect()->to(route_to('')); // link
        } else {
            $data['validation'] = $this->validator;
        }

        return view('{{PanelView}}');
    }
    
}
