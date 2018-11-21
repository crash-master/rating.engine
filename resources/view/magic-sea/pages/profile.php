<?php vjoin('magic-sea/layouts/header') ?>

<div class="container">
	<div class="page" id="single">
		<div class="page-title">
			<?= $profile['name'] ?> <i class="m-icon account-outline"></i> - #<?= $profile['number'] ?> <small>в рейтинге</small>
		</div>

		<div class="page-menu">
			<div class="nav-links">
				<a href="#" data-page-part="info" data-margin-left="966">Информация</a>
				<a href="#" data-page-part="comments" data-margin-left="1063">Отзывы</a>
			</div>
			<div class="line">
				<div class="dialog-arrow page-menu-arrow" style="margin-left: 966px"></div>
			</div>
		</div>

		<div class="page-part-container" id="info">
			<div class="row">
			<div class="col-12 col-lg-6 col-xl-6">
				<div class="info-item row">
					<span class="left-part"><strong>Сайт</strong></span>
					<noindex>
						<span class="right-part"><a target="_blank" href="<?= $profile['site_link'] ?>" rel="nofollow" class="mag-link"><?= $profile['site'] ?></a> (<?= $profile['site_obj']['count_visits'] ?> посещений)</span>
					</noindex>
				</div>
				<div class="info-item row">
					<span class="left-part"><strong>Категория</strong></span>
					<span class="right-part"><?= $profile['cat']['title'] ?></span>
				</div>
				<? if($mag['site_obj']['title']): ?>
				<div class="info-item row">
					<span class="left-part"><strong>Заголовок сайта</strong></span>
					<span class="right-part"><?= $profile['site_obj']['title'] ?></span>
				</div>
				<? endif; ?>
				<? if($profile['contacts']): ?>
				<div class="info-item row">
					<span class="left-part"><strong>Контактные данные</strong></span>
					<span class="right-part"><?= $profile['contacts'] ?></span>
				</div>
				<? endif; ?>
				<div class="info-item row">
					<span class="left-part"><strong>Описание</strong></span>
					<span class="right-part"><? if($profile['site_obj']['description']): ?><?= $profile['site_obj']['description'] ?></span><? else: ?> Неизвестно <? endif; ?>
				</div>
				<? if($profile['site_obj']['domen_created']): // domen_created ?>
				<div class="info-item row">
					<span class="left-part"><strong>Дата регистрации домена</strong></span>
					<span class="right-part"><?= $profile['site_obj']['domen_created'] ?></span>
				</div>
				<? endif; ?>
				<? if($profile['site_obj']['favicon']): ?>
				<div class="info-item row">
					<span class="left-part"><strong>Иконка сайта</strong></span>
					<span class="right-part"><img src="<?= $profile['site_obj']['favicon'] ?>" style="max-width: 64px" alt="Icon"></span>
				</div>
				<? endif; ?>
				<div class="info-item row rating">
					<span class="left-part"><strong>Рейтинг</strong></span>
					<span class="right-part">
						<i class="m-icon like"></i> <big><?= $profile['count_like'] ?></big>
						<i class="m-icon thumbs-up-down"></i> <big><?= $profile['count_neutral'] ?> </big>
						<i class="m-icon dislike"></i> <big><?= $profile['count_dislike'] ?></big>
					</span>
				</div>
				<div class="info-item row">
					<span class="left-part"><strong>Общий рейтинг</strong></span>
					<span class="right-part"><big><b style="position:  relative;top: -3px;"><?= $profile['rating'] ?></b></big></span>
				</div>
				<div class="info-item row">
					<span class="left-part"><strong>Просмотров профиля</strong></span>
					<span class="right-part"><i class="m-icon eye-blue"></i> <big><b style="position:  relative;top: -3px;"><?= $profile['count_views'] ?></b></big></span>
				</div>
			</div>
			<div class="col-12 col-lg-6 col-xl-6">
				<? if($profile['site_obj']['screen']): ?>
						<img src="<?= $profile['site_obj']['screen'] ?>" style="width: 100%; height: auto;" alt="Icon">
				<? endif; ?>
			</div>
		</div>

		<hr style="opacity: .3;">

			<button class="send-form open-add-comments-form">Добавить отзыв<i class="m-icon comment-text"></i></button>

			<div class="add-comments-form">
				<input type="hidden" name="profileid" value="<?= $profile['id'] ?>">
				<div class="dialog-arrow"></div>
				<div class="row">
					<div class="col-lg-6">
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
					</div>
					<div class="col-lg-6">
						<div class="form-about">
							<?= model('Meta') -> getMeta('rules-for-adding-reviews'); ?>
						</div>
					</div>
				</div>
			</div>
		</div>

		<?php vjoin('magic-sea/layouts/reviews') ?>
	</div>
</div>

<?php vjoin('Footer') ?>
