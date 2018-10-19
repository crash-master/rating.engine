<?php

/*  Automatically was generated from a template fw/templates/controller.php */
use Kernel\{
	View,
	Model
};

class APIController extends \Extend\Controller{
	public function profile($api_key, $id){
		if(!model('API') -> check_api_key($api_key)){
			return api_error('Bad api key');
		}

		$result = model('API') -> get_profile($id);
		return api_success($result);
	}

	public function get_iframe_top_page(){
		return view('attract/pages/dev/get-iframe-top', ['siteurl' => model('Meta') -> getMeta('siteurl')]);
	}

	public function get_iframe_profile_page(){
		$profile = model('Profile') -> first();
		$profile = model('Profile') -> profile_fields_transform($profile, ['to_profile']);
		return view('attract/pages/dev/get-iframe-profile', ['siteurl' => model('Meta') -> getMeta('siteurl'), 'default_profile' => $profile]);
	}

	public function high_profiles($api_key){
		if(!model('API') -> check_api_key($api_key)){
			return api_error('Bad api key');
		}

		$result = model('API') -> get_high_profiles();
		return api_success($result);
	}

	public function export_json_data(){
		$data = model('API') -> get_json_data_for_export();
		return json_encode($data);
	}

	public function get_iframe_top($theme){
		$profiles = model('Profile') -> get_high_list();
		foreach($profiles as $i => $profile){
			$profiles[$i] = model('Profile') -> profile_fields_transform($profile, ['to_profile', 'number_txt']);
			$profiles[$i]['number'] = $profiles[$i]['number_txt'];
		}
		$sitename = model('Meta') -> getMeta('sitename');
		$siteurl = model('Meta') -> getMeta('siteurl');

		\Kernel\Components::create('ProfileItem', ['attract/layouts/popups/search-output' => [
			'APIController@iframe_profile_item_component'
		]]);

		$theme = explode('&', $theme);
		$theme_arr = [];
		foreach($theme as $i => $val){
			list($key, $prop) = explode('=', $val);
			$theme_arr[$key] = $prop;
		}
		$theme = $theme_arr;
		return view('attract/pages/api/iframe-top', compact('sitename', 'siteurl', 'profiles', 'theme'));
	}

	public function iframe_profile_item_component($profile = null){
		return ['data' => $profile];
	}

	public function get_iframe_profile($slug, $theme){
		$profile = model('Profile') -> get_profile_by_slug($slug);
		$profile = model('Profile') -> profile_fields_transform($profile, ['reviews', 'to_profile']);
		$sitename = model('Meta') -> getMeta('sitename');
		$siteurl = model('Meta') -> getMeta('siteurl');
		$theme = explode('&', $theme);
		$theme_arr = [];
		foreach($theme as $i => $val){
			list($key, $prop) = explode('=', $val);
			$theme_arr[$key] = $prop;
		}
		$theme = $theme_arr;
		return view('attract/pages/api/iframe-profile', compact('sitename', 'siteurl', 'profile', 'theme'));
	}

	public function get_started_page(){
		return view('attract/pages/dev/get-started');
	}

	public function api_doc_page(){
		return view('attract/pages/dev/api-doc');
	}
	
}