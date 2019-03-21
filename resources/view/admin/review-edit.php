<? vjoin('admin-layouts/header'); ?>

<div class="container">
	<div class="page" id="Profile-edit-page">
		<div class="jumbotron">
			<h1 class="display-6">Редактирования отзыва c ID <?= $review['id'] ?></h1>
			<hr class="my-4">
			
			<div class="row">
				<div class="col-12 col-lg-6 col-xl-6">
					<h3>Техническая информация</h3>
					<dl>
						<dt>Оставлен в профиле</dt>
						<dd><a href="<?= linkTo('ProfileController@page', ['slug' => $review['profile']['slug']]) ?>" target="_blank "><?= $review['profile']['name'] ?></a></dd>

						<dt>Email пользователя</dt>
						<dd><?= $review['email'] ?></dd>

						<dt>IP пользователя</dt>
						<dd><?= $review['user_ip'] ?></dd>

						<dt>Знак отзыва</dt>
						<dd><? if($review['rating'] == 1): ?> <em>Позитивный</em> <? elseif($review['rating'] == -1): ?> <em>Негативный</em> <? else: ?> Нейтральный <? endif ?></dd>
					</dl>
				</div>
				<div class="col-12 col-lg-6 col-xl-6">
					<h3>Редактирование</h3>
					<form action="<?= linkTo('ReviewController@update_review') ?>" method="post">
						<input type="hidden" name="update-review">
						<input type="hidden" name="review_id" value="<?= $review['id'] ?>">
						<div class="form-group">
							<label for="username">Имя пользователя</label>
							<input type="text" class="form-control" name="username" id="username" value="<?= $review['username'] ?>" placeholder="Имя пользователя">
						</div>

						<div class="form-group">
							<label for="country">Страна пользователя</label>
							<input type="text" class="form-control" name="country" id="country" value="<?= $review['country'] ?>" placeholder="Страна пользователя">
						</div>

						<div class="form-group">
							<label for="city">Город пользователя</label>
							<input type="text" class="form-control" name="city" id="city" value="<?= $review['city'] ?>" placeholder="Город пользователя">
						</div>

						<div class="form-group">
							<label>Дата добавления</label>
							<input type="date" name="timestamp_date" class="form-control" value="<?= $review['timestamp_date'] ?>"><br>
							<input type="time" name="timestamp_time" class="form-control" value="<?= $review['timestamp_time'] ?>">
						</div>

						<div class="form-group">
							<label>Текст отзыва</label>
							<textarea name="message" class="form-control" placeholder="Рекст отзыва" style="height: 130px"><?= $review['message'] ?></textarea>
						</div>

						<button class="btn btn-primary">Сохранить</button>
						<a href="<?= linkTo('ReviewController@remove', ['id' => $review['id']]) ?>" class="danger-link" style="color: red; display: inine-block; margin-left: 40px">Удалить</a>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>

<? vjoin('admin-layouts/footer'); ?>	