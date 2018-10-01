<?php

/*  Automatically was generated from a template fw/templates/model.php */

class Tag_profile extends \Extend\Model{

    public $sets;

    public function __construct(){
        $this -> sets = new \Sets\Tag_profileSet;
    }

    public function get_id_profiles_by_tag($tag, $limit){
    	if(is_array($tag)){
    		$tagid = $tag['id'];
    	}else{
    		$tagid = $tag;
    	}

    	$profileids = arrayToArray($this -> get(['where' => ['tagid', '=', $tagid], 'limit' => [$limit, 15]]));
    	if(!$profileids[0]){
    		return [];
    	}

    	$ids = [];
    	foreach($profileids as $item){
    		$ids[] = $item['profileid'];
    	}
    	return $ids;
    }

}
