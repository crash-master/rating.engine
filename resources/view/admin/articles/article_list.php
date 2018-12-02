<?php vjoin('admin-layouts/header'); ?>

<div class="container">
	<div class="page" id="articles">
		<div class="jumbotron">
			<h1 class="display-4">Статьи <a href="<?= linkTo('ArticleController@admin_create_page') ?>" class="btn btn-primary">Добавить</a></h1>
			<hr class="my-4">
			<div class="row" style="margin-top: 25px;">
				<div class="col-12">
					<?php if (count($article_list) > 0 && $article_list[0]): ?>
						<table class="table table-light">
							<thead class="thead-dark">
								<tr>
									<th scope="col">#</th>
									<th scope="col">Название</th>
									<th scope="col">Slug</th>
									<th scope="col" title="Редактировать">Редактировать</th>
									<th scope="col" title="Удалить">Удалить</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach ($article_list as $key => $article): ?>
									<tr>
										<th scope="row"><?= $key + 1 ?></th>
										<td><?= $article['meta']['title'] ?></td>
										<td><?= $article['meta']['route'] ?></td>
										<td>
											<a href="<?= linkTo('ArticleController@admin_update_page', ['article_id' => $article['id']]) ?>">Редактировать</a>
										</td>
										<td>
											<a class="danger-link" href="<?= linkTo('ArticleController@remove', ['article_id' => $article['id']]) ?>">Удалить</a>
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