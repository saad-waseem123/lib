<?php

namespace App\Controllers\Backend;

use App\Controllers\BaseController;
use App\Models\SettingModel;

class SiteSettingController extends BaseController
{
    public function settings()
	{
		helper('inflector');
		$settingModel = new SettingModel();
		$settingData = $settingModel->findAll();

		if ($this->request->getMethod() == 'post') {

				foreach($settingData as $setting){
					if($setting['setting_key'] == 'site_logo'){
						$oldLogo 	= $this->request->getPost('site_old_logo');
						$logo 		= $this->request->getFile('site_logo');
						$this->uploadLogo($oldLogo,$logo);
					}else{
						$settingModel->where('setting_key', $setting['setting_key'])->set(['setting_value' => $this->request->getVar($setting['setting_key'])])->update();
					}
				}
				session()->setFlashdata('success', 'Settings Successfully Updated');
				return redirect()->to(base_url(route_to('backend_settings')));

		}

		$data['formData'] = $settingData;
		return view('backend/settings', $data);
	}

	protected function uploadLogo($oldLogo, $logo)
	{
		$settingModel = new SettingModel();
		if($logo){
			if ($logo->isValid() && !$logo->hasMoved()) {
				$name = $logo->getRandomName();
				$logo->move(UPLOAD_PATH, $name);
				$logoPath = $name;
				if($oldLogo){
					unlink(UPLOAD_PATH.'/'.$oldLogo);
				}
			}
		}else{
			$logoPath = $oldLogo;
		}
		$settingModel->where('setting_key', 'site_logo')->set(['setting_value' => $logoPath])->update();
		return;
	}

    
}
