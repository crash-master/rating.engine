<? vjoin('yellow-drops/layouts/header') ?>

<? vjoin('yellow-drops/layouts/site-present', ['mini' => true]) ?>

<div class="container">
	<div class="row">
		<div class="col-4 d-none d-lg-block d-xl-block">
			<? vjoin('yellow-drops/layouts/sidebar') ?>
		</div>
		<div class="col-12 col-lg-8 col-xl-8">
			<section class="page" id="info-page">
				<h2 class="page-title"><?= $page['title'] ?></h2>
				<?= $page['content'] ?>
			</section>
		</div>
	</div>
</div>

<? vjoin('yellow-drops/layouts/footer') ?>