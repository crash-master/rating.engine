<section class="block" id="newProfiles">
	<h2 class="block-title">Новые спеиалисты в рейтинге</h2>
	<div class="content">
		<? foreach($last_added as $i => $item): ?>

		<div class="ng-item">
			<div class="row">
				<div class="col-lg-8 col-xl-8 col-12">
					<div class="Profile-info">
						<a href="<?= linkTo('ProfileController@page', ['slug' => $item['slug']]) ?>" class="std-a"><?= $item['name'] ?></a> <span class="txt-grey">- <?= $item['site'] ?></span>
					</div>
				</div>
				<div class="col-lg-4 col-xl-4 col-12 timestamp">
					<span class="txt-grey">Опубликовано <?= $item['timestamp'] ?></span>
				</div>
			</div>
		</div>

		<? endforeach; ?>
	</div>
</section>