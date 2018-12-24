<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>404 not found</title>
    <link rel="shortcut icon" href="/frontend/img/favicon.png">
    <style>
        *{
            padding: 0;
            margin: 0;
            font-family: Verdana;
        }

        body{
            background: #fefefe;
        }

        .wrapper{
            width: 800px;
            margin: auto;
            margin-top: 20vh;
            text-align: center;
        }

        .main-text{
            font-size: 140px;
            color: #aaa;
        }

        .link{
            font-size: 30px;
            color: #555;
            margin: 50px 0;
        }

        .go-back{
            text-decoration: none;
            color: white;
            display: inline-block;
            width: 170px;
            height: 40px;
            line-height: 40px;
            background-color: #009688;
            font-size: 20px;
            transition-duration: .2s;
        }

        .go-back:hover{
            background-color: #00695C;
        }
    </style>
</head>
<body>

<div class="wrapper">
	<p class="main-text">Sorry, 404</p>
	<p class="link">Link <span>&laquo; <?= Kernel\Request::getUrl() ?> &raquo;</span> not found</p>
	<a href="#" class="go-back" onclick="history.go(-1);return false;">Вернутся назад</a>
</div>


</body>
</html>