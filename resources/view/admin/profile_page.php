<? vjoin('admin-layouts/header'); ?>
<div class="container">
	<div class="page" id="Profile-edit-page">
		<div class="jumbotron">
		  <h1 class="display-6">Редактирования профиля
			<? if(isset($profile)): ?> <a href="<?= linkTo('ProfileController@page', ['slug' => $profile['slug']]) ?>" target="_blank"><?=$profile['name']?></a> ID <?= $profile['id'] ?> <?endif;?>
			</h1>

			<hr class="my-4">

			<div class="row">
				<div class="col-12 col-lg-6 col-xl-6 offset-lg-3 offset-xl-3">
					<br>
					<form action="<?= linkTo('ProfileController@profile_edit_page') ?>" method="get">
						<div class="row">
							<div class="col-12">
								<div class="form-group">
									<div class="input-group mb-2">
							      <input type="text" name="s" class="form-control" placeholder="Ссылка на страницу мага" value="<?= isset($_GET['s']) ? $_GET['s'] : '' ?>">
							      <div class="input-group-append">
											<button class="input-group-text btn Profile-search">Искать</button>
							      </div>
							    </div>
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>

			<? if (isset($profile)): ?>
				<br>
				<br>
				<form action="/admin/profile_update?s=<?= $_GET['s'] ?>" method="post" enctype="multipart/form-data">
				<div class="row">
						<input type="hidden" name="mid" value="<?= $profile['id'] ?>">
						<div class="col-12 col-lg-4 col-xl-4">
							<? if($profile['site_obj']['screen']): ?>
								<img src="<?= $profile['site_obj']['screen'] ?>" class="a-panel-img" alt="Icon"></span>
							<? endif; ?>
							<br>
							<br>
							<div class="form-group">
								<div class="input-group mb-3">
						      <div class="custom-file">
						        <input type="file" class="custom-file-input" id="screen" name="screen">
						        <label class="custom-file-label" for="screen">Загрузка изображения</label>
						      </div>
						      <div class="input-group-append">
						        <button type="submit" class="input-group-text" id="">Загрузить</button>
						        <div class="saved-loader" style="display: none; position: absolute; margin: 45px 0 0 -200px;">
								  	<h5>Загрузка...</h5>
								  	<div class="progress" style="width: 200px">
									  <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%"></div>
									</div>
							  </div>
						      </div>
						    </div>

							</div>
						</div>

						<div class="col-12 col-lg-8 col-xl-8">
							<div class="form-group">
								<label for="name">Название мага</label>
								<input type="text" id="name" class="form-control" name="name" placeholder="Название мага" value="<?= $profile['name'] ?>">
							</div>
							<div class="form-group">
								<label for="site">Редактирование url сайта</label>
								<input type="text" id="site" class="form-control" name="site" placeholder="Редактирование url сайта" value="<?= $profile['site'] ?>">
							</div>
							<div class="form-group">
								<label for="timestamp_date">Дата публикации</label>
								<div class="row">
									<div class="col-12 col-lg-6 col-xl-6">
										<input type="date" id="timestamp_date" class="form-control" name="timestamp_date" value="<?= $profile['timestamp_date'] ?>">
									</div>
									<div class="col-12 col-lg-6 col-xl-6">
										<input type="time" id="timestamp_time" class="form-control" name="timestamp_time" value="<?= $profile['timestamp_time'] ?>">
									</div>
								</div>
							</div>
							<div class="form-group">
								<label for="catid">Выбор категории</label>
								<select name="catid" id="catid" class="form-control">
									<?php foreach ($categories as $i => $cat): ?>
										<option value="<?= $cat['id'] ?>" <?= $cat['id'] == $profile['catid'] ? 'selected' : '' ?>><?= $cat['title'] ?></option>
									<?php endforeach ?>
								</select>
							</div>
							<div class="form-group">
								<label for="contacts">Контакты</label>
								<textarea type="text" id="contacts" class="form-control" name="contacts" placeholder="Контакты"><?= $profile['contacts'] ?></textarea>
							</div>
							<div class="form-group">
								<div class="custom-control custom-checkbox">
							      <input type="checkbox" class="custom-control-input" id="public_flag" name="public" <? if($profile['public_flag'] == '1'): ?>checked<? endif; ?>>
							      <label class="custom-control-label" for="public_flag">Публиковать</label>
							    </div>
							</div>
						</div>
						<div class="col-12">
							<div class="form-group">
								<label for="title">Заголовок сайта</label>
								<input type="text" id="title" class="form-control" name="title" placeholder="Заголовок сайта" value="<?= $profile['site_obj']['title'] ?>">
							</div>
						</div>
						<div class="col-12">
							<div class="row">
								<div class="col-12 col-lg-6 col-xl-6">
									<div class="form-group">
										<label for="domen_created">Дата создания домена (дата)</label>
										<input type="date" class="form-control" name="domen_created_date" id="domen_created_date" value="<?= $profile['site_obj']['domen_created_date'] ?>">
									</div>
								</div>
								<div class="col-12 col-lg-6 col-xl-6">
									<label for="domen_created">Дата создания домена (время)</label>
									<input type="time" class="form-control" name="domen_created_time" id="domen_created_time" value="<?= $profile['site_obj']['domen_created_time'] ?>">
								</div>
							</div>
						</div>
						<div class="col-12">
							<div class="form-group">
								<label for="description">Описание</label>
								<!-- <div id="description"><?= $profile['site_obj']['description'] ?></div> -->
								<? vjoin('admin-layouts/quill-toolbar') ?>
								<div id="content" class="quill-editor"><?= $profile['site_obj']['description'] ?></div>
								<textarea name="description" class="quill-textarea" id="" cols="30" rows="10"></textarea>
								<!-- <textarea name="description" style="height: 180px;" id="description" class="form-control" placeholder="Описание"><?= $profile['site_obj']['description'] ?></textarea> -->
							</div>
						</div>
					</div>
					<div class="col-12">
						<div class="form-group">
							<button type="submit" class="btn btn-primary">Сохранить</button>
							<div class="saved-loader" style="display: none;">
							  	<h5>Сохранение...</h5>
							  	<div class="progress" style="width: 200px">
								  <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%"></div>
								</div>
							  </div>
						</div>
					</div>
				</form>

				<div class="row">
					<div class="col-12">
						<hr>
						<div class="row">
								<div class="col-12 col-lg-6 col-xl-6">
									<h6>Выбранные теги</h6>
									<div class="alert alert-dismissible alert-secondary empty-tag-list-out d-none">
									  <strong>Ни один тег не добавлен.</strong> Для добавления выберите нужный тег из списка тегов
									</div>
									<ul class="list-group" id="tag-list-out">
										<? foreach($profile['tags'] as $tag): ?>
										  <li class="list-group-item d-flex justify-content-between align-items-center" tag-id="<?= $tag['id'] ?>">
										    <?= $tag['title'] ?> /<?= $tag['slug'] ?>/
										    <span class="badge badge-pill" style="cursor: pointer; padding: 5px; font-size: 16px; color: #FF4136" d-id="<?= $tag['id'] ?>"><i class="fa fa-times-circle" aria-hidden="true"></i></span>
										  </li>
										<? endforeach; ?>
									</ul>

								</div>
								<div class="col-12 d-block d-lg-none d-xl-none mob-vert-space"></div>
								<div class="col-12 col-lg-6 col-xl-6">
									<h6>Существующие теги</h6>
									<div class="form-group">
										<select id="tag-list" class="form-control" data-path-to-create="/admin/api/profile-tags/create/" data-path-to-remove="/admin/api/profile-tags/remove/">
											<option value="">Не выбрано</option>
											<? foreach($tag_list as $tag): ?>
												<option value="<?= $tag['id'] ?>:<?= $tag['slug'] ?>"><?= $tag['title'] ?></option>
											<? endforeach; ?>
										</select>
									</div>
								</div>
							</div>
							<br>
							<br>
						<a class="danger-link btn btn-danger" href="<?= linkTo('ProfileController@remove', ['id' => $profile['id']]); ?>"><i class="fa fa-trash"></i> Удалить мага</a>
					</div>
				</div>
			<? endif; ?>
		</div>
	</div>
</div>

<script>
	$(document).ready(function(){
		setInterval(function(){
			let container = $('#tag-list-out');
			if(container.find('li').length == 0){
				$('.empty-tag-list-out').removeClass("d-none");
			}else{
				$('.empty-tag-list-out').addClass("d-none");
			}
		}, 250);
	});
</script>

<script>
	$(document).ready(function(){
		$('button[type="submit"]').on('click', function(){
			$(this).hide();
			$(this).parent().find('.saved-loader').show();
		});
	});
</script>

<? vjoin('admin-layouts/footer'); ?>
