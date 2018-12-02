<?php

/*  Automatically was generated from a template fw/templates/controller.php */
use Kernel\{
	View,
	Model
};

class MediaController extends \Extend\Controller{
    
    public function admin_page($page_num = 1){
    	$count_on_page = 20;
    	$media = model('Media') -> get_media_list('xs', $count_on_page, $page_num);
    	$pagination = model('Media') -> get_pagination($count_on_page, $page_num);
    	return view('admin/media', ['media_list' => $media, 'pagination' => $pagination]);
    }

    public function remove($media_id){
    	model('Media') -> remove_media($media_id);
    	return redirect('MediaController@admin_page', ['page_num' => 1]);
    }

    public function get_img_preview($media_id){
    	$media = model('Media') -> get_media($media_id, 'lg');
    	return model('Media') -> get_src($media);
    }
    
}