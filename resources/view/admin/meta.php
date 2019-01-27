<?php vjoin('admin-layouts/header'); ?>
<div class="container">
	<div class="page" id="meta">
		<div class="jumbotron">
		  <h1 class="display-4">Meta</h1>

			<hr class="my-4">

			<div class="row">
				<div class="col-12 col-md-12 col-lg-6 col-xl-6">
					<h4>Основная информация</h4>
					<form action="/admin/meta/save/main-meta" method="post">
						<input type="hidden" name="main-meta">
					  <div class="form-group">
						<label>Название сайта</label>
						<input type="text" class="form-control" name="sitename" placeholder="Название сайта" value="<?= $metainfo['sitename'] ?>">
					  </div>
					  <div class="form-group">
						<label>URL сайта</label>
						<input type="text" class="form-control" name="siteurl" placeholder="URL сайта" value="<?= $metainfo['siteurl'] ?>">
					  </div>
					  <div class="form-group">
						<label>Код метрики</label>
						<textarea class="form-control" rows="3" name="metrica" placeholder="Код метрики"><?= $metainfo['metrica'] ?></textarea>
					  </div>
					  <div class="form-group">
						<labe>Пароль от админки</label>
						<input type="password" class="form-control" placeholder="Пароль" name="password">
					  </div>
					  <button type="submit" class="btn btn-primary">Сохранить</button>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
<?php vjoin('admin-layouts/footer'); ?>
