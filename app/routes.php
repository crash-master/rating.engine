<?php
use Kernel\Router;
use Kernel\Model;
/*
*   Router::_404(action_name)
*   Router::get('route', 'action');
*   Router::post('field', 'action', 'route'?);
*   Router::actions(array_actions)
*   Router::controller(controller_name, [only])
*/

Router::_404('IndexController@_404');
Router::get('/', 'IndexController@index');
Router::get('/secret/app/init', 'IndexController@app_init');

Router::get('/page/{pagename}', 'PageController@text_page');
Router::get('/page/rating', 'RatingController@page');
Router::get('/page/tag/{slug}', 'TagController@page');
Router::get('/profile/{slug}', 'ProfileController@page');
Router::post('pass', 'IndexController@admin_login', '/admin/login');
Router::post('main-meta', 'MetaController@save_main_meta', '/admin/meta/save/main-meta');
Router::post('social-links', 'MetaController@save_social_links', '/admin/meta/save/social-links');
Router::get('/redirect/original-url/{profileid}','SiteController@incrementSiteVisit');
Router::get('/waiting/for/key/{key}', 'ReviewController@waiting_key_for_remove');