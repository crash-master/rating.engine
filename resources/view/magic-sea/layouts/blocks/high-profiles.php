<div class="block top-10">
	<div class="block-icon"><i class="m-icon prize"></i></div>
	<div class="block-title">Топ 10 магов</div>
	<div class="block-body">
		
		<ul class="top-list">
			<!-- li*10>.top-number{#$}+.top-name{Макс Топинг $}+(.top-site>a[href="#"]{max-toping$.com.ua})+.top-rating{<i class="m-icon like"></i> $$}+.top-timestamp{07-06-12 22:10}+(.top-btn-show>a.btn-profile-show[href="#"]{Посмотреть <i class="m-icon eye"></i>}) -->
			<? foreach($high_list as $i => $item): ?>
				<li>
					<div class="top-number">#<?= $item['number'] ?></div>
					<div class="top-name"><a href="<?= linkTo('ProfileController@page', ['slug' => $item['slug']]) ?>"><?= $item['name'] ?></a></div>
					<div class="top-site"><?= $item['site'] ?></div>
					<div class="top-rating"><i class="m-icon <? if($item['rating'] >= 0): ?>like<? else: ?>dislike<? endif; ?>"></i> <?= $item['rating'] ?></div>
					<div class="top-timestamp"><?= $item['timestamp'] ?></div>
					<div class="top-btn-show"><a href="<?= linkTo('ProfileController@page', ['slug' => $item['slug']]) ?>" class="btn-profile-show">Посмотреть <i class="m-icon eye"></i></a></div>
				</li>
			<? endforeach; ?>
			
		</ul>

	</div>
</div>