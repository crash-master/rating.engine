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
route('/', 'IndexController@index');
route('/secret/app/init', 'IndexController@app_init');
route('/secret/app/default_option', 'IndexController@init_default_options');
route('/secret/app/default_settings', 'IndexController@init_default_settings');

route('/page/{pagename}', 'PageController@text_page');
route('/page/rating', 'RatingController@page');
route('/page/tag/{slug}', 'TagController@page');
route('/profile/{slug}', 'ProfileController@page');
route('main-meta', 'MetaController@save_main_meta', '/admin/meta/save/main-meta');
route('social-links', 'MetaController@save_social_links', '/admin/meta/save/social-links');
route('/redirect/original-url/{profileid}','SiteController@incrementSiteVisit');
route('/waiting/for/key/{key}', 'ReviewController@waiting_key_for_remove');
route('/article/{slug}', 'ArticleController@single_article');
route('/articles', 'ArticleController@article_list');
route('/articles/page/{page_num}', 'ArticleController@article_list');
route('/articles/category/{cat_slug}', 'ArticleController@article_list_by_category');
route('/articles/category/{cat_slug}/page/{page_num}', 'ArticleController@article_list_by_category');
route('/profiles/category/{cat_slug}', 'ProfileController@profile_list_by_category');
route('/profiles/category/{cat_slug}/page/{page_num}', 'ProfileController@profile_list_by_category');
route('/articles/tag/{tag_slug}', 'ArticleController@article_list_by_tag_slug');
route('/articles/tag/{tag_slug}/page/{page_num}', 'ArticleController@article_list_by_tag_slug');

route('/binary-img/id/{media_id}/size/{size}', 'MediaController@get_binary_img');
route('media-upload', 'MediaController@upload_media', '/admin/media/upload');

// yellow drops
route('/page/profiles', 'YDController@profile_list');

// route('/transport', 'YDController@transport');

// transport
route('/app/transport-profile-screens', 'IndexController@transport_profile_screen_to_media');
route('/app/transport-review-images', 'IndexController@transport_review_image_to_media');

route('/monitor', function(){
	return model('Monitor') -> fix_all();
});
