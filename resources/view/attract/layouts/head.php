<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title><?= $page['title'] ? $page['title'] : $meta_page['title'] ? $meta_page['title'] : $profile['name'] ?></title>
	<meta name="description" value="<?= $meta['description'] ?>">
	<meta name="keywords" value="<?= $page['keywords'] ? $page['keywords'] : $meta_page['keywords'] ? $meta_page['keywords'] : $profile['site']['keywords'] ?>">

	<meta name="viewport" content="width=device-width, initial-scale=0.7, maximum-scale=1.0, user-scalable=no">
	<link rel="stylesheet" href="/resources/vendor/bootstrap-4.1.2/css/bootstrap.min.css" type="text/css">
	<link rel="stylesheet" href="/resources/vendor/normalize.css" type="text/css">
	<link rel="stylesheet" href="/resources/assets/css/icons.css" type="text/css">
	<link rel="stylesheet" href="/resources/assets/css/main.css" type="text/css">
	<link rel="stylesheet" href="/resources/assets/css/home.css" type="text/css">
	<link rel="stylesheet" href="/resources/assets/css/rating.css" type="text/css">
	<link rel="stylesheet" href="/resources/assets/css/profile.css" type="text/css">
	<link rel="stylesheet" href="/resources/assets/css/news.css" type="text/css">
	<link rel="stylesheet" href="/resources/assets/css/single-article.css" type="text/css">
	<link rel="stylesheet" href="/resources/assets/css/carousel.css" type="text/css">
	<link rel="stylesheet" href="/resources/assets/css/new-user.css" type="text/css">
	<link rel="stylesheet" href="/resources/assets/css/search.css" type="text/css">
	<link rel="stylesheet" href="/resources/assets/css/media.css" type="text/css">

	<script type="text/javascript" src="/resources/vendor/jquery-3.3.1.min.js"></script>
	<script type="text/javascript" src="/resources/vendor/bootstrap-4.1.2/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="/resources/assets/js/app.js"></script>
	<!-- <script type="text/javascript" src="/resources/js/disable-submit-btn.js"></script> -->
</head>
<body>