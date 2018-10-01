<?php

/*  Automatically was generated from a template fw/templates/controller.php */
use Kernel\{
	View,
	Model
};

// TextBlocksController
class TBController extends \Extend\Controller{
    
    public function admin_page(){
        return View::make('admin/tb', ['tb_list' => model('Meta') -> getTextBlocksList()]);
    }

    public function tb_edit_page($blockname){
    	return View::make('admin/tb', [
    		'tb_list' => model('Meta') -> getTextBlocksList(),
    		 'tblock' => model('Meta') -> getMeta($blockname),
    		 'blockname' => $blockname
    		]);
    }

    public function update(){
    	$block = \Kernel\Request::post('content');
    	$blockname = \Kernel\Request::post('blockname');
    	model('Meta') -> updateMeta($blockname, $block);
    	return redirect(linkTo('TBController@tb_edit_page', ['blockname' => $blockname]));
    }
    
    // Other methods
    
    
}