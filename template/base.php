<!DOCTYPE html>
<html lang="it" dir="ltr">
<head>
  <meta charset="utf-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

  <!--Foglio di stile-->
  <link rel="stylesheet" type="text/css" href="./css/style.css" />

  <!--Font Bebas Neue per logo-->
  <link href='https://fonts.googleapis.com/css?family=Bebas+Neue' rel='stylesheet'>

  <!--Titolo pagina e icona-->
  <title>Prova Bootstrap</title>
  <link rel="icon" href="../upload/Logo_Bianco.png" type="image/x-icon">
</head>
<body>

    <!--HEADER-->
  <div class="container-fluid fixed-top">
    <div class="row header overflow-hidden">

      <!--colonna impostazioni-->
      <div class="col-2">
        <a class="d-flex justify-content-start align-items-center" href="#">
          <img class="menu" src="./upload/webpageIcons/setting.svg" alt="impostazioni"/>
        </a>
      </div>

      <!--colonna logo-->
      <div class="col">
        <a class="text-center d-flex justify-content-center align-items-center" href="#">
          <h1>ShareHub</h1>
        </a>
      </div>

      <!--colonna profilo-->
      <div class="col-2">
        <a class="d-flex justify-content-end align-items-center" href="#">
          <img class="menu profileImg" src="./upload/profile/elmo.jpg" alt="profilo"/>
        </a>
      </div>
      
    </div>
  </div>
    <!--FINE HEADER-->


   
  <!--POST-->

  <div class="container post">
    <?php
    if(isset($templateParams["nome"])){
        require($templateParams["nome"]);
    }
    ?>
  </div>

  <!--FINE POST-->


  <!--NAV-->
  <div class="container-fluid container-nav fixed-bottom">
      <ul class="nav nav-pills">

        <!--nuovo post-->
        <li class="nav-item col-3 text-center">
          <a href="./newPost.html">
            <img class="barra" src="./upload/webpageIcons/pen.svg" alt="nuovo post">
          </a>
        </li>

        <!--chat-->
        <li class="nav-item col-3 text-center">
          <a href="./chat.html">
            <img class="barra" src="./upload/webpageIcons/paper-plane.svg" alt="nuovo messaggio">
          </a>
        </li>

        <!--like e salvati-->
        <li class="nav-item col-3 text-center">
          <a href="./likes.html">
            <img class="barra" src="./upload/webpageIcons/heart.svg" alt="like e salvati">
          </a>
        </li>

        <!--cerca-->
        <li class="nav-item col-3 text-center">
          <a href="./search.html">
            <img class="barra" src="./upload/webpageIcons/search.svg" alt="cerca">
          </a>
        </li>

      </ul>
  </div>
  <!--FINE NAV-->

</body>
</html>