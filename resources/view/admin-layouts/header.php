<?php vjoin('admin-layouts/head') ?>
<aside id="aside">
	<h3>Админ панель</h3>
	<nav class="main">
		<ul>
			<? if(re_is_visible(linkTo('MetaController@meta_page'))): ?><li><a href="<?= linkTo('MetaController@meta_page') ?>">Мета информация</a></li><? endif; ?>
			<? if(re_is_visible(linkTo('PageController@admin_page'))): ?><li><a href="<?= linkTo('PageController@admin_page') ?>">Страницы</a></li><? endif; ?>
			<? if(re_is_visible(linkTo('TBController@admin_page'))): ?><li><a href="<?= linkTo('TBController@admin_page') ?>">Текстовые блоки</a></li><? endif; ?>
			<? if(re_is_visible(linkTo('CatsController@admin_page'))): ?><li><a href="<?= linkTo('CatsController@admin_page') ?>">Категории</a></li><? endif; ?>
			<? if(re_is_visible(linkTo('TagController@admin_page'))): ?><li><a href="<?= linkTo('TagController@admin_page') ?>">Теги</a></li><? endif; ?> <!-- Услуги -->
			<? if(re_is_visible(linkTo('RecomendedController@admin_page'))): ?><li><a href="<?= linkTo('RecomendedController@admin_page') ?>">Рекомендованные</a></li><? endif; ?>
			<? if(re_is_visible(linkTo('IndexController@moderation_page'))): ?><li><a href="<?= linkTo('IndexController@moderation_page') ?>">Модерация</a></li><? endif; ?>
			<? if(re_is_visible(linkTo('ProfileController@search_profile_page'))): ?><li><a href="<?= linkTo('ProfileController@search_profile_page') ?>">Редактирование мага</a></li><? endif; ?>
			<? if(re_is_visible(linkTo('ProfileController@admin_create_new_profile_page'))): ?><li><a href="<?= linkTo('ProfileController@admin_create_new_profile_page') ?>">Добавить мага</a></li><? endif; ?>
			<li><a href="<?= linkTo('IndexController@admin_logout') ?>">Выйти</a></li>
			<li><a href="/">На сайт</a></li>
		</ul>
	</nav>
</aside>