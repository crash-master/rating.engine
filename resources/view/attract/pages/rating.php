<? vjoin('attract/layouts/header') ?>

<script>
	let rating = new Rating();
	$(document).ready(function(){
			rating.get();
			$('#rating-order .option').on('click', function(){
				setTimeout(function(){
					console.log($('input[name="order"]').val());
					$('#rating .items-container').html('');
					$('.load-more').show();
		      rating.ratingListCounter = 1;
		      rating.currentCountRatingList = 0;
		      rating.get();
				}, 300);
	    });
	});
</script>

<div class="container" id="rating">
	<div class="row">
		<div class="col-lg-6 col-md-6 col-12">
			<h2 class="block-title">Список магов на сайте <small class="txt-grey-light">(<?= $count ?> шт)</small></h2>
		</div>
		<div class="col-lg-6 col-md-6 col-12 order-field">
			<div class="input select with-icon" id="rating-order">
				<i class="main-icon mdi mdi-sort-variant input-icon"></i>
				<div class="placeholder txt-grey">Сортировать по рейтингу</div>
				<input type="hidden" name="order" value="rating">
				<i class="mdi mdi-menu-down"></i>

				<div class="options">
					<div class="option" data-value="rating">Сортировать по рейтингу</div>
					<div class="option" data-value="name">Сортировать по имени</div>
					<div class="option" data-value="timestamp">Сортировать по дате</div>
					<div class="option" data-value="count_reviews">Сортировать по количеству отзывов</div>
					<div class="option" data-value="count_views">Сортировать по количеству просмотров</div>
				</div>
				<div class="close-layer"></div>
			</div>
		</div>
	</div>

	<div class="items-container"></div>

	<div class="more-btn-container">
		<button class="std-btn load-more">Загрузить ещё</button>
	</div>

	<div class="preloader">
		<img src="/resources/view/attract/assets/imgs/103.gif">
	</div>

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
	</div> -->

</div>

<? vjoin('attract/layouts/footer') ?>
