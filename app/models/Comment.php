<?php

/*  Automatically was generated from a template fw/templates/model.php */

class Comment extends \Extend\Model{

    public $sets;

    public function __construct(){
        $this -> sets = new \Sets\CommentSet;
    }

    public function get_moderation_list(){
    	$comments = arrayToArray($this -> get(['where' => ['public_flag', '=', '0']]));
    	$count = count($comments);
    	for($i=0;$i<$count;$i++){
    		$comments[$i]['review'] = model('Review') -> get(['where' => ['id', '=', $comments[$i]['reviewid']]]);
    		$comments[$i]['profile'] = model('Profile') -> get(['where' => ['id', '=', $comments[$i]['review']['profileid']]]);
    	}

    	return $comments;
    }

    public function get_by_review_id($review_id){
        $link = 'review_'.$review_id;
    	return $this -> get_by($link);
    }

    public function get_by($link){
        $comments = model('Comment_link') -> get_comments_by_link($link);
        $count_comments = count($comments);
        for($i=0;$i<$count_comments;$i++){
            $comments[$i]['timestamp'] = dateFormat($comments[$i]['timestamp']);
        }

        return $comments;
    }

    public function remove_by_review($review){
    	$comments = $this -> get_by_review_id($review['id']);
        foreach($comments as $comment){
            $this -> remove_comment($comment['id']);
        }
        return true;
    }

    public function remove_comment($comment){
        $id = is_array($comment) ? $comment['id'] : $comment;
        $linked_comments = model('Comment_link') -> remove_by_srcid($id);
        $this -> remove(['id', '=', $id]);
        foreach($linked_comments as $lined_comment){
            $id = ltrim($lined_comment, 'comment_');
            $this -> remove(['id', '=', $id]);
            model('Meta') -> decrementField('count_comments');
        }
        model('Meta') -> decrementField('count_comments');
        return true;
    }

    /**
     * [create new comment with link]
     *
     * @param  [array] $data [comment data]
     * @param  [string] $linkname [review or profile or comment or route]
     *
     * @return [bool] [description]
     */
    public function create($data, $link = false){
        $this -> set($data);
        $cur_comment = $this -> get(['name', '=', $data['name'], 'AND', 'message', '=', $data['message']]);
        if($link){
            model('Comment_link') -> create_link($cur_comment['id'], $link);
        }
        return true;
    }

    public function get_by_profile_id($profile_id){
        $link = 'profile_'.$profile_id;
        $comments = $this -> get_by($link);
        $res_comments = [];
        foreach($comments as $comment){
            $res_comments[] = $comment;
            $link = 'comment_' . $comment['id'];
            $comments_answers = $this -> get_by($link);
            foreach($comments_answers as $answer){
                $answer['answer_flag'] = true;
                $res_comments[] = $answer;
            }
        }

        return $res_comments;
    }

    public function get_count_comments_tree_by_profile_id($profile_id){
        $link = 'profile_' . $profile_id;
        return model('Comment_link') -> get_count_comments_tree_by_link($link);
    }

    public function get_last_comments(){
        $link_type = 'profile';
        $links = model('Comment_link') -> get_last_links_by_link_type($link_type, 5);
        $src = [];
        foreach ($links as $link) {
            $src[] = $link['srcid'];
        }
        $comments_query_str = "('" . implode ( "','", $src ) . "')";
        $comments = atarr($this -> get(['public_flag', '=', '1', 'AND', 'id', 'IN', $comments_query_str]));
        $count = count($comments);
        $res_comments = [];
        for($i=$count-1, $c=0; $i>=0; $i--, $c++){
            list(, $profileid) = explode('_', $links[$c]['link']);
            $res_comments[$c] = $comments[$i];
            $res_comments[$c]['profile'] = model('Profile') -> get_by_id($profileid);
            $res_comments[$c]['timestamp'] = dateFormat($res_comments[$c]['timestamp']);
        }
        return $res_comments;
    }
    

}
