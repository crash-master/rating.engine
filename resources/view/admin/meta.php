<?php vjoin('admin-layouts/header'); ?>
<div class="container">
	<div class="page" id="meta">
		<div class="jumbotron">
		  <h1 class="display-4">Meta</h1>

			<hr class="my-4">

			<div class="row">
				<div class="col-6">
					<h4>Основная информация</h4>
					<form action="/admin/meta/save/main-meta" method="post">
						<input type="hidden" name="main-meta">
					  <div class="form-group">
						<label>Название сайта</label>
						<input type="text" class="form-control" name="sitename" placeholder="Название сайта" value="<?= $metainfo['sitename'] ?>">
					  </div>
					  <div class="form-group">
					    <label>Подзаголовок сайта</label>
					    <input type="text" class="form-control" name="sub_sitename" placeholder="Подзаголовок сайта" value="<?= $metainfo['sub_sitename'] ?>">
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

				<div class="col-6">
					<h4>Соц сети</h4>
					<form method="post" action="/admin/meta/save/social-links">
						<input type="hidden" name="social-links">
					  <div class="form-group">
						<label for="srfer">Facebook</label>
						<input type="text" class="form-control" id="srfer" name="facebook" aria-describedby="emailHelp" placeholder="Facebook ссылка" value="<?= $metainfo['social']['facebook'] ?>">
					  </div>
					  <div class="form-group">
						<label for="ysdvthtr">Twitter</label>
						<input type="text" class="form-control" id="ysdvthtr" name="twitter" aria-describedby="emailHelp" placeholder="Twitter ссылка" value="<?= $metainfo['social']['twitter'] ?>">
					  </div>
					  <div class="form-group">
						<label for="uyersey">VK</label>
						<input type="text" class="form-control" id="uyersey" name="vk" aria-describedby="emailHelp" placeholder="VK ссылка" value="<?= $metainfo['social']['vk'] ?>">
					  </div>
					  <button type="submit" class="btn btn-primary">Сохранить</button>
					</form>
				</div>
			</div>
		</div>
		<!-- <h1 class="page-name">Meta</h1> -->
	</div>
</div>
<?php vjoin('admin-layouts/footer'); ?>
