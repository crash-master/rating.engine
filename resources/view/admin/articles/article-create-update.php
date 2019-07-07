<?php vjoin('admin-layouts/header'); ?>

<div class="container">
	<div class="page" id="articles">
		<div class="jumbotron">
		 	<h1 class="display-4"><? if($update_flag): ?> Редактирование статьи <? else: ?> Новая статья <? endif; ?></h1>
			<hr class="my-4">

			<div class="row">
				<div class="col-12">
					<form action="<?= isset($article) ? linkTo('ArticleController@update') : linkTo('ArticleController@create') ?>" method="post" enctype="multipart/form-data">
						<input type="hidden" name="<?= isset($article) ? 'article-update' : 'article-create' ?>" value="<?= !isset($article) ? '' : $article['id'] ?>">
						<? if(isset($article)): ?><input type="hidden" name="mid" value="<?= $article['id'] ?>"><? endif; ?>
						<div class="row">
							<div class="col-12 col-lg-7 col-xl-7">
								<div class="form-group">
									<label>Название статьи</label>
									<input type="text" class="form-control" name="title" placeholder="Название статьи" value="<?= !isset($article) ? '' : $article['meta']['title'] ?>">
								</div>
								<div class="form-group">
									<label>Адрес статьи (slug) 
										<? if(!isset($article)): ?>
											/article/...
										<? else: ?>
											<a href="<?= $article['link'] ?>" target="_blank"><?= $article['link'] ?></a> 
										<? endif ?>
									</label>
									<input type="text" class="form-control" name="route" placeholder="/article/..." value="<?= !isset($article) ? '' : $article['meta']['route'] ?>">
								</div>
								<div class="form-group">
								<label for="timestamp_date">Дата публикации</label>
									<div class="row">
										<div class="col-12 col-lg-6 col-xl-6">
											<input type="date" id="timestamp_date" class="form-control" name="timestamp_date" value="<?= $article['timestamp_date'] ?>">
										</div>
										<div class="col-12 col-lg-6 col-xl-6">
											<input type="time" id="timestamp_time" class="form-control" name="timestamp_time" value="<?= $article['timestamp_time'] ?>">
										</div>
									</div>
								</div>
								<div class="form-group">
									<div class="custom-control custom-checkbox">
										<input type="checkbox" class="custom-control-input" id="published" name="published" <?= (isset($article) and $article['published'] == '1') ? 'checked' : '' ?>>
										<label class="custom-control-label" for="published">Публиковать</label>
									</div>
								</div>
								<div class="form-group">
									<div class="custom-control custom-checkbox">
										<input type="checkbox" class="custom-control-input" id="with_comments" name="with_comments" <?= (isset($article) and $article['with_comments'] == '1') ? 'checked' : '' ?>>
										<label class="custom-control-label" for="with_comments">Включить комментарии</label>
									</div>
								</div>
								<div class="form-group">
									<label for="catid">Выбор категории</label>
									<select name="catid" id="catid" class="form-control">
										<option value="0">Без категории</option>
										<?php foreach ($categories as $i => $cat): ?>
											<option value="<?= $cat['id'] ?>" <?= $cat['id'] == $article['category']['id'] ? 'selected' : '' ?>><?= $cat['title'] ?></option>
										<?php endforeach ?>
									</select>
								</div>
							</div>
							<div class="col-12 col-lg-5 col-xl-5">
								<? if(isset($article) and isset($article['thumbnail']) and $article['thumbnail']): ?>
									<img src="<?= $article['thumbnail'] ?>" class="a-panel-img" alt="Thumbnail">
								<? endif ?>
								<br><br>
								<div class="input-group mb-3">
							      <div class="custom-file">
							        <input type="file" class="custom-file-input" id="thumbnail" name="thumbnail">
							        <label class="custom-file-label" for="thumbnail">Загрузить обложку статьи</label>
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
						<div class="form-group">
							<? vjoin('admin-layouts/quill-toolbar') ?>
							<div id="content" class="quill-editor"><?= !isset($article) ? '' : $article['content'] ?></div>
							<textarea name="content" class="quill-textarea" id="" cols="30" rows="10"></textarea>
						</div>
						<div class="form-group">
							<label>Ключевые слова</label>
							<textarea class="form-control" rows="2" name="keywords" placeholder="Ключевые слова"><?= !isset($article) ? '' : $article['meta']['keywords'] ?></textarea>
						</div>
						<div class="form-group">
							<label>Описание статьи (description)</label>
							<textarea class="form-control" rows="3" name="description" placeholder="Описание статьи (description)"><?= !isset($article) ? '' : $article['meta']['description'] ?></textarea>
						</div>
						<div class="form-group">
							<button type="submit" class="btn btn-primary">Сохранить</button>
							<a href="<?= linkTo('ArticleController@admin_article_list_page') ?>" class="btn">Отмена</a>
							<div class="saved-loader" style="display: none; position: absolute;">
							  	<h5>Загрузка...</h5>
							  	<div class="progress" style="width: 200px">
								  <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%"></div>
								</div>
						   </div>
						</div>
					</form>
				</div>
			</div>
			<? if(isset($article)): ?>
			<div class="row">
				<div class="col-12">
					<hr>
					<div class="row">
						<div class="col-6">
							<h6>Выбранные теги</h6>
							<div class="alert alert-dismissible alert-secondary empty-tag-list-out d-none">
							  <strong>Ни один тег не добавлен.</strong> Для добавления выберите нужный тег из списка тегов
							</div>
							<ul class="list-group" id="tag-list-out">
								<? foreach($article['tags'] as $tag): ?>
								  <li class="list-group-item d-flex justify-content-between align-items-center" tag-id="<?= $tag['id'] ?>">
								    <?= $tag['title'] ?> /<?= $tag['slug'] ?>/
								    <span class="badge badge-pill" style="cursor: pointer; padding: 5px; font-size: 16px; color: #FF4136" d-id="<?= $tag['id'] ?>"><i class="fa fa-times-circle" aria-hidden="true"></i></span>
								  </li>
								<? endforeach; ?>
							</ul>

						</div>
						<div class="col-6">
							<h6>Существующие теги</h6>
							<div class="form-group">
								<select id="tag-list" class="form-control" data-path-to-create="/admin/api/article-tags/create/" data-path-to-remove="/admin/api/article-tags/remove/">
									<option value="">Не выбрано</option>
									<? foreach($tag_list as $tag): ?>
										<option value="<?= $tag['id'] ?>:<?= $tag['slug'] ?>"><?= $tag['title'] ?></option>
									<? endforeach; ?>
								</select>
							</div>
						</div>
					</div>
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


<?php vjoin('admin-layouts/footer'); ?>