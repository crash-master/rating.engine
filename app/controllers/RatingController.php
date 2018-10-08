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

    public function rating($order, $limit = 0){
        $count_on_page = 10;
        $data = model('Profile') -> get_rating_list($order, $limit, $count_on_page);
        $len = model('Profile') -> length(['public_flag', '=', '1']);
        return View::json(['rating' => $data, 'len' => $len]);
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