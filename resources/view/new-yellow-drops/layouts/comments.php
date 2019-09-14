<section class="comments">
	<div class="comments-header"><?= count($comments) ?> Коментариев к "<?= $profile['name'] ?>"</div>
	<div class="comments-container">
		<? if(count($comments)): ?>
			<?php foreach ($comments as $key => $comment): ?>
				<div class="comment-item <? if($comment['answer_flag']): ?>answer_<?= $comment['answer_flag'] ?><? endif ?>">
					<div class="comment-head">
						<div class="user-name"><?= $comment['name'] ?></div>
						<div class="comment-timestamp"><?= $comment['timestamp'] ?></div>
						<? if($comment['answer_flag'] < 3): ?>
							<div class="answer-btn-container">
								<a href="<?= $comment['id'] ?>" class="answer">ответить <i class="mdi mdi-reply"></i></a>
							</div>
						<? endif ?>
					</div>
					<div class="comment-body">
						<?= $comment['message'] ?>
						<? if(is_admin()): ?>
							<br>
							<a class="danger-link" target="_blank" href="<?= linkTo('CommentController@edit_comment_page', ['comment_id' => $comment['id']]) ?>">Редактировать</a>
							&nbsp;
							<small><a class="danger-link" href="<?= linkTo('CommentController@remove', ['id' => $comment['id']]) ?>">Удалить</a></small>
						<? endif; ?>
					</div>
				</div>  
			<? endforeach ?>
		<? endif; ?>
	</div>
</section>