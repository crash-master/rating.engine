<?php vjoin('admin-layouts/header'); ?>

<div class="container">
	<div class="page" id="moderation">
		<h1 class="page-name">Модерация</h1>
		<div class="row">
			<div class="col-3">
				<ul>
					<li><a href="<?= linkTo('ProfileController@moderation') ?>">Новые профили</a></li>
					<li><a href="<?= linkTo('ReviewController@moderation') ?>">Новые отзывы</a></li>
					<li><a href="<?= linkTo('CommentController@moderation') ?>">Новые комментарии</a></li>
				</ul>
			</div>
			<div class="col-9">
				<div class="row">
					<? if($profile == true):?>
						<h5 class="col-12">Модерация новых профилей (<?= count($moderation_list); ?> шт)</h5>
						<? if(count($moderation_list)): ?>
							<? foreach($moderation_list as $i => $item): ?>
								<div class="col-xl-6 col-lg-8 col-12">
									<div class="card" style="margin-bottom: 25px;">
									  <div class="card-body">
									    <h5 class="card-title"><?= $item['name'] ?></h5>
									    <h6 class="card-subtitle mb-2 text-muted"><?= $item['timestamp'] ?></h6>
									    <p class="card-text"><a href="<?= $item['site'] ?>"><?= $item['site'] ?></a></p>
									    <a href="<?= linkTo('ProfileController@confirm', ['id' => $item['id']]) ?>" class="card-link btn btn-success">Одобрить</a>
									    <a href="<?= linkTo('ProfileController@reject', ['id' => $item['id']]) ?>" class="card-link btn btn-danger">Удалить</a>
									    <hr>
									    <a href="#" class="description-update">Редактировать описание</a>
									    <div class="description-form">
									    	<br>
									    	<textarea class="form-control" name="description" placeholder="Описание" id="" cols="30" rows="12"><?= $item['site_obj']['description'] ?></textarea><br>
									    	<button class="btn btn-primary update" data-url="<?= linkTo('SiteController@update_description', ['profileid' => $item['id']]) ?>">Сохранить</button>
									    	<button class="btn close">Отмена</button>
									  	</div>
									</div>
								</div>
							</div>
							<? endforeach; ?>
						<? endif; ?>
					<? endif; ?>

					<? if($review == true):?>
						<h5 class="col-12">Модерация новых отзывов (<?= count($moderation_list); ?> шт)</h5>
						<? if(count($moderation_list)): ?>
							<? foreach($moderation_list as $i => $item): ?>
								<div class="col-xl-6 col-lg-8 col-12">
									<div class="card" style="margin-bottom: 25px;">
									  <div class="card-body">
									    <h5 class="card-title"><?= $item['username'] ?> <small>(<?= $item['timestamp'] ?>)</small></h5>
									    <h6 class="card-subtitle mb-2 text-muted">Профиль: <a href="<?= linkTo('ProfileController@page', ['id' => $item['slug']]); ?>" target="_blank"><?= $item['profile']['name'] ?></a></h6>
									    <p class="card-text">
									    	<? if($item['image'] ): ?>
									    		<img src="<?= $item['image'] ?>" width="100%">
									    	<? endif; ?>
									    	<?= $item['message'] ?>
									    </p>
									    <a href="<?= linkTo('ReviewController@confirm', ['id' => $item['id']]) ?>" class="card-link btn btn-success">Одобрить</a>
									    <a href="<?= linkTo('ReviewController@reject', ['id' => $item['id']]) ?>" class="card-link btn btn-danger">Удалить</a>
									  </div>
									</div>
								</div>
							<? endforeach; ?>
						<? endif; ?>
					<? endif; ?>

					<? if($comment == true): ?>
						<h5 class="col-12">Модерация новых комментариев (<?= count($moderation_list); ?> шт)</h5>
						<? if(count($moderation_list)): ?>
							<? foreach($moderation_list as $i => $item): ?>
								<div class="col-xl-6 col-lg-8 col-12">
									<div class="card" style="margin-bottom: 25px;">
									  <div class="card-body">
									    <h5 class="card-title"><?= $item['name'] ?> <a href="<?= linkTo('ProfileController@page', ['slug' => $item['profile']['slug']]); ?>" target="_blank">к отзыву @<?= $item['review']['username'] ?>@</a></h5>
									    <p class="card-text">
									    	<b>Текст комментария:</b> <?= $item['message'] ?>
									    	<hr>
									    	Дата добавления <small>(<?= $item['timestamp'] ?>)</small>								    	
									    </p>
									    <a href="<?= linkTo('CommentController@confirm', ['id' => $item['id']]) ?>" class="card-link btn btn-success">Одобрить</a>
									    <a href="<?= linkTo('CommentController@reject', ['id' => $item['id']]) ?>" class="card-link btn btn-danger">Удалить</a>
									  </div>
									</div>
								</div>
							<? endforeach; ?>
						<? endif; ?>
					<? endif; ?>
				</div>	
			</div>
		</div>
	</div>
</div>

<?php vjoin('admin-layouts/footer'); ?>