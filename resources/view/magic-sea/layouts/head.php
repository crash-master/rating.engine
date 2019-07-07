<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<title><?= $page_meta['title'] ?></title>
	<meta name="description" content="<?= $page_meta['description'] ?>">
	<meta name="keywords" content="<?= $page_meta['keywords'] ?>">

	<meta name="viewport" content="width=device-width, initial-scale=0.7, maximum-scale=1.0, user-scalable=no">
	<link href="https://fonts.googleapis.com/css?family=Roboto+Slab" rel="stylesheet">
	<link rel="stylesheet" href="/resources/vendor/bootstrap-4.1.2/css/bootstrap-grid.min.css" type="text/css">
	<link rel="stylesheet" href="/resources/vendor/normalize.css" type="text/css">
	<!-- <link rel="stylesheet" href="/resources/view/magic-sea/assets/css/icons.css">
	<link rel="stylesheet" href="/resources/view/magic-sea/assets/css/app.css">
	<link rel="stylesheet" href="/resources/view/magic-sea/assets/css/home.css">
	<link rel="stylesheet" href="/resources/view/magic-sea/assets/css/rating.css">
	<link rel="stylesheet" href="/resources/view/magic-sea/assets/css/single.css">
	<link rel="stylesheet" href="/resources/view/magic-sea/assets/css/media.1.0.css"> -->

	<?= _css('/resources/view/magic-sea/assets/css/', [
			'icons.css',
			'app.css',
			'home.css',
			'rating.css',
			'single.css',
			'media.1.0.css'
		], '/resources/view/magic-sea/assets/css/master.min.css') ?>

    <script type="text/javascript" src="/resources/vendor/jquery-3.3.1.min.js"></script>
	<script type="text/javascript" src="/resources/view/magic-sea/assets/js/libs/excerpt.js"></script>
	<script type="text/javascript" src="/resources/view/magic-sea/assets/js/disable-submit-btn.js"></script>
	<script type="text/javascript" src="/resources/view/magic-sea/assets/js/check-site-on-exists.js"></script>
	<script type="text/javascript" src="/resources/view/magic-sea/assets/js/app.1.3.js"></script>

	<link rel="icon" href="/resources/view/magic-sea/assets/imgs/favicon.png" type="image/png" />

</head>
<body>
	
