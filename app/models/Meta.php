<?php

/*  Automatically was generated from a template fw/templates/model.php */

class Meta extends \Extend\Model{

	private $section_name = 'meta_info';

	public function getMeta($name, $arr_flag = false){
		if($arr_flag){                
			$option = model('Option') -> get_by_name($name);
			if($option['section_name'] == $this -> section_name){
				return $option;
			}

			return [];
		}

		$option = model('Option') -> get_option($name);

		return $option;
	}

	public function setMeta($name, $value, $about_meta = false){
		return model('Option') -> set_option($name, $value, $this -> section_name, $about_meta);
	}

	public function updateMeta($name, $val, $about_meta = false){
		return $this -> setMeta($name, $val, $about_meta);
	}

	public function allMeta(){
		return $this -> all();
	}

	public function getTextBlocksList(){
		return json_decode($this -> getMeta('text-blocks'), true);
	}

	public function incrementField($meta_name){
		$num = intval($this -> getMeta($meta_name));
		$num++;
		$this -> updateMeta($meta_name, $num);
	}

	public function decrementField($meta_name){
		$num = intval($this -> getMeta($meta_name));
		$num--;
		$this -> updateMeta($meta_name, $num);
	}

	public function set_meta_from_arr($meta){
		if(!isset($meta['about_option'])) 
			$meta['about_option'] = false;
		return $this -> setMeta($meta['name'], $meta['value'], $meta['about_option']);
	}

}
