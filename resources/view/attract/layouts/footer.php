<div class="container">
	<div style="position: absolute; opacity: 0; width: 1px; height: 1px; overflow: hidden;"><?= model('Meta') -> getMeta('metrica') ?></div>
	<footer id="footer">
		<div class="row">
			<div class="col-6 col-lg-6 col-xl-6 left-part">
				<div class="logo txt-grey mariupol-bold" onclick="document.location = '/'"><?= model('Meta') -> getMeta('sitename') ?></div>
				<p class="copyright txt-grey">&copy; Copyright 2018</p>
			</div>

			<div class="col-6 col-lg-6 col-xl-6 right-part">
				<div class="footer-nav">
					<a href="<?= linkTo('PageController@text_page', ['pagename' => 'privacy-policy']) ?>" class="std-a footer-link">Политика конфиденциальности</a>
					<a href="<?= linkTo('PageController@text_page', ['pagename' => 'denial-of-responsibility']) ?>" class="std-a footer-link">Отказ от ответственности</a>
				</div>
				<div class="social-nav">
					<a href="<?= $social['vk'] ?>"><i class="m-icon vk"></i></a>
					<a href="<?= $social['twitter'] ?>"><i class="m-icon twitter"></i></a>
					<a href="<?= $social['facebook'] ?>"><i class="m-icon facebook"></i></a>
				</div>
			</div>
		</div>
	</footer>
</div>

</body>
</html>