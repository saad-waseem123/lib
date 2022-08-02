<?php

use App\Models\SettingModel;

if (!function_exists('getSiteSettings'))
{
	function getSiteSettings($find)
	{	
		$settingModel = new SettingModel();
		$data = $settingModel->select('setting_value')->where('setting_key', $find)->first();
		if($data){
			// Save into the cache for 1 day
			$data = $data['setting_value'];
         
			return $data;
		}else{
			return;
		}
	}
}