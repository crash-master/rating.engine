<?php

/*  Automatically was generated from a template fw/templates/controller.php */
use Kernel\{
	View,
	Model
};

class SiteController extends \Extend\Controller{
    
    public function incrementSiteVisit($profileid){
        $profile = model('Profile') -> get(['where' => ['id', '=', $profileid]]);
        $site = model('Site') -> get(['where' => ['profileid', '=', $profileid]]);
        model('Site') -> update(['count_visits' => $site['count_visits'] + 1], ['id', '=', $site['id']]);
        return redirect(linkToLink($profile['site']));
    }

    public function update_description($profileid){
    	$post = \Kernel\Request::post();
    	$description = $post['description'];
    	model('Site') -> update(['description' => $description], ['profileid', '=', $profileid]);
    }

    public function get_site_thumbnail($id){
        $site = model('Site') -> get(['where' => ['id', '=', $id]]);
        return $site['screen'];
    }
    
}