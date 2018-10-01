<?php vjoin('admin-layouts/header'); ?>
<div class="container">
	<div class="page" id="meta">
		<h1 class="page-name">Meta</h1>
		<div class="row">
			<div class="col-6">
				<h4>Основная информация</h4>
				<form action="/admin/meta/save/main-meta" method="post">
					<input type="hidden" name="main-meta">
				  <div class="form-group">
				    <label for="exampleInputEmail1">Название сайта</label>
				    <input type="text" class="form-control" id="exampleInputEmail1" name="sitename" placeholder="Название сайта" value="<?= $metainfo['sitename'] ?>">
				  </div>
				  <div class="form-group">
				    <label for="exampleInputEmail121">URL сайта</label>
				    <input type="text" class="form-control" id="exampleInputEmail121" name="siteurl" placeholder="URL сайта" value="<?= $metainfo['siteurl'] ?>">
				  </div>
				  <div class="form-group">
				    <label for="qwewdczdcsd">Описание сайта</label>
				    <textarea class="form-control" id="qwewdczdcsd" rows="3" name="description" placeholder="Описание сайта"><?= $metainfo['description'] ?></textarea>
				  </div>
				  <div class="form-group">
				    <label for="qwewdczdcsd1">Код метрики</label>
				    <textarea class="form-control" id="qwewdczdcsd1" rows="3" name="metrica" placeholder="Код метрики"><?= $metainfo['metrica'] ?></textarea>
				  </div>
				  <div class="form-group">
				    <label for="exampleInputPassword1">Пароль от админки</label>
				    <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Пароль" name="password">
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
</div>
<?php vjoin('admin-layouts/footer'); ?>