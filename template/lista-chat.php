<?php
setcookie("user", 0, time() - 3600);
foreach($templateParams["single"] as $single): ?>
<!--riga img profilo + nome utente -->
<article>
<div class="row">
<div class="col-md-2"></div>
<!--colonna immagine profilo-->
<div class="col-2 d-flex justify-content-center">
  <form method="post" action="./user-chat.php">
    <input type="hidden" name="user" value="<?php echo $single["username"]; ?>">
    <input type="image" name="submit_button" src="<?php echo UPLOAD_DIR_PROFILE.$single["immagineProfilo"]; ?>" />
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
