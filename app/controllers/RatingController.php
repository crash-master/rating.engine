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
		$count_on_page = 20;
		$data = model('Profile') -> get_rating_list($order, $limit, $count_on_page);
		$len = model('Profile') -> length(['public_flag', '=', '1']);
		return View::json(['rating' => $data, 'len' => $len]);
	}

	public function high_list(){
		$data = model('Profile') -> get_high_list();

		return ['high_list' => $data];
	}
	
	
}