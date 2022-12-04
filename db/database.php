<?php
class DatabaseHelper{
    private $db;

    public function __construct($servername, $username, $password, $dbname){
      $this->db = new mysqli($servername, $username, $password, $dbname);
      if ($this->db->connect_error) {
        die("Connection failed: " . $db->connect_error);
      }        
    }

    public function getPosts(){
      /*restituisce tutti i post*/
      $query = "SELECT idPost, username, testo, immagine, immagineProfilo, descImmagine FROM post, utente WHERE idUtente=codUtente ORDER BY dataPost DESC";
      $stmt = $this->db->prepare($query);
      $stmt->execute();
      $result = $stmt->get_result();

      return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function insertPostWithImg($testoPost, $imgPost, $descrizioneImmagine, $dataPost, $autore){
      $query = "INSERT INTO post (testo, immagine, descImmagine, dataPost, codUtente) VALUES (?, ?, ?, ?, ?)";
      $stmt = $this->db->prepare($query);
      $stmt->bind_param('ssssi',$testoPost, $imgPost, $descrizioneImmagine, $dataPost, $autore);
      $stmt->execute();
        
      return $stmt->insert_id;
    }

    public function insertPostSimple($testoPost, $dataPost, $autore){
      $query = "INSERT INTO post (testo, dataPost, codUtente) VALUES (?, ?, ?)";
      $stmt = $this->db->prepare($query);
      $stmt->bind_param('ssi',$testoPost, $dataPost, $autore);
      $stmt->execute();
        
      return $stmt->insert_id;
    }

    public function registerUser($nome, $cognome, $dataNascita, $sesso, $prefissoTelefonico, $numeroTelefono, $email, $username, $password, $immagineProfilo){
      $query = "INSERT INTO utente (`nome`, `cognome`, `dataNascita`, `sesso`, `prefissoTelefonico`, `numeroTelefono`, `email`, `username`, `password`, `immagineProfilo`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
      $stmt = $this->db->prepare($query);
      $stmt->bind_param('ssssssssss',$nome, $cognome, $dataNascita, $sesso, $prefissoTelefonico, $numeroTelefono, $email, $username, $password, $immagineProfilo);
      $stmt->execute();
        
      return $stmt->insert_id;
    }

    private function checkUsernameExistence($username){
      /*controlla l'esistenza del nomeutente*/
      $query = "SELECT `utente`.`nome`, `utente`.`cognome`
      FROM `utente`
      WHERE `utente`.`username` = ?";
      $stmt = $this->db->prepare($query);
      $stmt->bind_param('s', $username);
      $stmt->execute();
      $result = $stmt->get_result();
      if(mysqli_num_rows($result)){
        return true;
      }
      return false;
    }

    private function checkPostExistence($idPost){
      /*controlla l'esistenza di un post*/
      $query = "SELECT `post`.`idPost`
      FROM `post`
      WHERE `post`.`idPost` = ?";
      $stmt = $this->db->prepare($query);
      $stmt->bind_param('i', $idPost);
      $stmt->execute();
      $result = $stmt->get_result();
      if(mysqli_num_rows($result)){
        return true;
      }
      return false;
    }

    private function  checkChatExistence($idChat){
      /*controlla l'esistenza di una chat*/
    }

    public function getUserPosts($username){
      /*restituisce tutti i post di un utente*/
      if($this->checkUsernameExistence($username)){
        $query = "SELECT idPost, username, testo, immagine, immagineProfilo, descImmagine, dataPost FROM post, utente WHERE idUtente=codUtente AND username = ? ORDER BY dataPost DESC";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('s', $username);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
      }
      return 0;
    }
    public function getUserInfo($username){
      /*restituisce tutti i post di un utente*/
      if($this->checkUsernameExistence($username)){
        $query = "SELECT username, immagineProfilo FROM utente WHERE username = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('s', $username);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
      }
      return 0;
    }
    public function getFriends($username){
      /*restituisce tutti gli amici di un determinato utente*/
      if($this->checkUsernameExistence($username)){
        $query = "SELECT `utente`.`username`
        FROM `utente`
        WHERE `utente`.`idUtente` IN (SELECT `amicizia`.`codUtente2`
        FROM `amicizia`, `utente`
        WHERE `utente`.`idUtente` = `amicizia`.`codUtente`
        AND `utente`.`username` = ?)";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('s', $username);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
      }
      return 0;
    }

    public function getComments($idPost){
      if($this->checkPostExistence($idPost)){
        $query = "SELECT `testo`, `dataCommento`, `username`, `codPost`
        FROM `commento`, `utente`
        WHERE `commento`.`codUtente` = `utente`.`idUtente`
        AND `commento`.`codPost` = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('i', $idPost);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
      }
      return 0;
    }

    public function getChatUsers($idChat){
      /*restituisce tutti gli utenti di una chat*/
    }

    public function getChatMessages($idChat){
      /*restituisce tutti i messaggi di una chat*/
    }

    public function postLiked($idUtente, $idPost){

    }

    public function postSaved($idUtente, $idPost){

    }

    public function writeComment($idUtente, $idPost, $testo){
      
    }

    public function checkLogin($username, $password){
      $query = "SELECT idUtente, username, nome FROM utente WHERE username = ? AND password = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('ss',$username, $password);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getUserProfileImg($idUtente){
      $query = "SELECT immagineProfilo FROM utente WHERE idUtente = ?";
      $stmt = $this->db->prepare($query);
      $stmt->bind_param('i',$idUtente);
      $stmt->execute();
      $result = $stmt->get_result();

      return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function isUsernameUnique($username){
      /*controlla se l'username inserito è già presente nel db*/
      $query = "SELECT `utente`.`username`
      FROM `utente`
      WHERE `utente`.`username` = ?";
      $stmt = $this->db->prepare($query);
      $stmt->bind_param('s', $username);
      $stmt->execute();
      $result = $stmt->get_result();
      if(mysqli_num_rows($result)==0){
        return true;
      }
      return false;
    }

    public function isEmailUnique($mail){
      /*controlla se l'username inserito è già presente nel db*/
      $query = "SELECT `utente`.`email`
      FROM `utente`
      WHERE `utente`.`email` = ?";
      $stmt = $this->db->prepare($query);
      $stmt->bind_param('s', $mail);
      $stmt->execute();
      $result = $stmt->get_result();
      if(mysqli_num_rows($result)==0){
        return true;
      }
      return false;
    }
}
?>