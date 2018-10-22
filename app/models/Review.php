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
			$reviews[$i] = $this -> fields_transform($reviews[$i], ['profile', 'media', 'to_profile']);
		}

		return $reviews;
	}

	public function get_last_reviews(){
		$reviews = arrayToArray(model('Review') -> get(['where' => ['public_flag', '=', '1'], 'order' => ['id', 'DESC'], 'limit' => [0, 3]]));

		$count = count($reviews);
		for($i=0; $i<$count; $i++){
			$reviews[$i] = $this -> fields_transform($reviews[$i], ['timestamp', 'profile', 'to_profile']);
		}

		return $reviews;
	}

	public function remove_review($review){
		$this -> remove(['id', '=', $review['id']]);
		model('Profile') -> rating($review, true);
		model('Comment') -> remove_by_review($review);
		model('Media') -> remove(['id', '=', $review['image']]);
	}

	public function get_by_profile_id($profile_id){
		$reviews = arrayToArray(model('Review') -> get(['where' => ['profileid', '=', $profile_id, 'AND', 'public_flag', '=', '1']]));
		$count = count($reviews);
		for($i=0; $i<$count; $i++){
			$reviews[$i] = $this -> fields_transform($reviews[$i], ['country', 'city', 'timestamp', 'media']);
		}

		return $reviews;
	}

	public function get_with_comments_by_profile_id($profile_id){
		$reviews = $this -> get_by_profile_id($profile_id);
		$count = count($reviews);
		for($i=0; $i<$count; $i++){
			$reviews[$i] = $this -> fields_transform($reviews[$i], ['comments']);
		}

		return $reviews;
	}

	public function fields_transform($review, $fields){
		foreach($fields as $field){
			switch($field){
				case 'comments': $review['comments'] = model('Comment') -> get_by_review_id($review['id']); break;
				case 'timestamp': $review['timestamp'] = dateFormat($review['timestamp']); break;
				case 'city': $review['city'] = ($review['city'] == '') ? 'Неизвестно': $review['city']; break;
				case 'country': $review['country'] = ($review['country'] == '') ? 'Неизвестно': $review['country']; break;
				case 'profile': $review['profile'] = model('Profile') -> get(['where' => ['id', '=', $review['profileid']]]); break;
				case 'to_profile': 
					if(!isset($review['profile'])){
						$this -> fields_transform($review, ['profile']);
					}
					$review['to_profile'] = linkTo('ProfileController@page', ['slug' => $review['profile']['slug']]);
				break;
				case 'media': 
					if(empty($review['image']) or strpos($review['image'], 'base64')){
						break;
					}
					$review['media'] = model('Media') -> get_media($review['image'], 'sm');
					$review['image'] = model('Media') -> get_src($review['media']);
				break;
			}
		}

		return $review;
	}

}
