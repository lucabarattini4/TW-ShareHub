<?php foreach($templateParams["chats"] as $chat): ?>
  <!--riga img profilo + nome utente -->
<article>
  <div class="row ">

  <div class="col-md-2"></div>

  <!--colonna immagine profilo-->
  <div class="col-2 d-flex justify-content-center">
    <a href="./profile.html">
      <img src="<?php echo UPLOAD_DIR_PROFILE.$chat["immagineGruppo"]; ?>" alt="immagineProfilo"/>
    </a>
  </div>

  <!--colonna nome utente-->
  <div class="col-10 col-md-6 d-flex align-items-center">
    <a href="./profile.html">
      <h2><?php echo $posts["nomeChat"]; ?></h2>
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

</article>
  <?php endforeach; ?>
