<?php

use Kernel\Router;
use Kernel\Model;

// insider api
Router::post('create-profile', 'ProfileController@create_profile', '/api/create-profile');
Router::post('create-review', 'ReviewController@create', '/api/create-review');
Router::post('create-comment', 'CommentController@create', '/api/create-comment');
// route('/api/create-comment', 'CommentController@create');
Router::get('/api/rating/order/{order}/limit/{limit}','RatingController@rating');
Router::get('/api/tag/{tagid}/limit/{limit}','TagController@rating_by_tag');
Router::get('/api/search/{word}','ProfileController@search');
Router::get('/api/search/clean/{word}','ProfileController@search_clean');
Router::get('/api/review/remove/order','ReviewController@order_for_remove');
Router::get('/api/review/create-email-order-for-remove/{reviewid}', 'ReviewController@email_order_for_remove');
Router::get('/api/exist', 'ProfileController@exist');
Router::get('/get-site-thumbnail/{id}', 'SiteController@get_site_thumbnail');
Router::get('/api/update-site-description/{profileid}', 'SiteController@update_description');