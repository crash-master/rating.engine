<?php

/*  Automatically was generated from a template fw/templates/controller.php */
use Kernel\{
	View,
	Model
};

class MediaController extends \Extend\Controller{
    
    public function admin_page($page_num = 1){
    	$count_on_page = 20;
    	$media = model('Media') -> get_media_list('sm', $count_on_page, $page_num);
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

    public function get_binary_img($media_id, $size = 'md'){
        $media = model('Media') -> get_binary($media_id, $size);
        header('Content-type:image/' . $media['format']);
        return $media['bin'];
    }

    public function get_all_media_list(){
        $media = model('Media') -> get_all_media_list();
        $media = model('Media') -> transform_binary_links($media, 'xs');
        return View::json($media);
    }

    public function upload_media(){
        if(isset($_FILES['media_file'])){
            model('Media') -> set_new_media($_FILES['media_file']['tmp_name'], $_FILES['media_file']['name']);
        }

        return redirect('MediaController@admin_page');
    }
    
}