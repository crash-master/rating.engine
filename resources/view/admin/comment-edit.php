<? vjoin('admin-layouts/header'); ?>

<div class="container">
	<div class="page" id="Profile-edit-page">
		<div class="jumbotron">
			<h1 class="display-6">Редактирования коментария c ID <?= $comment['id'] ?></h1>
			<hr class="my-4">
			
			<div class="row">
				<div class="col-12 col-lg-6 col-xl-6">
					<h3>Редактирование</h3>
					<form action="<?= linkTo('CommentController@update_comment') ?>" method="post">
						<input type="hidden" name="update-comment">
						<input type="hidden" name="comment_id" value="<?= $comment['id'] ?>">
						<div class="form-group">
							<label for="name">Имя пользователя</label>
							<input type="text" class="form-control" name="name" id="name" value="<?= $comment['name'] ?>" placeholder="Имя пользователя">
						</div>

						<div class="form-group">
							<label>Дата добавления</label>
							<input type="date" name="timestamp_date" class="form-control" value="<?= $comment['timestamp_date'] ?>"><br>
							<input type="time" name="timestamp_time" class="form-control" value="<?= $comment['timestamp_time'] ?>">
						</div>

						<div class="form-group">
							<label>Текст отзыва</label>
							<textarea name="message" class="form-control" placeholder="Рекст отзыва" style="height: 130px"><?= $comment['message'] ?></textarea>
						</div>

						<button class="btn btn-primary">Сохранить</button>
						<a href="<?= linkTo('CommentController@remove', ['id' => $comment['id']]) ?>" class="danger-link" style="color: red; display: inine-block; margin-left: 40px">Удалить</a>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>

<? vjoin('admin-layouts/footer'); ?>	