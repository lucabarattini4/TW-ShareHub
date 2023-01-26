<div class="row ">
  <a href="new-chat.php"><button>NUOVA CHAT</button></a>
</div>
<hr>
<?php
setcookie("user", 0, time() - 3600);
 foreach($templateParams["groups"] as $chat): ?>
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
<hr>
  <?php endforeach; ?>

  <?php foreach($templateParams["single"] as $single): ?>
  <!--riga img profilo + nome utente -->
<article>
  <div class="row">

  <div class="col-md-2"></div>

  <!--colonna immagine profilo-->
  <div class="col-2 d-flex justify-content-center">
    <form method="post" action="./user-chat.php">
<input type="hidden" name="user" value="<?php echo $single["username"]; ?>">
<input type="image" name="submit_button" type="submit" src="<?php echo UPLOAD_DIR_PROFILE.$single["immagineProfilo"]; ?>" />
</form>




  </div>

  <!--colonna nome utente-->
  <div class="col-10 col-md-6 d-flex align-items-center">

    <form method="post" action="./user-chat.php">
<input type="hidden" name="user" value="<?php echo $single["username"]; ?>">
<input  name="submit_button" type="submit" value="<?php echo $single["username"]; ?>" />
</form>
  </div>

  <div class="col-md-2"></div>

  </div>

</article>
<hr>
  <?php endforeach; ?>
