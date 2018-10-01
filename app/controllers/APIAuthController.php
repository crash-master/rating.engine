<?php

/*  Automatically was generated from a template fw/templates/controller.php */
use Kernel\{
	View,
	Model
};

class APIAuthController extends \Extend\Controller{

	public function page_create_key(){
		return View::make(\Kernel\Config::get('rating-engine -> view-template') . '/pages/dev/new-api-key', ['create' => true]);
	}
    
    public function create_key(){
    	$data = \Kernel\Request::post();
    	if(!$data['access_url']){
    		return false;
    	}
    	$data['access_url'] = urldecode($data['access_url']);
    	$data['confirm_flag'] = '0';
    	$data['active_flag'] = '0';
    	if(!$data['email']){
    		return false;
    	}
    	$data['email'] = trim($data['email']);

    	// create api key and insert to db
    	$data = model('APIAuth') -> create_key($data);

    	// send confirm message to user email
    	$sitename = model('Meta') -> getMeta('sitename');
    	$address = $data['email'];
		$subject = 'Администрация сайта ' . $sitename;
		$title = 'Подтверждение выдачи API key';
		$message = 'Для подтверждения выдачи API key разработчика на сайте "'.$sitename.'" перейдите по ссылке ниже';
		$content = View::make(\Kernel\Config::get('rating-engine -> view-template').'/layouts/emails/base', [
			'title' => $title,
			'sitename' => $sitename,
			'message' => $message, 
			'link' =>  ['href' => model('Meta') -> getMeta('siteurl').linkTo('APIAuthController@confirm', ['id' => $data['id'], 'api_key' => $data['api_key']]), 'text' => 'Получить API key']
		]);
		$headers = "From: admin@ezorating.ru\r\n"; // <----- dont frget change admin email!!!
		$headers .= "Content-type:text/html; Charset=UTF-8\r\n";
		mail($address, $subject, $content, $headers);
		// return $content;
		return redirect(linkTo('APIAuthController@page_create_key_success'));
    }

    public function page_create_key_success(){
    	return View::make(\Kernel\Config::get('rating-engine -> view-template') . '/pages/dev/new-api-key', ['success' => true]);
    }

    public function confirm($id, $api_key){
    	model('APIAuth') -> confirm($id, $api_key);
    	return redirect(linkTo('APIAuthController@page_confirm_key_success', ['api_key' => $api_key]));
    }

    public function page_confirm_key_success($api_key){
    	return View::make(\Kernel\Config::get('rating-engine -> view-template') . '/pages/dev/new-api-key', ['confirm_success' => true, 'api_key' => $api_key]);
    }

    
}