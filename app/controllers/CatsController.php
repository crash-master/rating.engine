<?php

/*  Automatically was generated from a template fw/templates/controller.php */
use Kernel\{
	View,
	Model
};

class CatsController extends \Extend\Controller{
    
    public function admin_page(){
        return View::make('admin/cats',[
        	'cat_list' => arrayToArray(model('Cats') -> all())
        ]);
    }

    public function add(){
    	$title = \Kernel\Request::post('title');
    	model('Cats') -> set(['title' => $title]);
    	return redirect(linkTo('CatsController@admin_page'));
    }

    public function remove($id){
    	model('Cats') -> remove(['id','=',$id]);
    	return redirect(linkTo('CatsController@admin_page'));
    }

    public function cats(){
    	return ['cat_list' => arrayToArray(model('Cats') -> all())];
    }
    
    // Other methods
    
    
}