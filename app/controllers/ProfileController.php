<?php

/*  Automatically was generated from a template fw/templates/controller.php */
use Kernel\{
	View,
	Model,
	Request
};

class ProfileController extends \Extend\Controller{
	
	public function create_profile(){
		Request::clear();
		$data = Request::post();
		$profile = model('Profile') -> create($data);
		return json_encode(['status' => true, 'redirect-link' => linkTo('ProfileController@page', ['id' => $profile['id']])]);
	}

	public function page($slug){
		$profile = model('Profile') -> get_profile_by_slug($slug);
		if(!$profile || $profile['public_flag'] != '1'){
			return view('default/404');
		}

		$reviews = model('Review') -> get_with_comments_by_profile_id($profile['id']);
		$count_comments = model('Comment') -> get_count_comments_tree_by_profile_id($profile['id']);
		return view(\Kernel\Config::get('rating-engine -> view-template') . '/pages/profile', compact('profile', 'reviews', 'count_comments'));
	}

	public function moderation(){
		$moderation_list = model('Profile') -> get_moderation_list();
		return View::make('admin/moderation', ['moderation_list' => $moderation_list, 'profile' => true]);
	}

	public function confirm($id){
		model('Profile') -> update(['public_flag' => '1'], ['id', '=', $id]);
		model('Meta') -> incrementField('count_profiles');
		return redirect(linkTo('ProfileController@moderation'));
	}

	public function reject($id){
		model('Profile') -> remove(['id', '=', $id]);
		model('Site') -> remove(['profileid', '=', $id]);
		return redirect(linkTo('ProfileController@moderation'));
	}

	public function get_last_profiles(){
		$count_profiles = 5;
		$profiles = model('Profile') -> get_last_profiles($count_profiles);
		return ['last_added' => $profiles];
	}

	public function search($word){
		$word = urldecode($word);
		$profiles = model('Profile') -> search_request($word);

		if(!$profiles){
			return View::json(['result' => '']);
		}

		$html = View::make(\Kernel\Config::get('rating-engine -> view-template') . '/layouts/popups/search-output', ['data' => $profiles]);

		return View::json(['result' => $html, 'count' => $count]);
	}

	public function search_clean($word){
		$word = urldecode($word);
		$profiles = model('Profile') -> search_request($word);

		if(!$profiles){
			return View::json(['result' => false]);
		}

		return View::json(['result' => $profiles, 'count' => $count]);
	}

	public function search_profile_page(){
		return View::make('admin/profile_page');
	}

	public function profile_edit_page(){
		$search = $_GET['s'];
		$slug = explode('/', $search);
		$slug = $slug[count($slug) - 1];
		if(!$slug){
			return View::make('admin/profile_page');
		}
		$profile = model('Profile') -> get_profile_by_slug($slug);
		if(!$profile['site_obj']){
			model('Site') -> set(['profileid' => $profile['id'], 'count_visits' => '0']);
		}
		return View::make('admin/profile_page', ['profile' => $profile, 'tag_list' => model('Tag') -> get_tag_list()]);
	}

	public function profile_update(){
		$data = Request::post();
		$data['public_flag'] = ($data['public'] == 'on') ? '1' : '0';
		$file = $_FILES['screen']['tmp_name'];
		if($file){
			$nf = './tmp/'.basename($_FILES['screen']['name']);
			copy($file, $nf);
			include_once('app/vendor/resize.php');
			$f = images_size($nf, $nf, 600);
			$type = explode('.', $_FILES['screen']['name']);
			$type = $type[count($type) - 1];
			$d = file_get_contents($f);
			$base64 = 'data:image/' . $type . ';base64,' . base64_encode($d);
			$data['screen'] = $base64;

			// clean
			@unlink($f);
			@unlink($nf);
		}else{
			unset($data['screen']);
		}

		$data['slug'] = translit($data['name']);
		$profile_search = model('Profile') -> get(['where' => ['slug', '=', $data['slug']]]);
		if($profile_search['id'] && $profile_search['id'] != $data['mid']){
			$data['slug'] .= '_'.$data['mid'];
		}

		$data['slug'] = strtolower($data['slug']);
		// dd($data);
		model('Profile') -> update($data, ['id', '=', $data['mid']]);
		model('Site') -> update($data, ['profileid', '=', $data['mid']]);
		return redirect(linkTo('ProfileController@profile_edit_page').'?s='.$_GET['s']);
	}

	public function remove($id){
		$reviews = model('Review') -> get(['where' => ['profileid', '=', $id]]);
		$reviews = atarr($reviews);
		foreach($reviews as $key => $item){
			model('Review') -> remove($item['id']);
		}
		model('Profile') -> remove(['id', '=', $id]);
		model('Meta') -> decrementField('count_profiles');
		model('Site') -> remove(['profileid', '=', $id]);
		model('Number') -> update_numbers();
		return redirect('ProfileController@search_profile_page');
	}

	public function exist(){
		$site = $_GET['site'];
		$site = url_without_prefix($site);
		$res = model('Profile') -> get(['where' => ['site', 'LIKE', '%' . $site . '%']]);
		if($res){
			return json_encode(['result' => true]);
		}
		return json_encode(['result' => false]);
	}

	public function admin_create_new_profile_page(){
		$cats = model('Cats') -> full_list();
		return View::make('admin/create-new-profile', ['cats' => $cats]);
	}

	public function admin_create_profile(){
		Request::clear();
		$data = Request::post();
		$data['public_flag'] = '1';
		$profile = model('Profile') -> create($data);
		model('Meta') -> incrementField('count_profiles');
		$post = \Kernel\Request::post();
		$description = $data['description'];
		model('Site') -> update(['description' => $description], ['profileid', '=', $profile['id']]);
		return redirect(linkTo('ProfileController@profile_edit_page') . '?s=' . linkTo('ProfileController@page', ['slug' => $profile['slug']]));
	}
	
}