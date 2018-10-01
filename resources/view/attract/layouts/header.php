<? vjoin('attract/layouts/head') ?>
<button class="menu" data-menu="">
	<span class="item"></span>
	<span class="item"></span>
	<span class="item"></span>
</button>

<div class="mobile-menu">	
	<div class="menu"></div>
	<br>
	<div class="sub-menu">
		<ul>
			<li><a href="#" class="new-user-open popup-from-mob-menu">Добавить мага</a></li>
			<li><a href="#" class="search-open popup-from-mob-menu">Поиск</a></li>
		</ul>
	</div>
</div>

<div class="container">
	<header id="header">
		<div class="row">
			<div class="col-9 col-lg-2 col-xl-2">
				<div class="logo txt-grey mariupol-bold" onclick="document.location = '/'"><?= model('Meta') -> getMeta('sitename') ?></div>
			</div>
			<div class="col-8">
				<nav class="main">
					<ul>
						<li><a href="/" class="std-a">Главная</a></li><li><a href="<?= linkTo('RatingController@page') ?>" class="std-a">Рейтинг</a></li><li><a href="http://news.astralmagic.ru/" class="std-a">Новости</a></li><li><a href="<?= linkTo('PageController@text_page', ['pagename' => 'about']) ?>" class="std-a">О проекте</a></li>
					</ul>
				</nav>
			</div>
			<div class="col-2">
				<div class="top-btn-group">
					<button class="new-user-open"><i class="m-icon plus"></i><i class="m-icon plus-red"></i></button>
					<button class="search-open"><i class="m-icon magnify"></i><i class="m-icon magnify-red"></i></button>
				</div>
			</div>
		</div>
	</header>
</div>

<? vjoin('attract/layouts/popups/new-profile') ?>
<? vjoin('attract/layouts/popups/search') ?>