<?php

/*  Automatically was generated from a template fw/templates/model.php */

class Recomended extends \Extend\Model{

    public $sets;

    public function __construct(){
        $this -> sets = new \Sets\RecomendedSet;
    }

    public function get_recomended_list($count = null){
    	$res = atarr($this -> all());
    	$len = count($res);
    	$recomended_list = [];
    	if(!is_null($count) and $len > 3){
    		$r = [];
    		for($i=0; $i<$count; $i++){
    			$flag = false;
    			$rand = rand(0, $len - 1);
    			for($j=0; $j<count($r); $j++){
    				if($r[$j] == $rand){
    					$flag = true;
    				}
    			}
    			if($flag){
    				$i--;
    				continue;
    			}
    			$r[] = $rand;
    			$recomended_list[] = $res[$rand];
    		}
    	}else{
    		$recomended_list = $res;
    	}
    	$data = [];
    	foreach($recomended_list as $i => $item){
    		$data[$i] = model('Profile') -> get(['id', '=', $item['profileid']]);
    		$data[$i] = model('Profile') -> profile_fields_transform($data[$i], ['site', 'to_profile', 'site_obj']);
    	}
    	return $data;
    }

}
