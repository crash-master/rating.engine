<?php

use \Kernel\Request;

class SettingsController{
	public function admin_page(){
		$settings = model('Settings') -> get_settings_list();
		foreach($settings as $i => $setting){
			$settings[$setting['name']] = $setting['value'];
		}
		return view('admin/settings', ['settings' => $settings]);
	}

	public function update(){
		$data = Request::post();
		unset($data['update-settings']);
		if(!isset($data['monitor_flag'])){
			$data['monitor_flag'] = 'off';
		}
		foreach($data as $name => $value){
			model('Settings') -> set_setting($name, $value);
		}

		return redirect('SettingsController@admin_page');
	}
}