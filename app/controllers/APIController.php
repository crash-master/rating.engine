<?php

/*  Automatically was generated from a template fw/templates/controller.php */
use Kernel\{
	View,
	Model
};

class APIController extends \Extend\Controller{
    public function profile($api_key, $id){
    	if(!model('API') -> check_api_key($api_key)){
    		return api_error('Bad api key');
    	}

    	$result = model('API') -> get_profile($id);
    	return api_success($result);
    }

    public function high_profiles($api_key){
		if(!model('API') -> check_api_key($api_key)){
    		return api_error('Bad api key');
    	}

    	$result = model('API') -> get_high_profiles();
    	return api_success($result);
    }

    public function export_json_data(){
        $data = model('Blog') -> get_json_data_for_export();
        return json_encode($data);
    }
    
}