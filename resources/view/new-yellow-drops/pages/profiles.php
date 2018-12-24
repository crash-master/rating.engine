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
				<section class="page profiles">
					<?php if (isset($tag) or isset($category)): ?>
						<h1 class="yd-page-title"><? if(isset($category)) echo $category['title']; elseif(isset($tag)) echo '#'.$tag['title'] ?></h1>	
					<?php endif ?>

					<? if(!count($profiles)): ?>
						<div class="no-content">На этой странице ещё нет ни одной записи</div>
					<? endif ?>
					
					<? if(count($profiles)): ?>
						<?php foreach ($profiles as $i => $profile): ?>
								<div class="profile-item">
									<h1 class="profile-name">
										<a href="<?= $profile['to_profile'] ?>"><?= $profile['name'] ?></a>
									</h1>
									<div class="profile-timestamp">Дата добавления <?= nyd_short_timestamp($profile['timestamp']) ?></div>
									<div class="profile-thumb" style="background-image: url('<?= $profile['site_obj']['screen'] ? $profile['site_obj']['screen'] : '/resources/view/new-yellow-drops/assets/imgs/no-img.jpg'; ?>')"></div>
									<div class="profile-description">
										<p class="text">
											<?= nyd_excerpt_from_text($profile['site_obj']['description'], 50); ?>
										</p>
										<div class="read-more">
											<a href="<?= $profile['to_profile'] ?>" class="yd-btn with-icon go-to-profile">Читать дальше <i class="mdi mdi-account-card-details"></i></a>
										</div>
									</div>
								</div>
							<?php endforeach ?>
					<? endif; ?>

				</section>
				<? if(count($profiles)): ?>
					<section class="simple-pagination full-pagination">
						<? $pag = nyd_profiles_pag($page_num, $category); ?>
						<div class="row">
							<div class="col-2 col-md-4 col-xl-4 col-lg-4 simple-pagination-section">
								<?php if ($pag['prev']): ?>
									<a href="<?= $pag['prev'] ?>" class="prev-page">
										<span class="yd-btn">
											<i class="mdi mdi-chevron-left"></i>
										</span>	
										<span class="btn-label">Предыдущая</span>
									</a>
								<? endif; ?>
							</div>
							<div class="col-8 col-md-4 col-xl-4 col-lg-4 simple-pagination-section">
								<div class="simple-pages">
									<?= $pag['pages'] ?>
								</div>	
							</div>
							<div class="col-2 col-md-4 col-xl-4 col-lg-4 simple-pagination-section">
								<?php if ($pag['next']): ?>
									<a href="<?= $pag['next'] ?>" class="next-page">
										<span class="btn-label">Следующая</span>
										<span class="yd-btn">
											<i class="mdi mdi-chevron-right"></i>
										</span>	
									</a>
								<? endif; ?>
							</div>
						</div>
					</section>
				<? endif ?>
			</main>
		</div>
	</div>
</div>

<? vjoin('new-yellow-drops/layouts/footer') ?>

