<?php vjoin('admin-layouts/header'); ?>

<div class="modal fade" id="edit-block-content" tabindex="-1" role="dialog" aria-labelledby="edit-block-content" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" style="max-width: 992px" role="document">
		<div class="modal-content">
			<form method="post" action="<?= linkTo('ContentBlockController@update') ?>">
				<input type="hidden" name="block-alias" value="">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLongTitle">Редактирование блока <small class="block-title"></small></h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="form-group">
						<? vjoin('admin-layouts/quill-toolbar') ?>
						<div id="content" class="quill-editor"></div>
						<textarea name="content" class="quill-textarea" id="" cols="30" rows="10"></textarea>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn" data-dismiss="modal">Отмена</button>
						<button type="submit" class="btn btn-primary">Сохранить</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>


<div class="container">
	<div class="page" id="tag">
		<div class="jumbotron">
		  <h1 class="display-4">Управление блоками контента</h1>

			<hr class="my-4">
			<div class="row">
				<div class="col-12">
					<table class="table table-light">
						  <thead class="thead-dark">
						    <tr>
						      <th class="mob-hid" scope="col">#</th>
						      <th scope="col">Название</th>
						      <th scope="col">Псевдоним</th>
						      <th scope="col"><i class="fa fa-edit"></i> <span class="mob-hid">Редактировать</span></th>
						    </tr>
						  </thead>
						  <tbody>
						  	<? foreach($blocks as $i => $block): ?>
								<tr>
									<th class="mob-hid" scope="row"><?= $i+1 ?></th>
									<td title="<?= $block['about_block'] ?>"><?= $block['title'] ?></td>
									<td><?= $block['alias'] ?></td>
									<td>
										<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#edit-block-content" data-block-alias="<?= $block['alias'] ?>">
											<i class="fa fa-edit"></i> <span class="mob-hid">Редактировать</span>
										</button>
									</td>
								</tr>
							<? endforeach; ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>

<script>
	$(document).ready(function(){
		let path = '/admin/api/content-blocks/get-block/{block_alias}';
		$('[data-block-alias]').on('click', function(){
			let alias = $(this).attr('data-block-alias');
			let request = path.replace('{block_alias}', alias);
			if($('#content .ql-editor').attr('data-alias') != alias){
				$.getJSON(request, function(block){
					$('#content .ql-editor').attr('data-alias', block.alias).html(block.content);
					$('.block-title').html(block.title);
					$('[name="block-alias"]').val(block.alias);
				});
			}
		});
	});
</script>

<?php vjoin('admin-layouts/footer'); ?>