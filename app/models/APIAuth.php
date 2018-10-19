<?php

/*  Automatically was generated from a template fw/templates/model.php */

class APIAuth extends \Extend\Model{

    public $sets;

    public function __construct(){

        $this -> sets = new \Sets\APIAuthSet;

    }

    private function gen_key($timestamp){
    	$key = sha1(rand(999999,999999999)).sha1($timestamp);
    	return $key;
    }

    public function create_key($data){
    	$data['date_of_issue'] = 'NOW()';
        // dd($data);
    	$this -> set($data);
    	$data = $this -> last();
    	$data['api_key'] = $this -> gen_key($data['timestamp']);
    	$this -> update($data, ['id', '=', $data['id']]);

    	return $data;
    }

    public function confirm($id, $api_key){
    	$data = [
    		'confirm_flag' => '1',
    		'active_flag' => '1'
    	];

    	$result = $this -> update($data, ['id', '=', $id, 'AND', 'api_key', '=', $api_key]);

    	if($result){
    		return true;
    	}

    	return false;
    }

    public function check_api_key($api_key){
    	$api = $this -> get(['where' => ['api_key', '=', $api_key, 'AND', 'confirm_flag', '=', '1']]);
    	if($api and $api['active_flag'] == '1'){
    		$this -> increment_count_request($api);
    		return true;
    	}

    	return false;
    }

    public function increment_count_request($api){
    	$this -> update(['count_request' => intval($api['count_request']) + 1], ['id', '=', $api['id']]);
    }

}
