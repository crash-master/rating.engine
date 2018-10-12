<?php

/*  Automatically was generated from a template fw/templates/model.php */

class Meta extends \Extend\Model{

	public $sets;
	public $metaCache = [];

	public function __construct(){
		$this -> sets = new \Sets\MetaSet;
	}

	public function getMeta($name, $arr_flag = false){
		$meta = $this -> get(['where' => ['meta_name', '=', $name]]);
		if(isset($meta['meta_name'])){
			if(!$arr_flag){
				return $meta['meta_value'];
			}else{
				return $meta;
			}
		}

		return false;
	}

	public function setMeta($name, $val){
		return $this -> set(['meta_name' => $name, 'meta_value' => $val]);
	}

	public function updateMeta($name, $val){
		return $this -> update(['meta_name' => $name, 'meta_value' => $val], ['meta_name', '=', $name]);
	}

	public function removeMeta($name){
		return $this -> remove(['meta_name', '=', $name]);
	}

	public function allMeta(){
		return $this -> all();
	}

	public function issetMeta($name){
		if(!count($this -> metaCache)){
			$all = $this -> allMeta();
			$this -> metaCache = $all;
		}else{
			$all = $this -> metaCache;
		}

		foreach($all as $i => $item){
			if($item['meta_name'] == $name){
				return true;
			}
		}

		return false;
	}

	public function init(){
		
		$base = require('app/basemetadata.php');

		foreach($base as $name => $val){
			if($this -> issetMeta($name)){
				continue;
			}
			$this -> setMeta($name, $val);
		}

		return true;
	}

	public function get_title($pagename){
		
	}

	public function get_keywords($pagename){
		
	}

	public function get_description($pagename){
		
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

	// public function get_main_pages(){
	//    $pages = json_decode($this -> getMeta('main-pages'), true);
	//    $mainpagelist = array_keys($pages);
	//    return ['mainPageList' => $mainpagelist, 'mainpages' => $pages];
	// }

}
