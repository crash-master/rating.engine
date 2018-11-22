<?php vjoin('admin-layouts/header'); ?>
<div class="container">
	<div class="page" id="page-edit">
		<div class="jumbotron">
		  <h1 class="display-4"><?= isset($page) ? 'Редактирование' : 'Создание' ?> страницы</h1>

			<hr class="my-4">

			<div class="row">
				<div class="col-12">
					<form action="<?= isset($page) ? linkTo('PageController@update') : linkTo('PageController@create') ?>" method="post">
						<input type="hidden" name="<?= isset($page) ? 'update-page' : 'new-page' ?>" value="<?= !isset($page) ? '' : $page['id'] ?>">
						<div class="row">
							<div class="col-12 col-lg-6 col-xl-6">
								<div class="form-group">
									<label>Название страницы</label>
									<input type="text" class="form-control" name="title" placeholder="Название страницы" value="<?= !isset($page) ? '' : $page['title'] ?>">
								</div>
							</div>
							<div class="col-12 col-lg-6 col-xl-6">
								<div class="form-group">
									<label>Адрес страницы (slug)</label>
									<input type="text" class="form-control" name="route" placeholder="Адрес страницы (slug)" value="<?= !isset($page) ? '' : $page['route'] ?>">
								</div>
							</div>
						</div>
						<div class="form-group">
							<div class="row">
								<div class="col-4"><label>Контент страницы</label></div>
								<div class="col-8" style="text-align: right">
									<div class="form-group">
										<div class="custom-control custom-checkbox">
											<input type="checkbox" class="custom-control-input" id="is_text" name="is_text" <?= (isset($page) and $page['is_text'] == '1') ? 'checked' : '' ?>>
											<label class="custom-control-label" for="is_text">Текстовая страница</label>
										</div>
									</div>
								</div>
							</div>
							<div id="content"><?= !isset($page) ? '' : $page['content'] ?></div>
						</div>
						<div class="form-group">
							<label>Ключевые слова</label>
							<textarea class="form-control" rows="2" name="keywords" placeholder="Ключевые слова"><?= !isset($page) ? '' : $page['keywords'] ?></textarea>
						</div>
						<div class="form-group">
							<label>Описание страницы (description)</label>
							<textarea class="form-control" rows="3" name="description" placeholder="Описание страницы (description)"><?= !isset($page) ? '' : $page['description'] ?></textarea>
						</div>
						<div class="form-group">
							<button type="submit" class="btn btn-primary">Сохранить</button>
							<a href="<?= linkTo('PageController@admin_page') ?>" class="btn">Отмена</a>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
<?php vjoin('admin-layouts/footer'); ?>
