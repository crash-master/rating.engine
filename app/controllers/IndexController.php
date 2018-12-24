<?php
use Kernel\{
	Router,
	View,
	Sess
};

class IndexController extends \Extend\Controller{

	public function _404(){
		return re_404();
	}

	public function index(){
		return view(\Kernel\Config::get('rating-engine -> view-template') . '/pages/index',[
			'sitename' => model('Meta') -> getMeta('sitename')
		]);
	}

	public function search_clean($word){
		$word = urldecode($word);
		$profiles = model('Profile') -> search_request($word);
		$articles = model('Article') -> search_request($word);

		if(!$profiles and !$articles){
			return View::json(['result' => false, 'count' => 0, 'count_profiles' => 0, 'count_articles' => 0]);
		}

		foreach($profiles as $i => $profile){
			$profiles[$i]['type'] = 'profile';
		}

		foreach($articles as $i => $article){
			$articles[$i]['type'] = 'article';
			unset($articles[$i]['thumbnail']);
		}

		$count_profiles = count($profiles);
		$count_articles = count($articles);
		$count = $count_profiles + $count_articles;

		return View::json(['result' => array_merge($profiles, $articles), 'count' => $count, 'count_profiles' => $count_profiles, 'count_articles' => $count_articles]);
	}

	public function app_init(){
		model('Meta') -> init();
		$profiles = arrayToArray(model('Profile') -> get(['where' => ['slug', '=', '']]));
		$count = count($profiles);
		for($i=0;$i<$count;$i++){
			$slug = translit($profiles[$i]['name']);
			$profile_search = model('Profile') -> get(['where' => ['slug', '=', $slug]]);
			if($profile_search['id']){
				$slug .= '_'.$profiles[$i]['id'];
			}
			model("Profile") -> update(['slug' => strtolower($slug)], ['id', '=', $profiles[$i]['id']]);
		}
		model('Number') -> init();
		model('Site') -> domen_created_init();
		return redirect('/');
	}

	public function admin_logout(){
		Sess::kill('admin');
		return redirect(linkTo('IndexController@admin_login_page'));
	}

	public function admin(){
		return redirect(linkTo('MetaController@meta_page'));
	}

	public function admin_login_page(){
		return View::make('admin/login');
	}

	public function admin_login(){
		$pass = \Kernel\Request::post('pass');
		$passdb = model('Meta') -> getMeta('password');
		$pass = sha1($pass);
		if($pass == $passdb){
			Sess::set('admin','true');
			return redirect(linkTo('IndexController@admin'));
		}
		return redirect(linkTo('IndexController@admin_login_page'));
	}

	public function moderation_page(){
		return View::make('admin/moderation');
	}

	public function transport_profile_screen_to_media(){
		$sites = model('Site') -> get(['screen', 'LIKE', '%base64%']);
		foreach($sites as $site){
			$media = model('Media');
			$file = $media -> b64_to_file($site['screen']);
			list(, $filename) = explode('media/', $file);
			$site['screen'] = $media -> set_new_media($file, $filename);
			unlink($file);
			model('Site') -> update(['screen' => $site['screen']], ['id', '=', $site['id']]);
		}

		return count($sites);
	}

	public function transport_review_image_to_media(){
		$reviews = model('Review') -> get(['image', 'LIKE', '%base64%']);
		foreach($reviews as $review){
			$media = model('Media');
			$file = $media -> b64_to_file($review['image']);
			list(, $filename) = explode('media/', $file);
			$review['image'] = $media -> set_new_media($file, $filename);
			unlink($file);
			model('Review') -> update(['image' => $review['image']], ['id', '=', $review['id']]);
		}

		return count($reviews);
	}

}
