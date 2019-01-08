<?php vjoin('admin-layouts/header'); ?>

<div class="modal fade" id="create-new-tag" tabindex="-1" role="dialog" aria-labelledby="create-new-tag" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<form method="post">
				<input type="hidden" name="create-tag">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLongTitle">Добавлуние нового тега</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="form-group">
							<label for="s123">Название тега</label>
							<input type="text" class="form-control" id="s123" name="title" placeholder="Название тега">
						</div>
						<div class="form-group">
							<label for="s1234">Slug</label>
							<input type="text" class="form-control" id="s1234" name="slug" placeholder="Slug">
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn" data-dismiss="modal">Отмена</button>
						<button type="submit" class="btn btn-primary">Сохранить</button>
					</div>
			</form>
		</div>
	</div>
</div>

<div class="container">
	<div class="page" id="tag">
		<div class="jumbotron">
		  <h1 class="display-4">Управление тегами <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#create-new-tag">Добавить</button></h1>

			<hr class="my-4">
			<div class="row">
				<div class="col-12">
					<table class="table table-light">
						  <thead class="thead-dark">
						    <tr>
						      <th class="mob-hid" scope="col">#</th>
						      <th scope="col">Название</th>
						      <th scope="col">Slug</th>
						      <th scope="col" title="Удалить"><i class="fa fa-trash"></i> <span class="mob-hid">Удалить</span></th>
						    </tr>
						  </thead>
						  <tbody>
						  	<? $i = 0; foreach($tag_list as $tag): $i++; ?>
							<tr>
								<th class="mob-hid" scope="row"><?= $i ?></th>
								<td data-edit="/admin/tags/update/<?= $tag['id'] ?>/title/?"><?= $tag['title'] ?></td>
								<td data-edit="/admin/tags/update/<?= $tag['id'] ?>/slug/?"><?= $tag['slug'] ?></td>
								<td>
									<a class="danger-link" href="<?= linkTo('TagController@remove', ['tagid' => $tag['id']]); ?>">
										<i class="fa fa-trash"></i> <span class="mob-hid">Удалить</span>
									</a>
								</td>
							</tr>
						<? endforeach; ?>
						</tbody>
					</table>
				</div>

			</div>
		</div>
	</div>
</div>

<?php vjoin('admin-layouts/footer'); ?>
