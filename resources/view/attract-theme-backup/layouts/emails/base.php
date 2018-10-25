<meta charset="UTF-8">
<div class="wrap" style="padding: 20px; border: 7px solid #ccc; color: #616161; font-family: Roboto; width: 60%; margin-left: 20%">
	<header style="margin-bottom: 40px;">
		<h1 style="font-size: 28px; margin-top: 0; text-align: center"><?= $sitename ?></h1>
		<h3 style="font-size: 28px; margin-top: 0; text-align: center"><?= $title ?></h3>
	</header>
	<section class="main" style="text-align: center">
		<?= $message ?>
		<? if(isset($link)): ?>
			<br><br>
			<a href="<?= $link['href'] ?>" style="color: #ff4936;text-decoration: none;"><?= $link['text'] ?></a>
		<? endif; ?>
	</section>
</div>