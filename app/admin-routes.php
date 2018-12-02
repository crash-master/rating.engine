<?php
use Kernel\Model;

// Admin
route('/admin', 'IndexController@admin');
route('/admin/meta', 'MetaController@meta_page');
route('/admin/logout', 'IndexController@admin_logout');
route('/admin/login-page', 'IndexController@admin_login_page');
route('/admin/pages', 'PageController@admin_page');
route('/admin/page/create', 'PageController@create_page');
route('/admin/page/update/{pageid}', 'PageController@update_page');
route('/admin/page/remove/{pageid}', 'PageController@remove');
route('new-page', 'PageController@create', '/admin/page/create-new-page');
route('update-page', 'PageController@update', '/admin/page/update-page');
route('/admin/pages/edit/{pagename}', 'PageController@admin_page_edit');
route('/admin/main-pages/edit/{pagename}', 'PageController@main_page_edit');
route('/admin/pages/save/{pagename}', 'PageController@save_page');
route('/admin/pages/main-pages/save/{pagename}', 'PageController@main_page_save');
route('/admin/pages/update/{id}/{colname}/{val}', 'PageController@update_field'); //api
route('/admin/moderation', 'IndexController@moderation_page');
route('/admin/moderation/create-profile', 'ProfileController@moderation');
route('/admin/moderation/create-profile/confirm/{id}', 'ProfileController@confirm');
route('/admin/moderation/create-profile/reject/{id}', 'ProfileController@reject');
route('/admin/moderation/create-review', 'ReviewController@moderation');
route('/admin/moderation/create-review/confirm/{id}', 'ReviewController@confirm');
route('/admin/moderation/create-review/reject/{id}', 'ReviewController@reject');
route('/admin/moderation/create-comment', 'CommentController@moderation');
route('/admin/moderation/create-comment/confirm/{id}', 'CommentController@confirm');
route('/admin/moderation/create-comment/reject/{id}', 'CommentController@reject');
route('/admin/textblocks', 'TBController@admin_page');
route('/admin/textblocks/edit/{blockname}', 'TBController@tb_edit_page');
route('/admin/textblocks/update', 'TBController@update');
route('/admin/cats', 'CatsController@admin_page');
route('/admin/cats/remove/{id}', 'CatsController@remove');
route('/admin/cats/update/{id}/{colname}/{val}', 'CatsController@update'); //api
route('/admin/search_profile_page', 'ProfileController@search_profile_page');
route('/admin/profile_edit_page', 'ProfileController@profile_edit_page');
route('/admin/profile/remove/{id}', 'ProfileController@remove');
route('/admin/review/remove/{id}', 'ReviewController@remove');
route('/admin/comment/remove/{id}', 'CommentController@remove');
route('title', 'CatsController@add', '/admin/cats/new');
route('name', 'ProfileController@profile_update', '/admin/profile_update');
route('pass', 'IndexController@admin_login', '/admin/login');
route('admin-create-new-profile', 'ProfileController@admin_create_profile', '/admin/create-new-profile');
route('/admin/create-new-profile', 'ProfileController@admin_create_new_profile_page');
route('/admin/recomended', 'RecomendedController@admin_page');
route('/admin/recomended/remove/{profileid}', 'RecomendedController@remove');
route('/admin/article/list', 'ArticleController@admin_article_list_page');
route('/admin/article/create-page', 'ArticleController@admin_create_page');
route('/admin/article/update-page/{article_id}', 'ArticleController@admin_update_page');
route('/admin/article/remove/{article_id}', 'ArticleController@remove');
route('/admin/api/profile-tags/remove/{profileid}/{tagid}', 'TagController@remove_profile_tag_link');
route('/admin/api/profile-tags/create/{profileid}/{tagid}', 'TagController@create_profile_tag_link');
route('/admin/api/article-tags/remove/{article_id}/{tag_id}', 'TagController@remove_article_tag_link');
route('/admin/api/article-tags/create/{article_id}/{tag_id}', 'TagController@create_article_tag_link');
route('article-create', 'ArticleController@create', '/admin/article/create');
route('article-update', 'ArticleController@update', '/admin/article/update');
route('/admin/media', 'MediaController@admin_page');
route('/admin/media/page/{page_num}', 'MediaController@admin_page');
route('/admin/media/remove/{media_id}', 'MediaController@remove');
route('/admin/media/img-preview/{media_id}', 'MediaController@get_img_preview');


route('/admin/tags', 'TagController@admin_page');
route('/admin/tags/remove/{tagid}', 'TagController@remove');
route('/admin/tags/update/{id}/{colname}/{val}', 'TagController@update');
route('create-tag', 'TagController@create');
route('recomended-add', 'RecomendedController@add_new_profile', '/admin/recomended/add-new');