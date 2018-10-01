<?php

/*  Automatically was generated from a template fw/templates/model.php */

class Comment extends \Extend\Model{

    public $sets;

    public function __construct(){
        $this -> sets = new \Sets\CommentSet;
    }

    public function get_moderation_list(){
    	$comments = arrayToArray(model('Comment') -> get(['where' => ['public_flag', '=', '0']]));
        if($comments[0] === false){
            $comments = [];
        }
    	$count = count($comments);
    	for($i=0;$i<$count;$i++){
    		$comments[$i]['review'] = model('Review') -> get(['where' => ['id', '=', $comments[$i]['reviewid']]]);
    		$comments[$i]['profile'] = model('Profile') -> get(['where' => ['id', '=', $comments[$i]['review']['profileid']]]);
    	}

    	return $comments;
    }

    public function get_by_review_id($review_id){
    	$comments = arrayToArray(model('Comment') -> get(['where' => ['reviewid', '=', $review_id, 'AND', 'public_flag', '=', '1']]));
        if($comments[0] === false){
            $comments = [];
        }
        $count_comments = count($comments);
        for($i=0;$i<$count_comments;$i++){
            $comments[$i]['timestamp'] = dateFormat($comments[$i]['timestamp']);
        }

        return $comments;
    }

    public function remove_by_review($review){
    	$comments = $this -> get_by_review_id($review['id']);
    	$count = count($comments);
    	if($count){
    		model('Comment') -> remove(['reviewid', '=', $review['id']]);
    	}
        for($i=0;$i<$count;$i++){
            model('Meta') -> decrementField('count_comments');
        }
    }

    public function remove_comment($comment){

    }

}
