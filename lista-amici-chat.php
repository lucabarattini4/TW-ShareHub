<?php foreach($templateParams["friends"] as $friend): ?>
<!--riga img profilo + nome utente -->
<div>
<div class="row">

<div class="col-md-2"></div>

<!--colonna immagine profilo-->
<div class="col-2 d-flex justify-content-center">
  <form method="post" action="./user-chat.php">
<input type="hidden" name="user" value="<?php echo $friend["username"]; ?>">
<input type="image" name="submit_button" type="submit" src="<?php echo UPLOAD_DIR_PROFILE.$friend["immagineProfilo"]; ?>" alt="immagine profilo"/>
</form>




</div>

<!--colonna nome utente-->
<div class="col-10 col-md-6 d-flex align-items-center">

  <form method="post" action="./user-chat.php">
<input type="hidden" name="user" value="<?php echo $friend["username"]; ?>">
<input  name="submit_button" type="submit" value="<?php echo $friend["username"]; ?>" />
</form>
</div>

<div class="col-md-2"></div>

</div>

</div>
<hr>
<?php endforeach; ?>
<?php foreach($templateParams["friends2"] as $friend): ?>
<!--riga img profilo + nome utente -->
<div>
<div class="row">

<div class="col-md-2"></div>

<!--colonna immagine profilo-->
<div class="col-2 d-flex justify-content-center">
  <form method="post" action="./user-chat.php">
<input type="hidden" name="user" value="<?php echo $friend["username"]; ?>">
<input type="image" name="submit_button" type="submit" src="<?php echo UPLOAD_DIR_PROFILE.$friend["immagineProfilo"]; ?>" alt="immagine profilo" />
</form>




</div>

<!--colonna nome utente-->
<div class="col-10 col-md-6 d-flex align-items-center">

  <form method="post" action="./user-chat.php">
<input type="hidden" name="user" value="<?php echo $friend["username"]; ?>">
<input  name="submit_button" type="submit" value="<?php echo $friend["username"]; ?>" />
</form>
</div>

<div class="col-md-2"></div>

</div>

</div>
<hr>
<?php endforeach; ?>
