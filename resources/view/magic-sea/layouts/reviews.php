<div class="page-part-container" id="comments">
	<div class="count-comments">Количество отзывов <strong><big><?= count($reviews) ?></big></strong></div>
	<div class="comments-list row">
		<? if(count($reviews)): $i = 0; ?>
			<? foreach($reviews as $i => $item): $i++; ?>
				<div class="col-lg-6">
					<div class="card-comment" data-item-i="<?= $i; ?>">
						<div class="cc-header">
							<div class="row">
								<div class="col-7 cc-title">
									<? if($item['rating'] == 1): ?>
										<i class="m-icon like"></i><? elseif($item['rating'] == -1): ?>
										<i class="m-icon dislike"></i><? else: ?>
										<i class="m-icon thumbs-up-down"></i>
									<? endif; ?> <?= $item['username'] ?>
								</div>
								<div class="col-5 cc-timestamp"><?= $item['timestamp'] ?></div>
							</div>
						</div>
						<div class="cc-body">
							<? if($item['image']): ?>
								<img src="<?= $item['image'] ?>" style="width: 100%; margin-bottom: 10px;" alt="Image">
							<? endif; ?>
							<?= $item['message'] ?> 
						</div>
						<div class="cc-footer">

							<div class="remove-dialog rd-step-1">
								<div class="dialog-arrow"></div>
								<p class="rd-title">Вы являетесь владельцем этого отзыва?</p>	
								<div class="rd-answers">
									<button class="rd-ans" data-ans="yes">Да</button>
									<button class="rd-ans" data-ans="no">Нет</button>
									<button class="rd-ans" data-ans="cancel">Отмена</button>
								</div>
							</div>
							<div class="remove-dialog rd-step-yes">
								<div class="dialog-arrow"></div>
								<p class="rd-title">На вашу почту <span class="rd-email">myfi****il@gmail.com</span> отправлено письмо с подтверждением</p>
							</div>
							<div class="remove-dialog rd-step-no">
								<div class="dialog-arrow"></div>
								<p class="rd-title">Для удаления отзыва укажите причину</p>
								<div class="input">
									<i class="m-icon email"></i>
									<input type="text" name="email" placeholder="Ваш email">
								</div>
								<div class="input textarea">
									<i class="m-icon message-processing"></i>
									<textarea name="message" placeholder="Текст обращения"></textarea>
								</div>
								<button class="send-form">Отправить <i class="m-icon arrow-right"></i></button>
								<span><button class="rd-ans" data-ans="cancel">Отмена</button></span>
							</div>

							<div class="remove-dialog rd-step-no-send">
								<div class="dialog-arrow"></div>
								<p class="rd-title">Ваше обращение принято и будет рассмотрено</p>
							</div>

							<div class="row">
								<div class="col-8">
									Страна: <strong><?= $item['country'] ?></strong>, Город: <strong><?= $item['city'] ?></strong>
								</div>
								<div class="col-4" style="text-align: right">
									<? if(is_admin()): ?>
										---- <a href="<?= linkTo('ReviewController@remove', ['id' => $item['id']]); ?>" class="std-a danger-link">Удалить</a>
									<? else: ?>
										<!-- <button class="comment-delete" data-id="<?= $item['id'] ?>">Удалить <i class="m-icon delete"></i></button> -->
									<? endif; ?>
								</div>
							</div>
						</div>
					</div>
				</div>
			<? endforeach ?>
		<? endif; ?>
	</div>
</div>