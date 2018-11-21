<? isset($profile) ? vjoin('Head', ['profile' => $profile]) : vjoin('Head'); ?>

<header id="header">
	<div class="container">
		<div class="row">
			<div class="col-lg-3 col-md-3 col-sm-5 col-5">
				<div class="logo">
					<h1><?= isset($sitename) ? $sitename : model('Meta') -> getMeta('sitename') ?></h1>
				</div>
			</div>
			<div class="col-lg-6 col-md-5 col-sm-2 col-2">
				<nav class="main">
					<ul>
						<li><a href="/">Главная</a></li>
						<li><a href="<?= linkTo('RatingController@page'); ?>">Рейтинг</a></li>
						<li><a href="<?= txtpage('help') ?>">Помощь</a></li>
						<li><a href="<?= txtpage('about') ?>">О нас</a></li>
					</ul>
				</nav>
			</div>
			<div class="col-lg-3 col-md-4 col-sm-5 col-5">
				<div class="service-btns">
					<button class="add-user">Добавить <i class="m-icon account-plus"></i></button>
					<button class="search-on">Поиск <i class="m-icon magnify"></i></button>
				</div>
				<button class="mob-menu"><i class="m-icon menu"></i></button>
			</div>
		</div>
	</div>

	<div class="search-container">
		<div class="search-field">
			<div class="dialog-arrow"></div>
			<i class="m-icon search-grey"></i>
			<input type="text" class="search-input" placeholder="Поиск">
		</div>
		<!-- <div class="sr-preloader"><img src="./assets/imgs/preloader.gif" class="preloader" alt="Loading"></div> -->
		<div class="search-result">
			<!-- <div class="sr-item"><a href="#">Николай Басков</a></div>
			<div class="sr-item"><a href="#">Николай Басков</a></div>
			<div class="sr-item"><a href="#">Николай Басков</a></div>
			<div class="sr-item"><a href="#">Николай Басков</a></div> -->
		</div>
	</div>

	<?php vjoin('magic-sea/layouts/popups/new-profile-form.php') ?>
</header>

<div class="mobile-nav">
	<button class="close-mob-nav"><i class="m-icon close"></i></button>
	<div class="main-nav"></div>
	<div class="service-nav">
		<button class="add-user"><i class="m-icon account-plus"></i></button>
		<button class="search-on"><i class="m-icon magnify"></i></button>
	</div>
</div>

<div class="global-background"></div>
