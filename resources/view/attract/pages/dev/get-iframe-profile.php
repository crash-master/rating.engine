<? vjoin('attract/layouts/header') ?>
<div class="container">
	<section class="page">
		<h2 class="block-title">
			Получение Iframe профиля
		</h2>
		Укажите ссылку на профиль, который нужно отображать у вас на сайте в Iframe <br><br>
		<div class="input" style="min-width: 400px;">
			<input name="to-profile" style="width: 95%" placeholder="Ссылка на профиль" value="<?= $default_profile['to_profile'] ?>">
		</div>

		<h6 style="font-size: 6rem; margin-bottom: 15px;">Настройки внешнего вида</h6>
		<div class="iframe-sittings">
			<div class="input checkbox">
				<input type="hidden" name="color-scheme" value="0">
				<div class="box color-scheme-box">
					<i class="m-icon main-icon checkbox-blank-outline"></i>
					<i class="m-icon second-icon checkbox-marked"></i>
				</div>
				<div class="placeholder txt-grey">Тёмная цветовая тема</div>
			</div>
			<div class="input checkbox">
				<input type="hidden" name="minimal" value="0">
				<div class="box minimal-box">
					<i class="m-icon main-icon checkbox-blank-outline"></i>
					<i class="m-icon second-icon checkbox-marked"></i>
				</div>
				<div class="placeholder txt-grey">Минималистичный стиль</div>
			</div>
			<div class="input checkbox">
				<input type="hidden" name="reviews" value="0">
				<div class="box reviews-box">
					<i class="m-icon main-icon checkbox-blank-outline"></i>
					<i class="m-icon second-icon checkbox-marked"></i>
				</div>
				<div class="placeholder txt-grey">Не отображать отзывы</div>
			</div>
		</div>	
		<h6 style="font-size: 6rem; margin-bottom: 15px;">Результат</h6>
		<iframe src="<?= $siteurl . linkTo('APIController@get_iframe_profile', ['theme' => 'color-scheme=light&reviews=true&minimal=false', 'slug' => $default_profile['slug']]) ?>" frameborder="0" style="height: 450px; width: 520px;"></iframe><br><br>
		<h6 style="font-size: 6rem; margin-bottom: 15px;">Код для вставки Iframe</h6>
		<div class="code">
			<div class="input" style="min-width: 400px;">
				<input id="code" style="width: 95%">
			</div>
		</div>
	</section>
</div>

<script>
	var url = "<?= $siteurl . linkTo('APIController@get_iframe_profile') ?>";
	$(document).ready(function(){
		var iframe = $('iframe', 0);
		$('#code').val(iframe[0].outerHTML);

		$('.input .box').on('click', function(){
			iframeRefresh();
		});

		$('[name="to-profile"]').on('change', function(){
			iframeRefresh();
		});
	});

	function iframeRefresh(){
		let props = {
			'color-scheme': ['light', 'dark'],
			'spacing': ['true', 'false'],
			'minimal': ['false', 'true'],
			'reviews': ['true', 'false']
		};
		let profileLink = $('[name="to-profile"]').val().split('/');
		profileLink = profileLink[profileLink.length - 1];
		let data = takeData($('.iframe-sittings', 0));
		let query = [];
		for(let key in data){
			if(data.hasOwnProperty(key)){
				query.push(key + '=' + props[key][data[key]]);
			}
		}

		query = query.join('&');
		let iUrl = url.replace('{theme}', query);
		iUrl = iUrl.replace('{slug}', profileLink);
		let iframe = $('iframe', 0);
		$(iframe).attr('src', iUrl);
		$('#code').val(iframe[0].outerHTML);
	}
</script>
<? vjoin('attract/layouts/footer') ?>