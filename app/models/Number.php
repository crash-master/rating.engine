<?php

/*  Automatically was generated from a template fw/templates/model.php */

class Number extends \Extend\Model{

	public $sets;

	public function __construct(){
		$this -> sets = new \Sets\NumberSet;
	}

	public function init(){
		$this -> update_numbers();
	}

	public function update_numbers(){
		$items = arrayToArray(model('Profile') -> get(['where' => ['public_flag', '=', '1'], 'order' => ['rating', 'DESC']]));

		$i = 0;
		foreach($items as $item){
			$i++;
			if($this -> get(['profileid', '=', $item['id']])){
				$this -> update(['number' => $i], ['profileid', '=', $item['id']]);
				continue;
			}
			$this -> set(['number' => $i, 'profileid' => $item['id']]);
		}
	}

	public function get_number($profileid){
		$res = $this -> get(['profileid', '=', $profileid]);
		return $res['number'];
	}

}
