<?php

/*  Automatically was generated from a template fw/templates/controller.php */
use Kernel\{
	View,
	Model
};

class SidebarController extends \Extend\Controller{
    
    public function get_sidebar_content(){
    	$last_comments = model('Comment') -> get_last_comments();
    	return ['last_comments' => $last_comments];
    }
}