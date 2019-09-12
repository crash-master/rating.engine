<? vjoin('Head', ['profile' => $profile]) ?>
<? vjoin('new-yellow-drops/layouts/mobile-nav') ?>
<? vjoin('new-yellow-drops/layouts/nav') ?>
<? vjoin('new-yellow-drops/layouts/header') ?>

<div class="container">
	<div class="row">
		<div class="col-4">
			<? vjoin('new-yellow-drops/layouts/sidebar') ?>
		</div>
		<div class="col-xl-8 col-lg-8 col-md-12 col-sm-12">
			<main>
				
				<section class="page articles">
					<?php if (isset($tag) or isset($category)): ?>
						<h1 class="yd-page-title"><? if(isset($category)) echo $category['title']; elseif(isset($tag)) echo '#'.$tag['title'] ?></h1>	
					<?php endif ?>

					<? if(!count($articles)): ?>
						<div class="no-content">На этой странице ещё нет ни одной записи</div>
					<? endif ?>
					
					<?php foreach ($articles as $inx => $article): ?>
						<div class="article-item">
							<h1 class="article-title">
								<a href="<?= $article['link'] ?>"><?= $article['meta']['title'] ?></a>
							</h1>
							<div class="article-timestamp">Дата публикации <?= nyd_short_timestamp($article['timestamp']) ?></div>
							<? if($article['thumbnail']): ?>
								<img src="<?= $article['thumbnail'] ?>" class="article-thumbnail" alt="<?= $article['thumbnail_alt'] ?>">
							<? endif; ?>
							<div class="article-excerpt">
								<?= $article['meta']['description'] ?>
							</div>
							<div class="article-footer">
								<a href="<?= $article['link'] ?>" class="yd-btn with-icon read-article">Читать дальше <i class="mdi mdi-newspaper"></i></a>
							</div>
						</div>
					<?php endforeach ?>

				</section>
				
				<? if(count($articles)): ?>
					<section class="simple-pagination">
						<? $pag = nyd_articles_pag($page_num, $category); ?>
						<div class="row">
							<div class="col-2 col-md-5 col-xl-5 col-lg-5 simple-pagination-section">
								<? if($pag['next']): ?>
									<a href="<?= linkTo('ArticleController@article_list_by_category', ['cat_slug' => $category['slug'], 'page_num' => $pag['prev']]) ?>" class="prev-page">
										<span class="yd-btn">
											<i class="mdi mdi-chevron-left"></i>
										</span>	
										<span class="btn-label">Предыдущая</span>
									</a>
								<? endif; ?>
							</div>
							<div class="col-8 col-md-2 col-xl-2 col-lg-2 simple-pagination-section">
								<div class="counter"><strong><?= $pag['current'] ?></strong> / <strong><?= $pag['total'] ?></strong></div>
							</div>
							<div class="col-2 col-md-5 col-xl-5 col-lg-5 simple-pagination-section">
								<? if($pag['next']): ?>
									<a href="<?= linkTo('ArticleController@article_list_by_category', ['cat_slug' => $category['slug'], 'page_num' => $pag['next']]) ?>" class="next-page">
										<span class="btn-label">Следующая</span>
										<span class="yd-btn">
											<i class="mdi mdi-chevron-right"></i>
										</span>	
									</a>
								<? endif; ?>
							</div>
						</div>
					</section>
				<? endif ?>
			</main>
		</div>
	</div>
</div>

<? vjoin('new-yellow-drops/layouts/footer') ?>