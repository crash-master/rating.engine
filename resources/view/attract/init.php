<?php

content_block_register('Инфо блок на главной', 'after-high-profiles-block', 'Инфо блок', 'Инфо блок на главной странице, рядом со списком услуг');
content_block_register('Правила добавления профилей', 'rules-for-adding-profiles', 'Список правил', 'Блок для хранения правил добавления профилей');
content_block_register('Блок приветствия', 'preface', '<h2>Рейтинг магов и экстрасенсов  astralmagic.ru</h2>', 'Блок приветствия, находится на главной странице под слайдшоу');

function theme_settings(){
	return [
		'profile_thumbnail_size' => 'md',
		'reviews_thumbnail_size' => 'sm'
	];
}