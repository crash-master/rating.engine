<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<title><?= $page_meta['title'] ?></title>
	<meta name="description" content="<?= $page_meta['description'] ?>">
	<meta name="keywords" content="<?= $page_meta['keywords'] ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
	
	<!-- CSS LIBS -->
	<!-- <link rel="stylesheet" href="/resources/view/new-yellow-drops/assets/css/libs/normalize.css">
	<link rel="stylesheet" href="/resources/view/new-yellow-drops/assets/css/libs/bootstrap-grid.min.css"> -->
	<link rel="stylesheet" href="/resources/view/new-yellow-drops/assets/css/libs/materialdesignicons.css">

	<!-- APP CSS -->
	<?= _css('/resources/view/new-yellow-drops/assets/css/', [
			'libs/normalize.css',
			'libs/bootstrap-grid.min.css',
			'fonts.css',
			'vars.css',
			'mobile-nav.css',
			'main.css',
			'sidebar.css',
			'article-list.css',
			'article-read.css',
			'profile-list.css',
			'profile-read.css',
			'media.css'
		], '/resources/view/new-yellow-drops/assets/css/master.min.css')  ?>
	<!-- <link rel="stylesheet" href="/resources/view/new-yellow-drops/assets/css/fonts.css">
	<link rel="stylesheet" href="/resources/view/new-yellow-drops/assets/css/vars.css">
	<link rel="stylesheet" href="/resources/view/new-yellow-drops/assets/css/mobile-nav.css">
	<link rel="stylesheet" href="/resources/view/new-yellow-drops/assets/css/main.css">
	<link rel="stylesheet" href="/resources/view/new-yellow-drops/assets/css/sidebar.css">
	<link rel="stylesheet" href="/resources/view/new-yellow-drops/assets/css/article-list.css">
	<link rel="stylesheet" href="/resources/view/new-yellow-drops/assets/css/article-read.css">
	<link rel="stylesheet" href="/resources/view/new-yellow-drops/assets/css/profile-list.css">
	<link rel="stylesheet" href="/resources/view/new-yellow-drops/assets/css/profile-read.css">

	<link rel="stylesheet" href="/resources/view/new-yellow-drops/assets/css/media.css"> -->

	<!-- JS LIBS -->
	<script src="/resources/view/new-yellow-drops/assets/js/libs/jquery-3.3.1.min.js"></script>

	<!-- APP JS -->
	<script src="/resources/view/new-yellow-drops/assets/js/mobile-nav.js"></script>
	<script src="/resources/view/new-yellow-drops/assets/js/comments.js"></script>
	<script src="/resources/view/new-yellow-drops/assets/js/search.js"></script>
	<script src="/resources/view/new-yellow-drops/assets/js/app.js"></script>
</head>
<body>