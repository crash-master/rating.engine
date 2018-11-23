<?php

/*  Automatically was generated from a template fw/templates/model.php */

class Site extends \Extend\Model{

	public $sets;

	public function __construct(){
		$this -> sets = new \Sets\SiteSet;
	}

	 public function domen_created($profile){ // domen_created
		$domen = urlencode(url_without_prefix($profile['site']));
		$url = 'http://api.whois.vu/?q='.$domen;
		$result = json_decode(file_get_contents($url), true);
		if($result['created']){
			$this -> update(['domen_created' => $result['created']], ['profileid', '=', $profile['id']]);
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
