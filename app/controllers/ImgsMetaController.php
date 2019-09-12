<?php

/*  Automatically was generated from a template fw/templates/controller.php */
use Kernel\{
	View,
	Model,
	Request
};

class ImgsMetaController extends \Extend\Controller{
	public function ajax_update(){
		/* $post must be ['img_storage_id' => (int), 'alt' => (string)] */
		$post = Request::post();
		$where = ['img_storage_id', '=', $post['img_storage_id']];
		if(model('ImgsMeta') -> length($where)){
			model('ImgsMeta') -> update($post, $where);
		}else{
			model('ImgsMeta') -> set($post);
		}
		return true;
	}
}