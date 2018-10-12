<div class="comments-container">
	<?php foreach ($comments as $key => $comment): ?>
		<div class="comment-item <? if(isset($comment['answer_flag']) and $comment['answer_flag']): ?> ans<? endif ?>">
			<div class="comment-item-head">
				<div class="row">
					<div class="col-9">
						<a href="#" class="comment-item-username"><?= $comment['name'] ?></a>
						<!-- в 16.02.18 12:44 -->
						<!-- <?= $comment['timestamp'] ?> -->
					</div>
					<div class="col-3 comment-item-answer-wrap">
						<button class="yd-btn-simple comment-item-answer" type="button">Ответить</button>
					</div>
				</div>
			</div>
			<div class="comment-item-body comment-item-triangle">
				<div class="comment-item-message">
					<?= $comment['message'] ?>
					<? if(is_admin()): ?>
						<br>
						---- <a class="danger-link" href="<?= linkTo('CommentController@remove', ['id' => $comment['id']]) ?>">Удалить</a>
					<? endif; ?>
				</div>
				<div class="comment-item-answer-form">
					<? vjoin('yellow-drops/layouts/create-comment-form', ['profileid' => 0, 'commentid' => $comment['id']]) ?>
				</div>
			</div>
		</div>
	<?php endforeach ?>

</div>