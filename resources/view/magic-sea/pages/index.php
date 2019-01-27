<?php vjoin('magic-sea/layouts/header') ?>
<div class="container">
	<div id="home" class="page">
		<div class="check-block">
			<?= get_content_block('site_header_on_home_page') ?>
		</div>

		<div class="block-container">
			<? vjoin('high-profiles') ?>

			<? vjoin('global-stats') ?>

			<div class="row">
				<div class="col-lg-6">
					<? vjoin('last-reviews') ?>
				</div>

				<div class="col-lg-6">
					<? vjoin('last-profiles') ?>
				</div>
			</div>

		</div>
	</div>
</div>
<?php vjoin("Footer") ?>
