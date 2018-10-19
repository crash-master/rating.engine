<? vjoin('Head'); ?>
<style>
	body{
		overflow-x: hidden;
		background: transparent;
	}
</style>

<?php if ($theme): ?>
	<?php if ($theme['color-scheme'] == 'dark'): ?>
		<style>
			.rating-item {
    			background: #333;
    		}

    		.txt-grey{
    			color: #fefefe;
    		}

    		.txt-grey-dark{
    			color: #fefefe;
    		}
		</style>
	<?php endif ?>
	<?php if ($theme['spacing'] == 'false'): ?>
		<style>
			.rating-item {
    			margin-bottom: 0;
    		}
		</style>
	<?php endif ?>
	<?php if ($theme['minimal'] == 'true'): ?>
		<style>
			.Profile-site,
			.location,
			.stats,
			.timestamp,
			.col-10.col-lg-4.col-xl-4.offset-2.offset-md-2.offset-sm-2.offset-lg-0.offset-xl-0{
				display: none;
			}

			.rating-item{
				padding: 5px 0; 
			}

			.Profile-info{
				margin-top: 3px;
			}
		</style>
	<?php endif ?>
<?php endif ?>

<a href="<?= $siteurl ?>" style="font-size: 6rem; margin-bottom: 15px; display: block" target="_blank" class="std-a"><?= $sitename ?></a>
<div class="wrap">
	<? vjoin('ProfileItem', ['profile' => $profiles]); ?>
</div>
<script>
	$(document).ready(function(){
		$('.rating-item a').each(function(){
			$(this).attr('target', '_blank');
		})
	});
</script>
</body>
</html>