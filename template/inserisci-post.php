<section class="d-flex justify-content-center">
<form action="upload.php" method="POST" enctype="multipart/form-data">
  <div>
    <h2 class="d-flex justify-content-center pt-5">Inserisci Post</h2>
    <ul>
      <li>
        <label for="testopost">Testo:</label>
        <textarea id="testopost" name="testopost" required></textarea>
      </li>
      <li>
        <label for="fileToUpload">Immagine:</label>
        <input type="file" id="fileToUpload" name="fileToUpload" />
        <button id="rmv" type="button">Remove file</button>
      </li>
      <li>
        <div id="img-preview" class="d-flex justify-content-center pt-5"></div>
      </li>
      <li>
        <label for="descrizioneimmagine" id="labelDescrizione" style="display: none">Breve descrizione:</label>
        <textarea id="descrizioneimmagine" name="descrizioneimmagine" style="display: none"></textarea>
      </li>
      <li>
        <input type="submit" name="submit" value="Invia"/>
      </li>
      <li><p><?php if(isset($_GET["msg"])){ echo $_GET["msg"]; }?></p></li>
    </ul>
  </div>
</form>
</section>