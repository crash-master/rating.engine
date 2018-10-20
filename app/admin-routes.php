<?php
use Kernel\Router;
use Kernel\Model;

// Admin
Router::get('/admin', 'IndexController@admin');
Router::get('/admin/meta', 'MetaController@meta_page');
Router::get('/admin/logout', 'IndexController@admin_logout');
Router::get('/admin/login-page', 'IndexController@admin_login_page');
Router::get('/admin/pages', 'PageController@admin_page');
route('/admin/page/create', 'PageController@create_page');
route('/admin/page/update/{pageid}', 'PageController@update_page');
route('/admin/page/remove/{pageid}', 'PageController@remove');
route('new-page', 'PageController@create', '/admin/page/create-new-page');
route('update-page', 'PageController@update', '/admin/page/update-page');
Router::get('/admin/pages/edit/{pagename}', 'PageController@admin_page_edit');
Router::get('/admin/main-pages/edit/{pagename}', 'PageController@main_page_edit');
Router::get('/admin/pages/save/{pagename}', 'PageController@save_page');
Router::get('/admin/pages/main-pages/save/{pagename}', 'PageController@main_page_save');
route('/admin/pages/update/{id}/{colname}/{val}', 'PageController@update_field'); //api
Router::get('/admin/moderation', 'IndexController@moderation_page');
Router::get('/admin/moderation/create-profile', 'ProfileController@moderation');
Router::get('/admin/moderation/create-profile/confirm/{id}', 'ProfileController@confirm');
Router::get('/admin/moderation/create-profile/reject/{id}', 'ProfileController@reject');
Router::get('/admin/moderation/create-review', 'ReviewController@moderation');
Router::get('/admin/moderation/create-review/confirm/{id}', 'ReviewController@confirm');
Router::get('/admin/moderation/create-review/reject/{id}', 'ReviewController@reject');
Router::get('/admin/moderation/create-comment', 'CommentController@moderation');
Router::get('/admin/moderation/create-comment/confirm/{id}', 'CommentController@confirm');
Router::get('/admin/moderation/create-comment/reject/{id}', 'CommentController@reject');
Router::get('/admin/textblocks', 'TBController@admin_page');
Router::get('/admin/textblocks/edit/{blockname}', 'TBController@tb_edit_page');
Router::get('/admin/textblocks/update', 'TBController@update');
Router::get('/admin/cats', 'CatsController@admin_page');
Router::get('/admin/cats/remove/{id}', 'CatsController@remove');
route('/admin/cats/update/{id}/{colname}/{val}', 'CatsController@update'); //api
Router::get('/admin/search_profile_page', 'ProfileController@search_profile_page');
Router::get('/admin/profile_edit_page', 'ProfileController@profile_edit_page');
Router::get('/admin/profile/remove/{id}', 'ProfileController@remove');
Router::get('/admin/review/remove/{id}', 'ReviewController@remove');
Router::get('/admin/comment/remove/{id}', 'CommentController@remove');
Router::post('title', 'CatsController@add', '/admin/cats/new');
Router::post('name', 'ProfileController@profile_update', '/admin/profile_update');
route('pass', 'IndexController@admin_login', '/admin/login');
Router::post('admin-create-new-profile', 'ProfileController@admin_create_profile', '/admin/create-new-profile');
Router::get('/admin/create-new-profile', 'ProfileController@admin_create_new_profile_page');
route('/admin/recomended', 'RecomendedController@admin_page');
route('/admin/recomended/remove/{profileid}', 'RecomendedController@remove');

Router::get('/admin/tags', 'TagController@admin_page');
Router::get('/admin/tags/remove/{tagid}', 'TagController@remove');
Router::get('/admin/tags/update/{id}/{colname}/{val}', 'TagController@update');
Router::post('create-tag', 'TagController@create');
Router::post('recomended-add', 'RecomendedController@add_new_profile', '/admin/recomended/add-new');