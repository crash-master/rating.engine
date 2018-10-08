<?php
use Kernel\Components;
$templatename = \Kernel\Config::get('rating-engine -> view-template');

Components::create('YDFooter', [$templatename . '/layouts/footer' => [
	'MetaController@getSocialLinksMeta'
]]);

Components::create('YDlast-profiles', [$templatename . '/layouts/last-profiles' => [
	'ProfileController@get_last_profiles'
]]);

Components::create('YDCommentForm', [$templatename . '/layouts/create-comment-form' => [
	'CommentController@createCommentForm'
]]);

Components::create('YDComments', [$templatename . '/layouts/create-comment-form' => [
	'CommentController@comments'
]]);

Components::create('YDSidebar', [$templatename . '/layouts/sidebar' => [
	'SidebarController@get_sidebar_content'
]]);

Components::create('YDSitePresent', [$templatename . '/layouts/site-present' => [
	'YDController@site_present'
]]);