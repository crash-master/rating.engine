<? vjoin('Head', ['profile' => ['name' => 'Ошибка 404']]) ?>

<style>

	._404{
		color: var(--yd-main-color);
		font-size: 51rem;
		width: 100%;
		text-align: center;
	}

	.main-text{
		margin-top: 30%;
		font-size: 12rem;
	}

	.link{
		margin-top: 10px;
		font-size: 5rem;
	}

	.go-back{
		margin-top: 20px;
	}

	@media (max-width: 992px){
		.main-text{
			margin-top: 10%;
		}

		.go-back{
			margin-bottom: 100px;
		}

		.content{
			text-align: center;
		}
	}
</style>

<? vjoin('YDSitePresent', ['mini' => true]) ?>

<div class="container wrapper">
	<div class="row">
		<div class="col-12 col-lg-6 col-xl-6">
			<h1 class="_404">404</h1>
		</div>
		<div class="col-12 col-lg-6 col-xl-6 content">
			<p class="main-text">Что-то пошло не так</p>
			<p class="link">Страница <span>&laquo; <?= Kernel\Request::getUrl() ?> &raquo;</span> не существует</p>
			<a href="#" class="go-back yd-btn" onclick="history.go(-1);return false;">Вернутся назад</a>
		</div>
	</div>
	
</div>


</body>
</html>