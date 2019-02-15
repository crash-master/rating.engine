<section class="popup new-user">
	<button class="close-popup"><i class="mdi mdi-close"></i></button>
	<div class="container">
		<h2 class="block-title main txt-grey">Добавление нового мага</h2>
		<div class="row">
			<div class="col-12 col-lg-6 col-xl-6">
				<div class="notification txt-grey">
					Новый маг отправлен на модерацию.<br> Спасибо!
				</div>
				<div class="new-user-form">
					<div class="input">
						<i class="mdi mdi-web input-icon"></i>
						<input type="text" name="site" placeholder="Сайт мага">
					</div>

					<div class="input">
						<i class="mdi mdi-account input-icon"></i>
						<input type="text" name="name" placeholder="Имя нового мага">
					</div>

					<div class="input select with-icon">
						<i class="main-icon mdi mdi-playlist-edit input-icon"></i>
						<div class="placeholder txt-grey">Выберите категорию</div>
						<input type="hidden" name="catid" value="rating">
						<i class="mdi mdi-menu-down"></i>
						
						<div class="options">
							<? foreach ($cat_list as $i => $item): ?>
								<div class="option" data-value="<?= $item['id'] ?>"><?= $item['title'] ?></div>
							<? endforeach; ?>
						</div>
						<div class="close-layer"></div>
					</div>

					<div class="input checkbox">
						<input type="hidden" name="agree" value="0">
						<div class="box agree-box font-color-grey">
							<i class="m-icon main-icon mdi mdi-checkbox-blank-outline"></i>
							<i class="m-icon second-icon mdi mdi-checkbox-marked font-color-red"></i>
						</div>
						<div class="placeholder txt-grey">Я согласен/согласна с правилами сайта</div>
					</div>

					<button class="std-btn send-btn disable">Добавить <i class="mdi mdi-arrow-right mdi-fix"></i></button>
					<div class="lds-ring hid" id="create-profile-loader"><div></div><div></div><div></div><div></div></div>
				</div>
			</div>
			<div class="col-12 col-lg-6 col-xl-6">
				<?= get_content_block('rules-for-adding-profiles') ?>
			</div>
		</div>
	</div>
</section>

<div class="hidden-bg"></div>