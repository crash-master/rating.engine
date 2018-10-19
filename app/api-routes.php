<?php
use Kernel\Router;
use Kernel\Model;

// api auth
Router::get('/dev/page/new-api-key', 'APIAuthController@page_create_key');
Router::get('/dev/page/api-doc', 'APIController@api_doc_page');
Router::get('/dev/page/new-api-key-success', 'APIAuthController@page_create_key_success');
Router::get('/dev/page/new-api-key-confirm-success/{api_key}', 'APIAuthController@page_confirm_key_success');
Router::get('/dev/create-api-key', 'APIAuthController@create_key');
Router::get('/dev/confirm-api-key/{id}/{api_key}', 'APIAuthController@confirm');
Router::get('/get-json-data', 'APIController@export_json_data');
route('/iframe-top/{theme}', 'APIController@get_iframe_top');
route('/dev/get-iframe-top', 'APIController@get_iframe_top_page');
route('/dev/get-iframe-profile', 'APIController@get_iframe_profile_page');
route('/iframe-top/{slug}/{theme}', 'APIController@get_iframe_profile');
route('/dev/get-started', 'APIController@get_started_page');

// api content

Router::get('/api/v1/{api_key}/profile/{id}', 'APIController@profile');
Router::get('/api/v1/{api_key}/high-profiles', 'APIController@high_profiles');
