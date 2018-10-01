<?php vjoin('admin-layouts/head') ?>
<aside id="aside">
	<h3>Админ панель</h3>
	<nav class="main">
		<ul>
			<li><a href="<?= linkTo('MetaController@meta_page') ?>">Мета информация</a></li>
			<li><a href="<?= linkTo('PageController@admin_page') ?>">Текстовые страницы</a></li>
			<li><a href="<?= linkTo('PageController@main_pages_admin') ?>">Основные страницы</a></li>
			<li><a href="<?= linkTo('TBController@admin_page') ?>">Текстовые блоки</a></li>
			<li><a href="<?= linkTo('CatsController@admin_page') ?>">Категории</a></li>
			<li><a href="<?= linkTo('TagController@admin_page') ?>">Теги</a></li> <!-- Услуги -->
			<li><a href="<?= linkTo('IndexController@moderation_page') ?>">Модерация</a></li>
			<li><a href="<?= linkTo('ProfileController@search_profile_page') ?>">Редактирование мага</a></li>
			<li><a href="<?= linkTo('IndexController@admin_logout') ?>">Выйти</a></li>
			<li><a href="/">На сайт</a></li>
		</ul>
	</nav>
</aside>