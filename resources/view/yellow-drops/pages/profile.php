<? vjoin('yellow-drops/layouts/header') ?>

<? vjoin('YDSitePresent', ['mini' => true]) ?>

<div class="container">
	<div class="row">
		<div class="col-4 d-none d-lg-block d-xl-block">
			<? vjoin('yellow-drops/layouts/sidebar') ?>
		</div>
		<div class="col-12 col-lg-8 col-xl-8">
			<section class="page" id="profile">

				<img src="<? if($profile['site_obj']['screen']): ?><?= $profile['site_obj']['screen'] ?><? else: ?>/resources/view/yellow-drops/assets/imgs/screen-site-big.png<? endif; ?>" alt="" class="profile-thumbnail">

				<div class="profile-head">
					<div class="row">
						<div class="col-12 col-lg-10 col-xl-10">
							<h2 class="profile-title"><?= $profile['name'] ?></h2>
							<noindex>
								<a rel="nofollow" href="<?= $profile['site_link'] ?>" class="profile-site-link"><?= $profile['site'] ?></a>
							</noindex>
							<? if(is_admin()): ?>
								<br>
								---- <a href="<?= linkTo('ProfileController@profile_edit_page') ?>?s=" onclick="this.href += document.location">Редактировать</a>
							<? endif; ?>
						</div>
						<div class="col-12 col-lg-2 col-xl-2">
							<div class="timestamp"><? list($profile['timestamp']) = explode(' ', $profile['timestamp']); echo $profile['timestamp'] ?></div>
						</div>
					</div>
				</div>
				<div class="profile-body">
					<h4 class="profile-body-title">Описание</h4>
					<div class="profile-txt">
						<? list(,$desc) = explode('::::', $profile['site_obj']['description']); echo $desc; ?>
					</div>
				</div>
				<div class="profile-foot">
					<div class="profile-count-comments">Комментариев: <span id="count-comments-container"></span></div>
				</div>
				
				<? vjoin('yellow-drops/layouts/create-comment-form', ['profileid' => $profile['id']]) ?>
				
				<? vjoin('yellow-drops/layouts/comments', ['profileid' => $profile['id']]) ?>
			</section>
		</div>
	</div>
</div>

<? vjoin('yellow-drops/layouts/footer') ?>