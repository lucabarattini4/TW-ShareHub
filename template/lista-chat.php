<?php foreach($templateParams["chats"] as $chat): ?>
  <!--riga img profilo + nome utente -->
<article>
  <div class="row ">

  <div class="col-md-2"></div>

  <!--colonna immagine profilo-->
  <div class="col-2 d-flex justify-content-center">
    <a href="./messages.php">
      <img src="<?php echo UPLOAD_DIR_PROFILE.$chat["immagineGruppo"]; ?>" alt="immagineProfilo"/>
    </a>
  </div>

  <!--colonna nome utente-->
  <div class="col-10 col-md-6 d-flex align-items-center">
    <a href="./messages.php">
      <h2><?php echo $chat["nomeChat"]; ?></h2>
    </a>
  </div>

  <div class="col-md-2"></div>

  </div>

</article>
  <?php endforeach; ?>
