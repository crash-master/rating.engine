<?php vjoin('admin-layouts/head') ?>
<button class="menu" data-menu-status="close">
	<i class="fa fa-bars"></i>
	<i class="fa fa-times"></i>
</button>
<aside id="aside">
	<!-- <h3 class="admin-panel-name">Админ панель</h3> -->
	<nav class="main">
		<ul>
			<?php foreach ($nav_items as $nav_item): ?>
				<? if(re_is_visible(linkTo($nav_item['action']))): ?>
					<li <? if(isset($nav_item['active']) and $nav_item['active']): ?> class="active" <? endif ?>>
						<a href="<?= isset($nav_item['linkTo_second_arg']) ? linkTo($nav_item['action'], $nav_item['linkTo_second_arg']) : linkTo($nav_item['action']) ?>"><?= $nav_item['icon_html'] ?> <?= $nav_item['title'] ?></a>
					</li>
				<? endif; ?>
			<?php endforeach ?>
			

			<li><a href="<?= linkTo('IndexController@admin_logout') ?>"><i class="fa fa-sign-out" aria-hidden="true"></i> Выйти</a></li>
			<li><a href="/"><i class="fa fa-home" aria-hidden="true"></i> На сайт</a></li>
		</ul>
	</nav>
</aside>
