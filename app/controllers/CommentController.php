<?php

/*  Automatically was generated from a template fw/templates/controller.php */
use Kernel\{
	View,
	Model
};

class CommentController extends \Extend\Controller{
    
    public function moderation(){
    	$moderation_list = model('Comment') -> get_moderation_list();
    	return View::make('admin/moderation', ['moderation_list' => $moderation_list, 'comment' => true]);
    }

    public function create(){
    	$post = \Kernel\Request::post();
    	$post['public_flag'] = '0';
    	model('Comment') -> set($post);
    }

    public function confirm($id){
    	model('Comment') -> update(['public_flag' => '1'], ['id', '=', $id]);
    	model('Meta') -> incrementField('count_comments');
    	return redirect(linkTo('CommentController@moderation'));
    }

    public function reject($id){
    	$comment = model('Comment') -> get(['where' => ['id', '=', $id]]);
    	model('Comment') -> remove(['id', '=', $id]);
    	return redirect(linkTo('CommentController@moderation'));
    }

    public function remove($id){

    }
    
    
}