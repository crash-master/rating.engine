<section id="news" class="block no-border">
		<h2 class="block-title">Последние новости</h2>
		<div class="content">
			<div class="row">
				<div class="col-12 col-lg-6 col-xl-6">
					<div class="news-item-big" style="background-image: url('<?= model('Blog') -> thumbnail($news[0]['_links']['wp:featuredmedia'][0]['href']) ?>')">
						<div class="description">
							<a href="<?= $news[0]['link'] ?>" class="std-a news-title txt-red"><?= $news[0]['title']['rendered'] ?></a>
							<p class="news-desc"><?= $news[0]['excerpt']['rendered'] ?></p>
							<div class="timestamp txt-grey">
								Опубликовано <?= $news[0]['date'] ?>
							</div>
						</div>
						<!-- <img class="news-cover" src="<?= model('Blog') -> thumbnail($news[0]['_links']['wp:featuredmedia'][0]['href']) ?>"> -->
					</div>
				</div>
			

				<div class="col-12 col-lg-6 col-xl-6">
					<div class="row">
						<div class="col-12 col-lg-6 col-xl-6">
							<div class="news-item">
								<img class="news-cover" src="<?= model('Blog') -> thumbnail($news[1]['_links']['wp:featuredmedia'][0]['href']) ?>">
								<div class="description">
									<a href="<?= $news[1]['link'] ?>" class="std-a news-title txt-red"><?= $news[1]['title']['rendered'] ?> <span class="timestamp txt-grey-light">
										- <?= $news[1]['date'] ?>
									</span></a>
									<p class="news-desc txt-grey"><?= $news[1]['excerpt']['rendered'] ?></p>
								</div>
							</div>
						</div>

						<div class="col-12 col-lg-6 col-xl-6">
							<div class="news-item">
								<img class="news-cover" src="<?= model('Blog') -> thumbnail($news[2]['_links']['wp:featuredmedia'][0]['href']) ?>">
								<div class="description">
									<a href="<?= $news[2]['link'] ?>" class="std-a news-title txt-red"><?= $news[2]['title']['rendered'] ?> <span class="timestamp txt-grey-light">
										- <?= $news[2]['date'] ?>
									</span></a>
									<p class="news-desc txt-grey"><?= $news[2]['excerpt']['rendered'] ?></p>
								</div>
							</div>
						</div>
					</div>

					<button data-emulate-a="http://news.astralmagic.ru/" class="std-a std-btn more-news">Ещё статьи <i class="mdi mdi-arrow-right mdi-fix"></i></button>
					
				</div>
			</div>
		</div>
	</section>