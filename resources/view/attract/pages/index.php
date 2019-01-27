<? vjoin('attract/layouts/header') ?>
<div class="container">
<? vjoin('attract/layouts/blocks/carousel') ?>

	<section class="block" id="home-info">
		<div class="content">
			<?= get_content_block('preface'); ?>
		</div>
	</section>

	<? vjoin('attract/layouts/blocks/high-profiles') ?>

	<div class="row">
		<div class="col-12 col-lg-6 col-xl-6">
			<section class="block no-border">
				<div class="content txt-grey">
					<?= get_content_block('after-high-profiles-block'); ?>
				</div>
			</section>
		</div>

		<div class="col-12 col-lg-6 col-xl-6">
			<? vjoin('attract/layouts/blocks/tags-cloud') ?>
		</div>
	</div>

	<div class="col-12 border-bottom"></div>

	<div class="row m-bottom">
		<div class="col-12 col-lg-6 col-xl-6">
			<? vjoin('attract/layouts/blocks/last-reviews') ?>
		</div>

		<div class="col-12 col-lg-6 col-xl-6">
			<? vjoin('attract/layouts/blocks/global-stats') ?>
		</div>
	</div>

	<div class="col-12 border-bottom"></div>

	<? vjoin('attract/layouts/blocks/last-profiles') ?>
	<? vjoin('attract/layouts/blocks/blog-articles') ?>
</div>

<? vjoin('attract/layouts/footer') ?>