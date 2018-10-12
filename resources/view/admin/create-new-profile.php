<?php vjoin('admin-layouts/header'); ?>
<div class="container">
	<div class="page" id="meta">
		<h1 class="page-name">Добавление нового профиля</h1>
		<div class="row">
			<div class="col-12">
				<form action="<?= linkTo('ProfileController@admin_create_profile') ?>" method="post">
					<input type="hidden" name="admin-create-new-profile">
				  <div class="form-group">
				    <label for="exampleInputEmail121">URL сайта</label>
				    <input type="text" class="form-control" id="exampleInputEmail121" name="site" placeholder="URL сайта">
				  </div>
				  <div class="form-group">
				    <label for="exampleInputEmail121">Имя профиля</label>
				    <input type="text" class="form-control" id="exampleInputEmail121" name="name" placeholder="Имя профиля">
				  </div>
				  <div class="form-group">
				    <label for="qwewdczdcsd">Описание</label>
				    <textarea class="form-control" id="qwewdczdcsd" rows="3" name="description" placeholder="Описание сайта"></textarea>
				  </div>
				  <div class="form-group">
				    <label for="qwewdczdcsd1">Выберите категорию</label>
				    <select name="catid" id="qwewdczdcsd1" class="form-control">
				    	<option value="0">--- Выберите категорию ---</option>
				    	<?php foreach ($cats as $cat): ?>
				    		<option value="<?= $cat['id'] ?>"><?= $cat['title'] ?></option>
				    	<?php endforeach ?>
				    </select>
				  </div>
				  <button type="submit" class="btn btn-primary">Сохранить</button>
				</form>
			</div>
		</div>
	</div>
</div>
<?php vjoin('admin-layouts/footer'); ?>