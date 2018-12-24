<?php

/*  Automatically was generated from a template fw/templates/model.php */

class Site extends \Extend\Model{

	public $sets;

	public function __construct(){
		$this -> sets = new \Sets\SiteSet;
	}

	public function get_site_obj_by_profile_id($profile_id){
		$site_obj = $this -> get(['profileid', '=', $profile_id]);

		return $site_obj;
	}

	public function create($profileid){
		$profile = model('Profile') -> get(['id', '=', $profileid]);
		$site_url = $profile['site'];

		$site_link = linkToLink($site_url);
		$site = $this -> getMetaDataFromSite($site_link);
		$site['profileid'] = $profile['id'];
		$this -> set($site);
		$site = $this -> last();
		$this -> domen_created($profile); // domen_created
		$this -> make_site_screen($site['id']);
	}

	public function getMetaDataFromSite($url){
		include_once("./app/vendor/simple_html_dom.php");
		$html = @file_get_contents($url);
		if(!$html){
			return [
				'title' => 'Неизвестно',
				'description' => 'Неизвестно',
				'keywords' => 'Неизвестно',
				'favicon' => 'Неизвестно'
			];
		}
		$dom = str_get_html($html);
		$title = '';
		$title = $dom -> find('title', 0);
		if($title){
			 $title = mb_strimwidth($title -> innertext, 0, 250, "...");
		}
		$description = '';
		$keywords = '';
		$favicon = '';
		try{
			$description = $dom -> find('meta[name="description"]', 0);
			if($description){
				 $description = mb_strimwidth($description -> getAttribute('content'), 0, 250, "...");
			}
			$keywords = $dom -> find('meta[name="keywords"]', 0);
			if($keywords){
				 $keywords = mb_strimwidth($keywords -> getAttribute('content'), 0, 250, "...");
			}
			$favicon = $dom -> find('link[rel="icon"]', 0);
			if($favicon){
				 $favicon = $favicon -> getAttribute('href');

				if(strstr($favicon, 'http') === false){
					$favicon = $url . $favicon;
				}
			}
		}catch (Exception $e){

		}
		return [
			'title' => $title,
			'description' => $description,
			'keywords' => $keywords,
			'favicon' => $favicon
		];
	}

	 public function domen_created($profile){ // domen_created
		$domen = urlencode(url_without_prefix($profile['site']));
		$url = 'http://api.whois.vu/?q='.$domen;
		$result = json_decode(file_get_contents($url), true);
		if($result['created']){
			$this -> update(['domen_created' => $result['created']], ['profileid', '=', $profile['id']]);
		}else{
			$this -> update(['domen_created' => "Неизвестно"], ['profileid', '=', $profile['id']]);
		}
		return false;
	}

	public function domen_created_init(){ // domen_created
		$profiles = arrayToArray(model('Profile') -> all());
		if(!$profiles[0]){
			$profiles = [];
		}

		$count = count($profiles);
		for($i=0; $i<$count; $i++){
			$site = $this -> get(['where' => ['profileid', '=', $profiles[$i]['id']]]);
			if(empty($site['domen_created'])){
				$this -> domen_created($profiles[$i]);
			}
		}

	}

	public function make_site_screen($siteid){
		$site = $this -> get(['id', '=', $siteid]);
		$profile = model("Profile") -> get(['id', '=', $site['profileid']]);
		$url = $profile['site'];
		$screen = file_get_contents("http://mini.s-shot.ru/1366x768/800/png/?{$url}");
		$base64 = base64_encode($screen);
		if(empty($base64)){
			return false;
		}
	  $screen_b64 = 'data:image/png;base64,' . $base64;
		$path = model('Media') -> b64_to_file($screen_b64);
		$title = explode('/', $path);
		$title = $title[count($title) - 1];
		$mediaid = model('Media') -> set_new_media($path, $title);
		$this -> update(['screen' => $mediaid], ['id', '=', $siteid]);
	}

}
