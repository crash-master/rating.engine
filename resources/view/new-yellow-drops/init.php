<?php

content_block_register('Контент, главная страница', 'content-home-page', 'Контент на главной странице', 'Редактирование контента на главной странице');

function theme_settings(){
	return [
		'profile_thumbnail_size' => 'lg',
		'reviews_thumbnail_size' => 'md',
		'article_thumbnail_size' => 'md'
	];
}