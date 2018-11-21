<style type="text/css">	
	@import url('https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i&subset=cyrillic,cyrillic-ext,greek,greek-ext,latin-ext,vietnamese');
	*{
		margin: 0;
		padding: 0;
		font-family: Roboto;
	}

	header, section{
		text-align: center;
		margin-top: 20px;
	}

	h4{
		color: grey;
	}

	.remove-btn{
		display: inline-block;
		color: white;
		text-decoration: none;
		transition-duration: .2s;
		background-color: #1e88e5;
		border-radius: 3px;
		padding: 10px;
	}

	.remove-btn:hover{
		opacity: .7;
	}
</style>

<header style="font-family: Roboto; text-align: center; margin-top: 20px;">
	<h1>Подтвердите удаление вашего отзыва на сайте <?= $sitename ?></h1>
</header>
<section style="font-family: Roboto; text-align: center; margin-top: 20px;">
	<h4 style="color: grey;">Если вы не оставляли заявку на удаление отзыва, проигнорируйте это письмо</h4>
	<br><br>
	<a style="display: inline-block;
		color: white;
		text-decoration: none;
		transition-duration: .2s;
		background-color: #1e88e5;
		border-radius: 3px;
		padding: 10px;
		font-family: Roboto;" href="<?= $siteurl ?><?= linkTo('ReviewController@waiting_key_for_remove', ['key' => $key]); ?>">Подтвердить удаление</a>
		<br>
		<br>
		<small><?= $siteurl ?><?= linkTo('ReviewController@waiting_key_for_remove', ['key' => $key]); ?></small>

</section>