<?php

/*  Automatically was generated from a template fw/templates/model.php */

class Profile extends \Extend\Model{

	public $sets;

	public function __construct(){
		$this -> sets = new \Sets\ProfileSet;
	}

	public function create($data){
		$data['timestamp'] = 'NOW()';
		$slug = translit($data['name']);
		list(,$site) = explode("://", $data['site']);
		list($site) = explode("/", $site);
		if($this -> length(['site', 'LIKE', '%' . $site . '%'])){
			die("Site like this, already exists");
		}
		$this -> set($data);
		$profile = $this -> get(['where' => ['site', '=', $data['site']]]);
		$profile_search = $this -> get(['where' => ['slug', '=', $slug]]);
		if($profile_search['id']){
			$slug .= '_'.$profile['id'];
		}
		$this -> update(['slug' => strtolower($slug)], ['id', '=', $profile['id']]);

		model('Site') -> create($profile['id'], $profile['site']);
		$profile['slug'] = $slug;
		return $profile;
	}

	public function search_request($request){
		$profiles = arrayToArray(model('Profile') -> get(['where' => ['name', 'LIKE', '%'.$request.'%', 'OR', 'site', 'LIKE', '%'.$request.'%'], 'limit' => [0, 5]]));
		$count = count($profiles);
		$profiles_public = [];
		for($i=0; $i<$count; $i++){
			if($profiles[$i]['public_flag'] == '0'){
				return false;
			}
			$profiles_public[$i] = $this -> fields_transform($profiles[$i], ['to_profile', 'site', 'timestamp', 'number', 'number_txt']);
		}

		return $profiles_public;
	}

	public function get_last_profiles($count_profiles){
		$profiles = arrayToArray($this -> get(['where' => ['public_flag','=','1'], 'order' => ['id','DESC'], 'limit' => [0, $count_profiles]]));
		$count = count($profiles);
		for($i=0; $i<$count; $i++) {
			$profiles[$i] = $this -> fields_transform($profiles[$i], ['site', 'timestamp', 'site_link']);
		}

		return $profiles;
	}

	public function fields_transform($profile, $fields){
		foreach($fields as $field){
			switch($field){
				case 'site_link': $profile['site_link'] = linkTo('SiteController@incrementSiteVisit', ['profileid' => $profile['id']]); break;
				case 'timestamp': $profile['timestamp'] = dateFormat($profile['timestamp']); break;
				case 'site_obj': $profile['site_obj'] = model('Site') -> get(['where' => ['profileid', '=', $profile['id']]]); break;
				case 'cat': $profile['cat'] = model('Cats') -> get(['where' => ['id', '=', $profile['catid']]]); break;
				case 'site': $profile['site'] = url_without_prefix($profile['site']); break;
				case 'to_profile': $profile['to_profile'] = model('Meta') -> getMeta('siteurl') . linkTo('ProfileController@page', ['slug' => $profile['slug']]); break;
				case 'domen_created': $profile['site_obj']['domen_created'] = dateFormat($profile['site_obj']['domen_created']); break;
				case 'number': $profile['number'] = model('Number') -> get_number($profile['id']); break;
				case 'number_txt': $profile['number_txt'] = model('Number') -> get_number($profile['id']);
					$profile['number_txt'] = ($profile['number_txt'] < 9) ? '0' . $profile['number_txt'] : $profile['number_txt'];
				break;
				case 'tags': $profile['tags'] = model('Tag') -> get_by_profile($profile); break;
				case 'count_comments': $profile['count_comments'] = model('Comment') -> get_count_comments_tree_by_profile_id($profile['id']); break;
				case 'reviews': $profile['reviews'] = model('Review') -> get_by_profile_id($profile['id']); break;
				case 'media': $profile = $this -> get_profile_media($profile, 'sm'); break;
				case 'media_md': $profile = $this -> get_profile_media($profile, 'md'); break;
				case 'media_lg': $profile = $this -> get_profile_media($profile, 'lg'); break;
				case 'media_sm': $profile = $this -> get_profile_media($profile, 'sm'); break;
				case 'media_xs': $profile = $this -> get_profile_media($profile, 'xs'); break;
				case 'category': $profile['category'] = model('Cats') -> get_cat_by_id($profile['catid']); break;
			}
		}

		return $profile;
	}
 
