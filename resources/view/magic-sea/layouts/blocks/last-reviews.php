<div class="block last-comments">
	<div class="block-icon"><i class="m-icon comment-text-multiple"></i></div>
	<div class="block-title">Последние отзывы</div>
	<div class="block-body">
		<?php foreach ($reviews as $i => $item): ?>

			<div class="lc-item">
				<div class="row">
					<div class="col-12">
						<div class="lc-name">
							<? if($item['rating'] == 1): ?>
								<i class="m-icon like"></i><? elseif($item['rating'] == -1): ?>
								<i class="m-icon dislike"></i><? else: ?>
								<i class="m-icon thumbs-up-down"></i>
							<? endif; ?> <?= $item['username'] ?> <small>о маге</small> <a href="<?= linkTo('ProfileController@page', ['slug' => $item['profile']['slug']]) ?>"><?= $item['profile']['name'] ?></a>
						</div>
					</div>
					<div class="col-12">
						<div class="lc-timestamp"><?= $item['timestamp'] ?></div>
					</div>
				</div>
				<div class="row">
					<div class="col-12">
						<div class="lc-comment"><?= $item['message'] ?></div>
					</div>
				</div>
			</div>

		<?php endforeach ?>

	</div>
</div>
