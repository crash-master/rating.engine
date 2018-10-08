<?php

/*  Automatically was generated from a template fw/templates/model.php */

class Review extends \Extend\Model{

    public $sets;

    public function __construct(){
        $this -> sets = new \Sets\ReviewSet;
    }

    public function get_moderation_list(){
    	$reviews = arrayToArray($this -> get(['where' => ['public_flag', '=', '0'], 'order' => ['id', 'ASC']]));
        $count = count($reviews);
        for($i=0; $i<$count; $i++){
            $reviews[$i]['profile'] = model('Profile') -> get(['where' => ['id', '=', $reviews[$i]['profileid']]]);
        }

        return $reviews;
    }

    public function get_last_reviews(){
        $reviews = arrayToArray(model('Review') -> get(['where' => ['public_flag', '=', '1'], 'order' => ['id', 'DESC'], 'limit' => [0, 3]]));

        $count = count($reviews);
        for($i=0; $i<$count; $i++){
            $reviews[$i]['timestamp'] = dateFormat($reviews[$i]['timestamp']);
            $reviews[$i]['profile'] = model('Profile') -> get(['where' => ['id', '=', $reviews[$i]['profileid']]]);
            $reviews[$i]['to_profile'] = linkTo('ProfileController@page', ['slug' => $reviews[$i]['profile']['slug']]);
        }

        return $reviews;
    }

    public function remove_review($review){
        $this -> remove(['id', '=', $review['id']]);
        model('Meta') -> decrementField('count_reviews');
        model('Profile') -> rating($review, true);
        model('Comment') -> remove_by_review($review);
        model('Number') -> dump($review['profileid']);
    }

    public function get_by_profile_id($profile_id){
        $reviews = arrayToArray(model('Review') -> get(['where' => ['profileid', '=', $profile_id, 'AND', 'public_flag', '=', '1']]));
        $count = count($reviews);
        for($i=0; $i<$count; $i++){
            $reviews[$i]['country'] = ($reviews[$i]['country'] == '') ? 'Неизвестно': $reviews[$i]['country'];
            $reviews[$i]['city'] = ($reviews[$i]['city'] == '') ? 'Неизвестно': $reviews[$i]['city'];
            $reviews[$i]['timestamp'] = dateFormat($reviews[$i]['timestamp']);
        }

        return $reviews;
    }

    public function get_with_comments_by_profile_id($profile_id){
        $reviews = $this -> get_by_profile_id($profile_id);
        $count = count($reviews);
        for($i=0; $i<$count; $i++){
            $reviews[$i]['comments'] = model('Comment') -> get_by_review_id($reviews[$i]['id']);
        }

        return $reviews;
    }

}
