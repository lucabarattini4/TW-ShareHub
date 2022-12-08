<?php
class DatabaseHelper{
    private $db;

    public function __construct($servername, $username, $password, $dbname){
      $this->db = new mysqli($servername, $username, $password, $dbname);
      if ($this->db->connect_error) {
        die("Connection failed: " . $db->connect_error);
      }
    }

    /**
     * Restituisce tutti i post
     */
    public function getPosts(){
      $query = "SELECT idPost, username, testo, immagine, immagineProfilo, descImmagine FROM post, utente WHERE idUtente=codUtente ORDER BY dataPost DESC";
      $stmt = $this->db->prepare($query);
      $stmt->execute();
      $result = $stmt->get_result();

      return $result->fetch_all(MYSQLI_ASSOC);
    }

    /**
     * Inserisce un post con una immagine
     *
     * @param string $testoPost testo del post
     * @param string $imgPost immagine del post
     * @param string $descrizioneImmagine alt dell'immagine postata
     * @param string $dataPost data del post
     * @param int $codUtente utente autore del post
     */
    public function insertPostWithImg($testoPost, $imgPost, $descrizioneImmagine, $dataPost, $codUtente){
      $query = "INSERT INTO post (testo, immagine, descImmagine, dataPost, codUtente) VALUES (?, ?, ?, ?, ?)";
      $stmt = $this->db->prepare($query);
      $stmt->bind_param('ssssi',$testoPost, $imgPost, $descrizioneImmagine, $dataPost, $codUtente);
      $stmt->execute();

      return $stmt->insert_id;
    }

    /**
     * Inserisce un post senza immagine
     * @param string $testoPost testo del post
     * @param string $dataPost data del post
     * @param int $codUtente utente autore del post
     */
    public function insertPostSimple($testoPost, $dataPost, $codUtente){
      $query = "INSERT INTO post (testo, dataPost, codUtente) VALUES (?, ?, ?)";
      $stmt = $this->db->prepare($query);
      $stmt->bind_param('ssi',$testoPost, $dataPost, $codUtente);
      $stmt->execute();

      return $stmt->insert_id;
    }

    /**
     * Registra un nuovo utente
     */
    public function registerUser($nome, $cognome, $dataNascita, $sesso, $prefissoTelefonico, $numeroTelefono, $email, $username, $password, $immagineProfilo){
      $query = "INSERT INTO utente (`nome`, `cognome`, `dataNascita`, `sesso`, `prefissoTelefonico`, `numeroTelefono`, `email`, `username`, `password`, `immagineProfilo`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
      $stmt = $this->db->prepare($query);
      $stmt->bind_param('ssssssssss',$nome, $cognome, $dataNascita, $sesso, $prefissoTelefonico, $numeroTelefono, $email, $username, $password, $immagineProfilo);
      $stmt->execute();

      return $stmt->insert_id;
    }

