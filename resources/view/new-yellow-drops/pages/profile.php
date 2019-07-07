<? vjoin('Head', ['profile' => $profile]) ?>
<? vjoin('new-yellow-drops/layouts/mobile-nav') ?>
<? vjoin('new-yellow-drops/layouts/nav') ?>
<? vjoin('new-yellow-drops/layouts/header') ?>

<div class="container">
	<div class="row">
		<div class="col-4">
			<? vjoin('new-yellow-drops/layouts/sidebar') ?>
		</div>
		<div class="col-xl-8 col-lg-8 col-md-12 col-sm-12">
			<main>
				<section class="page single-profile">
					<article>
						<? if($profile['site_obj']['screen']): ?>
							<img src="<?= $profile['site_obj']['screen'] ?>" class="profile-screen page-thumbnail">
						<? endif; ?>
						<h1 class="profile-title"><?= $profile['name'] ?></h1>
						<div class="profile-site">
							<!-- <noindex>
								<a href="<?= $profile['site_link'] ?>" rel="nofollow"><?= $profile['site'] ?></a>
							</noindex> -->
							<?= $profile['site'] ?>
						</div>
						<!-- <div class="profile-timestamp">Дата добавления <?= $profile['timestamp'] ?></div> -->
						<div class="profile-description">
							<h3 class="description-title">Описание</h3>
							<p>
								<?= $profile['site_obj']['description'] ?>
							</p>
						</div>
					</article>

					<? vjoin('Share') ?>

					<div class="form-new-comment create-comment-form">
						<h3 class="form-title">Вы можете написать отзыв</h3>
						<div class="row">
							<div class="col-12">
								<textarea name="message" id="message" class="yd-input textarea" placeholder="Ваш отзыв"></textarea>
							</div>
							<div class="col-12 col-lg-6 col-xl-6 col-md-6">
								<input type="text" class="yd-input" name="name" placeholder="Ваше имя" value="<?= \Kernel\Sess::get('username') ?>">
							</div>
							<div class="col-12 col-lg-6 col-xl-6 col-md-6">
								<input type="text" class="yd-input" name="email" placeholder="Ваш E-mail" value="<?= \Kernel\Sess::get('email') ?>">
							</div>
							<div class="col-12 submit-container">
								<button data-profile-id="<?= $profile['id'] ?>" class="yd-btn with-icon">Отправить <i class="mdi mdi-send"></i></button>

								<div class="form-state sending">
									<span class="spinner"></span>
									Отправка отзыва
								</div>

								<div class="form-state sending-success">
									<i class="mdi mdi-information-outline"></i>
									Ваш отзыв был успешно отправлен на модерацию
								</div>
							</div>
						</div>
						
					</div>
				</section>
				<? vjoin('new-yellow-drops/layouts/comments', ['profileid' => $profile['id']]) ?>
			</main>
		</div>
	</div>
</div>

<? vjoin('new-yellow-drops/layouts/footer') ?>