<?php

class API{
	public function check_api_key($api_key){
		return model('APIAuth') -> check_api_key($api_key);
	}

	public function get_profile($id){
		$siteurl = model('Meta') -> getMeta('siteurl');
		$profile = model('Profile') -> get(['where' => ['id', '=', $id, 'OR', 'slug', '=', $id]]);
		if(!$profile or $profile['public_flag'] == '0'){
			return [];
		}
		
		$profile = $this -> profile_transform($profile, $siteurl);

		$reviews = arrayToArray(model('Review') -> get(['where' => ['profileid', '=', $profile['id'], 'AND', 'public_flag', '=', '1'], 'limit' => [0, 3], 'order' => ['id', 'DESC']]));
		$count = count($reviews);
		for($i=0;$i<$count;$i++){
			$reviews[$i]['date_of_create'] = $reviews[$i]['timestamp'];
			$reviews[$i]['message'] = [
				'image_src' => $reviews[$i]['image'],
				'text' => $reviews[$i]['message']
			];
			$reviews[$i]['rating_weight'] = $reviews[$i]['rating'];

			unset($reviews[$i]['timestamp']);
			unset($reviews[$i]['user_ip']);
			unset($reviews[$i]['country']);
			unset($reviews[$i]['city']);
			unset($reviews[$i]['public_flag']);
			unset($reviews[$i]['email']);
			unset($reviews[$i]['profileid']);
			unset($reviews[$i]['rating']);
		}

		$data = [
			'profile' => $profile,
			'last_reviews' => $reviews
		];

		return $data; 
	}

	public function get_high_profiles(){
		$siteurl = model('Meta') -> getMeta('siteurl');
		$profiles = model('Profile') -> get(['where' => ['public_flag', '=', 1], 'order' => ['rating', 'DESC'], 'limit' => [0, 5]]);
        $profiles = arrayToArray($profiles);
        $count = count($profiles);
        for($i=0; $i<$count; $i++){
        	$profiles[$i]['number_txt'] = ($i < 9) ? '0' . ($i + 1) : $i + 1;
        	$profiles[$i]['number'] = $i + 1;
        	$profiles[$i] = $this -> profile_transform($profiles[$i], $siteurl);
        }

        return $profiles;
	}

	// services
	
	public function profile_transform($profile, $siteurl){
		$profile['rating'] = [
			'good' => $profile['count_like'],
			'bad' => $profile['count_dislike'],
			'neutral' => $profile['count_neutral'],
			'total' => $profile['count_like'] + $profile['count_dislike'] + $profile['count_neutral'],
			'rating_value' => $profile['rating']
		];
		$profile['date_of_create'] = $profile['timestamp'];
		$profile['number'] = model('Number') -> get_number($profile['id']);
		$profile['category'] = model('Cats') -> get(['where' => ['id', '=', $profile['catid']]]);
		$profile['category'] = $profile['category']['title'];
		$profile['site_url'] = $siteurl . linkTo('SiteController@incrementSiteVisit', ['profileid' => $profile['id']]);;
		$profile['site'] = url_without_prefix($profile['site']);
		$profile['url_to_profile'] = $siteurl . linkTo('ProfileController@page', ['slug' => $profile['slug']]);
		$tags = model('Tag') -> get_by_profile($profile['id']);
		$profile['tags'] = [];
		foreach ($tags as $tag) {
			$profile['tags'][] = [
				'title' => $tag['title'],
				'url' => $siteurl . linkTo('TagController@page', ['slug' => $tag['slug']])
			];
		}

		unset($profile['count_like']);
		unset($profile['count_dislike']);
		unset($profile['count_neutral']);
		unset($profile['timestamp']);
		unset($profile['catid']);
		unset($profile['public_flag']);
		unset($profile['count_reviews']);

		return $profile;
	}

	public function get_most_popular_api_key(){
		$api = $this -> get(['order' => ['count_request', 'DESC'], 'limit' => [0, 1]]);
		return $api;
	}

	public function get_old_api_keys(){
		$count = 5;
		$api = $this -> get(['order' => ['timestamp', 'ASC'], 'limit' => [0, $count]]);
		$old_api = [];
		for($i=0;$i<$count;$i++){
			$date_of_use = strtotime($api[$i]['timestamp']);
			$date_of_issue = strtotime($api[$i]['date_of_issue']);
			if($date_of_use - $date_of_issue > (60 * 60 * 24 * 30)){ // (60*60*24*30) - month
				$old_api[] = $api[$i];
			}
		}

		return $old_api;
	}

	public function get_json_data_for_export(){
        return [
            'sitename' => model('Meta') -> getMeta('sitename'),
            'siteurl' => model('Meta') -> getMeta('siteurl'),
            'social' => model('Meta') -> getMeta('social'),
            'cats' => arrayToArray(model('Cats') -> all()),
            'footer_links' => ['privacy-policy' => linkTo('PageController@text_page', ['pagename' => 'privacy-policy']), 'denial-of-responsibility' => linkTo('PageController@text_page', ['pagename' => 'denial-of-responsibility'])],
            'rules-for-adding-psychics' => model('Meta') -> getMeta('rules-for-adding-psychics'),
        ];
    }
}
