<? vjoin('Head') ?>
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
				<section class="page home">
					<?= get_content_block('content-home-page') ?>
				</section>
				<? //vjoin('Proved_profiles') ?>
			</main>
		</div>
	</div>
</div>

<? vjoin('new-yellow-drops/layouts/footer') ?>