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
        if(isset($post['profileid']) and $post['profileid'] != 0){
            $link = 'profile_'.$post['profileid'];
            unset($post['reviewid']);
            unset($post['commentid']);
        }elseif(isset($post['reviewid']) and $post['reviewid'] != 0){
            $link = 'review_'.$post['reviewid'];
            unset($post['profileid']);
            unset($post['commentid']);
        }elseif(isset($post['commentid']) and $post['commentid'] != 0){
            $link = 'comment_'.$post['commentid'];
            unset($post['profileid']);
            unset($post['reviewid']);
        }

        model('Comment') -> create($post, $link);
        return true; // call this action from ajax
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
        model('Comment') -> remove_comment($id);
        return redirect('IndexController@index');
    }

    public function createCommentForm($profileid = 0, $commentid = 0){
        return ['profileid' => $profileid, 'commentid' => $commentid];
    }

    public function comments($profileid = 0, $commentid = 0){
        if($profileid){
            $comments = model('Comment') -> get_by_profile_id($profileid);
        }

        return ['comments' => $comments];
    }
    
    
}