    /**
     * Controlla l'esistenza di un username
     */
    private function checkUsernameExistence($username){
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

    /**
     * Controlla l'esistenza di un post
     */
    private function checkPostExistence($idPost){
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

    /**
     * Controlla l'esistenza di una chat
     */
    private function  checkChatExistence($idChat){
      $query = "SELECT `chat`.`idChat`
      FROM `chat`
      WHERE `chat`.`idChat` = ?";
      $stmt = $this->db->prepare($query);
      $stmt->bind_param('i', $idChat);
      $stmt->execute();
      $result = $stmt->get_result();
      if(mysqli_num_rows($result)){
        return true;
      }
      return false;
    }

    /**
     * Restituisce tutti i post di un utente
     */
    public function getUserPosts($username){
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

    /**
     * Ritorna le info di un utente
     */
    public function getUserInfo($username){
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

    /**
     * Restituisce gli amici di un utente
     */
    public function getFriends($username){
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

    /**
     * Restituisce tutti i commenti di un post
     */
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

    /**
     * Restituisce tutti gli utenti che partecipano ad una determinata chat
     */
    public function getChatComponents($idChat){
      $query = "SELECT `utente`.`username` FROM `chat`, `partecipazione`, `utente` WHERE `chat`.`idChat`=`partecipazione`.`codChat` AND `partecipazione`.`codUtente` = `utente`.`idUtente` AND `chat`.`idChat` = ?";
      $stmt = $this->db->prepare($query);
      $stmt->bind_param('i',$idChat);
      $stmt->execute();
      $result = $stmt->get_result();

      return $result->fetch_all(MYSQLI_ASSOC);
    }

    /**
     * Restituisce tutti i messaggi di una determinata chat
     */
    public function getChatMessages($idChat){
      $query = "SELECT `utente`.`username`, `messaggio`.`testo`  FROM `chat`, `partecipazione`, `utente`, `messaggio` WHERE `chat`.`idChat` = `partecipazione`.`codChat` AND `partecipazione`.`codUtente` = `utente`.`idUtente` AND `utente`.`idUtente` = `messaggio`,`codUtente` AND `chat`.`idChat` = `messaggio`.`codChat` AND `chat`.`idChat` = ?";
      $stmt = $this->db->prepare($query);
      $stmt->bind_param('i',$idChat);
      $stmt->execute();
      $result = $stmt->get_result();

      return $result->fetch_all(MYSQLI_ASSOC);

    }

    /**
     * Restituisce tutte le chat di gruppo di un determinato utente
     */
    public function getUserGroupChat($username){
      $query = "SELECT `chat`.`idChat`, `chat`.`nomeChat`, `chat`.`descrizioneChat`, `chat`.`immagineGruppo` FROM `chat`, `partecipazione`, `utente` WHERE `chat`.`idChat`=`partecipazione`.`codChat` AND `partecipazione`.`codUtente` = `utente`.`idUtente` AND `utente`.`username` = ? AND `chat`.`nomeChat` != '' ";
      $stmt = $this->db->prepare($query);
      $stmt->bind_param('s',$username);
      $stmt->execute();
      $result = $stmt->get_result();

      return $result->fetch_all(MYSQLI_ASSOC);
    }

    /**
     * Restituisce tutte le chat singole di un determinato utente
     */
    public function getUserSingleChat($username){
      $query = "SELECT `chat`.`idChat`, `chat`.`nomeChat`, `chat`.`immagineGruppo` FROM `chat`, `partecipazione`, `utente` WHERE `chat`.`idChat`=`partecipazione`.`codChat` AND `partecipazione`.`codUtente` = `utente`.`idUtente` AND `utente`.`username` = ? AND `chat`.`nomeChat` == '' ";
      $stmt = $this->db->prepare($query);
      $stmt->bind_param('s',$username);
      $stmt->execute();
      $result = $stmt->get_result();

      return $result->fetch_all(MYSQLI_ASSOC);
    }

    /**
     * Mette like ad un post
     */
    public function setPostLiked($idUtente, $idPost){
    }

    /**
     * Ritorna tutti i post a cui l'utente ha messo like
     */
    public function getPostLiked($username){

    }

    /**
     * Salva un post
     */
    public function setPostSaved($idUtente, $idPost){
    }

    /**
     * Ritorna tutti i post salvati da un utente
     */
    public function getPostSaved($username){

    }

    /**
     *
     */
    public function searchUser($string){
      $query = "SELECT idUtente, username, nome FROM utente WHERE username LIKE %?%";
      $stmt = $this->db->prepare($query);
      $stmt->bind_param('s', $string);
      $stmt->execute();
      $result = $stmt->get_result();

      return $result->fetch_all(MYSQLI_ASSOC);
    }

    /**
     * Scrive un commento sotto un post
     */
    public function writeComment($idUtente, $idPost, $testo){
      $query = "INSERT INTO commento (`testo`, `codUtente`, `codPost`) VALUES (?, ?, ?)";
      $stmt = $this->db->prepare($query);
      $stmt->bind_param('sii',$testo, $idUtente, $idPost);
      $stmt->execute();

      return $stmt->insert_id;
    }

    /**
     * Controlla se il login è corretto
     */
    public function checkLogin($username, $password){
      $query = "SELECT idUtente, username, nome FROM utente WHERE username = ? AND password = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('ss',$username, $password);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    /**
     * Restituisce l'immagine profilo di un determinato utente
     */
    public function getUserProfileImg($idUtente){
      $query = "SELECT immagineProfilo FROM utente WHERE idUtente = ?";
      $stmt = $this->db->prepare($query);
      $stmt->bind_param('i',$idUtente);
      $stmt->execute();
      $result = $stmt->get_result();

      return $result->fetch_all(MYSQLI_ASSOC);
    }

    /**
     * Controlla se l'username inserito è già presente nel db
     */
    public function isUsernameUnique($username){
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

    /**
     * Controlla se l'username inserito è già presente nel db
     */
    public function isEmailUnique($mail){
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
