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
				
				<section class="page single-article">
					<article>
						<h1 class="article-title"><?= $page['title'] ?></h1>
						<div class="article-content">
							<?= $page['content'] ?>
						</div>
					</article>

					<? vjoin('Share'); ?>
					
				</section>
				
				<? if($article['with_comments']): ?>
					<? vjoin('new-yellow-drops/layouts/comments', ['articleid' => $article['id'], 'profileid' => false]); ?>
				<? endif ?>
				
			</main>
		</div>
	</div>
</div>

<? vjoin('new-yellow-drops/layouts/footer') ?>