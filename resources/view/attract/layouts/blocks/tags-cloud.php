<section class="block no-border" id="tags-cloud">
	<h2 class="block-title">Список услуг</h2>
	<div class="content">
		<? foreach($tags as $tag): ?>
			<a href="<?= linkTo('TagController@page', ['slug' => $tag['slug']]) ?>" class="tag"><?= $tag['title'] ?></a>
		<? endforeach; ?>
	</div>
</section>