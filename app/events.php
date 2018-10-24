<?php
use Kernel\Events;
use Kernel\Sess;

// for login to admin panel
function checkOnSecureList($current_route){

	$exeption = [
		'/admin/login-page',
		'/admin/login'
	];

	return array_search('admin', explode('/', $current_route)) && array_search($current_route, $exeption) === false;
}

Events::add('call_action', function($params){
	if(is_string($params['actionName'])){
		$route = linkTo($params['controllerName'].'@'.$params['actionName']);
		if(Sess::get('admin') != 'true'){
			if(checkOnSecureList($route)){
				return redirect(linkTo('IndexController@admin_login_page'));
			}
		}
	}

	model('Media') -> always_resize();
});

//Events::add('call_action_404', function($params){
//
//});


Events::add('after_db_query', function($params){
	$sql = strtolower($params['sql']);
	if(strpos($sql, 'insert') !== false or strpos($sql, 'delete') !== false){
		if(strpos($sql, '`' . strtolower(model('Comment') -> sets -> tableName()) . '`')){
			$count = model('Comment') -> length();
			model('Meta') -> updateMeta('count_comments', $count);
		}elseif(strpos($sql, '`' . strtolower(model('Review') -> sets -> tableName()) . '`')){
			$count = model('Review') -> length();
			model('Meta') -> updateMeta('count_reviews', $count);
		}elseif(strpos($sql, '`' . strtolower(model('Profile') -> sets -> tableName()) . '`')){
			$count = model('Profile') -> length();
			model('Meta') -> updateMeta('count_profiles', $count);
		}
	}
});


//Events::add('after_query_fetch', function($params){
//    dd($params);
//});
