<?php vjoin('magic-sea/layouts/header') ?>
<div class="container">
	<div id="home" class="page">
		<div class="check-block">
			<!-- <button class="check-btn">Проверить мага</button> -->
			<h3>Единый рейтинг магов и экстрасенсов</h3>
			<p>Самый полный каталог специалистов в области эзотерики со всего СНГ.<br>Реальные отзывы людей</p>
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
