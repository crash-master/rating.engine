<?php vjoin('admin-layouts/header'); ?>

<div class="container">
	<div class="page" id="moderation">
		<div class="jumbotron">
		  <h1 class="display-4">Модерация</h1>

			<hr class="my-4">
			<div class="row">
				<div class="col-3">
					<ul>
						<? if(re_is_visible(linkTo('ProfileController@moderation'))): ?><li><a href="<?= linkTo('ProfileController@moderation') ?>">Новые профили</a></li><? endif; ?>
						<? if(re_is_visible(linkTo('ReviewController@moderation'))): ?><li><a href="<?= linkTo('ReviewController@moderation') ?>">Новые отзывы</a></li><? endif; ?>
						<? if(re_is_visible(linkTo('CommentController@moderation'))): ?><li><a href="<?= linkTo('CommentController@moderation') ?>">Новые комментарии</a></li><? endif; ?>
					</ul>
				</div>
				<div class="col-9">
					<div class="row">
						<? if(isset($profile) and $profile == true):?>
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

						<? if(isset($review) and $review == true):?>
							<h5 class="col-12">Модерация новых отзывов (<?= count($moderation_list); ?> шт)</h5>
							<? if(count($moderation_list)): ?>
								<? foreach($moderation_list as $i => $item): ?>
									<div class="col-xl-6 col-lg-8 col-12">
										<div class="card" style="margin-bottom: 25px;">
										  <div class="card-body">
										    <h5 class="card-title"><?= $item['username'] ?> <small>(<?= $item['timestamp'] ?>)</small></h5>
										    <h6 class="card-subtitle mb-2 text-muted">Профиль: <a href="<?= $item['to_profile'] ?>" target="_blank"><?= $item['profile']['name'] ?></a></h6>
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

						<? if(isset($comment) and $comment == true): ?>
							<h5 class="col-12">Модерация новых комментариев (<?= count($moderation_list); ?> шт)</h5><br><br>
							<? if(count($moderation_list)): ?>
								<? foreach($moderation_list as $i => $item): ?>
									<div class="col-xl-6 col-lg-8 col-12">
										<div class="card" style="margin-bottom: 25px;">
										  <div class="card-body">
										    <h5 class="card-title"><a href="<?= linkTo('ProfileController@page', ['slug' => $item['profile']['slug']]); ?>" target="_blank"><?= $item['name'] ?></a></h5>
										    <? if(strpos($item['link']['link'], 'comment') !== false): ?>
										    	- к коментарию <?= $item['parent_comment']['name'] ?><br>
										    	<?php if (isset($item['review']['username'])): ?>
										    		- к отзыву <?= $item['review']['username'] ?><br>
										    	<?php endif ?>
										    	- в профиле <?= $item['profile']['name'] ?>
										    <? endif ?>
										    <? if(strpos($item['link']['link'], 'review') !== false): ?>
										    	- к отзыву <?= $item['review']['username'] ?>
										    	- в профиле <?= $item['profile']['name'] ?>
										    <? endif ?>
										    <? if(strpos($item['link']['link'], 'profile') !== false): ?>
										    	- к профилю <?= $item['profile']['name'] ?>
										    <? endif ?>
										    <br>
										    <br>
										    <p class="card-text" style="background-color: #ddd; padding: 10px 5px; width: 100%">
												<?= $item['message'] ?>
										    </p>
										    <a href="<?= linkTo('CommentController@confirm', ['id' => $item['id']]) ?>" class="card-link btn btn-success">Одобрить</a>
										    <a href="<?= linkTo('CommentController@reject', ['id' => $item['id']]) ?>" class="card-link btn btn-danger">Удалить</a>
										    <br><br>
										    <?= $item['timestamp'] ?>
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
</div>

<?php vjoin('admin-layouts/footer'); ?>
