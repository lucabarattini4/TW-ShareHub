<?php foreach($templateParams["post"] as $posts): ?>
  
<article>
  <!--riga img profilo + nome utente -->
  <div class="row ">

    <!--colonna vuota-->
    <div class="col-md-2"></div>

    <!--colonna immagine profilo-->
    <div class="col-2 d-flex justify-content-center">
      <a href="./profilo.php?user=<?php echo $posts["username"]; ?>">
        <img src="<?php echo UPLOAD_DIR_PROFILE.$posts["immagineProfilo"]; ?>" alt="<?php echo "immagine profilo di ".$posts["username"]?>"/>
      </a>
    </div>

    <!--colonna nome utente-->
    <div class="col-10 col-md-6 d-flex align-items-center">
      <a href="./profilo.php?user=<?php echo $posts["username"]; ?>">
        <h2><?php echo $posts["username"]; ?></h2>
      </a>
    </div>

    <!--colonna vuota-->
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

    <!--colonna vuota-->
    <div class="col-md-3"></div>

    <!--colonna mi piace-->
    <div class="col">
      <img src="./upload/webpageIcons/heart.svg" alt="<?php echo "like al post di ".$posts["username"]?>"/>
      <input type="hidden" value="<?php echo $posts["idPost"]; ?>"/>
    </div>

    <!--colonna commenti-->
    <div class="col">
      <img src="./upload/webpageIcons/comment.svg" alt="<?php echo "commenta il post di ".$posts["username"]?>"/>
      <input type="hidden" value="<?php echo $posts["idPost"]; ?>"/>
      <input type="hidden" value="<?php echo $_SESSION["idUtente"]; ?>"/>
    </div>

    <!--colonna save-->
    <div class="col">
      <img src="./upload/webpageIcons/save.svg" alt="<?php echo "salva il post di ".$posts["username"]?>"/>
      <input type="hidden" value="<?php echo $posts["idPost"]; ?>"/>
    </div>

    <!--colonna condividi-->
    <div class="col">
      <img src="./upload/webpageIcons/share.svg" alt="<?php echo "condividi il post di ".$posts["username"]?>"/>
    </div>

    <!--colonna vuota-->
    <div class="col"></div>

  </div>

  <!--riga sezione commenti + form-->
  <div class="row"></div>

</article>

<?php endforeach; ?>
