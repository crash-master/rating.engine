<section class="new-review">
	<div class="row">
		<div class="col-12 col-lg-8 col-xl-8">
			<div class="notification txt-grey">
				Ваш отзыв был отправлен на модерацию.<br>Спасибо!
			</div>
			<div class="add-review-form">
				<div class="block-title"><span class="txt-grey-dark">Добавление отзыва</span></div>
				<input type="hidden" name="profileid" value="<?= $profile['id'] ?>">
				<div class="input">
					<i class="mdi mdi-account font-color-grey input-icon"></i>
					<input type="text" name="username" placeholder="Ваше имя" value="<?= \Kernel\Sess::get('username') ?>">
				</div>

				<div class="input">
					<i class="mdi mdi-email font-color-grey input-icon"></i>
					<input type="text" name="email" placeholder="Ваш E-mail" value="<?= \Kernel\Sess::get('email') ?>">
				</div>

				<div class="input textarea">
					<i class="mdi mdi-message-text font-color-grey input-icon"></i>
					<textarea type="text" name="message" placeholder="Ваш отзыв"></textarea>
				</div>

				<div class="input image">
					<i class="mdi mdi-folder-image font-color-grey input-icon"></i>
					<div class="placeholder">Нажмите, чтоб загрузить изображение</div>
					<input type="file" name="photo" style="cursor: pointer; opacity: 0; visibility: visible; position: relative; top: -78px; left: 20px">
				</div>
				<small class="txt-grey-light" style="position: absolute; margin-top: -55px;">Не более 2х мегабайт</small>
				<div class="img-radio">
					<input type="hidden" name="rating" value="0">
					<button class="radio rat-btn good font-color-green" data-val="1"><i class="mdi mdi-thumb-up-outline mdi-big disactive"></i><i class="mdi mdi-thumb-up mdi-big active"></i></button>
					<button class="radio rat-btn bad font-color-red" data-val="-1"><i class="mdi mdi-thumb-down-outline mdi-big disactive"></i><i class="mdi mdi-thumb-down mdi-big active"></i></button>
				</div>

				<button class="std-btn send-btn">Отправить <i class="mdi mdi-arrow-right mdi-fix"></i></button>
			</div>
		</div>
		<div class="col-12 col-lg-4 col-xl-4 txt-grey new-review-big-icon">
			
		</div>
	</div>
</section>