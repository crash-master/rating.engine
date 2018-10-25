<section class="block" id="recomended">
	<h2 class="block-title">
		Рекомендованные
	</h2>
	<div class="row">
		<?php foreach ($recomended_list as $key => $profile): ?>
			<div class="col-12 col-lg-4 col-xl-4">
				<div class="r-item">
					<div class="r-screen"><img src="<?= empty($profile['site_obj']['screen']) ? '/resources/view/attract/assets/imgs/screens/default-screen.jpg' : $profile['site_obj']['screen'] ?>"></div>
					<div class="r-title"><a href="<?= $profile['to_profile'] ?>" class="std-a"><?= $profile['name'] ?></a></div>
					<div class="r-site txt-red"><?= $profile['site'] ?></div>
				</div>
			</div>
		<?php endforeach ?>
	</div>
</section>