<?php foreach ($data as $key => $profile): ?>
	<div class="rating-item">
	<div class="row">
		<div class="col-1">
			<div class="top number txt-grey-dark"><span><?= $profile['number_txt'] ?></span></div>
		</div>
		<div class="col-10 col-lg-7 col-xl-7 offset-1 offset-md-1 offset-sm-1 offset-lg-0 offset-xl-0">
			<div class="top Profile-info">
				<a href="<?= $profile['to_profile'] ?>" class="std-a Profile-name"><?= $profile['name'] ?></a><span class="txt-grey Profile-site"> - <?= $profile['site'] ?></span>
			</div>	
			<div class="bottom location txt-grey">
				Общий рейтинг: <strong class="txt-grey-dark"><?= $profile['rating'] ?></strong>
			</div>
		</div>
		<div class="col-10 col-lg-4 col-xl-4 offset-2 offset-md-2 offset-sm-2 offset-lg-0 offset-xl-0">
			<div class="top stats txt-grey-dark">
				<i class="m-icon thumb-up-green"></i> <?= $profile['count_like'] ?>
				<i class="m-icon thumb-down-red"></i> <?= $profile['count_dislike'] ?>
				<i class="m-icon thumbs-up-down"></i> <?= $profile['count_neutral'] ?>
			</div>
			<div class="bottom timestamp txt-grey">
				Добавлен <?= $profile['timestamp'] ?>
			</div>
		</div>
	</div>
</div>
<?php endforeach ?>
