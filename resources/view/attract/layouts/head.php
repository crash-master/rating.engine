<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title><?= $page_meta['title'] ?></title>
	<meta name="description" value="<?= $page_meta['description'] ?>">
	<meta name="keywords" value="<?= $page_meta['keywords'] ?>">

	<meta name="viewport" content="width=device-width, initial-scale=0.7, maximum-scale=1.0, user-scalable=no">
	<link rel="stylesheet" href="/resources/vendor/bootstrap-4.1.2/css/bootstrap.min.css" type="text/css">
	<link rel="stylesheet" href="/resources/vendor/normalize.css" type="text/css">
	<!-- <link rel="stylesheet" href="/resources/view/attract/assets/css/icons.css" type="text/css">
	<link rel="stylesheet" href="/resources/view/attract/assets/css/main.css" type="text/css">
	<link rel="stylesheet" href="/resources/view/attract/assets/css/home.css" type="text/css">
	<link rel="stylesheet" href="/resources/view/attract/assets/css/rating.css" type="text/css">
	<link rel="stylesheet" href="/resources/view/attract/assets/css/profile.css" type="text/css">
	<link rel="stylesheet" href="/resources/view/attract/assets/css/news.css" type="text/css">
	<link rel="stylesheet" href="/resources/view/attract/assets/css/single-article.css" type="text/css">
	<link rel="stylesheet" href="/resources/view/attract/assets/css/carousel.css" type="text/css">
	<link rel="stylesheet" href="/resources/view/attract/assets/css/new-user.css" type="text/css">
	<link rel="stylesheet" href="/resources/view/attract/assets/css/search.css" type="text/css">
	<link rel="stylesheet" href="/resources/view/attract/assets/css/media.css" type="text/css"> -->
	<?= _css('/resources/view/attract/assets/css/', [
			'icons.css',
			'main.css',
			'home.css',
			'rating.css',
			'profile.css',
			'news.css',
			'single-article.css',
			'carousel.css',
			'new-user.css',
			'search.css',
			'media.css'
		], '/resources/view/attract/assets/css/master.min.css') ?>

	<script type="text/javascript" src="/resources/vendor/jquery-3.3.1.min.js"></script>
	<script type="text/javascript" src="/resources/vendor/bootstrap-4.1.2/js/bootstrap.min.js"></script>
	<!-- <script type="text/javascript" src="/resources/view/attract/assets/js/funcs.js"></script>
	<script type="text/javascript" src="/resources/view/attract/assets/js/mobile-nav.js"></script>
	<script type="text/javascript" src="/resources/view/attract/assets/js/form-control.js"></script>
	<script type="text/javascript" src="/resources/view/attract/assets/js/search.js"></script>
	<script type="text/javascript" src="/resources/view/attract/assets/js/comments.js"></script>
	<script type="text/javascript" src="/resources/view/attract/assets/js/check-site-on-exists.js"></script>
	<script type="text/javascript" src="/resources/view/attract/assets/js/rating.js"></script>
	<script type="text/javascript" src="/resources/view/attract/assets/js/app.js"></script> -->
	<?= _js('/resources/view/attract/assets/js/', [
			'funcs.js',
			'mobile-nav.js',
			'form-control.js',
			'search.js',
			'comments.js',
			'check-site-on-exists.js',
			'rating.js',
			'app.js'
		], '/resources/view/attract/assets/js/master.min.js') ?>

</head>
<body>
