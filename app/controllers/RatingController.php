<?php

/*  Automatically was generated from a template fw/templates/controller.php */
use Kernel\{
	View,
	Model
};

class RatingController extends \Extend\Controller{
    
    public function page(){
        $res = model('Meta') -> getMeta('count_profiles');
        return View::make(\Kernel\Config::get('rating-engine -> view-template') . '/pages/rating.php', ['count' => $res]);
    }

    public function rating($order, $limit){
        $data = arrayToArray(model('Profile') -> get(['where' => ['public_flag','=','1'], 'order' => [$order,'DESC'], 'limit' => [$limit, 15]]));
        $count = count($data);
        for($i=0; $i<$count; $i++){
            $data[$i]['timestamp'] = dateFormat($data[$i]['timestamp']);
            $data[$i]['number'] = $i + 1;
            $data[$i]['site_link'] = linkTo('SiteController@incrementSiteVisit', ['profileid' => $data[$i]['id']]);
            $data[$i]['site'] = url_without_prefix($data[$i]['site']);
            $data[$i]['to_profile'] = linkTo('ProfileController@page', ['slug' => $data[$i]['slug']]);
            $data[$i]['site_obj'] = model('Site') -> get(['where' => ['profileid', '=', $data[$i]['id']]]);
            $data[$i]['cat'] = model('Cats') -> get(['where' => ['id', '=', $data[$i]['catid']]]);
            if(!$data[$i]['site_obj']){
                $data[$i]['site_obj'] = false;
            }else{
                $data[$i]['site_obj']['screen'] = '';
            }
        }

        return View::json(['rating' => $data, 'len' => model('Meta') -> getMeta('count_profiles') - 1]);
    }

    public function high_list(){
        $data = model('Profile') -> get(['where' => ['public_flag', '=', 1], 'order' => ['rating', 'DESC'], 'limit' => [0, 5]]);
        $data = arrayToArray($data);
        $count = count($data);
        for($i=0; $i<$count; $i++){
            $data[$i]['number'] = ($i < 9) ? '0' . ($i + 1) : $i + 1;
            $data[$i]['site_link'] = linkTo('SiteController@incrementSiteVisit', ['profileid' => $data[$i]['id']]);
            $data[$i]['site'] = url_without_prefix($data[$i]['site']);
            $data[$i]['timestamp'] = dateFormat($data[$i]['timestamp']);
        }

        return ['high_list' => $data];
    }
    
    
}