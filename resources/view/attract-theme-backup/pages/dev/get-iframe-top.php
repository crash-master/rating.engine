<? vjoin('attract/layouts/header') ?>
<div class="container">
	<section class="page">
		<h2 class="block-title">
			Получение Iframe лучших магов
		</h2>
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
				<input type="hidden" name="spacing" value="0">
				<div class="box spacing-box">
					<i class="m-icon main-icon checkbox-blank-outline"></i>
					<i class="m-icon second-icon checkbox-marked"></i>
				</div>
				<div class="placeholder txt-grey">Убрать отступы</div>
			</div>
			<div class="input checkbox">
				<input type="hidden" name="minimal" value="0">
				<div class="box minimal-box">
					<i class="m-icon main-icon checkbox-blank-outline"></i>
					<i class="m-icon second-icon checkbox-marked"></i>
				</div>
				<div class="placeholder txt-grey">Минималистичный стиль</div>
			</div>
		</div>	
		<h6 style="font-size: 6rem; margin-bottom: 15px;">Результат</h6>
		<iframe src="<?= $siteurl . linkTo('APIController@get_iframe_top', ['theme' => 'color-scheme=light&spacing=true&minimal=false']) ?>" frameborder="0" style="height: 552px; width: 100%;"></iframe><br><br>
		<h6 style="font-size: 6rem; margin-bottom: 15px;">Код для вставки Iframe</h6>
		<div class="code">
			<div class="input" style="min-width: 400px;">
				<input id="code" style="width: 95%">
			</div>
		</div>
	</section>
</div>

<script>
	$(document).ready(function(){
		let iframe = $('iframe', 0);
		$('#code').val(iframe[0].outerHTML);

		var url = "<?= $siteurl . linkTo('APIController@get_iframe_top') ?>";
		$('.input .box').on('click', function(){
			let props = {
				'color-scheme': ['light', 'dark'],
				'spacing': ['true', 'false'],
				'minimal': ['false', 'true']
			};
			let data = takeData($('.iframe-sittings', 0));
			let query = [];
			for(let key in data){
				if(data.hasOwnProperty(key)){
					query.push(key + '=' + props[key][data[key]]);
				}
			}

			query = query.join('&');
			let iUrl = url.split('{theme}')[0];
			let iframe = $('iframe', 0);
			$(iframe).attr('src', iUrl + query);
			$('#code').val(iframe[0].outerHTML);
		});
	});
</script>
<? vjoin('attract/layouts/footer') ?>