<?php vjoin('admin-layouts/header'); ?>

<div class="container">
	<div class="page" id="articles">
		<div class="jumbotron">
		 	<h1 class="display-4">Пользовательские настройки</h1>
			<hr class="my-4">
			<h4>Основные настройки сайта</h4>
			<form action="/admin/meta/save/main-meta" method="post">
				<input type="hidden" name="main-meta">
			  <div class="form-group">
				<label>Название сайта</label>
				<input type="text" class="form-control" name="sitename" placeholder="Название сайта" value="<?= $metainfo['sitename'] ?>">
			  </div>
			  <div class="form-group">
				<label>Дефолтное описание <small>(Будет использовано на страницах без описания)</small></label>
				<textarea class="form-control" rows="3" name="description" placeholder="Дефолтное описание"><?= $metainfo['description'] ?></textarea>
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
			<hr class="my-4">
			<h4>Дополнительные настройки сайта</h4>
			<form action="<?= linkTo('SettingsController@update') ?>" method="post">
				<input type="hidden" name="update-settings">
				<div class="row">
					<div class="col-12 col-lg-6 col-xl-6">
						<div class="form-group">
							<label>Количество статей на одной странице</label>
							<input type="number" step="2" min="2" max="100" class="form-control" name="count_articles_on_page" placeholder="Количество статей" value="<?= $settings['count_articles_on_page'] ?>">
						</div>
						<div class="form-group">
							<label>Поиск</label>

							<div class="custom-control custom-radio">
			                    <input type="radio" id="customRadio1" name="search_by" class="custom-control-input" value="articles" <? if($settings['search_by'] == 'articles'): ?>checked=""<? endif; ?>>
			                    <label class="custom-control-label" for="customRadio1">По статьям</label>
			                </div>
			                <div class="custom-control custom-radio">
			                    <input type="radio" id="customRadio2" name="search_by" class="custom-control-input" value="profiles" <? if($settings['search_by'] == 'profiles'): ?>checked=""<? endif; ?>>
			                    <label class="custom-control-label" for="customRadio2">По профилям</label>
			                </div>
			                <div class="custom-control custom-radio">
			                    <input type="radio" id="customRadio3" name="search_by" class="custom-control-input" value="articles and profiles" <? if($settings['search_by'] == 'articles and profiles'): ?>checked=""<? endif; ?>>
			                    <label class="custom-control-label" for="customRadio3">По статьям и профилям</label>
			                </div>
						</div>
					</div>
					<div class="col-12 col-lg-6 col-xl-6">
						<div class="form-group">
							<label>Количество профилей на одной странице</label>
							<input type="number" step="2" min="2" max="100" class="form-control" name="count_profiles_on_page" placeholder="Количество профилей" value="<?= $settings['count_profiles_on_page'] ?>">
						</div>
						<div class="form-group">
							<label>Количество профилей в блоке "Лучшие"</label>
							<input type="number" step="1" min="1" max="100" class="form-control" name="count_profiles_on_high_block" placeholder="Количество профилей" value="<?= $settings['count_profiles_on_high_block'] ?>">
						</div>
						<div class="form-group">
							<label>Монитор проблем базы данных</label>
							<label for="monitor_time_period">Частота активации монитора (в день)</label>
		                    <input type="number" step="1" min="1" max="24" value="<?= $settings['monitor_time_period'] ?>" class="form-control" name="monitor_time_period" id="monitor_time_period">
							<div class="custom-control custom-checkbox">
			                    <input type="checkbox" class="custom-control-input" name="monitor_flag" id="monitor" <? if($settings['monitor_flag'] == 'on'): ?>checked=""<? endif ?>>
			                    <label class="custom-control-label" for="monitor">Включить монитор</label>
		            		</div>
						</div>
						<div class="form-group">
							<label>Настройки sitemap.xml</label>
							<label for="monitor_time_period">Частота обновления карты (в день)</label>
		                    <input type="number" step="1" min="1" max="24" value="<?= $settings['sitemap_time_period'] ?>" class="form-control" name="sitemap_time_period" id="sitemap_time_period">
							<div class="custom-control custom-checkbox">
			                    <input type="checkbox" class="custom-control-input" name="sitemap_flag" id="sitemap" <? if($settings['sitemap_flag'] == 'on'): ?>checked=""<? endif ?>>
			                    <label class="custom-control-label" for="sitemap">Включить построение карты</label>
		            		</div>
						</div>
					</div>

					<div class="col-12">
						<hr class="my-4">
						<div class="form-group">
							<button type="submit" class="btn btn-primary">Сохранить</button>
						</div>
					</div>
				</div>	
			</form>	
		</div>
	</div>
</div>

<?php vjoin('admin-layouts/footer'); ?>