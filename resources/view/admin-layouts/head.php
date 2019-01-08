<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Admin panel</title>
	
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">
	<!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous"> -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css" />
	<link rel="stylesheet" href="/resources/css/libs/font-awesome.min.css">
	<link rel="stylesheet" href="/resources/vendor/bootstrap-4.1.2/css/themes/bootstrap.lumen.min.css">
	<!-- <link rel="stylesheet" href="/resources/vendor/images/style.css" type="text/css"> -->
	<!-- <link rel="stylesheet" href="/resources/vendor/markitup/skins/simple/style.css" type="text/css">
	<link rel="stylesheet" href="/resources/vendor/markitup/sets/default/style.css" type="text/css"> -->
	<?= \Kernel\View::css(['*' => ['admin.css', 'admin-adaptive.css']]) ?>

	<?= \Kernel\View::js(['*' => ['libs/jquery-3.1.1.min.js', 'libs/trumbowyg.min.js']]) ?>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>


<!-- Theme included stylesheets -->
<link href="//cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
<link href="//cdn.quilljs.com/1.3.6/quill.bubble.css" rel="stylesheet">

<!-- Core build with no theme, formatting, non-essential modules -->
<!-- <link href="//cdn.quilljs.com/1.3.6/quill.core.css" rel="stylesheet">
<script src="//cdn.quilljs.com/1.3.6/quill.core.js"></script> -->

<!-- Main Quill library -->
<!-- <script src="//cdn.quilljs.com/1.3.6/quill.js"></script> -->
<script src="//cdn.quilljs.com/1.3.6/quill.min.js"></script>
	<?= \Kernel\View::js(['*' => ['admin.js']]) ?>
</head>
<body>

<? vjoin('admin/media-modal.php'); ?>