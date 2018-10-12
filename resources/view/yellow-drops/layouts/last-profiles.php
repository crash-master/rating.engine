<div class="sidebar-section" id="last-profiles">
	<h3 class="sidebar-section-title">Поcледние добавленные</h3>
	<ul>
		<?php foreach ($last_added as $item): ?>
			<li>
				<a href="<?= linkTo('ProfileController@page', ['slug' => $item['slug']]) ?>" class="std-a"><?= $item['name'] ?></a>
			</li>
		<?php endforeach ?>
	</ul>
</div>