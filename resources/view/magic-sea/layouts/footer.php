<footer id="footer">
	<div class="container">
		<div class="row">
			<div class="col-lg-3 col-md-3 col-12">
				<div class="copyright">&copy; Copyright 2018</div>
				<div style="position: absolute; opacity: 0; width: 1px; height: 0px; overflow: hidden;"><?= model('Meta') -> getMeta('metrica') ?></div>
			</div>
			<div class="col-lg-6 col-md-6 col-12">
				<nav class="footer-nav">
					<ul>
						<li><a href="<?= txtpage('privacy-policy') ?>">Политика конфиденциальности</a></li>
						<li><a href="<?= txtpage('denial-of-responsibility') ?>">Отказ от ответственности</a></li>
					</ul>
				</nav>
			</div>
			<div class="col-lg-3 col-md-3 col-12">
				<nav class="social-links">
					<ul>
						<li><a href="<?= $social['facebook'] ?>"><i class="m-icon facebook"></i></a></li>
						<li><a href="<?= $social['twitter'] ?>"><i class="m-icon twitter"></i></a></li>
						<li><a href="<?= $social['vk'] ?>"><i class="m-icon vk"></i></a></li>
					</ul>
				</nav>
			</div>
		</div>	
	</div>
</footer>

</body>
</html>