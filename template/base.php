<?php require_once "bootstrap.php"; ?>

<!DOCTYPE html>
<html lang="it" dir="ltr">
<head>
  <meta charset="utf-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>


  <!--Bootstrap-->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

  <!--Foglio di stile-->
  <link rel="stylesheet" type="text/css" href="./css/style.css" />
  <?php
    if(isset($templateParams["css"])):
        foreach($templateParams["css"] as $css):
    ?>
        <link rel="stylesheet" type="text/css" href="<?php echo $css; ?>"/>
    <?php
        endforeach;
    endif;
  ?>


  <!--Font Bebas Neue per logo-->
  <link href='https://fonts.googleapis.com/css?family=Bebas+Neue' rel='stylesheet'>

  <!--Titolo pagina e icona-->
  <title>Prova Bootstrap</title>
  <link rel="icon" href="./upload/webpageIcons/Logo_Nero.png" type="image/x-icon">
</head>
<body>

    <!--HEADER-->
  <div class="container-fluid fixed-top">
    <header>
    <div class="row overflow-hidden">

    <?php if(isUserLoggedIn()){ ?>
      <!--colonna impostazioni-->
      <div class="col-2">
        <a class="d-flex justify-content-start align-items-center" href="#">
          <img class="menu" src="./upload/webpageIcons/setting.svg" alt="impostazioni"/>
        </a>
      </div>
      <?php } ?>
    

      <!--colonna logo-->
      <div class="col">
        <a class="text-center d-flex justify-content-center align-items-center" href="index.php">
          <h1>ShareHub</h1>
        </a>
      </div>

      <?php if(isUserLoggedIn()){ ?>
      <!--colonna profilo-->
      <div class="col-2">
        <a class="d-flex justify-content-end align-items-center" href="#">
          <?php 
          $templateParams["img"] = $dbh->getUserProfileImg($_SESSION["idUtente"]);
          foreach($templateParams["img"] as $img): 
          ?>
          <img src="./upload/profile/<?php echo $img["immagineProfilo"]?>" alt="profilo"/>
          <?php endforeach; ?>
        </a>
      </div>
      <?php } ?>
      
    </div>
  </header>
  </div>
    <!--FINE HEADER-->


   
  <!--POST-->

  <div class="container">
    <?php
    if(isset($templateParams["nome"])){
        require($templateParams["nome"]);
    }
    ?>
  </div>

  <!--FINE POST-->

  <?php if(isUserLoggedIn()){ ?>
  <!--NAV-->
  <div class="container-fluid fixed-bottom">
    <footer>
      <ul class="nav nav-pills">

        <!--nuovo post-->
        <li class="nav-item col-3 text-center">
          <a href="./nuovo-post.php">
            <img src="./upload/webpageIcons/pen.svg" alt="nuovo post">
          </a>
        </li>

        <!--chat-->
        <li class="nav-item col-3 text-center">
          <a href="./chat.html">
            <img src="./upload/webpageIcons/paper-plane.svg" alt="nuovo messaggio">
          </a>
        </li>

        <!--like e salvati-->
        <li class="nav-item col-3 text-center">
          <a href="./likes.html">
            <img src="./upload/webpageIcons/heart.svg" alt="like e salvati">
          </a>
        </li>

        <!--cerca-->
        <li class="nav-item col-3 text-center">
          <a href="./search.html">
            <img src="./upload/webpageIcons/search.svg" alt="cerca">
          </a>
        </li>

      </ul>
    </footer>
  </div>
  <?php } ?>
  <!--FINE NAV-->

  <?php
    if(isset($templateParams["js"])):
        foreach($templateParams["js"] as $script):
    ?>
        <script src="<?php echo $script; ?>"></script>
    <?php
        endforeach;
    endif;
  ?>

</body>
</html>