<div class="container">
	<nav class="nav-main">
		<ul>
			<li><a href="/" class="nav-link">Главная</a></li>
			<li><a href="<?= linkTo('ProfileController@profile_list_by_category', ['cat_slug' => 'proved', 'page_num' => 1]) ?>" class="nav-link">Проверенные маги</a></li>
			<li><a href="<?= linkTo('ProfileController@profile_list_by_category', ['cat_slug' => 'unproved', 'page_num' => 1]) ?>" class="nav-link">Маги на проверке</a></li>
			<li><a href="<?= linkTo('ArticleController@article_list_by_category', ['cat_slug' => 'simple-articles', 'page_num' => 1]) ?>" class="nav-link">Статьи</a></li>
			<li><a href="<?= linkTo('ArticleController@article_list_by_category', ['cat_slug' => 'magic-ratings-and-organizations', 'page_num' => 1]) ?>" class="nav-link">Магические рейтинги и организации</a></li>
			<li><a href="<?= linkTo('PageController@text_page', ['pagename' => 'contacts']) ?>" class="nav-link">Контакты</a></li>
		</ul>
	</nav>
</div>