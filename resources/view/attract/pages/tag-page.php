<? vjoin('attract/layouts/header') ?>

<script>
	let rating = new Rating();
	$(document).ready(function(){
		rating.get(<?= $tag['id'] ?>);
	});
</script>

<div class="container" id="rating">
	<div class="row">
		<div class="col-12">
			<h2 class="block-title">Услуга <span class="txt-grey-dark">#<?= $tag['title'] ?></span> <!-- <small class="txt-grey-light">(12 шт)</small> --></h2>
		</div>
	</div>

	<div class="items-container"></div>

	<div class="more-btn-container">
		<button class="std-btn load-more" data-tag="<?= $tag['id'] ?>">Загрузить ещё</button>
	</div>

	<div class="preloader">
		<img src="/resources/view/attract/assets/imgs/103.gif">
	</div>

	<? $annotation = externalCustomField() -> get_field('attract_tagid_' . $tag['id']); ?>
	<?php if(($annotation and !empty($annotation)) or is_admin()): ?>
		<div class="tag-annotation" style="margin-top: 30px">
			<?= $annotation ?>
			<?php if (is_admin()): ?>
				<p style="text-align: right; width: 100%">
					<a href="#" class="open-tag-annotation-editor">--- Редактировать аннотацию к тегу</a>
				</p>
			<?php endif ?>
		</div>
	<?php endif ?>
	<?php if(is_admin()): ?>
		<style>
			.tag-annotation-input-container{
				width: 100%;
				height: 150px;
			}

			.tag-annotation-update{
				border: 1px solid red;
				padding: 30px;
				margin: 30px 0;
				display: none;
			}
		</style>

		<div class="tag-annotation-update">
			<h1>Админ превилегия</h3>
			<div class="tag-annotation-update-form">
				<label for="tag-annotation-input">Редактирование аннотации тега</label><br><br>
				<div class="input textarea tag-annotation-input-container">
					<i class="mdi mdi-message-text font-color-grey input-icon"></i>
					<textarea id="tag-annotation-input" placeholder="Редактирование аннотации тега"><?= $annotation ?></textarea>
				</div>
				<button class="std-btn save-tag-annotation" data-tag-annotation-id="attract_tagid_<?= $tag['id'] ?>">Сохранить изменения</button>
			</div>
		</div>

		<script>
			$(document).ready(function(){
				$('.save-tag-annotation').on('click', function(){
					const data = {
						'external-custom-field-update': true,
						'field_id': $(this).attr('data-tag-annotation-id'),
						'field_value': $('#tag-annotation-input').val()
					};
					console.log(data);
					$.post('/api/external-custom-field/update', data, function(resp){
						document.location = document.location;
					});
				});

				$('.open-tag-annotation-editor').on('click', function(e){
					e.preventDefault();
					if($('.tag-annotation-update').is(":visible")){
						$('.tag-annotation-update').slideUp();
					}else{
						$('.tag-annotation-update').slideDown();
					}
				})
			})
		</script>
		
	<?php endif ?>

	<!-- <div class="rating-item">
		<div class="row">
			<div class="col-3 d-none d-xl-block">
				<div class="cover-container">
					<div class="number-container">
						<div class="number txt-grey-dark"><span>01</span></div>
					</div>
					<img src="/assets/imgs/screens/screen1.png" class="cover">
				</div>
			</div>
			<div class="col-xl-9 col-12 rating-item-content">
				<div class="row">
					<div class="col-12 col-lg-8 col-xl-8">
						<div class="top Profile-info">
							<a href="#" class="std-a Profile-name">Маг Валдай</a><span class="txt-grey Profile-site"> - Profilevalday.ru</span>
						</div>
						<div class="bottom location txt-grey">
							Страна <span class="txt-grey-dark">Украина</span>, город <span class="txt-grey-dark">Киев</span>
						</div>
						<div class="bottom categoty txt-grey">
							Категория: <span class="txt-grey-dark">Белый маг</span>
						</div>
					</div>

					<div class="col-12 col-lg-4 col-xl-4">
						<div class="top stats txt-grey-dark">
							<i class="m-icon thumb-up-green"></i> 12
							<i class="m-icon thumb-down-red"></i> 3
							<i class="m-icon thumbs-up-down"></i> 6
						</div>
						<div class="bottom timestamp txt-grey">
							Добавлен 06-08-18 в 14:35
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-12 txt-grey bottom">
						Игорь Леонидович Николаев – потомственный сибирский маг в пятом колене. Работает официально с 1989 года. Зарекомендовал себя как самый сильный и известный колдун не только в Красноярске, но и по всей Сибири. Верховный жрец ковена Волка-Орла. Магистр черной и белой магии.
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="rating-item">
		<div class="row">
			<div class="col-3 d-none d-xl-block">
				<div class="cover-container">
					<div class="number-container">
						<div class="number txt-grey-dark"><span>02</span></div>
					</div>
					<img src="/assets/imgs/screens/screen2.png" class="cover">
				</div>
			</div>
			<div class="col-xl-9 col-12 rating-item-content">
				<div class="row">
					<div class="col-12 col-lg-8 col-xl-8">
						<div class="top Profile-info">
							<a href="#" class="std-a Profile-name">Маг Валдай</a><span class="txt-grey Profile-site"> - Profilevalday.ru</span>
						</div>
						<div class="bottom location txt-grey">
							Страна <span class="txt-grey-dark">Украина</span>, город <span class="txt-grey-dark">Киев</span>
						</div>
						<div class="bottom categoty txt-grey">
							Категория: <span class="txt-grey-dark">Белый маг</span>
						</div>
					</div>

					<div class="col-12 col-lg-4 col-xl-4">
						<div class="top stats txt-grey-dark">
							<i class="m-icon thumb-up-green"></i> 12
							<i class="m-icon thumb-down-red"></i> 3
							<i class="m-icon thumbs-up-down"></i> 6
						</div>
						<div class="bottom timestamp txt-grey">
							Добавлен 06-08-18 в 14:35
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-12 txt-grey bottom">
						Игорь Леонидович Николаев – потомственный сибирский маг в пятом колене. Работает официально с 1989 года. Зарекомендовал себя как самый сильный и известный колдун не только в Красноярске, но и по всей Сибири. Верховный жрец ковена Волка-Орла. Магистр черной и белой магии.
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="rating-item">
		<div class="row">
			<div class="col-3 d-none d-xl-block">
				<div class="cover-container">
					<div class="number-container">
						<div class="number txt-grey-dark"><span>03</span></div>
					</div>
					<img src="/assets/imgs/screens/screen3.png" class="cover">
				</div>
			</div>
			<div class="col-xl-9 col-12 rating-item-content">
				<div class="row">
					<div class="col-12 col-lg-8 col-xl-8">
						<div class="top Profile-info">
							<a href="#" class="std-a Profile-name">Маг Валдай</a><span class="txt-grey Profile-site"> - Profilevalday.ru</span>
						</div>
						<div class="bottom location txt-grey">
							Страна <span class="txt-grey-dark">Украина</span>, город <span class="txt-grey-dark">Киев</span>
						</div>
						<div class="bottom categoty txt-grey">
							Категория: <span class="txt-grey-dark">Белый маг</span>
						</div>
					</div>

					<div class="col-12 col-lg-4 col-xl-4">
						<div class="top stats txt-grey-dark">
							<i class="m-icon thumb-up-green"></i> 12
							<i class="m-icon thumb-down-red"></i> 3
							<i class="m-icon thumbs-up-down"></i> 6
						</div>
						<div class="bottom timestamp txt-grey">
							Добавлен 06-08-18 в 14:35
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-12 txt-grey bottom">
						Игорь Леонидович Николаев – потомственный сибирский маг в пятом колене. Работает официально с 1989 года. Зарекомендовал себя как самый сильный и известный колдун не только в Красноярске, но и по всей Сибири. Верховный жрец ковена Волка-Орла. Магистр черной и белой магии.
					</div>
				</div>
			</div>
		</div>
	</div> -->

</div>

<? vjoin('attract/layouts/footer') ?>
