<div class="yd-block last-reviews">
	<h3 class="yd-block-title">Последние отзывы</h3>
	<div class="yd-block-container">

		<?php foreach ($last_comments as $comment): ?>
			<div class="review-item">
				<div class="review-name">
					<a href="<?= $comment['profile']['to_profile'] ?>"><?= $comment['name'] ?></a>
				</div>
				<div class="review-content">
					<?= nyd_excerpt_from_text($comment['message'], 30); ?>
				</div>
			</div>
		<?php endforeach ?>

	</div>
</div>