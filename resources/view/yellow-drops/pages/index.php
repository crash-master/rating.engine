<? vjoin('yellow-drops/layouts/header') ?>

<script>
	$(document).ready(function(){
		$('#rating').html('');
		var rating = new Rating();
	});
</script>

<? vjoin('YDSitePresent') ?>

<div class="container">
	<div class="row">
		<div class="col-4 d-none d-lg-block d-xl-block">
			<? vjoin('yellow-drops/layouts/sidebar') ?>
		</div>
		<div class="col-12 col-lg-8 col-xl-8">
			<section class="page">
				<!-- WELCOME -->
				<!-- <div class="welcome">
					<h1 class="sitename">Название</h1>
					<p class="sub-sitename">Немного скромного и полезного текста о сайте</p>
				</div> -->

				<!-- PROFILE LIST -->
				<div id="rating">
					<?php for ($i=0; $i<5; $i++): ?>
						<? vjoin('yellow-drops/layouts/home-profile-item') ?>
					<?php endfor; ?>
				</div>

				<!-- PAGINATION -->
				<nav class="pagination">
					<!-- <a href="#" class="yd-btn pagination-item pag-prev">
						<i class="fa fa-long-arrow-left" aria-hidden="true"></i>
					</a>
					<a href="#" class="yd-btn pagination-item num">1</a>
					<a href="#" class="yd-btn pagination-item num">2</a>
					<span class="dots">...</span>
					<a href="#" class="yd-btn pagination-item num">3</a>
					<a href="#" class="yd-btn pagination-item num">4</a>
					<a href="#" class="yd-btn pagination-item pag-next">
						<i class="fa fa-long-arrow-right" aria-hidden="true"></i>
					</a> -->
				</nav>
			</section>
		</div>
	</div>
</div>

<? vjoin('YDFooter') ?>