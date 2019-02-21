<?php

class Settings{

	private $section_name_in_option = 'user-settings';

	public function get_settings_list(){
		return model('Option') -> get_by_section_name($this -> section_name_in_option);
	}

	public function get_setting($name){
		$option = model('Option') -> get_by_name($name);
		if($option['section_name'] == $this -> section_name_in_option){
			return $option['value'];
		}

		return null;
	}

	public function set_setting_from_arr($setting){
		if(!isset($setting['about_setting'])) 
			$setting['about_setting'] = false;
		return $this -> set_setting($setting['name'], $setting['value'], $setting['about_setting']);
	}

	public function set_setting($name, $value, $about_setting = false){
		return model('Option') -> set_option($name, $value, $this -> section_name_in_option, $about_setting);
	}

}
