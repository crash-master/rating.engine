<?php vjoin('magic-sea/layouts/header') ?>

<div class="container">
	<div class="page" id="single">
		<div class="page-title">
			<? if($profile['site_obj']['favicon'] and $profile['site_obj']['favicon'] != 'Неизвестно'): ?>
				<img onerror="this.style.display='none'" class="site-favicon" src="<?= $profile['site_obj']['favicon'] ?>">
			<? endif; ?>
			<?= $profile['name'] ?> <i class="m-icon account-outline"></i> - #<?= $profile['number'] ?> <small>в рейтинге</small>
		</div>

		<div class="page-menu">
			<div class="line"></div>
		</div>

		<div class="page-part-container" id="info">
			<div class="row">
				<div class="col-12 col-lg-6 col-xl-6">
					<div class="info-container">
						<div class="screen-container">
							<? if($profile['site_obj']['screen']): ?>
								<img src="<?= $profile['site_obj']['screen'] ?>" class="screen" alt="Icon">
							<? endif; ?>
						</div>
						<?php if (is_admin()): ?>
							----- <a href="<?= linkTo('ProfileController@profile_edit_page') ?>?s=<?= $profile['slug'] ?>">Редактировать</a>
						<?php endif ?>
						
						<div class="info-item row rating">
							<span class="right-part">
								<i class="m-icon like"></i> <big><?= $profile['count_like'] ?></big>
								<i class="m-icon thumbs-up-down"></i> <big><?= $profile['count_neutral'] ?> </big>
								<i class="m-icon dislike"></i> <big><?= $profile['count_dislike'] ?></big>
							</span>
						</div>

						<div class="info-item row" itemprop="aggregateRating" itemscope="" itemtype="http://schema.org/AggregateRating">
							<meta itemprop="itemReviewed" content="<?= $profile['name'] ?>">
							<? $totalReviews = intval($profile['count_like']) + intval($profile['count_dislike']) + intval($profile['count_neutral']); ?>
							<? $ratingValue = $totalReviews * intval($profile['rating']) ? round(100 / $totalReviews * intval($profile['rating']) / 10, 1) : 0; ?>
							<meta itemprop="bestRating" content="10">
							<meta itemprop="ratingValue" content="<?= $ratingValue ?>">

							<span class="left-part"><strong>Общий рейтинг</strong></span>
							<span class="right-part"><big><b style="position:  relative;top: -3px;" itemprop="reviewCount"><?= $profile['rating'] ?></b></big></span>
						</div>

						<div class="info-item row">
							<noindex>
								<span class="left-part"><a target="_blank" href="<?= $profile['site_link'] ?>" rel="nofollow" class="mag-link"><?= $profile['site'] ?></a> (<?= $profile['site_obj']['count_visits'] ?> посещений)</span>
							</noindex>
						</div>
						<div class="info-item row">
							<span class="left-part"><strong>Категория</strong></span>
							<span class="right-part"><?= $profile['cat']['title'] ?></span>
						</div>
						<? if($mag['site_obj']['title']): ?>
						<div class="info-item row">
							<span class="left-part"><strong>Заголовок сайта</strong></span>
							<span class="right-part"><?= $profile['site_obj']['title'] ?></span>
						</div>
						<? endif; ?>
						<div class="info-item row">
							<span class="left-part"><strong>Описание</strong></span>
							<span class="right-part mob-fix"><? if($profile['site_obj']['description']): ?><?= $profile['site_obj']['description'] ?></span><? else: ?> Неизвестно <? endif; ?>
						</div>
						<? if($profile['site_obj']['domen_created']): // domen_created ?>
						<div class="info-item row">
							<span class="left-part"><strong>Дата регистрации домена</strong></span>
							<span class="right-part"><?= $profile['site_obj']['domen_created'] ?></span>
						</div>
						<? endif; ?>
						<div class="info-item row">
							<span class="left-part"><strong>Просмотров профиля</strong></span>
							<span class="right-part"><i class="m-icon eye-blue"></i> <big><b style="position:  relative;top: -3px;"><?= $profile['count_views'] ?></b></big></span>
						</div>
					</div>
				</div>
				<div class="col-12 col-lg-6 col-xl-6" style="margin-top: 20px;">
					<?php vjoin('magic-sea/layouts/reviews') ?>
					<div class="open-add-comments-form-container">
						<button class="send-form open-add-comments-form">Добавить отзыв<i class="m-icon comment-text"></i></button>
					</div>	
					<?php vjoin('magic-sea/layouts/blocks/new-review-form') ?>
				</div>
			</div>
		</div>
	</div>
</div>

<script>
	$(document).ready(function(){
		if($('.comments-list .card-comment').length == 0){
			$('.open-add-comments-form-container').addClass('up').find('button').trigger('click');
		}
	});


	// SCREEN SIZE
	const screenSize = function(){
		let container = $('.screen-container');
		container.removeAttr('style');
		container.css('height', container.innerHeight() + 'px');
	}

	screenSize();
	setInterval(function(){
		screenSize();
	}, 200);
	window.addEventListener('resize', function(){
		screenSize();
	});

	$(document).on('scroll', function() {
		// let heightPoint = $('.info-container').innerHeight();
		// if(heightPoint < 800){
		// 	heightPoint = 800;
		// }
		// // console.log(heightPoint);
	 //  	let s = $('html').scrollTop();
	 //  	if(s > heightPoint && !$(".screen-container .screen").hasClass("fixed")){
	 //  		$(".screen-container .screen").addClass('fixed').css('display', 'none');
	 //  		$(".screen-container .screen").fadeIn('fast');
	 //  	}

	 //  	if(s < heightPoint && $(".screen-container .screen").hasClass("fixed")){
	 //  		$(".screen-container .screen").removeClass('fixed');
	 //  	}
	});

</script>

<?php vjoin('Footer') ?>
