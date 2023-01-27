<?php
setcookie("user", 0, time() - 3600);
foreach($templateParams["single"] as $single): ?>
<!--riga img profilo + nome utente -->
<div>
<div class="row">
<div class="col-md-2"></div>
<!--colonna immagine profilo-->
<div class="col-2 d-flex justify-content-center">
  <form method="post" action="./user-chat.php">
    <input type="hidden" name="user" value="<?php echo $single["username"]; ?>">
    <label for="submit_button<?php echo $single["username"]; ?>" hidden>BOTTONE</label>
    <input type="image" id="submit_button<?php echo $single["username"]; ?>" name="submit_button" src="<?php echo UPLOAD_DIR_PROFILE.$single["immagineProfilo"]; ?>" alt="immagine profilo" />
  </form>
</div>
<!--colonna nome utente-->
<div class="col-10 col-md-6 d-flex align-items-center">
  <form method="post" action="./user-chat.php">
    <input type="hidden" name="user" value="<?php echo $single["username"]; ?>">
    <label for="submit_button2<?php echo $single["username"]; ?>" hidden>BOTTONE</label>
    <input  name="submit_button" id="submit_button2<?php echo $single["username"]; ?>" type="submit" value="<?php echo $single["username"]; ?>" />
  </form>
</div>
<div class="col-md-2"></div>
</div>
</div>
<hr>
<?php endforeach; ?>
