<?php
use Kernel\Router;
use Kernel\Model;

// Admin
Router::get('/admin', 'IndexController@admin');
Router::get('/admin/meta', 'MetaController@meta_page');
Router::get('/admin/logout', 'IndexController@admin_logout');
Router::get('/admin/login-page', 'IndexController@admin_login_page');
Router::get('/admin/pages', 'PageController@admin_page');
Router::get('/admin/main-pages', 'PageController@main_pages_admin');
Router::get('/admin/pages/edit/{pagename}', 'PageController@admin_page_edit');
Router::get('/admin/main-pages/edit/{pagename}', 'PageController@main_page_edit');
Router::get('/admin/pages/save/{pagename}', 'PageController@save_page');
Router::get('/admin/pages/main-pages/save/{pagename}', 'PageController@main_page_save');
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
Router::get('/admin/search_profile_page', 'ProfileController@search_profile_page');
Router::get('/admin/profile_edit_page', 'ProfileController@profile_edit_page');
Router::get('/admin/profile/remove/{id}', 'ProfileController@remove');
Router::get('/admin/review/remove/{id}', 'ReviewController@remove');
Router::get('/admin/comment/remove/{id}', 'CommentController@remove');
Router::post('title', 'CatsController@add', '/admin/cats/new');
Router::post('name', 'ProfileController@profile_update', '/admin/profile_update');

Router::get('/admin/tags', 'TagController@admin_page');
Router::get('/admin/tags/remove/{tagid}', 'TagController@remove');
Router::get('/admin/tags/update/{id}/{colname}/{val}', 'TagController@update');
Router::post('create-tag', 'TagController@create');