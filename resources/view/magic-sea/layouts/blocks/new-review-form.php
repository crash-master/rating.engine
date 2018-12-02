<div class="add-comments-form">
	<input type="hidden" name="profileid" value="<?= $profile['id'] ?>">
	<div class="dialog-arrow"></div>
	<div class="row">
		<div class="col-12">
			<div class="au-form">
				<div class="input">
					<i class="m-icon account-grey"></i>
					<input type="text" name="username" placeholder="Ваше имя" value="<?= \Kernel\Sess::get('username') ?>">
				</div>
				<div class="input">
					<i class="m-icon email"></i>
					<input type="text" name="email" placeholder="Ваш E-mail (не публикуется)" value="<?= \Kernel\Sess::get('email') ?>">
				</div>

				<div class="input textarea">
					<i class="m-icon message-processing"></i>
					<textarea type="text" name="message" placeholder="Ваш отзыв"></textarea>
				</div>

				<div class="input image">
					<i class="m-icon image-area"></i>
					<div class="placeholder" data-default = "Нажмите, чтоб загрузить фото">Нажмите, чтоб загрузить фото</div>
					<small style="color: #888;">Не более 2х мегабайт</small>
					<input type="file" name="photo" style="cursor: pointer; opacity: 0; visibility: visible; position: relative; top: -60px;">
				</div>

				<div class="img-radio">
					<input type="hidden" name="rating" value="-2">
					<button class="radio" data-val="1"><i class="m-icon like"></i></button>
					<button class="radio" data-val="0"><i class="m-icon thumbs-up-down"></i></button>
					<button class="radio" data-val="-1"><i class="m-icon dislike"></i></button>
				</div>

				<div class="send">
					<button class="send-form disable" >Добавить <i class="m-icon arrow-right"></i></button>
				</div>
			</div>
			<!-- <div class="form-about">
				<?= model('Meta') -> getMeta('rules-for-adding-reviews'); ?>
			</div> -->
		</div>
	</div>
</div>
