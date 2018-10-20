<?php

/*  Automatically was generated from a template fw/templates/controller.php */
use Kernel\{
	View,
	Model
};

class RecomendedController extends \Extend\Controller{
    public function get_recomended(){
    	$recomended_list = model('Recomended') -> get_recomended_list(3);
    	return ['recomended_list' => $recomended_list];
    }

    public function admin_page(){
    	$recomended_list = model('Recomended') -> get_recomended_list();
    	return view('admin/recomended', ['recomended_list' => $recomended_list]);
    }

    public function add_new_profile(){
    	$data = \Kernel\Request::post();
    	$slug = explode('/', $data['profile_url']);
    	$slug = $slug[count($slug) - 1];
    	$profile = model('Profile') -> get(['slug' ,'=', $slug]);
    	model('Recomended') -> set(['profileid' => $profile['id']]);
    	return redirect(linkTo('RecomendedController@admin_page'));
    }

    public function remove($profileid){
    	model('Recomended') -> remove(['profileid', '=', $profileid]);
    	return redirect(linkTo('RecomendedController@admin_page'));
    }
    
}