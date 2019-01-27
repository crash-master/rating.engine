<section class="block no-border" id="last-reviews">
	<h2 class="block-title">Последние отзывы</h2>
	<div class="content">
		<?php foreach ($reviews as $i => $item): ?>
		<div class="review-item">
			<div class="row">
				<div class="col-2 thumb">
					<? if($item['rating'] == 1): ?>
						<i class="mdi mdi-thumb-up font-color-green mdi-big"></i><? elseif($item['rating'] == -1): ?>
						<i class="mdi mdi-thumb-down font-color-red mdi-big"></i><? else: ?>
						<i class="mdi mdi-thumb-up-down font-color-grey mdi-big"></i>
					<? endif; ?>
				</div>
				<div class="col-10">
					<div class="review-head">
						<span class="txt-grey-dark"><?= $item['username'] ?></span> <span class="txt-grey-light">о маге</span> <a href="<?= $item['to_profile'] ?>" class="std-a"><?= $item['profile']['name'] ?></a>
					</div>
					<div class="review-body txt-grey-dark">
						<?= $item['message'] ?>
					</div>
					<div class="review-foot">
						<span class="txt-grey-light timestamp">Оставлен <?= $item['timestamp'] ?></span> <a href="<?= $item['to_profile'] ?>#review-<?= $item['id'] ?>" class="std-a">Коментировать</a>
					</div>
				</div>
			</div>
		</div>
	<? endforeach; ?>

	</div>
</section>