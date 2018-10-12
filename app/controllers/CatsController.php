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
    	$post = \Kernel\Request::post();
    	model('Cats') -> set($post);
    	return redirect(linkTo('CatsController@admin_page'));
    }

    public function remove($id){
    	model('Cats') -> remove(['id','=',$id]);
    	return redirect(linkTo('CatsController@admin_page'));
    }

    public function cats(){
    	return ['cat_list' => arrayToArray(model('Cats') -> all())];
    }

    public function update($id, $colname, $val){
        return model('Cats') -> update([$colname => urldecode($val)], ['id', '=', $id]);
    }
    
    // Other methods
    
    
}