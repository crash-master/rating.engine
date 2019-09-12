<?php

/*  Automatically was generated from a template fw/templates/model.php */

class ImgsMeta extends \Extend\Model{

	public $sets;

	public function __construct(){
		$this -> sets = new \Sets\ImgsMetaSet;
	}

	public function get_alt($img_storage_id){
		$meta = model('ImgsMeta') -> get(['img_storage_id', '=', $img_storage_id]);
		return $meta['alt'] ? $meta['alt'] : '';
	}

}
