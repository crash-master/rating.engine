<?php

/*  Automatically was generated from a template fw/templates/model.php */

class Number extends \Extend\Model{

    public $sets;

    public function __construct(){
        $this -> sets = new \Sets\NumberSet;
    }

    public function dump($profileid){
    	$items = arrayToArray(model('Profile') -> get(['order' => ['rating', 'DESC']]));
    	if(!$items[0]){
    		$items = [];
    	}

    	$i = 0;
    	foreach($items as $item){
    		$i++;
    		if($item['id'] != $profileid)
    			continue;
    		$this -> update(['number' => $i], ['profileid', '=', $profileid]);
    	}

    	return true;
    }

    public function init(){
    	$items = arrayToArray(model('Profile') -> get(['order' => ['rating', 'DESC']]));
    	if(!$items[0]){
    		$items = [];
    	}

    	$i = 0;
    	foreach($items as $item){
    		$i++;
    		if($this -> get(['where' => ['profileid', '=', $item['id']]]))
    			continue;
    		$this -> set(['number' => $i, 'profileid' => $item['id']]);
    	}
    }

    public function update_numbers(){
        $items = arrayToArray(model('Profile') -> get(['order' => ['rating', 'DESC']]));
        if(!$items[0]){
            $items = [];
        }

        $i = 0;
        foreach($items as $item){
            $i++;
            $this -> update(['number' => $i, 'profileid' => $item['id']]);
        }
    }

    public function get_number($profileid){
    	$res = $this -> get(['where' => ['profileid', '=', $profileid]]);
    	return $res['number'];
    }

}