	public function get_profile_media($profile, $size = 'sm'){
		if(!isset($profile['site_obj'])){
			$profile = $this -> fields_transform($profile, ['site_obj']);
		}
		if(empty($profile['site_obj']['screen']) or strpos($profile['site_obj']['screen'], 'base64')){
			return $profile;
		}
		$profile['media'] = model('Media') -> get_media($profile['site_obj']['screen'], $size);
		$profile['site_obj']['screen'] = linkTo('MediaController@get_binary_img', ['media_id' => $profile['media']['id'], 'size' => $size]);
		return $profile;
	}

	function get_profile_by_slug($slug){
		$profile = model('Profile') -> get(['where' => ['slug', '=', $slug]]);
		if(!$profile){
			return false;
		}
		if(function_exists('theme_settings')){
			$theme_settings = theme_settings();
		}
		$profile_media_size = (isset($theme_settings) and isset($theme_settings['profile_thumbnail_size'])) ? 'media_' . $theme_settings['profile_thumbnail_size'] : 'media_md';
		$profile['timestamp_src'] = $profile['timestamp'];
		list($profile['timestamp_date'], $profile['timestamp_time']) = explode(' ', $profile['timestamp_src']);
		$profile = $this -> fields_transform($profile, ['site_link', 'timestamp', 'site_obj', 'cat', 'site', 'number_txt', 'number', 'tags', $profile_media_size, 'category']);
		if(array_key_exists('domen_created', $profile['site_obj']) and $profile['site_obj']['domen_created'] != "Неизвестно"){
			$profile['site_obj']['domen_created_date'] = date('Y-m-d', $profile['site_obj']['domen_created']);
			$profile['site_obj']['domen_created_time'] = date('H:i:s', $profile['site_obj']['domen_created']);
		}
		$profile = $this -> fields_transform($profile, ['domen_created']);
		model('Profile') -> update(['count_views' => $profile['count_views'] + 1], ['slug', '=', $slug]);
		model('Meta') -> incrementField('count_profile_views');

		return $profile;
	}

	public function get_moderation_list(){
		$data = arrayToArray($this -> get(['where' => ['public_flag','=',0], 'order' => ['id', 'ASC']]));
		$count = count($data);
		for($i=0;$i<$count;$i++){
			$data[$i]['site'] = linkToLink($data[$i]['site']);
			$data[$i]['site_obj'] = model('Site') -> get(['where' => ['profileid', '=', $data[$i]['id']]]);
		}
		return $data;
	}

	public function get_by_id($profileid){
		$profile = $this -> fields_transform(model('Profile') -> get(['id', '=', $profileid]), ['to_profile']);
		return $profile;
	}

	public function get_high_list(){
		$count_profiles = model('Settings') -> get_setting('count_profiles_on_high_block');
		$data = model('Profile') -> get(['where' => ['public_flag', '=', 1], 'order' => ['rating', 'DESC'], 'limit' => [0, $count_profiles]]);
		$data = arrayToArray($data);
		$count = count($data);
		for($i=0; $i<$count; $i++){
			$data[$i]['number'] = ($i < 9) ? '0' . ($i + 1) : $i + 1;
			$data[$i]['site_link'] = linkTo('SiteController@incrementSiteVisit', ['profileid' => $data[$i]['id']]);
			$data[$i]['site'] = url_without_prefix($data[$i]['site']);
			$data[$i]['timestamp'] = dateFormat($data[$i]['timestamp']);
		}

		return $data;
	}

	public function get_profiles_by_cat_slug($cat_slug, $page_num = 1){
		$count_on_page = model('Settings') -> get_setting('count_profiles_on_page');
		$profile_ids = model('Cats') -> get_profile_ids_by_cat_slug($cat_slug);
		$query_str = "('" . implode ( "','", $profile_ids ) . "')";
        $where = ['public_flag', '=', '1', 'AND', 'id', 'IN', $query_str];
        $order = ['id', 'DESC'];
        $limit = [$count_on_page * $page_num, $count_on_page];
        $profiles = atarr($this -> get(['where' => $where, 'order' => $order, 'limit' => $limit]));
        foreach($profiles as $inx => $profile){
        	$profiles[$inx] = $this -> fields_transform($profiles[$inx], ['tags', 'site_obj', 'to_profile', 'media_sm']);
        }

        return $profiles;
	}

