<?php vjoin('magic-sea/layouts/header') ?>
<script>
	$(document).ready(function(){
		var ORDER = '';
		setInterval(function(){
			var val = $('input[name="order"]').val();
			if(val != ORDER){
				ORDER = val;
				$('#rating .top-list').html('');
				CURRENT_COUNT_RATING_LIST = 0;
				RATING_LIST_COUNTER = 1;
				getRating();
			}
		}, 200);
		// getRating();
	});
</script>

<div class="container">
	<div id="rating" class="page">
		<div class="page-head row">
			<div class="col-lg-6 col-md-6 col-12">
				<div class="page-title">Рейтинг магов <i class="m-icon prize-blue"></i></div>
			</div>
			<div class="col-lg-6 col-md-6 col-12 order-field">
				<div class="select">
					<i class="m-icon sort-variant"></i>
					<div class="placeholder">Сортировать по рейтингу</div>
					<input type="hidden" name="order" value="rating">
					<i class="m-icon menu-down"></i>

					<div class="options">
						<div class="option" data-value="rating">Сортировать по рейтингу</div>
						<div class="option" data-value="name">Сортировать по имени</div>
						<div class="option" data-value="timestamp">Сортировать по дате</div>
						<div class="option" data-value="count_reviews">Сортировать по количеству отзывов</div>
						<div class="option" data-value="count_views">Сортировать по количеству просмотров</div>
					</div>
				</div>
			</div>
		</div>

		<div class="rating-container">
			<ul class="top-list">
						<!-- li*10>.top-number{#$}+.top-name{Макс Топинг $}+(.top-site>a[href="#"]{max-toping$.com.ua})+.top-rating{<i class="m-icon like"></i> $$}+.top-timestamp{07-06-12 22:10}+(.top-btn-show>a.btn-profile-show[href="#"]{Посмотреть <i class="m-icon eye"></i>}) -->

						<!-- <li>
							<div class="top-number">#1</div>
							<div class="top-name">Макс Топинг 1</div>
							<div class="top-site"><a href="#">max-toping1.com.ua</a></div>
							<div class="top-rating"><i class="m-icon like"></i> 01 <i class="m-icon dislike"></i> 23 <i class="m-icon comment-text-multiple-blue"></i> 44</div>
							<div class="top-timestamp">07-06-12 22:10</div>
							<div class="top-btn-show"><a href="/single.php" class="btn-profile-show">Посмотреть <i class="m-icon eye"></i></a></div>
						</li>
						<li>
							<div class="top-number">#2</div>
							<div class="top-name">Макс Топинг 1</div>
							<div class="top-site"><a href="#">max-toping1.com.ua</a></div>
							<div class="top-rating"><i class="m-icon like"></i> 01 <i class="m-icon dislike"></i> 23 <i class="m-icon comment-text-multiple-blue"></i> 44</div>
							<div class="top-timestamp">07-06-12 22:10</div>
							<div class="top-btn-show"><a href="/single.php" class="btn-profile-show">Посмотреть <i class="m-icon eye"></i></a></div>
						</li>
						<li>
							<div class="top-number">#3</div>
							<div class="top-name">Макс Топинг 1</div>
							<div class="top-site"><a href="#">max-toping1.com.ua</a></div>
							<div class="top-rating"><i class="m-icon like"></i> 01 <i class="m-icon dislike"></i> 23 <i class="m-icon comment-text-multiple-blue"></i> 44</div>
							<div class="top-timestamp">07-06-12 22:10</div>
							<div class="top-btn-show"><a href="/single.php" class="btn-profile-show">Посмотреть <i class="m-icon eye"></i></a></div>
						</li>
						<li>
							<div class="top-number">#4</div>
							<div class="top-name">Макс Топинг 1</div>
							<div class="top-site"><a href="#">max-toping1.com.ua</a></div>
							<div class="top-rating"><i class="m-icon like"></i> 01 <i class="m-icon dislike"></i> 23 <i class="m-icon comment-text-multiple-blue"></i> 44</div>
							<div class="top-timestamp">07-06-12 22:10</div>
							<div class="top-btn-show"><a href="/single.php" class="btn-profile-show">Посмотреть <i class="m-icon eye"></i></a></div>
						</li>
						<li>
							<div class="top-number">#5</div>
							<div class="top-name">Макс Топинг 1</div>
							<div class="top-site"><a href="#">max-toping1.com.ua</a></div>
							<div class="top-rating"><i class="m-icon like"></i> 01 <i class="m-icon dislike"></i> 23 <i class="m-icon comment-text-multiple-blue"></i> 44</div>
							<div class="top-timestamp">07-06-12 22:10</div>
							<div class="top-btn-show"><a href="/single.php" class="btn-profile-show">Посмотреть <i class="m-icon eye"></i></a></div>
						</li>
						<li>
							<div class="top-number">#6</div>
							<div class="top-name">Макс Топинг 1</div>
							<div class="top-site"><a href="#">max-toping1.com.ua</a></div>
							<div class="top-rating"><i class="m-icon like"></i> 01 <i class="m-icon dislike"></i> 23 <i class="m-icon comment-text-multiple-blue"></i> 44</div>
							<div class="top-timestamp">07-06-12 22:10</div>
							<div class="top-btn-show"><a href="/single.php" class="btn-profile-show">Посмотреть <i class="m-icon eye"></i></a></div>
						</li>
						<li>
							<div class="top-number">#7</div>
							<div class="top-name">Макс Топинг 1</div>
							<div class="top-site"><a href="#">max-toping1.com.ua</a></div>
							<div class="top-rating"><i class="m-icon like"></i> 01 <i class="m-icon dislike"></i> 23 <i class="m-icon comment-text-multiple-blue"></i> 44</div>
							<div class="top-timestamp">07-06-12 22:10</div>
							<div class="top-btn-show"><a href="/single.php" class="btn-profile-show">Посмотреть <i class="m-icon eye"></i></a></div>
						</li>
						<li>
							<div class="top-number">#8</div>
							<div class="top-name">Макс Топинг 1</div>
							<div class="top-site"><a href="#">max-toping1.com.ua</a></div>
							<div class="top-rating"><i class="m-icon like"></i> 01 <i class="m-icon dislike"></i> 23 <i class="m-icon comment-text-multiple-blue"></i> 44</div>
							<div class="top-timestamp">07-06-12 22:10</div>
							<div class="top-btn-show"><a href="/single.php" class="btn-profile-show">Посмотреть <i class="m-icon eye"></i></a></div>
						</li>
						<li>
							<div class="top-number">#9</div>
							<div class="top-name">Макс Топинг 1</div>
							<div class="top-site"><a href="#">max-toping1.com.ua</a></div>
							<div class="top-rating"><i class="m-icon like"></i> 01 <i class="m-icon dislike"></i> 23 <i class="m-icon comment-text-multiple-blue"></i> 44</div>
							<div class="top-timestamp">07-06-12 22:10</div>
							<div class="top-btn-show"><a href="/single.php" class="btn-profile-show">Посмотреть <i class="m-icon eye"></i></a></div>
						</li>
						<li>
							<div class="top-number">#10</div>
							<div class="top-name">Макс Топинг 1</div>
							<div class="top-site"><a href="#">max-toping1.com.ua</a></div>
							<div class="top-rating"><i class="m-icon like"></i> 01 <i class="m-icon dislike"></i> 23 <i class="m-icon comment-text-multiple-blue"></i> 44</div>
							<div class="top-timestamp">07-06-12 22:10</div>
							<div class="top-btn-show"><a href="/single.php" class="btn-profile-show">Посмотреть <i class="m-icon eye"></i></a></div>
						</li>
						<li>
							<div class="top-number">#11</div>
							<div class="top-name">Макс Топинг 1</div>
							<div class="top-site"><a href="#">max-toping1.com.ua</a></div>
							<div class="top-rating"><i class="m-icon like"></i> 01 <i class="m-icon dislike"></i> 23 <i class="m-icon comment-text-multiple-blue"></i> 44</div>
							<div class="top-timestamp">07-06-12 22:10</div>
							<div class="top-btn-show"><a href="/single.php" class="btn-profile-show">Посмотреть <i class="m-icon eye"></i></a></div>
						</li>
						<li>
							<div class="top-number">#12</div>
							<div class="top-name">Макс Топинг 1</div>
							<div class="top-site"><a href="#">max-toping1.com.ua</a></div>
							<div class="top-rating"><i class="m-icon like"></i> 01 <i class="m-icon dislike"></i> 23 <i class="m-icon comment-text-multiple-blue"></i> 44</div>
							<div class="top-timestamp">07-06-12 22:10</div>
							<div class="top-btn-show"><a href="/single.php" class="btn-profile-show">Посмотреть <i class="m-icon eye"></i></a></div>
						</li>
						<li>
							<div class="top-number">#13</div>
							<div class="top-name">Макс Топинг 1</div>
							<div class="top-site"><a href="#">max-toping1.com.ua</a></div>
							<div class="top-rating"><i class="m-icon like"></i> 01 <i class="m-icon dislike"></i> 23 <i class="m-icon comment-text-multiple-blue"></i> 44</div>
							<div class="top-timestamp">07-06-12 22:10</div>
							<div class="top-btn-show"><a href="/single.php" class="btn-profile-show">Посмотреть <i class="m-icon eye"></i></a></div>
						</li>
						<li>
							<div class="top-number">#14</div>
							<div class="top-name">Макс Топинг 1</div>
							<div class="top-site"><a href="#">max-toping1.com.ua</a></div>
							<div class="top-rating"><i class="m-icon like"></i> 01 <i class="m-icon dislike"></i> 23 <i class="m-icon comment-text-multiple-blue"></i> 44</div>
							<div class="top-timestamp">07-06-12 22:10</div>
							<div class="top-btn-show"><a href="/single.php" class="btn-profile-show">Посмотреть <i class="m-icon eye"></i></a></div>
						</li>
						<li>
							<div class="top-number">#15</div>
							<div class="top-name">Макс Топинг 1</div>
							<div class="top-site"><a href="#">max-toping1.com.ua</a></div>
							<div class="top-rating"><i class="m-icon like"></i> 01 <i class="m-icon dislike"></i> 23 <i class="m-icon comment-text-multiple-blue"></i> 44</div>
							<div class="top-timestamp">07-06-12 22:10</div>
							<div class="top-btn-show"><a href="/single.php" class="btn-profile-show">Посмотреть <i class="m-icon eye"></i></a></div>
						</li>
						<li>
							<div class="top-number">#16</div>
							<div class="top-name">Макс Топинг 1</div>
							<div class="top-site"><a href="#">max-toping1.com.ua</a></div>
							<div class="top-rating"><i class="m-icon like"></i> 01 <i class="m-icon dislike"></i> 23 <i class="m-icon comment-text-multiple-blue"></i> 44</div>
							<div class="top-timestamp">07-06-12 22:10</div>
							<div class="top-btn-show"><a href="/single.php" class="btn-profile-show">Посмотреть <i class="m-icon eye"></i></a></div>
						</li>
						<li>
							<div class="top-number">#17</div>
							<div class="top-name">Макс Топинг 1</div>
							<div class="top-site"><a href="#">max-toping1.com.ua</a></div>
							<div class="top-rating"><i class="m-icon like"></i> 01 <i class="m-icon dislike"></i> 23 <i class="m-icon comment-text-multiple-blue"></i> 44</div>
							<div class="top-timestamp">07-06-12 22:10</div>
							<div class="top-btn-show"><a href="/single.php" class="btn-profile-show">Посмотреть <i class="m-icon eye"></i></a></div>
						</li> -->
					</ul>
					<div class="rating-bottom" style="text-align: center">
						<img src="/resources/imgs/preloader.gif" style="width: 70px; display: none;" alt="" class="preloader"><br>
						<button class="load-more">Загрузить ещё</button>
					</div>
		</div>
	</div>
</div>

<?php vjoin('Footer') ?>
