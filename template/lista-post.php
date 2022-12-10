

<?php foreach($templateParams["post"] as $posts): ?>
  <!--riga img profilo + nome utente -->
<article>
  <div class="row ">

  <div class="col-md-2"></div>

  <!--colonna immagine profilo-->
  <div class="col-2 d-flex justify-content-center">
    <a href="./profilo.php?user=<?php echo $posts["username"]; ?>">
      <img src="<?php echo UPLOAD_DIR_PROFILE.$posts["immagineProfilo"]; ?>" alt="<?php echo $posts["username"]?>"/>
    </a>
  </div>

  <!--colonna nome utente-->
  <div class="col-10 col-md-6 d-flex align-items-center">
    <a href="./profilo.php?user=<?php echo $posts["username"]; ?>">
      <h2><?php echo $posts["username"]; ?></h2>
    </a>
  </div>

  <div class="col-md-2"></div>

  </div>

  <?php $postId="post".$posts['idPost']; ?>

  <!--riga testo del post-->
  <div class="row">
    <div class="col-12 d-flex justify-content-center align-items-center" id="<?php echo $postId?>">
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
      <a href="">
        <img src="./upload/webpageIcons/heart.svg" alt="mi piace"/>
        <input type="hidden" value="<?php echo $posts["idPost"]; ?>"/>
      </a>
    </div>

    <!--colonna commenti-->
    <div class="col">
      <!--<a href="#">
        <img src="./upload/webpageIcons/comment.svg" alt="commenta"/>
      </a>-->
      

      <!--<a href="index.php#post<?php //echo $posts['idPost']; ?>" onclick="comments(<?php //echo $div?>)">-->
      <a href="">
        <img src="./upload/webpageIcons/comment.svg" alt="commenta"/>
        <input type="hidden" value="<?php echo $posts["idPost"]; ?>"/>
        <input type="hidden" value="<?php echo $_SESSION["idUtente"]; ?>"/>
      </a>

    </div>

    <!--colonna save-->
    <div class="col">
      <a href="" >
        <img src="./upload/webpageIcons/save.svg" alt="salva"/>
        <input type="hidden" value="<?php echo $posts["idPost"]; ?>"/>
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

  <!--sezione commenti + form-->
  <div class="row">

  </div>
</article>
  <?php endforeach; ?>
