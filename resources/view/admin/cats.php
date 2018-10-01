<?php vjoin('admin-layouts/header'); ?>
<div class="container">
	<div class="page" id="cats">
		<h1 class="page-name">Категории</h1>
		<div class="row" style="margin-top: 25px;">
			<ul class="list-group col-9">
				<? if(count($cat_list) > 0 && $cat_list[0]): ?>
					<? foreach($cat_list as $i => $item): ?>
					<li class="list-group-item"><?= $item['title'] ?> -------- <a href="<?= linkTo('CatsController@remove', ['id' => $item['id']]) ?>" class="remove btn btn-danger">Удалить</a></li>
					<? endforeach; ?>
				<? endif; ?>
			</ul>
			<div class="col-3">
				<form action="/admin/cats/new" method="post">
					<h5>Добавить категорию</h5>
					<div class="form-group">
					    <label for="s123">Название категории</label>
					    <input type="text" class="form-control" id="s123" name="title" placeholder="Название категории">
					  </div>
					  <button class="btn btn-primary">Добавить</button>
				</form>
			</div>
		</div>
	</div>
</div>

<?php vjoin('admin-layouts/footer'); ?>