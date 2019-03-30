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
						<? if($article['thumbnail']): ?>
							<img src="<?= $article['thumbnail'] ?>" class="article-screen">
						<? endif; ?>
						<h1 class="article-title"><?= $article['meta']['title'] ?></h1>
						<div class="article-timestamp">Дата публикации <?= $article['timestamp'] ?></div>
						<div class="article-tags">
							<?php foreach ($article['tags'] as $inx => $tag): ?>
								<a href="<?= $tag['link'] ?>" class="yd-tag"><?= $tag['title'] ?></a>
							<?php endforeach ?>
						</div>
						<div class="article-content">
							<?= $article['content'] ?>
						</div>
					</article>

					<? vjoin('Share'); ?>
					<? if($article['with_comments']): ?>
						<div class="form-new-comment create-comment-form">
							<h3 class="form-title">Вы можете оставить ваш коментарий</h3>
							<div class="row">
								<div class="col-12">
									<textarea name="message" id="message" class="yd-input textarea" placeholder="Коментарий"></textarea>
								</div>
								<div class="col-12 col-lg-6 col-xl-6 col-md-6">
									<input type="text" class="yd-input" name="name" placeholder="Ваше имя" value="<?= \Kernel\Sess::get('username') ?>">
								</div>
								<div class="col-12 col-lg-6 col-xl-6 col-md-6">
									<input type="text" class="yd-input" name="email" placeholder="Ваш E-mail" value="<?= \Kernel\Sess::get('email') ?>">
								</div>
								<div class="col-12 submit-container">
									<button class="yd-btn with-icon" data-article-id="<?= $article['id'] ?>">Отправить <i class="mdi mdi-send"></i></button>

									<div class="form-state sending">
										<span class="spinner"></span>
										Отправка коментария
									</div>

									<div class="form-state sending-success">
										<i class="mdi mdi-information-outline"></i>
										Ваш комментарий был успешно отправлен на модерацию
									</div>
								</div>
							</div>
						<? endif ?>
					</div>
				</section>
				
				<? if($article['with_comments']): ?>
					<? vjoin('new-yellow-drops/layouts/comments', ['articleid' => $article['id'], 'profileid' => false]); ?>
				<? endif ?>
				
			</main>
		</div>
	</div>
</div>

<? vjoin('new-yellow-drops/layouts/footer') ?>