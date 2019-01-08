<?php vjoin('admin-layouts/header'); ?>

<div class="container">
	<div class="page" id="articles">
		<div class="jumbotron">
			<h1 class="display-4">Статьи <a href="<?= linkTo('ArticleController@admin_create_page') ?>" class="btn btn-primary">Добавить</a></h1>
			<hr class="my-4">
			<div class="row" style="margin-top: 25px;">
				<div class="col-12 col-md-10 col-lg-8 col-xl-7">
					<div class="row">
						<div class="col">
							<span class="label">Фильтр по категориям</span>
							<select class="form-control" name="filter_by_cat" id="filter_by_cat">
								<option value="<?= linkTo('ArticleController@admin_article_list_page') ?>">Все статьи</option>
								<?php foreach ($cat_list as $cat): ?>
									<option value="<?= linkTo('ArticleController@admin_article_list_page_filtered_by_cat', ['cat_slug' => $cat['slug']]) ?>" <? if($cat['slug'] == $current_cat_slug): ?>selected<? endif; ?>>
										<?= $cat['title'] ?>
									</option>
								<?php endforeach ?>
							</select>
							<script>
								$('#filter_by_cat').on('change', function(){
									let route = $(this).val();
									console.log(route);
									document.location = route;
								});
							</script>
						</div>
						<!-- <div class="col-12 d-block d-lg-none d-xl-none mob-vert-space"></div> -->
						<div class="col">
							<h4 style="margin-top: 25px;">Всего в разделе статей <?= count($article_list) ?> </h4>
						</div>
					</div>
				</div>

				<div class="col-12" style="margin-top: 25px;">
					<?php if (count($article_list) > 0 && $article_list[0]): ?>
						<table class="table table-light">
							<thead class="thead-dark">
								<tr>
									<th class="mob-hid" scope="col">#</th>
									<th scope="col">Название</th>
									<th class="mob-hid" scope="col">Slug</th>
									<th scope="col" title="Редактировать"><i class="fa fa-edit"></i> <span class="mob-hid">Редактировать</span></th>
									<th scope="col" title="Удалить"><i class="fa fa-trash"></i> <span class="mob-hid">Удалить</span></th>
								</tr>
							</thead>
							<tbody>
								<?php foreach ($article_list as $key => $article): ?>
									<tr>
										<th class="mob-hid" scope="row"><?= $key + 1 ?></th>
										<td><?= $article['meta']['title'] ?></td>
										<td class="mob-hid"><?= $article['meta']['route'] ?></td>
										<td>
											<a href="<?= linkTo('ArticleController@admin_update_page', ['article_id' => $article['id']]) ?>">
												<i class="fa fa-edit"></i> <span class="mob-hid">Редактировать</span>
											</a>
										</td>
										<td>
											<a class="danger-link" href="<?= linkTo('ArticleController@remove', ['article_id' => $article['id']]) ?>">
												<i class="fa fa-trash"></i> <span class="mob-hid">Удалить</span>
											</a>
										</td>
										</tr>
								<?php endforeach ?>
							</tbody>
						</table>
					<?php else: ?>
						<div class="alert alert-warning" role="alert">
							Не добавлено ни одной статьи
						</div>
					<?php endif ?>
				</div>
		</div>
	</div>
</div>

<?php vjoin('admin-layouts/footer'); ?>