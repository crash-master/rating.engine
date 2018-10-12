<aside class="sidebar">
	<? vjoin('yellow-drops/layouts/last-profiles') ?>
	<div class="sidebar-section" id="last-comments">
		<h3 class="sidebar-section-title">Последние коментарии</h3>
		<?php foreach ($last_comments as $comment): ?>
			<div class="comment-item">
				<div class="comment-head">
					<?= $comment['name'] ?> о маге 
					<a href="<?= $comment['profile']['to_profile'] ?>" class="profile-link"><?= $comment['profile']['name'] ?></a>
				</div>
				<div class="comment-body">
					<?= $comment['message'] ?>
				</div>
				<div class="comment-foot">
					<!-- <div class="timestamp"><?= $comment['timestamp'] ?></div> -->
				</div>
			</div>
		<?php endforeach ?>

	</div>
</aside>