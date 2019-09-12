<?php

/*  Automatically was generated from a template fw/templates/controller.php */
use Kernel\{
	View,
	Model,
    Request
};

class CommentController extends \Extend\Controller{
    
    public function moderation(){
    	$moderation_list = model('Comment') -> get_moderation_list();
    	return View::make('admin/moderation', ['moderation_list' => $moderation_list, 'comment' => true]);
    }

    public function create(){
        \Kernel\Request::clear();
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
        }elseif(isset($post['articleid']) and $post['articleid'] != 0){
            $link = 'article_'.$post['articleid'];
            unset($post['profileid']);
            unset($post['reviewid']);
            unset($post['commentid']);
        }

        model('Comment') -> create($post, $link);
        return true; // call this action from ajax
    }

    public function confirm($id){
    	model('Comment') -> update(['public_flag' => '1'], ['id', '=', $id]);
    	return redirect(linkTo('CommentController@moderation'));
    }

    public function reject($id){
    	model('Comment') -> remove_comment($id);
    	return redirect(linkTo('CommentController@moderation'));
    }

    public function remove($id){
        model('Comment') -> remove_comment($id);
        return redirect('IndexController@index');
    }

    public function createCommentForm($profileid = 0, $commentid = 0){
        return ['profileid' => $profileid, 'commentid' => $commentid];
    }

    public function comments($profileid = false, $articleid = false){
        if($profileid){
            $comments = model('Comment') -> get_by_profile_id($profileid);
        }
        
        if($articleid){
            $comments = model('Comment') -> get_by_article_id($articleid);
        }

        return ['comments' => $comments];
    }

    public function edit_comment_page($comment_id){
        $comment_for_edit = model('Comment') -> get_comment_by_id($comment_id);
        list($comment_for_edit['timestamp_date'], $comment_for_edit['timestamp_time']) = explode(' ', $comment_for_edit['timestamp']);
        return view('admin/comment-edit', [
            'comment' => $comment_for_edit
        ]);
    }

    public function update_comment(){
        $post = Request::post();
        $post['timestamp'] = $post['timestamp_date'] . ' ' . $post['timestamp_time'];
        model('Comment') -> update($post, ['id', '=', $post['comment_id']]);
        return redirect(linkTo('CommentController@edit_comment_page', ['comment_id' => $post['comment_id']]));
    }
    
    
}