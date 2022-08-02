<?php
Done
namespace App\Controllers\Backend;

use App\Controllers\BaseController;
use App\Models\PostCategoriesModel;

class PostCategoryController extends BaseController
{
   
     protected $moduleName;
        protected $model;
    
        public function __construct()
        {
            $this->moduleName = 'postcategory';
            $this->model = new PostCategoriesModel();
        }
    
        public function index()
        {
            helper(['text']);
            return view("backend/{$this->moduleName}/index", [
                'moduleName' => $this->moduleName,
                'postcategories' => $this->model->findAll()
            ]);
        }
        public function create()
        {
            $rules = [
                'pcat_name' => [
                    'label'    => 'Catagry Name',
                    'rules'    => 'required|is_unique[categories.cat_name]|max_length[32]',
                    'errors'    => [
                        'required'        => '{field} is required.',
                        'is_unique'     => '{field} already exists',
                        'max_length'    => '{field} Too long.'
                    ]
                ],
                'pcat_short_desc' => [
                    'label'    => 'Catagry Shrot Description',
                    'rules'    => 'max_length[256]',
                    'errors'    => [
                        'max_length'    => '{field} Too long.'
                    ]
                ],
                'pcat_meta_title' => [
                    'label'    => 'Catagry Meta Title',
                    'rules'    => 'max_length[128]',
                    'errors'    => [
                        'max_length'    => '{field} Too long.'
                    ]
                ],
                'pcat_meta_desc' => [
                    'label'    => 'Catagry Meta Description',
                    'rules'    => 'max_length[128]',
                    'errors'    => [
                        'max_length'    => '{field} Too long.'
                    ]
                ],
            ];
            if ($this->validate($rules)) {
                $imageFile = $this->request->getFile('pcat_img');
                if ($imageFile->isValid() && !$imageFile->hasMoved()) {
                    $name = $imageFile->getRandomName();
                    $imageFile->move(UPLOAD_PATH . '/postcategories', $name);
                    $imgName = $name;
                } else {
                    $imgName = null;
                }
                $queryData = [
                    'pcat_slug'          => url_title($this->request->getVar('pcat_name'), '-', true),
                    'pcat_name'          => $this->request->getVar('pcat_name'),
                    'pcat_short_desc'    => $this->request->getVar('pcat_short_desc'),
                    'pcat_desc'          => $this->request->getVar('pcat_desc'),
                    'pcat_img'           => $imgName,
                    'pcat_parent_id'     => $this->request->getVar('pcat_parent_id'),
                    'pcat_meta_title'    => $this->request->getVar('pcat_meta_title'),
                    'pcat_meta_desc'     => $this->request->getVar('pcat_meta_desc'),
                    'created_at'        => date('Y-m-d H:i:s'),
                    'updated_at'        => date('Y-m-d H:i:s'),
                    'deleted_at'        => null
                ];
    
                if ($this->model->insert($queryData)) {
                    return redirect()->back()->with('success', 'PostCategory Successfully Created');
                } else {
                    throw new \CodeIgniter\Database\Exceptions\DatabaseException();
                }
            } else {
                return redirect()->back()->with('validation', $this->validator);
            }
        }
    
        public function ajax_edit()
        {
            return json_encode($this->model->where('id', $this->request->getVar('id'))->first());
        }
    
        public function update()
        {
            $id = $this->request->getVar('pedit_id');
    
            $rules = [
                'pedit_cat_name' => [
                    'label'    => 'Catagry Name',
                    'rules'    => "required|is_unique[categories.cat_name,id,{$id}]|max_length[32]",
                    'errors'    => [
                        'required'        => '{field} is required.',
                        'is_unique'     => '{field} already exists',
                        'max_length'    => '{field} Too long.'
                    ]
                ],
                'pedit_cat_short_desc' => [
                    'label'    => 'Catagry Shrot Description',
                    'rules'    => 'max_length[256]',
                    'errors'    => [
                        'max_length'    => '{field} Too long.'
                    ]
                ],
                'pedit_cat_meta_title' => [
                    'label'    => 'Catagry Meta Title',
                    'rules'    => 'max_length[128]',
                    'errors'    => [
                        'max_length'    => '{field} Too long.'
                    ]
                ],
            ];
            if ($this->validate($rules)) {
                $imageFile = $this->request->getFile('pedit_cat_img');
                if ($imageFile->isValid() && !$imageFile->hasMoved()) {
                    $name = $imageFile->getRandomName();
                    $imageFile->move(UPLOAD_PATH . '/postcategories', $name);
                    $imgName = $name;
                } else {
                    $imgName = $this->request->getVar('pold_cat_img');
                }
                $queryData = [
                    'pcat_slug'          => url_title($this->request->getVar('pedit_cat_name'), '-', true),
                    'pcat_name'          => $this->request->getVar('pedit_cat_name'),
                    'pcat_short_desc'    => $this->request->getVar('pedit_cat_short_desc'),
                    'pcat_desc'          => $this->request->getVar('pedit_cat_desc'),
                    'pcat_img'           => $imgName,
                    'pcat_banner_img_id' => $this->request->getVar('pedit_cat_banner_img_id'),
                    'pcat_parent_id'     => $this->request->getVar('pedit_cat_parent_id'),
                    'pcat_meta_title'    => $this->request->getVar('pedit_cat_meta_title'),
                    'pcat_meta_desc'     => $this->request->getVar('pedit_cat_meta_desc'),
                    'updated_at'        => date('Y-m-d H:i:s'),
                ];
    
                if ($this->model->update($id, $queryData)) {
                    return redirect()->back()->with('success', 'PostCategory Successfully Updated');
                } else {
                    throw new \CodeIgniter\Database\Exceptions\DatabaseException();
                }
            } else {
                return redirect()->back()->with('validation', $this->validator);
            }
        }
    
        public function delete()
        {
            $id = $this->request->getVar('pdelete_id');
            $categoryData = $this->model->where('id', $id)->first();
            if ($categoryData) {
                if ($this->model->delete($id)) {
                    if ($categoryData['pcat_img']) {
                        unlink(UPLOAD_PATH . '/postcategories/' . $categoryData['pcat_img']);
                    }
                    return redirect()->back()->with('success', 'PostCategory Successfully Deleted');
                } else {
                    throw new \CodeIgniter\Database\Exceptions\DatabaseException();
                }
            } else {
                throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
            }
        }
    }
    