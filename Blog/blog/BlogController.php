<?php
Done
namespace App\Controllers;

use App\Controllers\BaseController;
use App\Database\Migrations\Categories;
use App\Models\CategoryModel;
use App\Models\PostCategoriesModel;
use App\Models\PostModel;
use App\Models\UserModel;

class BlogController extends BaseController
{
   
protected $model;

public function __construct()
{
    $this->model = new PostModel();
}

public function index()
{
    $productModel = new PostCategoriesModel();
    $perPage = $this->request->getVar('count') ?? 3;
    
    
         return view('frontend/post_view', [
        'admin' => (new UserModel())->first(),
        'categories'      => (new PostCategoriesModel())->where('pcat_parent_id', 0)->findAll(7),
        
        'posts' => $this->model->findAll(2),
        'formData' => $this->model->withcategory()->findAll(),
        'products'      => $productModel->where('pcat_parent_id', 'id')->paginate($perPage, 'custom'),
            'pager'         => $productModel->pager,
            
        // 'postData' => $postData,
        // 'popularPosts' => $this->model->orderBy('pro_views' ,'DESC')->findAll(5),
    ]);
}

public function single_post($slug)
{
    
    // if($productData){
        return view('frontend/single_post_view', [
            'admin' => (new UserModel())->first(),
            'categories'      => (new PostCategoriesModel())->where('pcat_parent_id', 0)->findAll(7),
            'posts' => $this->model->findAll(2),
            'formData' => $this->model->where('post_slug', $slug)->first(),
            
            // 'postData' => $postData,
            // 'popularPosts' => $this->model->orderBy('pro_views' ,'DESC')->findAll(5),
        ]);
    // }else{
        // throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
    // }        
}
}