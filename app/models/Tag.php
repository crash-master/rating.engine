<?php

/*  Automatically was generated from a template fw/templates/model.php */

class Tag extends \Extend\Model{

    public $sets;

    public function __construct(){
        $this -> sets = new \Sets\TagSet;
    }

    public function get_tag_list(){
    	$tags = $this -> all();
    	$tags = arrayToArray($tags);
    	if(!$tags[0]){
    		$tags = [];
    	}
    	return $tags;
    }

    public function get_by_profile($profile){
        $profileid = isset($profile['id']) ? $profile['id'] : $profile;
    	$links = model('Tag_profile') -> get(['where' => ['profileid', '=', $profileid]]);
    	$links = arrayToArray($links);

    	$tags = [];
    	foreach($links as $link){
    		$tag = $this -> get(['where' => ['id', '=', $link['tagid']]]);
    		if($tag['id']){
    			$tags[] = $tag;
    		}
    	}

    	return $tags;
    }

}
