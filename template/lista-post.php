<?php foreach($templateParams["post"] as $posts): ?>
  <!--riga img profilo + nome utente -->
<article>
  <div class="row ">

  <div class="col-md-2"></div>

  <!--colonna immagine profilo-->
  <div class="col-2 d-flex justify-content-center">
    <a href="./profilo.php">
      <img src="<?php echo UPLOAD_DIR_PROFILE.$posts["immagineProfilo"]; ?>" alt="immagineProfilo"/>
    </a>
  </div>

  <!--colonna nome utente-->
  <div class="col-10 col-md-6 d-flex align-items-center">
    <a href="./profilo.php">
      <h2><?php echo $posts["username"]; ?></h2>
    </a>
  </div>

  <div class="col-md-2"></div>

  </div>

  <!--riga testo del post-->
  <div class="row">
  <div class="col-12 d-flex justify-content-center align-items-center">
    <p><?php echo $posts["testo"]; ?></p>
  </div>
  </div>

  <!--riga eventuale immagine-->
  <div class="row">
  <div class="col d-flex justify-content-center">
    <img src="<?php echo UPLOAD_DIR_POST.$posts["immagine"]; ?>" alt="<?php echo $posts["descImmagine"]; ?>" />
  </div>
  </div>

  <!--riga mi piace, commenti, save-->
  <div class="row w-75 pb-3">

  <div class="col-md-3"></div>

  <!--colonna mi piace-->
  <div class="col">
    <a href="#">
      <img src="./upload/webpageIcons/heart.svg" alt="mi piace"/>
    </a>
  </div>

  <!--colonna commenti-->
  <div class="col">
    <a href="#">
      <img src="./upload/webpageIcons/comment.svg" alt="commenta"/>
    </a>
  </div>

  <!--colonna save-->
  <div class="col">
    <a href="#">
      <img src="./upload/webpageIcons/save.svg" alt="salva"/>
    </a>
  </div>

  <!--colonna condividi-->
  <div class="col">
    <a href="#">
      <img src="./upload/webpageIcons/share.svg" alt="condividi"/>
    </a>
  </div>

  <div class="col"></div>

  </div>

  <div class="row">
    <div class="col-12 d-flex justify-content-center">

    <?php $div="myDIV".$posts['idPost']; ?>

    <button onclick="comments(<?php echo $div?>)">Show comments</button> 
    </div>
  </div>

  <div id="myDIV<?php echo $posts["idPost"]?>" class="row" style="display: none;"> 
      <ul>
        
      <?php
      $risultato = $dbh->getComments($posts["idPost"]);
      if(!count($risultato)==0){
        foreach($risultato as $r):
      ?>
        <li class="d-flex justify-content-center"><h3><?php echo $r["username"].": ";?></h3><p><?php echo $r["testo"]; ?></p></li>
      <?php endforeach; 
      }else{
      ?>
        <li>Nessun commento...</li>
      <?php
      }
      ?>


      </ul>
  </div> 
</article>
  <?php endforeach; ?>
