<?php

use \Kernel\Request;

class SettingsController{
	public function admin_page(){
		$settings = model('Settings') -> get_settings_list();
		foreach($settings as $i => $setting){
			$settings[$setting['name']] = $setting['value'];
		}

		$metainfo = [];
		$metainfo_fields = ['sitename', 'siteurl', 'metrica', 'description', 'extra_to_title'];
		foreach($metainfo_fields as $field){
			$mi = model('Meta') -> getMeta($field, true);
 			$metainfo[$mi['name']] = $mi['value'];
		}

		return view('admin/settings', ['settings' => $settings, 'metainfo' => $metainfo]);
	}

	public function update(){
		$data = Request::post();
		unset($data['update-settings']);
		if(!isset($data['monitor_flag'])){
			$data['monitor_flag'] = 'off';
		}

		if(!isset($data['sitemap_flag'])){
			$data['sitemap_flag'] = 'off';
		}
		foreach($data as $name => $value){
			model('Settings') -> set_setting($name, $value);
		}

		return redirect('SettingsController@admin_page');
	}
}