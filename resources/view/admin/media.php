<?php vjoin('admin-layouts/header'); ?>
<? $count_media = count($media_list); ?>
<div class="container">
		<div class="page" id="cats">
				<div class="jumbotron">
					<h1 class="display-4">Загруженные изображения (<?= $total ?>)</h1>
						<hr class="my-4">
						<form action="/admin/media/upload" method="post" enctype="multipart/form-data">
								<div class="row">
										<div class="col-12 col-md-8 col-lg-6 col-xl-5">
												<input type="hidden" name="media-upload">
												<div class="form-group">
														<div class="input-group mb-3">
															<div class="custom-file">
																<input type="file" class="custom-file-input" id="media_file" name="media_file">
																<label class="custom-file-label" for="media_file">Загрузка изображения</label>
															</div>
															<div class="input-group-append">
																<button type="submit" class="input-group-text">Загрузить</button>
																<div class="saved-loader" style="display: none; position: absolute; margin: 45px 0 0 -200px;">
																		<h5>Загрузка...</h5>
																		<div class="progress" style="width: 200px">
																			<div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%"></div>
																		</div>
															</div>
															</div>
														</div>
												</div>
										</div>
								</div>
						</form>
						<? if($count_media): ?>
								<hr class="my-4">
						<? endif ?>
						<? if(!$total): ?>
								<div class="alert alert-warning" role="alert">
										Не добавлено ни одного изображения
								</div>
						<? endif ?>
						<div class="row">
								<? for($i=0; $i<3; $i++): ?>
										<div class="col-12 col-xl-4 col-lg-6 col-md-6">
												<?php for($j=$i; $j<$count_media; $j += 3): ?>
														<? $media = $media_list[$j]; ?>
														<div class="card media-item">
															<img class="card-img-top" src="<?= $media['src'] ?>" data-toggle="modal" data-target="#img-view" data-img-view-id="<?= $media['id'] ?>" alt="<?= $media['alt'] ?>">
															<div class="card-body">
																<button type="button" class="btn btn-primary card-link" data-toggle="modal" data-target="#img-view" data-img-view-id="<?= $media['id'] ?>">Просмотр</button>
																<a href="<?= linkTo('MediaController@remove', ['media_id' => $media['id']]) ?>" class="card-link danger-link">Удалить</a>
															</div>
														</div>
												<?php endfor ?>
										</div>
								<? endfor; ?>
						</div>
						<? if($count_media): ?>
								<br>
								<hr class="my-4">
								<br>
								<nav>
									<ul class="pagination">
										<?php if ($pagination[0]['prev']): ?>
												<li class="page-item">
													<a class="page-link" href="<?= $pagination[0]['prev'] ?>" aria-label="Previous">
														<span aria-hidden="true">&laquo;</span>
														<span class="sr-only">Previous</span>
													</a>
												</li>
										<?php endif ?>
										<?php foreach ($pagination[1] as $i => $item): ?>
												<li class="page-item <?= $item['current'] ? 'active' : '' ?>">
														<? if(!$item['current']): ?>
																<a class="page-link" href="<?= $item['link'] ?>"><?= $item['num'] ?></a>
														<? else: ?> 
																<span class="page-link"><?= $item['num'] ?><span class="sr-only">(current)</span></span>
														<? endif; ?>
												</li>
										<?php endforeach ?>
										<?php if ($pagination[0]['next']): ?>
												<li class="page-item">
													<a class="page-link" href="<?= $pagination[0]['next'] ?>" aria-label="Next">
														<span aria-hidden="true">&raquo;</span>
														<span class="sr-only">Next</span>
													</a>
												</li>
										<?php endif ?>
									</ul>
								</nav>
						<? endif ?>
				</div>
		</div>
</div>

<div class="modal fade" id="img-view" tabindex="-1" role="dialog" aria-labelledby="img-view-label" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="img-view-label">Просмотр изображения</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<img src="" class="img-view-big-img" alt="LOADING">
				<br>
				<br>
				<div class="form-group">
					<label>Редактирование alt атрибута</label>
					<input type="hidden" name="img_storage_id" value="1">
					<input type="text" name="alt" class="form-control" placeholder="Редактирование alt атрибута">
				</div>
				<div class="form-group">
					<button class="btn btn-primary send-img-meta">Применить</button>
					<span class="badge badge-success d-none" style="display: inline-block; margin-left: 10px"><big>Успешно</big></span>
				</div>
				<script>
					$('.send-img-meta').on('click', function(){
						let self = this;
						let data = {
							'update-img-meta': true,
							'img_storage_id': $('[name="img_storage_id"]').val(),
							'alt': $('[name="alt"]').val()
						}

						$.post('/admin/update-img-meta', data, function(d){
							$('img[data-img-view-id="' + data.img_storage_id + '"]').attr('alt', data.alt);
							$(self).parent().find('.badge-success.d-none').removeClass('d-none');
						});
					});

					$('button[data-img-view-id]').on('click', function(){
						let success_message = $('#img-view .badge-success');
						if(!$(success_message).hasClass('d-none')){
							$(success_message).addClass('d-none');
						}
						$('[name="img_storage_id"]').val($(this).attr('data-img-view-id'));
						$('[name="alt"]').val($(this).parent().parent().find('img[data-img-view-id]').attr('alt'));
					});
				</script>
			</div>
		</div>
	</div>
</div>

<script>
		$(document).ready(function(){
				$('[data-img-view-id]').on('click', function(){
						let bigimg = $('#img-view .img-view-big-img');
						$(bigimg).attr('src', '');
						let url = '/admin/media/img-preview/' + $(this).attr('data-img-view-id');
						$.get(url, function(res){
								$(bigimg).attr('src', res);
						});
				});
		});
</script>

<?php vjoin('admin-layouts/footer'); ?>