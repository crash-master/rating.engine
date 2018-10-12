<?php vjoin('admin-layouts/header'); ?>
<div class="container">
	<div class="page" id="pages">
		<h1 class="page-name">Редактор страниц</h1>
		<div class="row">
			<div class="col-3">
				<h5>Список страниц</h5>
				<ul>
					<? foreach($pagelist as $i => $p): ?>
						<?php if (re_is_visible('/admin/pages/edit/' . $p)): ?>
							<li><a href="/admin/pages/edit/<?= $p ?>"><?= $p ?></a></li>
						<?php endif ?>
					<? endforeach; ?>
				</ul>
			</div>
			<div class="col-9">
				<? if(isset($pageedit) and $pageedit == true): ?>
				<h5>Редактирование "<?= $pagename ?>"</h5>
				<form action="<?= linkTo('PageController@save_page', ['pagename' => $pagename]) ?>" method="post">
					<div class="form-group">
					    <label for="kjyui">Заголовок страницы</label>
					    <input type="text" class="form-control" id="kjyui" placeholder="Заголовок страницы" name="title" value="<?= $page['title'] ?>">
					  </div>

					<div class="form-group">
					    <label for="cvg67dg">Ключевые слова</label>
					    <textarea class="form-control" id="cvg67dg" rows="3" name="keywords" placeholder="Ключевые слова"><?= $page['keywords'] ?></textarea>
					  </div>

					<div class="form-group">
					    <label for="wysivyg">Текст страницы</label>
					    <!-- <textarea class="form-control" id="wysivyg" rows="3" name="content"></textarea> -->
					    <div id="content"><?= $page['content'] ?></div>
					  </div>
					  <button type="submit" class="btn btn-primary">Сохранить</button>
				</form>
				<? endif; ?>
			</div>
		</div>
	</div>
</div>
<?php vjoin('admin-layouts/footer'); ?>