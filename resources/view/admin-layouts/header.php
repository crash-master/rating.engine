<?php vjoin('admin-layouts/head') ?>
<aside id="aside">
	<h3 class="admin-panel-name">Админ панель</h3>
	<nav class="main">
		<ul>
			<? if(re_is_visible(linkTo('MetaController@meta_page'))): ?><li><a href="<?= linkTo('MetaController@meta_page') ?>"><i class="fa fa-info-circle" aria-hidden="true"></i> Мета информация</a></li><? endif; ?>
			<? if(re_is_visible(linkTo('PageController@admin_page'))): ?><li><a href="<?= linkTo('PageController@admin_page') ?>"><i class="fa fa-window-maximize" aria-hidden="true"></i> Страницы</a></li><? endif; ?>
			<? if(re_is_visible(linkTo('TBController@admin_page'))): ?><li><a href="<?= linkTo('TBController@admin_page') ?>"><i class="fa fa-file-text" aria-hidden="true"></i> Текстовые блоки</a></li><? endif; ?>
			<? if(re_is_visible(linkTo('CatsController@admin_page'))): ?><li><a href="<?= linkTo('CatsController@admin_page') ?>"><i class="fa fa-th-list" aria-hidden="true"></i> Категории</a></li><? endif; ?>
			<? if(re_is_visible(linkTo('TagController@admin_page'))): ?><li><a href="<?= linkTo('TagController@admin_page') ?>"><i class="fa fa-tags" aria-hidden="true"></i> Теги</a></li><? endif; ?> <!-- Услуги -->
			<? if(re_is_visible(linkTo('RecomendedController@admin_page'))): ?><li><a href="<?= linkTo('RecomendedController@admin_page') ?>"><i class="fa fa-star" aria-hidden="true"></i> Рекомендованные</a></li><? endif; ?>
			<? if(re_is_visible(linkTo('IndexController@moderation_page'))): ?><li><a href="<?= linkTo('IndexController@moderation_page') ?>"><i class="fa fa-check" aria-hidden="true"></i> Модерация</a></li><? endif; ?>
			<? if(re_is_visible(linkTo('ProfileController@search_profile_page'))): ?><li><a href="<?= linkTo('ProfileController@search_profile_page') ?>"><i class="fa fa-pencil" aria-hidden="true"></i> Редактирование мага</a></li><? endif; ?>
			<? if(re_is_visible(linkTo('ProfileController@admin_create_new_profile_page'))): ?><li><a href="<?= linkTo('ProfileController@admin_create_new_profile_page') ?>"><i class="fa fa-plus" aria-hidden="true"></i> Добавить мага</a></li><? endif; ?>
			<li><a href="<?= linkTo('IndexController@admin_logout') ?>"><i class="fa fa-sign-out" aria-hidden="true"></i> Выйти</a></li>
			<li><a href="/"><i class="fa fa-home" aria-hidden="true"></i> На сайт</a></li>
		</ul>
	</nav>
</aside>
