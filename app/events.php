<?php
use Kernel\Events;
use Kernel\Sess;
use Kernel\Components;

// for login to admin panel
function checkOnSecureList($current_route){

	$exeption = [
		'/admin/login-page',
		'/admin/login'
	];

	return array_search('admin', explode('/', $current_route)) && array_search($current_route, $exeption) === false;
}

function monitor_manager(){
	if(model('Settings') -> get_setting('monitor_flag') == 'on'){
		$monitor_time_period = model('Settings') -> get_setting('monitor_time_period');
		$last_monitor_work = model('Option') -> get_option('last_monitor_work');
		$period = floor(24 * 60 * 60 / $monitor_time_period);
		if(empty($last_monitor_work) or time() - $last_monitor_work > $period){
			model('Monitor') -> fix_all();
			model('Option') -> set_option('last_monitor_work', time());
		}
	}
}

function sitemap_manager(){
	if(model('Settings') -> get_setting('sitemap_flag') == 'on'){
		$sitemap_time_period = model('Settings') -> get_setting('sitemap_time_period');
		$last_sitemap_generate = model('Option') -> get_option('last_sitemap_generate');
		$period = floor(24 * 60 * 60 / $sitemap_time_period);
		if(empty($last_sitemap_generate) or time() - $last_sitemap_generate > $period){
			model('Sitemap') -> generate();
			model('Option') -> set_option('last_sitemap_generate', time());
		}
	}
}

function admin_panel_secure($event_params){
	if(is_string($event_params['actionName'])){
		$route = linkTo($event_params['controllerName'].'@'.$event_params['actionName']);
		if(Sess::get('admin') != 'true'){
			if(checkOnSecureList($route)){
				return redirect(linkTo('IndexController@admin_login_page'));
			}
		}
	}
}

function theme_init(){
	$templatename = \Kernel\Config::get('rating-engine -> view-template');
	$path_to_theme_init = './resources/view/'. $templatename . '/init.php';
	include_once($path_to_theme_init);
}

Events::add('call_action', function($params){
	admin_panel_secure($params);

	theme_init();

	model('Media') -> always_resize();

	// monitor_manager();

	// sitemap_manager();
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

Events::add("before_making_page", function($params){
	// include functions.php if exists
	$templatename = \Kernel\Config::get('rating-engine -> view-template');
	$path = 'resources/view/' . $templatename . '/functions.php';
	if(file_exists($path)){
		include_once($path);
	}
});


//Events::add('after_query_fetch', function($params){
//    dd($params);
//});
