<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>404 Not found</title>
  <link rel="stylesheet" href="/resources/view/magic-sea/assets/css/libs/bootstrap.min.css">
  <link href="https://fonts.googleapis.com/css?family=Roboto+Slab" rel="stylesheet">
  <style type="text/css">
    html{
      font-size: 4.5px;
    }

    #page-404{
      font-family: RobotoSlab;
      margin-top: 200px;
      font-size: 5rem;
    }

    .url{
      font-weight: bold;
    }

    .icon-404-container{
      text-align: center;
    }

    .icon-404{
      max-width: 300px;
      display: inline-block;
      margin-top: 50px;
    }

    .page-title-404{
      font-size: 40rem;
      font-weight: bold;
      color: #1e88e5;
    }

    .text-404{
      font-size: 5rem;
    }

    .go-back{
      display: block;
      transition-duration: .2s;
      color: #1e88e5;
      font-size: 4rem;
    }

    .go-home{
      display: block;
      transition-duration: .2s;
      color: #1e88e5;
      font-size: 4rem;
    }

    @media (max-width: 998px){
      #page-404{
        margin-top: 0;
      }

      .content-container{
        text-align: center;
      }

      .text-404{
        display: none;
      }

      .go-back{
        margin-top: -40px;
        font-size: 6rem;
      }

      .page-title-404{
        font-size: 30rem;
      }
    }
  </style>
</head>
<body>
  <div class="container">
    <section class="page" id="page-404">
      <div class="row">
        <div class="col-12 col-lg-6 col-xl-6 icon-404-container">
          <img src="/resources/view/magic-sea/assets/imgs/404.icon.png" class="icon-404">
        </div>
        <div class="col-12 col-lg-6 col-xl-6 content-container">
          <div class="page-title-404">404</div>
          <p class="text-404">Извините, мы не смогли найти страницу <span class="url"></span></p>
          <br>
          <a href="/" class="go-back go-home">На главную страницу</a>
        </div>
      </div>
    </section>
  </div>

  <script>
    window.onload = function(){
      document.getElementsByClassName("url")[0].innerHTML = document.location;
    }
  </script>
</body>
</html>
