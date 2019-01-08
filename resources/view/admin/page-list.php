<?php vjoin('admin-layouts/header'); ?>
<div class="container">
	<div class="page" id="meta">
		<div class="jumbotron">
		  <h1 class="display-4">Список страниц <a href="<?= linkTo('PageController@create_page') ?>" class="btn btn-primary">Добавить новую</a></h1>

			<hr class="my-4">
			<div class="row">
				<div class="col-12">
					<?php if (count($pagelist)): ?>
						<table class="table table-light">
							<thead class="thead-dark">
								<tr>
									<th class="mob-hid" scope="col">#</th>
									<th scope="col">Название</th>
									<th scope="col">Slug</th>
									<th scope="col" title="Редактировать"><i class="fa fa-edit"></i> <span class="mob-hid">Редактировать</span></th>
									<th scope="col" title="Удалить"><i class="fa fa-trash"></i> <span class="mob-hid">Удалить</span></th>
								</tr>
							</thead>
							<tbody>
								<?php foreach ($pagelist as $key => $page): ?>
									<?// dd($page) ?>
									<tr>
										<th class="mob-hid" scope="row"><?= $key + 1 ?></th>
										<td data-edit="/admin/pages/update/<?= $page['id'] ?>/title/?"><?= $page['title'] ?></td>
										<td data-edit="/admin/pages/update/<?= $page['page_id'] ?>/route/?"><?= $page['route'] ?></td>
										<td>
											<a href="<?= linkTo('PageController@update_page', ['pageid' => $page['page_id']]) ?>">
												<i class="fa fa-edit"></i> <span class="mob-hid">Редактировать</span>
											</a>
										</td>
										<td>
											<a class="danger-link" href="<?= linkTo('PageController@remove', ['pageid' => $page['page_id']]) ?>">
												<i class="fa fa-trash"></i> <span class="mob-hid">Удалить</span>
											</a>
										</td>
									</tr>
								<?php endforeach ?>
							</tbody>
						</table>
					<?php else: ?>
						<div class="alert alert-warning" role="alert">
							Не добавлено ни одной страницы
						</div>
					<?php endif ?>
				</div>
			</div>
		</div>
	</div>
</div>
<?php vjoin('admin-layouts/footer'); ?>
