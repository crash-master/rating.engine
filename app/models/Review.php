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

	public function get_last_reviews($count_reviews = 3){
		$reviews = arrayToArray(model('Review') -> get(['where' => ['public_flag', '=', '1'], 'order' => ['timestamp', 'DESC'], 'limit' => [0, $count_reviews]]));

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
		$order = [
			'timestamp',
			'DESC'
		];
		$reviews = arrayToArray(model('Review') -> get(['where' => ['profileid', '=', $profile_id, 'AND', 'public_flag', '=', '1'], 'order' => $order]));
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
				case 'comments': 
					$review['comments'] = model('Comment') -> get_by_with_answers('review_'.$review['id']); 
				break;
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
					if(function_exists('theme_settings')){
						$theme_settings = theme_settings();
					}
					$reviews_media_size = (isset($theme_settings) and isset($theme_settings['reviews_thumbnail_size'])) ? $theme_settings['reviews_thumbnail_size'] : 'md';
					$review['media'] = model('Media') -> get_media($review['image'], $reviews_media_size);
					$review['image'] = linkTo('MediaController@get_binary_img', ['media_id' => $review['media']['id'], 'size' => $reviews_media_size]);
				break;
			}
		}

		return $review;
	}

	public function get_review_for_edit($review_id){
		$review = $this -> get(['id', '=', $review_id]);
		$review = $this -> fields_transform($review, ['profile']);
		list($review['timestamp_date'], $review['timestamp_time']) = explode(' ', $review['timestamp']);
		return $review;
	}

}
