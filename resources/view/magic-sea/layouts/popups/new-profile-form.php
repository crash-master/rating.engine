<div class="add-user-container">
		<button class="close-add-new-user"><i class="m-icon close-dark"></i></button>
		<div class="dialog-arrow"></div>
		<div class="row">
			<div class="col-lg-6 col-md-12 col-12">
				<div class="au-form">
					<div class="input">
						<i class="m-icon web"></i>
						<input type="text" name="site" placeholder="Сайт мага">
					</div>
					<div class="input">
						<i class="m-icon account-grey"></i>
						<input type="text" name="name" placeholder="Имя нового мага">
					</div>
					<div class="select">
						<i class="m-icon playlist-edit"></i>
						<div class="placeholder">Выберите категорию</div>
						<input type="hidden" name="catid" value="0">
						<i class="m-icon menu-down"></i>

						<div class="options">
							<? $cat_list = arrayToArray(model('Cats') -> all()); foreach ($cat_list as $i => $item): ?>
								<div class="option" data-value="<?= $item['id'] ?>"><?= $item['title'] ?></div>
							<? endforeach; ?>
						</div>
					</div>
					<div class="checkbox">
						<input type="hidden" name="agree" value="0">
						<div class="box">
							<i class="m-icon checkbox-blank-outline"></i>
							<i class="m-icon checkbox-marked-outline"></i>
						</div>
						<span class="label agree-label">Я согласен/согласна с правилами сайта</span>
					</div>
					<div class="send">
						<button class="send-form disable">Добавить <i class="m-icon arrow-right"></i></button>
					</div>
				</div>
			</div>
			<div class="col-lg-6 col-md-12 col-12">
				<div class="form-about">
					<?= model('Meta') -> getMeta('rules-for-adding-psychics'); ?>
				</div>	
			</div>
		</div>
	</div>

	<div class="notification"></div>