<? vjoin('admin-layouts/header'); ?>
<div class="container">
	<div class="page" id="Profile-edit-page">
		<h1 class="page-name">
			Редактирования профиля 
			<? if(isset($profile)): ?> <a href="<?= linkTo('ProfileController@page', ['slug' => $profile['slug']]) ?>" target="_blank"><?=$profile['name']?></a> ID <?= $profile['id'] ?> <?endif;?>
		</h1>
		<div class="row">
			<div class="col-8 offset-2">
				<br>
				<form action="<?= linkTo('ProfileController@profile_edit_page') ?>" method="get">
					<div class="row">
						<div class="col-10">
							<input type="text" name="s" class="form-control" placeholder="Ссылка на страницу мага" value="<?= isset($_GET['s']) ? $_GET['s'] : '' ?>">
						</div>
						<div class="col-2">	
							<button class="btn btn-primary Profile-search">Искать</button>
						</div>	
					</div>	
				</form>
			</div>	
		</div>

		<? if (isset($profile)): ?>
			<hr>
			<div class="row">
				<div class="col-8 offset-2">
					<form action="/admin/profile_update?s=<?= $_GET['s'] ?>" method="post" enctype="multipart/form-data">
						<br>
						<input type="hidden" name="mid" value="<?= $profile['id'] ?>">
						<input type="text" class="form-control" name="name" placeholder="Название мага" value="<?= $profile['name'] ?>">
						<br>
						<label for="screen">Скриншот</label><br>
						<input type="file" id="screen" name="screen" placeholder="Скриншот сайта">
						
						<? if($profile['site_obj']['screen']): ?>
							<br>
							<img src="<?= $profile['site_obj']['screen'] ?>" style="max-width: 256px" alt="Icon"></span>
						<? endif; ?>

						<br>
						<br>
						<input type="text" name="site" class="form-control" placeholder="Редактирование url сайта" value="<?= $profile['site'] ?>">
						<br>
						<textarea type="text" class="form-control" name="contacts" placeholder="Контакты"><?= $profile['contacts'] ?></textarea>
						<br>
						<textarea name="description" class="form-control" placeholder="Описание"><?= $profile['site_obj']['description'] ?></textarea>
						<br>
						<div class="form-check">
							<input type="checkbox" class="form-check-input" id="public_flag" name="public" <? if($profile['public_flag'] == '1'): ?>checked<? endif; ?>>
							<label for="public_flag" class="form-check-label">Публиковать</label>
						</div>
						<br>
						<button class="btn btn-primary">Сохранить</button>
					</form>
					<br>
					<div class="row">
							<div class="col-6">
								<h5>Выбранные теги</h5>
								<ul class="list-group" id="tag-list-out">
									<? foreach($profile['tags'] as $tag): ?>
										<li class="list-group-item" tag-id="<?= $tag['id'] ?>">
											<div class="row">
												<div class="col-8"><?= $tag['title'] ?> <small>(<?= $tag['slug'] ?>)</small></div> 
												<div class="col-4"><button class="btn" d-id="<?= $tag['id'] ?>">Удалить</button></div>
											</div>
										</li>
									<? endforeach; ?>
								</ul>
							</div>
							<div class="col-6">
								<h5>Существующие теги</h5>
								<div class="form-group">
									<select id="tag-list" class="form-control">
										<option value="">Не выбрано</option>
										<? foreach($tag_list as $tag): ?>
											<option value="<?= $tag['id'] ?>:<?= $tag['slug'] ?>"><?= $tag['title'] ?></option>
										<? endforeach; ?>
									</select>
								</div>
							</div>
						</div>
						<br>
					<a class="danger-link" href="<?= linkTo('ProfileController@remove', ['id' => $profile['id']]); ?>">Удалить мага</a>
				</div>	
			</div>
		<? endif; ?>
	</div>
</div>

<? vjoin('admin-layouts/footer'); ?>