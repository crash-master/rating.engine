<? isset($profile) ? vjoin('Head', ['profile' => $profile]) : vjoin('Head'); ?>
<? vjoin('yellow-drops/layouts/mobile-nav') ?>

<div class="container">
	<header id="header">
		<div class="row">
			<div class="col-4 col-lg-8 col-xl-8">
				<nav class="main">
					<a href="/" class="nav-item">Главная</a>
					<a href="<?= linkTo('YDController@profile_list'); ?>" class="nav-item">Список магов</a>
					<a href="<?= txtpage('about') ?>" class="nav-item">О проекте</a>
					<a href="<?= txtpage('contacts') ?>" class="nav-item">Контакты</a>
				</nav>
			</div>

			<div class="col-8 col-lg-4 col-xl-4">
				<div class="search">
					<input type="text" class="yd-input" placeholder="Поиск">
					<div class="search-result"></div>
				</div>
			</div>
		</div>
	</header>
</div>