	public function get_count_published_profiles($cat_id){
		if(!$cat_id){
			return $this -> length(['public_flag', '=', '1']);
		}

        $len = $this -> length(['public_flag', '=', '1', 'AND', 'catid', '=', $cat_id]);
        return $len;
	}

	public function get_all_profiles_for_map(){
		$rows = [
			'slug', 'timestamp'
		];

		$profiles = $this -> get(['rows' => $rows]);
		foreach($profiles as $i => $profile){
			$profiles[$i]['loc'] = linkTo('ProfileController@page', ['slug' => $profile['slug']]);
			list($profiles[$i]['lastmod']) = explode(' ', $profile['timestamp']);
			unset($profiles[$i]['slug']);
			unset($profiles[$i]['timestamp']);
		}

		return count($profiles) ? $profiles : [];
	}


		/////// RATING ///////

	/**
	 * [rating description]
	 *
	 * @param  [array] $review [model object]
	 * @param  [type] $profileid [description]
	 *
	 * @return [type] [description]
	 */
	public function rating($review, $removeFlag = false){
		$profileid = $review['profileid'];
		switch($review['rating']){
			case '-1': $this -> rating_minus($profileid, $removeFlag); break;
			case '1': $this -> rating_plus($profileid, $removeFlag); break;
			case '0': $this -> rating_neutral($profileid, $removeFlag); break;
		}
		model('Number') -> update_numbers();
	}

	public function rating_plus($profileid, $removeFlag){
		$profile = model('Profile') -> get(['where' => ['id', '=', $profileid]]);
		if(!$removeFlag){
			$newProfileRating = intval($profile['rating']) + 1;
			$newCount = intval($profile['count_like']) + 1;
		}else{
			$newProfileRating = intval($profile['rating']) - 1;
			$newCount = intval($profile['count_like']) - 1;
		}

		$data = [
			'rating' => $newProfileRating,
			'count_like' => $newCount
		];
		model('Profile') -> update($data, ['id', '=', $profileid]);
	}

	public function rating_minus($profileid, $removeFlag){
		$profile = model('Profile') -> get(['where' => ['id', '=', $profileid]]);
		if(!$removeFlag){
			$newProfileRating = intval($profile['rating']) - 1;
			$newCount = intval($profile['count_dislike']) + 1;
		}else{
			$newProfileRating = intval($profile['rating']) + 1;
			$newCount = intval($profile['count_dislike']) - 1;
		}

		$data = [
			'rating' => $newProfileRating,
			'count_dislike' => $newCount
		];
		model('Profile') -> update($data, ['id', '=', $profileid]);
	}

	public function rating_neutral($profileid, $removeFlag){
		$profile = model('Profile') -> get(['where' => ['id', '=', $profileid]]);
		if(!$removeFlag){
			$newCount = intval($profile['count_neutral']) + 1;
		}else{
			$newCount = intval($profile['count_neutral']) - 1;
		}

		$data = [
			'count_neutral' => $newCount
		];
		model('Profile') -> update($data, ['id', '=', $profileid]);
	}

	public function get_rating_list($order, $limit = false, $count_on_page = false){
		if($count_on_page){
			$data = arrayToArray(model('Profile') -> get(['where' => ['public_flag','=','1'], 'order' => [$order,'DESC'], 'limit' => [$limit, $count_on_page]]));
		}else{
			$data = arrayToArray(model('Profile') -> get(['where' => ['public_flag','=','1'], 'order' => [$order,'DESC']]));
		}
		$count = count($data);
		for($i=0; $i<$count; $i++){
			$data[$i] = $this -> fields_transform($data[$i], ['timestamp', 'number', 'number_txt', 'site_link', 'site', 'to_profile', 'site_obj', 'cat', 'count_comments']);
			if(!$data[$i]['site_obj']){
				$data[$i]['site_obj'] = false;
			}else{
				$data[$i]['site_obj']['screen'] = '';
			}
		}
		return $data;
	}

}
