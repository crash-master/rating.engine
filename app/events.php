<?php
use Kernel\Events;
use Kernel\Sess;

// for login to admin panel
function checkOnSecureList($current_route){

    $exeption = [
        '/admin/login-page'
    ];

    return array_search('admin', explode('/', $current_route)) && array_search($current_route, $exeption) === false;
}

Events::add('call_action', function($params){
	$route = linkTo($params['controllerName'].'@'.$params['actionName']);
    if(Sess::get('admin') != 'true'){
    	if(checkOnSecureList($route)){
    		return redirect(linkTo('IndexController@admin_login_page'));
    	}
    }
});

//Events::add('call_action_404', function($params){
//
//});

//Events::add('before_db_query', function($params){
//    dd($params);
//});

//Events::add('after_db_query', function($params){
//    dd($params);
//});

//Events::add('after_query_fetch', function($params){
//    dd($params);
//});