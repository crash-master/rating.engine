<?php vjoin('admin-layouts/header'); ?>
<div class="container">
	<div class="page" id="cats">
		<h1 class="page-name">Категории <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#create-new-cat">Добавить</button></h1>
		
		<div class="modal fade" id="create-new-cat" tabindex="-1" role="dialog" aria-labelledby="create-new-cat" aria-hidden="true">
		  <div class="modal-dialog modal-dialog-centered" role="document">
		    <div class="modal-content">
		    	<form action="/admin/cats/new" method="post">
			      <div class="modal-header">
			        <h5 class="modal-title" id="exampleModalLongTitle">Добавление новой категории</h5>
			        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			          <span aria-hidden="true">&times;</span>
			        </button>
			      </div>
			      <div class="modal-body">
					<div class="form-group">
					    <label>Название категории</label>
					    <input type="text" class="form-control" name="title" placeholder="Название категории">
					  </div>
					  <div class="form-group">
					  	<label>Slug категории</label>
					  	<input type="text" class="form-control" name="slug" placeholder="Slug">
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

		<div class="row" style="margin-top: 25px;">
			<div class="col-12">
				<?php if (count($cat_list) > 0 && $cat_list[0]): ?>
					<table class="table table-light">
						<thead class="thead-dark">
							<tr>
								<th scope="col">#</th>
								<th scope="col">Название</th>
								<th scope="col">Slug</th>
								<th scope="col" title="Удалить">Удалить</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach ($cat_list as $key => $item): ?>
								<tr>
									<th scope="row"><?= $key + 1 ?></th>							
									<td data-edit="/admin/cats/update/<?= $item['id'] ?>/title/?"><?= $item['title'] ?></td>
									<td data-edit="/admin/cats/update/<?= $item['id'] ?>/slug/?"><?= $item['slug'] ?></td>
									<td>
										<a class="danger-link" href="<?= linkTo('CatsController@remove', ['id' => $item['id']]) ?>">Удалить</a>
									</td>
									</tr>
							<?php endforeach ?>
						</tbody>
					</table>
				<?php else: ?>	
					<div class="alert alert-warning" role="alert">
						Не добавлено ни одной категории
					</div>
				<?php endif ?>
			</div>
		</div>
	</div>
</div>

<?php vjoin('admin-layouts/footer'); ?>