<?php vjoin('admin-layouts/header'); ?>
<div class="container">
	<div class="page" id="tb">
		<h1 class="page-name">Редактирование текстовых блоков</h1>
		<div class="row">
			<div class="col-3">
				<h5>Список текстовых блоков</h5>
				<ul>
					<? foreach($tb_list as $i => $item): ?>
						<li><a href="<?= linkTo('TBController@tb_edit_page', ['blockname' => $item]) ?>"><?= $item ?></a></li>
					<? endforeach; ?>
				</ul>
			</div>
			<div class="col-9">
				<? if(isset($tblock)): ?>
					<h5>Редактирование "<?= $blockname ?>"</h5>
					<form action="<?= linkTo('TBController@update') ?>" method="post">
						<input type="hidden" name="blockname" value="<?= $blockname ?>">
						<div class="form-group">
						    <label for="wysivyg">Текс в блоке:</label>
						    <!-- <textarea class="form-control" id="wysivyg" name="block" rows="15"></textarea> -->
						    <div id="content"><?= $tblock ?></div>
						  </div>
						  <button class="btn btn-primary">Сохранить</button>
					</form>
				<? endif; ?>
			</div>
		</div>
	</div>
</div>
<?php vjoin('admin-layouts/footer'); ?>
