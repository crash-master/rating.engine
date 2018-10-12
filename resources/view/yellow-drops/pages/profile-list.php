<? vjoin('yellow-drops/layouts/header') ?>

<? vjoin('yellow-drops/layouts/site-present', ['mini' => true]) ?>

<div class="container">
	<div class="row">
		<div class="col-4 d-none d-lg-block d-xl-block">
			<? vjoin('yellow-drops/layouts/sidebar') ?>
		</div>
		<div class="col-12 col-lg-8 col-xl-8">
			<section class="page" id="profile-list">
				<h2 class="page-title">Список магов</h2>
				<ul class="profile-list">
					<?php foreach ($profiles as $key => $profile): ?>
						<li class="profile-list-item">
							<div class="row">
								<div class="col-9">
									<a href="<?= $profile['to_profile'] ?>" class="profile-name"><?= $profile['name'] ?></a>
									<span class="link-to-site"><?= $profile['site'] ?></span>
								</div>
								<div class="col-3 timestamp"><?= $profile['timestamp'] ?></div>
							</div>
						</li>
					<?php endforeach ?>
				</ul>
			</section>
		</div>
	</div>
</div>

<? vjoin('yellow-drops/layouts/footer') ?>