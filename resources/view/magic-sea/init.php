<?php

content_block_register('Шапка сайта, главная страница', 'site_header_on_home_page', '<h3>Единый рейтинг магов и экстрасенсов</h3><p>Самый полный каталог специалистов в области эзотерики со всего СНГ.<br>Реальные отзывы людей</p>', 'Редактирование текста в шапке на главной странице');
content_block_register('Правила добавления профилей', 'rules-for-adding-profiles', 'Список правил', 'Блок для хранения правил добавления профилей');

function theme_settings(){
	return [
		'profile_thumbnail_size' => 'lg',
		'reviews_thumbnail_size' => 'md'
	];
}