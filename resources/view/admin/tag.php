<?php vjoin('admin-layouts/header'); ?>

<div class="container">
	<div class="page" id="tag">
		<h1 class="page-name">Управление тегами</h1>
		<div class="row">
			<div class="col-3">
				<form method="post">
					<input type="hidden" name="create-tag">
					<h5>Добавить тег</h5>
					<div class="form-group">
					    <label for="s123">Название тега</label>
					    <input type="text" class="form-control" id="s123" name="title" placeholder="Название тега">
					  </div>
					  <div class="form-group">
					    <label for="s1234">Slug</label>
					    <input type="text" class="form-control" id="s1234" name="slug" placeholder="Slug">
					  </div>
					  <button class="btn btn-primary">Добавить</button>
				</form>
			</div>
			<div class="col-9">
				<table class="table table-light">
					  <thead class="thead-dark">
					    <tr>
					      <th scope="col">#</th>
					      <th scope="col">Название</th>
					      <th scope="col">Slug</th>
					      <th scope="col" title="Удалить"><i class="fa fa-trash" aria-hidden="true"></i></th>
					    </tr>
					  </thead>
					  <tbody>
					  	<? $i = 0; foreach($tag_list as $tag): $i++; ?>
						<tr>
							<th scope="row"><?= $i ?></th>
							<td data-edit="/admin/tags/update/<?= $tag['id'] ?>/title/?"><?= $tag['title'] ?></td>
							<td data-edit="/admin/tags/update/<?= $tag['id'] ?>/slug/?"><?= $tag['slug'] ?></td>
							<td>
								<a class="danger-link" href="<?= linkTo('TagController@remove', ['tagid' => $tag['id']]); ?>">Удалить</a>
							</td>
						</tr>
					<? endforeach; ?>
					</tbody>
				</table>
			</div>
			
		</div>
	</div>
</div>

<?php vjoin('admin-layouts/footer'); ?>