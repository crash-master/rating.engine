<?php

/*  Automatically was generated from a template fw/templates/model.php */

class Route_meta extends \Extend\Model{

	public $sets;

	public function __construct(){
		$this -> sets = new \Sets\Route_metaSet;
	}

	public function get_by_route($route){
		return $this -> get(['route', '=', $route]);
	}

	public function get_by_page_id($page_id){
		return $this -> get(['page_id', '=', $page_id]);
	}

}
