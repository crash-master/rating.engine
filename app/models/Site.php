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

}
