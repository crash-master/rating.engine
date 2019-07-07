<div class="yd-block last-profiles">
	<h3 class="yd-block-title">Новые маги</h3>
	<div class="yd-block-content">
		<? foreach($last_added as $i => $item): ?>

			<div class="profile-item" data-click-open="<?= linkTo('ProfileController@page', ['slug' => $item['slug']]) ?>">
				<div class="profile-thumb" style="background-image: url('<?= nyd_get_profile_thumb($item['id']) ?>')">
					<div class="hover-icon"><i class="mdi mdi-chevron-right"></i></div>
				</div>
				<div class="profile-info">
					<div class="profile-name"><?= $item['name'] ?></div>
					<div class="profile-site">
						<noindex>
							<span class="txt-grey"><?= $item['site'] ?></span>
						</noindex>
					</div>
					<div class="date-of-create">
						Читать <i class="mdi mdi-arrow-right"></i>
					</div>
				</div>
			</div>

		<? endforeach; ?>

	</div>
</div>