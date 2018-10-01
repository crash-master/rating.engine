<section class="new-review">
	<div class="row">
		<div class="col-12 col-lg-6 col-xl-6">
			<div class="notification txt-grey">
				Ваш отзыв был отправлен на модерацию.<br>Спасибо!
			</div>
			<div class="add-review-form">
				<div class="block-title"><span class="txt-grey-dark">Добавление отзыва</span></div>
				<input type="hidden" name="profileid" value="<?= $profile['id'] ?>">
				<div class="input">
					<i class="m-icon account"></i>
					<input type="text" name="username" placeholder="Ваше имя" value="<?= \Kernel\Sess::get('username') ?>">
				</div>

				<div class="input">
					<i class="m-icon email"></i>
					<input type="text" name="email" placeholder="Ваш E-mail" value="<?= \Kernel\Sess::get('email') ?>">
				</div>

				<div class="input textarea">
					<i class="m-icon message-text"></i>
					<textarea type="text" name="message" placeholder="Ваш отзыв"></textarea>
				</div>

				<div class="input image">
					<i class="m-icon folder-image"></i>
					<div class="placeholder">Нажмите, чтоб загрузить изображение</div>
					<input type="file" name="photo" style="cursor: pointer; opacity: 0; visibility: visible; position: relative; top: -90px; left: 20px">
				</div>
				<small class="txt-grey-light" style="position: absolute; margin-top: -70px;">Не более 2х мегабайт</small>
				<div class="img-radio">
					<input type="hidden" name="rating" value="0">
					<button class="radio rat-btn good" data-val="1"></button>
					<button class="radio rat-btn bad" data-val="-1"></button>
				</div>

				<button class="std-btn icon-fix send-btn">Отправить <i class="m-icon arrow-right-red"></i> <i class="m-icon arrow-right"></i></button>
			</div>
		</div>
		<div class="col-12 col-lg-6 col-xl-6 txt-grey">
			<?= model('Meta') -> getMeta('rules-for-adding-reviews'); ?>
		</div>
	</div>
</section>