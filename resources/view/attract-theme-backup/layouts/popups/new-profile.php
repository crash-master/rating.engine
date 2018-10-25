<section class="popup new-user">
	<button class="close-popup"><i class="m-icon close"></i></button>
	<div class="container">
		<h2 class="block-title main txt-grey">Добавление нового мага</h2>
		<div class="row">
			<div class="col-12 col-lg-6 col-xl-6">
				<div class="notification txt-grey">
					Новый маг отправлен на модерацию.<br> Спасибо!
				</div>
				<div class="new-user-form">
					<div class="input">
						<i class="m-icon web"></i>
						<input type="text" name="site" placeholder="Сайт мага">
					</div>

					<div class="input">
						<i class="m-icon account"></i>
						<input type="text" name="name" placeholder="Имя нового мага">
					</div>

					<div class="input select with-icon">
						<i class="main-icon m-icon playlist-edit"></i>
						<div class="placeholder txt-grey">Выберите категорию</div>
						<input type="hidden" name="catid" value="rating">
						<i class="m-icon menu-down"></i>
						
						<div class="options">
							<? foreach ($cat_list as $i => $item): ?>
								<div class="option" data-value="<?= $item['id'] ?>"><?= $item['title'] ?></div>
							<? endforeach; ?>
						</div>
						<div class="close-layer"></div>
					</div>

					<div class="input checkbox">
						<input type="hidden" name="agree" value="0">
						<div class="box agree-box">
							<i class="m-icon main-icon checkbox-blank-outline"></i>
							<i class="m-icon second-icon checkbox-marked"></i>
						</div>
						<div class="placeholder txt-grey">Я согласен/согласна с правилами сайта</div>
					</div>

					<button class="std-btn icon-fix send-btn disable">Добавить <i class="m-icon arrow-right-red"></i> <i class="m-icon arrow-right"></i></button>
				</div>
			</div>
			<div class="col-12 col-lg-6 col-xl-6">
				<?= model('Meta') -> getMeta('rules-for-adding-psychics'); ?>
				<!-- <h3 class="block-title txt-grey-dark">Правила добавления экстрасенсов</h3>

				<p class="txt-grey-dark">Укажите ссылку на официальный сайт мага, а так же его полное имя. После модерации вашей заявки маг попадет на наш рейтинг, а все участники смогут видеть и оставлять свои отзывы.</p><br>

				<p class="txt-grey-dark">Модерация на нашем сайте происходит в автоматическом режиме, если же система распознает запрос как не правдивый/спам/клевета/пиар, ваша заявка будет проверена нашим модератором в ручном режиме в рабочее время.</p> -->
			</div>
		</div>
	</div>
</section>

<div class="hidden-bg"></div>