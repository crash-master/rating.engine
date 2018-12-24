<div class="yd-block tags-cloud">
	<h3 class="yd-block-title">Облако тегов</h3>
	<div class="yd-block-content">
		<?php foreach ($tags as $i => $tag): ?>
			<a href="<?= $tag['link'] ?>" class="yd-tag"><?= $tag['title'] ?></a>
		<?php endforeach ?>
		
	</div>
</div>