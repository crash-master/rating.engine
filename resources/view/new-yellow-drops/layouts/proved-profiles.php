<div class="yd-block proved-profiles">
	<h3 class="yd-block-title">Проверенные маги</h3>
	<div class="yd-block-content">
		<div class="row">
			<?php foreach ($recomended_list as $key => $profile): ?>
				<div class="col-12 col-lg-4 col-xl-4 col-md-6">
					<div class="proved-item" data-click-open="<?= $profile['to_profile'] ?>">
						<div class="proved-thumb" style="background-image: url('<?= empty($profile['site_obj']['screen']) ? '/resources/view/new-yellow-drops/assets/imgs/no-img.jpg' : $profile['site_obj']['screen'] ?>')">
							<div class="hover-icon"><i class="mdi mdi-chevron-right"></i></div>
						</div>
						<div class="proved-info">
							<div class="proved-name"><?= $profile['name'] ?></div>
							<div class="proved-site">
								<noindex><?= $profile['site'] ?></noindex>
							</div>
						</div>
					</div>
				</div>
			<?php endforeach ?>
		</div>
	</div>
</div>