<? vjoin('attract/layouts/header') ?>
<style>
	.gs-cards{
		text-align: center;
		margin-top: 30px;
	}
	.gs-img{
		width: 300px;
		display: inline-block;
	}
	.gs-title{
		font-size: 6rem;
		margin-top: 10px;
	}
	.gs-desc{
		margin-top: 10px;
		padding: 0 10%;
	}
	.gs-selected{
		margin-top: 10px;
		display: inline-block;
	}
</style>
<div class="container">
	<section class="page" id="get-started">
		<h2 class="block-title">
			Добавление нашего виджета
		</h2>
		<p>У вас есть возможность добавить один из наших виджетов к себе на сайт</p>
		<p>Выберите один из приемлимых для вас вариантов виджета:</p>
		<div class="gs-cards">
			<div class="row">
				<div class="col-12 col-lg-6 col-xl-6">
					<img src="/resources/view/attract/assets/imgs/iframe.png" class="gs-img">
					<h3 class="gs-title"><span class="txt-red">Iframe для вашего сайта</span></h3>
					<p class="gs-desc">
						Позволит вам отобразить информацию с нашего сайта максимально просто и быстро. Получить Iframe:<br>
						<a href="<?= linkTo('APIController@get_iframe_top_page') ?>" class="std-a">ТОП список магов</a><br>
						<a href="<?= linkTo('APIController@get_iframe_profile_page') ?>" class="std-a">Выбранного мага</a>
					</p>
				</div>
				<div class="col-12 col-lg-6 col-xl-6">
					<img src="/resources/view/attract/assets/imgs/widget.png" class="gs-img">
					<h3 class="gs-title"><span class="txt-red">Виджет для WordPress</span></h3>
					<p class="gs-desc">
						Если ваш сайт работает под управлением CMS WordPress, - виджет это самый быстрый и эфективный способ показать информацию с нашего сайта на вашем. <br>
						[ В разработке... ]
					</p>
				</div>
			</div>
		</div>
		<br><br>
		<p>Для расширения возможностей работы с нашим сервисом, воспользуйтесь <a href="<?= linkTo('APIController@api_doc_page') ?>">документацией API</a></p>
	</section>
</div>

<? vjoin('Footer') ?>