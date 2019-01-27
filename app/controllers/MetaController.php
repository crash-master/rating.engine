<?php

/*  Automatically was generated from a template fw/templates/controller.php */
use Kernel\{
	View,
	Model,
	Request
};

class MetaController extends \Extend\Controller{

    public function save_main_meta(){
    	Request::clear();
    	$post = Request::post();
    	unset($post['main-meta']);
    	if($post['password'] == ''){
    		unset($post['password']);
    	}else{
    		$post['password'] = sha1($post['password']);
    	}
    	foreach ($post as $name => $value) {
    		model('Meta') -> updateMeta($name, $value);
    	}

    	return redirect('SettingsController@admin_page');
    }

    public function getHeadMeta(){  // !!!!!!!!!!!!!
    	$data = [
    		'sitename' => model('Meta') -> getMeta('sitename'),
    		'description' => model('Meta') -> getMeta('description'),
            'title' => model('Meta') -> getMeta('sitename')
    	];
    	return ['meta' => $data];
    }

    public function getSocialLinksMeta(){
    	return ['social' => json_decode(model('Meta') -> getMeta('social'), true)];
    }

    public function get_stats(){
        $params = [
            'count_profiles',
            'count_reviews',
            'count_comments',
            'count_personal_site_visits',
            'count_profile_views',
        ];
        $meta = [];
        foreach($params as $param){
            $meta[$param] = model('Meta') -> getMeta($param);
        }
        $meta['days_from_birth'] = get_count_days_from_birth();

        return ['stats' => $meta];
    }


    
    // Other methods
    
    
}