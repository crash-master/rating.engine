<? vjoin('attract/layouts/header') ?>
<div class="container" id="profile">
	<div class="row">
		<!--  profile info -->
		<div class="col-12 col-lg-6 col-xl-6">
			<div class="screen-container">
				<img src="<?= ($profile['site_obj'] and !empty($profile['site_obj']['screen'])) ? $profile['site_obj']['screen'] : "/resources/view/attract/assets/imgs/screens/default-screen.jpg" ?>" class="screen">
			</div>
			<h3 class="txt-grey Profile-name">
				<span class="top number txt-grey-dark"><span><?= $profile['number_txt'] ?></span></span> <?= $profile['name'] ?>
				<?php if (is_admin()): ?>
					----- <a href="<?= linkTo('ProfileController@profile_edit_page') ?>?s=<?= $profile['slug'] ?>">Редактировать</a>
				<?php endif ?>
			</h3>
			<noindex>
				<a href="<?= $profile['site_link'] ?>" rel="nofollow" class="std-a site txt-red" target="_blank">
					<?= $profile['site'] ?> <small><i class="mdi mdi-open-in-new"></i></small>
				</a> <span class="txt-grey-light count-views">(<?= $profile['site_obj']['count_visits'] ?> посещений)</span>
			</noindex>
			<div class="top stats txt-grey-dark" itemprop="aggregateRating" itemscope="" itemtype="http://schema.org/AggregateRating">
				<meta itemprop="itemReviewed" content="<?= $profile['name'] ?>">
				<? $totalReviews = intval($profile['count_like']) + intval($profile['count_dislike']) + intval($profile['count_neutral']); ?>
				<? $ratingValue = $totalReviews * intval($profile['rating']) ? round(100 / $totalReviews * intval($profile['rating']) / 10, 1) : 0; ?>
				<meta itemprop="bestRating" content="10">
				<meta itemprop="ratingValue" content="<?= $ratingValue ?>">
				<i class="mdi mdi-thumb-up font-color-green"></i> <?= $profile['count_like'] ?>&nbsp;&nbsp;
				<i class="mdi mdi-thumb-down font-color-red"></i> <?= $profile['count_dislike'] ?>&nbsp;&nbsp;
				<i class="mdi mdi-thumbs-up-down font-color-grey"></i> <?= $profile['count_neutral'] ?>
				<span class="total-rating txt-grey">Общий рейтинг: <span class="txt-grey-dark" itemprop="reviewCount"><?= $profile['rating'] ?></span></span>
				<p class="profile-views txt-grey">
					Просмотров профиля: <span class="txt-grey-dark"><?= $profile['count_views'] ?></span>
				</p>
			</div>
		</div>

		<div class="col-12 col-lg-6 col-xl-6">
			<? if($profile['cat']): ?>
				<p class="category txt-grey">
					Категория: <span class="txt-grey-dark"><?= $profile['cat']['title'] ?></span>
				</p>
			<? endif; ?>
			<? if($profile['tags']): ?>
				<p class="category txt-grey">
					Услуги:
					<? foreach($profile['tags'] as $tag): ?>
						<a href="<?= linkTo('TagController@page', ['slug' => $tag['slug']]) ?>" class="tag"><?= $tag['title'] ?></a>
					<? endforeach; ?>
				</p>
			<? endif; ?>
			<? if($profile['site_obj']['title']): ?>
				<p class="site-title txt-grey">
					Заголовок сайта: <span class="txt-grey-dark"><?= $profile['site_obj']['title'] ?></span>
				</p>
			<? endif; ?>
			<? if($profile['site_obj']['domen_created']): ?>
				<p class="site-title txt-grey">
					Дата создания сайта: <span class="txt-grey-dark"><?= $profile['site_obj']['domen_created'] ?></span>
				</p>
			<? endif; ?>
			<? if($profile['contacts']): ?>
				<p class="site-description txt-grey">
					Контактные данные: <br>
					<span class="txt-grey-dark">
						<?= $profile['contacts'] ?>
					</span>
				</p>
			<? endif; ?>
			<?php if ($profile['site_obj']['description']): ?>
				<p class="site-description txt-grey">
					Описание: <br>
					<div class="txt-grey-dark site-description-text">
						<?= $profile['site_obj']['description'] ?>
					</div>
				</p>
			<?php endif ?>
			
		</div>

	</div>

	<div class="col-12 bottom-border"></div>
	<!-- recomended -->
	<? vjoin('Recomended') ?>

	<div class="col-12 bottom-border"></div>
	<!-- review list -->
	<? vjoin('attract/layouts/blocks/review-list') ?>

	<div class="col-12 bottom-border"></div>
	<!-- new review form -->
	<? vjoin('attract/layouts/blocks/new-review') ?>

</div>

<? vjoin('attract/layouts/footer') ?>