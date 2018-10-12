<?php

/*  Automatically was generated from a template fw/templates/controller.php */
use Kernel\{
	View,
	Model,
	Request
};

class ReviewController extends \Extend\Controller{
    
    public function moderation(){
    	$moderation_list = model('Review') -> get_moderation_list();
        return View::make('admin/moderation', ['moderation_list' => $moderation_list, 'review' => true]);
    }

    public function create(){
    	Request::clear();
        $data = Request::post();
        \Kernel\Sess::set('username', $data['username']);
        \Kernel\Sess::set('email', $data['email']);
        $data['timestamp'] = 'NOW()';
        $data['user_ip'] = $_SERVER['REMOTE_ADDR'];
        $geo = json_decode(file_get_contents('http://api.sypexgeo.net/json/'.$data['user_ip']), true);
        $data['country'] = $geo['country']['name_ru'];
        $data['city'] = $geo['city']['name_ru'];
        if($data['image']){
            list($format) = explode(';base64', $data['image']);
            list(,$format) = explode('/', $format);
            $filename = rand(0,99999).'tmp.'.$format;
            $nf = './tmp/'.$filename;
            list(,$data['image']) = explode(',', $data['image']);
            file_put_contents($nf, base64_decode($data['image']));
            include_once('app/vendor/resize.php');
            $f = images_size($nf, $nf, 600);
            $d = file_get_contents($f);
            $base64 = 'data:image/' . $format . ';base64,' . base64_encode($d);
            $data['image'] = $base64;
            // clean
            @unlink($nf);
            @unlink($nf.'.'.$format);
        }
        return model('Review') -> set($data);
    }

    public function get_last_reviews(){
    	$reviews = model('Review') -> get_last_reviews();
        return ['reviews' => $reviews];
    }

    public function confirm($id){
        $review = model('Review') -> get(['where' => ['id', '=', $id]]);
      	model('Review') -> update(['public_flag' => '1'], ['id', '=', $id]);
        model('Profile') -> rating($review);
        return redirect(linkTo('ReviewController@moderation'));
    }

    public function reject($id){
        model('Review') -> remove(['id', '=', $id]);
        return redirect(linkTo('ReviewController@moderation'));
    }

    public function remove($id){
        $review = model('Review') -> get(['where' => ['id', '=', $id]]);
        model('Review') -> remove_review($review);
        $profile = model('Profile') -> get(['where' => ['id', '=', $review['profileid']]]);
        return redirect(linkTo('ProfileController@page', ['slug' => $profile['slug']]));
    }
    
}