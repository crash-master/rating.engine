<div class="block new-users">
	<div class="block-icon"><i class="m-icon account-multiple"></i></div>
	<div class="block-title">Новые маги</div>
	<div class="block-body">
		<? foreach($last_added as $i => $item): ?>
		<div class="nu-item">
			<div class="row">
				<div class="col-2">
					<div class="nu-circle" style="background-color: <?= get_random_color() ?>"><?= $item['name'][0] ?></div>
				</div>
				<div class="col-10">
					<div class="nu-name"><a href="<?= linkTo('ProfileController@page', ['slug' => $item['slug']]) ?>" class="f-link"><?= $item['name'] ?></a></div>
					<div class="nu-site"><?= $item['site'] ?></div>
					<div class="nu-timastamp"><?= $item['timestamp'] ?></div>
				</div>
			</div>
		</div>
		<? endforeach; ?>
	</div>
</div>
