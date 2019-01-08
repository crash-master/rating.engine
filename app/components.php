<?php
use Kernel\Components;
$templatename = \Kernel\Config::get('rating-engine -> view-template');

Components::create('Admin-Head', ['admin-layouts/header' => [
	'IndexController@admin_header'
]]);

Components::create('Head', [$templatename . '/layouts/head' => [
	'PageController@page_meta_component'
]]);

Components::create('Footer', [$templatename . '/layouts/footer' => [
	'MetaController@getSocialLinksMeta'
]]);

Components::create('last-profiles', [$templatename . '/layouts/blocks/last-profiles' => [
	'ProfileController@get_last_profiles'
]]);

Components::create('high-profiles', [$templatename . '/layouts/blocks/high-profiles' => [
	'RatingController@high_list'
]]);

Components::create('new-profile', [$templatename . '/layouts/popups/new-profile' => [
	'CatsController@cats'
]]);

Components::create('last-reviews', [$templatename . '/layouts/blocks/last-reviews' => [
	'ReviewController@get_last_reviews'
]]);

Components::create('last-news-block', [$templatename . '/layouts/blocks/blog-articles' => [
	'BlogController@last_news'
]]);

Components::create('global-stats', [$templatename . '/layouts/blocks/global-stats' => [
	'MetaController@get_stats'
]]);

Components::create('tags-cloud', [$templatename . '/layouts/blocks/tags-cloud' => [
	'TagController@get_tag_list'
]]);

Components::create('Recomended', [$templatename . '/layouts/blocks/recomended' => [
	'RecomendedController@get_recomended'
]]);
