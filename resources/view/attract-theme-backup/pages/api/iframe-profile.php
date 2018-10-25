<? vjoin('Head'); ?>
<style>
	body{
		overflow-x: hidden;
		background: transparent;
	}

	.attract-card{
		background: #eee;
		padding: 10px 20px;
		width: 500px;
	}

	.wrap{
		width: 500px;
	}

	#profile .Profile-name{
		margin-top: 5px;
	}

	.Profile-name a{
		color: inherit;
	}

	.review-item{
		background: #eee;
		margin-bottom: 0;
	}

	.review-item{
		border: 0;
		border-top: 1px solid #ddd;
	}

	.review-item .thumb .m-icon{
		left: 10px;
	}

	.stats .m-icon:first-of-type{
		margin-left: 0;
	}
</style>

<?php if ($theme): ?>
	<?php if ($theme['color-scheme'] == 'dark'): ?>
		<style>
			.attract-card, .review-item {
    			background: #333;
    		}

    		.txt-grey{
    			color: #fefefe;
    		}

    		.txt-grey-dark{
    			color: #fefefe;
    		}

    		.review-item{
				border-color: #555;
			}
		</style>
	<?php endif ?>
	<?php if ($theme['minimal'] == 'true'): ?>
		<style>
			.site,
			.details,
			.no-minimal{
				display: none;
			}
		</style>
	<?php endif ?>
<?php endif ?>

<a href="<?= $siteurl ?>" style="font-size: 6rem; margin-bottom: 15px; display: block" target="_blank" class="std-a"><?= $sitename ?></a>
<div class="wrap" id="profile">
	<div class="attract-card">
		<h3 class="txt-grey Profile-name"><span class="top number txt-grey-dark"><span><?= $profile['number_txt'] ?></span></span> 
			<a href="<?= $profile['to_profile'] ?>" class="std-a" target="_blank"><?= $profile['name'] ?></a></h3>
		<noindex>
			<a href="<?= $profile['site_link'] ?>" rel="nofollow" class="std-a site txt-red" target="_blank">
				<?= $profile['site'] ?> <i class="m-icon open-in-new"></i>
			</a>
		</noindex>
		<div class="top stats txt-grey-dark">
			<span class="details">
				<i class="m-icon thumb-up-green"></i> <?= $profile['count_like'] ?>
				<i class="m-icon thumb-down-red"></i> <?= $profile['count_dislike'] ?>
				<i class="m-icon thumbs-up-down"></i> <?= $profile['count_neutral'] ?>
			</span>
			<span class="total-rating txt-grey">Общий рейтинг: <span class="txt-grey-dark"><?= $profile['rating'] ?></span></span>
		</div>
	</div>
	<?php if ($theme['reviews'] != 'false'): ?>
	<?php $count = 0; foreach ($profile['reviews'] as $review): if($count == 3){ break; } $count++; ?>
		
	<div class="block review-item" id="review-<?= $review['id'] ?>">
		<div class="row">
			<div class="col-2 thumb">
				<? if($review['rating'] == 1): ?>
					<i class="m-icon thumb-up-green"></i><? elseif($review['rating'] == -1): ?>
					<i class="m-icon thumb-down-red"></i><? else: ?>
					<i class="m-icon thumbs-up-down"></i>
				<? endif; ?>
			</div>
			<div class="col-10">
				<div class="review-head">
					<span class="txt-grey-dark"><?= $review['username'] ?></span> 
					<span class="no-minimal"><span class="txt-grey-light">о маге</span> <a href="<?= $profile['to_profile'] ?>" target="_blank" class="std-a"><?= $profile['name'] ?></a></span>
				</div>
				<div class="review-body txt-grey-dark">
					<? if($review['image']): ?>
						<img class="no-minimal" src="<?= $review['image'] ?>" style="width: 100%; margin-bottom: 10px;" alt="image">
					<? endif; ?>
					<?= $review['message'] ?> 
				</div>
				<div class="review-foot">
					<span class="txt-grey-light timestamp">Оставлен <?= $review['timestamp'] ?></span> <span class="txt-red no-minimal">Коментарии <span class="txt-grey">(<?= count($review['comments']) ?>)</span></span>
				</div>
			</div>

		</div>
	</div>	
	<?php endforeach ?>
	<? endif; ?>
</div>
</body>
</html>