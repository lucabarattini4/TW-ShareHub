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
    public function getPosts($n=-1){
      $query = "SELECT idPost, username, testo, immagine, immagineProfilo, descImmagine, dataPost FROM post, utente WHERE idUtente=codUtente ORDER BY RAND() DESC";
      if($n > 0){
        $query .= " LIMIT ?";
      }
      $stmt = $this->db->prepare($query);
      if($n > 0){
        $stmt->bind_param('i', $n);
      }
      $stmt->execute();
      $result = $stmt->get_result();

      return $result->fetch_all(MYSQLI_ASSOC);
    }

    /**
     * Restituisce tutti i msg di una chat
     */
    public function getMsg($idChat){
      $query = "SELECT idMessaggio, testo, immagine, altroFile, dataMessaggio, codChat, codUtente FROM messaggio WHERE codChat = ? ";
      $stmt = $this->db->prepare($query);
      $stmt->bind_param('i', $idChat);
      $stmt->execute();
      $result = $stmt->get_result();

      return $result->fetch_all(MYSQLI_ASSOC);
    }

    /**
     * Restituisce un post dato l'id
     */
    public function getPostById($idPost){
      $query = "SELECT idPost, username, testo, immagine, immagineProfilo, descImmagine, dataPost FROM post, utente WHERE idUtente=codUtente AND idPost=?";
      $stmt = $this->db->prepare($query);
      $stmt->bind_param('i', $idPost);
      $stmt->execute();
      $result = $stmt->get_result();

      return $result->fetch_all(MYSQLI_ASSOC);
    }

    /**
     * 
     */
    public function getUserIdFromIdPost($idPost){
      $query = "SELECT codUtente FROM post WHERE idPost = ? LIMIT 1";
      $stmt = $this->db->prepare($query);
      $stmt->bind_param('i', $idPost);
      $stmt->execute();
      $result = $stmt->get_result();
      $row = $result->fetch_assoc();
      return $row['codUtente'];
    }

    public function getUsernameFromId($idUser){
      $query = "SELECT username FROM utente WHERE idUtente = ?";
      $stmt = $this->db->prepare($query);
      $stmt->bind_param('i', $idUser);
      $stmt->execute();
      $result = $stmt->get_result();
      $row = $result->fetch_assoc();
      return $row['username'];
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
      $password = password_hash($password, PASSWORD_DEFAULT);
      $stmt->bind_param('ssssssssss',$nome, $cognome, $dataNascita, $sesso, $prefissoTelefonico, $numeroTelefono, $email, $username, $password, $immagineProfilo);
      $stmt->execute();

      return $stmt->insert_id;
    }

    /**
     * Controlla l'esistenza di un username
     */
    public function checkUsernameExistence($username){
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
    public function getUserSingleChat($idUtente){
      $query = "SELECT `partecipazione`.`codChat`, `utente`.`idUtente`, `utente`.`immagineProfilo`, `utente`.`username`  FROM `partecipazione`, `utente`, `chat` WHERE `partecipazione`.`codUtente`=`utente`.`idUtente` AND `utente`.`idUtente` != ? AND `partecipazione`.`codChat`=`chat`.`idChat` AND `partecipazione`.`codChat`= ANY (SELECT `partecipazione`.`codChat` FROM `partecipazione`, `chat` WHERE `chat`.`idChat`=`partecipazione`.`codChat` AND `chat`.`nomeChat` = '' AND `partecipazione`.`codUtente` = ?)";
      $stmt = $this->db->prepare($query);
      $stmt->bind_param('ii', $idUtente, $idUtente);
      $stmt->execute();
      $result = $stmt->get_result();

      return $result->fetch_all(MYSQLI_ASSOC);
    }

    /**
     *
     */
    private function likesaveRowExist($idUtente, $idPost){
      $query = "SELECT `likesave`.`codUtente` FROM `likesave` WHERE `likesave`.`codUtente`=? AND `likesave`.`codPost`=?";
      $stmt = $this->db->prepare($query);
      $stmt->bind_param('ii', $idUtente, $idPost);
      $stmt->execute();
      $result = $stmt->get_result();
      if(mysqli_num_rows($result)){
        return true;
      }
      return false;
    }

    /**
     *
     */
    public function isPostLiked($idUtente, $idPost){
      $query = "SELECT `likesave`.`like` FROM `likesave` WHERE `likesave`.`like` = ? AND `likesave`.`codPost` = ? AND `likesave`.`codUtente`=?";
      $stmt = $this->db->prepare($query);
      $value = 1;
      $stmt->bind_param('iii', $value, $idPost, $idUtente);
      $stmt->execute();
      $result = $stmt->get_result();
      if(mysqli_num_rows($result)){
        return true;
      }
      return false;
    }

    /**
     * Mette like ad un post
     */
    public function setPostLiked($idUtente, $idPost){
      $liked = $this->isPostLiked($idUtente, $idPost);
      if($liked){
        $query1 = "UPDATE `likesave` SET `like` = ? WHERE `codPost`=? AND `codUtente`=?";
        $stmt = $this->db->prepare($query1);
        $value = 0;
        $stmt->bind_param('iii', $value, $idPost, $idUtente);
        $stmt->execute();
      }else{
        //update
        if($this->likesaveRowExist($idUtente, $idPost) && !$liked){
          $query2 = "UPDATE `likesave` SET `like` = 1 WHERE `codPost`=? AND `codUtente`=?";
          $stmt = $this->db->prepare($query2);
          $stmt->bind_param('ii', $idPost, $idUtente);
          $stmt->execute();
        }else{
          //insert
          $query3 = "INSERT INTO `likesave` (`codUtente`, `codPost`, `like`) VALUES (?, ?, ?)";
          $stmt = $this->db->prepare($query3);
          $value = 1;
          $stmt->bind_param('iii', $idUtente, $idPost, $value);
          $stmt->execute();
        }
      }
    }

    /**
     * Ritorna tutti i post a cui l'utente ha messo like
     */
    public function getPostLiked($idUtente){
      $query = "SELECT `likesave`.`codPost` FROM `likesave` WHERE `likesave`.`codUtente` = ? AND `likesave`.`like`=?";
      $stmt = $this->db->prepare($query);
      $stmt->bind_param('ii', $idUtente, 1);
      $stmt->execute();
      $result = $stmt->get_result();

      return $result->fetch_all(MYSQLI_ASSOC);
    }

    /**
     *
     */
    public function isPostSaved($idUtente, $idPost){
      $query = "SELECT `likesave`.`save` FROM `likesave` WHERE `likesave`.`save` = ? AND `likesave`.`codPost` = ? AND `likesave`.`codUtente`=?";
      $stmt = $this->db->prepare($query);
      $value = 1;
      $stmt->bind_param('iii', $value, $idPost, $idUtente);
      $stmt->execute();
      $result = $stmt->get_result();
      if(mysqli_num_rows($result)){
        return true;
      }
      return false;
    }

    /**
     * Salva un post
     */
    public function setPostSaved($idUtente, $idPost){
      $saved = $this->isPostSaved($idUtente, $idPost);
      if($saved){
        $query1 = "UPDATE `likesave` SET `save` = ? WHERE `codPost`=? AND `codUtente`=?";
        $stmt = $this->db->prepare($query1);
        $value = 0;
        $stmt->bind_param('iii', $value, $idPost, $idUtente);
        $stmt->execute();
      }else{
        //update
        if($this->likesaveRowExist($idUtente, $idPost) && !$saved){
          $query2 = "UPDATE `likesave` SET `save` = 1 WHERE `codPost`=? AND `codUtente`=?";
          $stmt = $this->db->prepare($query2);
          $stmt->bind_param('ii', $idPost, $idUtente);
          $stmt->execute();
        }else{
          //insert
          $query3 = "INSERT INTO `likesave` (`codUtente`, `codPost`, `save`) VALUES (?, ?, ?)";
          $stmt = $this->db->prepare($query3);
          $value = 1;
          $stmt->bind_param('iii', $idUtente, $idPost, $value);
          $stmt->execute();
        }

      }
    }

    /**
     * Ritorna tutti i post salvati da un utente
     */
    public function getPostSaved($username){
      $query = "SELECT `likesave`.`codPost` FROM `likesave` WHERE `likesave`.`codUtente` = ? AND `likesave`.`save`=?";
      $stmt = $this->db->prepare($query);
      $stmt->bind_param('ii', $idUtente, 1);
      $stmt->execute();
      $result = $stmt->get_result();

      return $result->fetch_all(MYSQLI_ASSOC);
    }

    /**
     *
     */
    public function searchUser($string){
      $query = "SELECT idUtente, username, immagineProfilo FROM utente WHERE username LIKE CONCAT(?,'%')";
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

    public function verifyPassword($username, $password){
      $query = "SELECT `password` FROM `utente` WHERE `username` = ? LIMIT 1";
      $stmt = $this->db->prepare($query);
      $stmt->bind_param('s', $username);
      $stmt->execute();
      $stmt->bind_result($hash);
      while ($stmt->fetch()) {
        return password_verify($password, $hash);
      }
    }

    /**
     * Controlla se il login è corretto
     */
    public function checkLogin($username, $password){
      if($this->verifyPassword($username, $password)){
        $query = "SELECT `idUtente`, `username`, `nome` FROM `utente` WHERE `username` = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('s',$username);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
      }else{
        return array();
      }

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

    /**
     * Controlla se l'utente $username ha il profilo pubblico
     */
    public function isUserProfilePublic($username){
      $query = "SELECT `impostazione`.`idImpostazione`
      FROM `impostazione`, `utente`
      WHERE `utente`.`idUtente` = `impostazione`.`codUtente` AND `impostazione`.`privato` = ? AND `utente`.`username` = ?";
      $stmt = $this->db->prepare($query);
      $stmt->bind_param('is', 0, $username);
      $stmt->execute();
      $result = $stmt->get_result();
      if(mysqli_num_rows($result)){
        return true;
      }
      return false;
    }

    /**
     * Controlla se l'utente registrato in sessione ha come amico $idUtente
     */
<<<<<<< HEAD
    public function isUserFriend($idFriend, $idUser){
      $query = "SELECT `amicizia`.`codFollowed`, `amicizia`.`codFollower`, `amicizia`.`dataAmicizia`, `amicizia`.`accettata`
      FROM `amicizia`
      WHERE `amicizia`.`codFollowed` = ? AND `amicizia`.`codFollower` = ? AND `amicizia`.`accettata` = ?";
      $stmt = $this->db->prepare($query);
      $stmt->bind_param('iii', $idFriend, $idUser, 1);
      $stmt->execute();
      if(mysqli_num_rows($result)){
        $query2 = "SELECT `amicizia`.`codFollowed`, `amicizia`.`codFollower`, `amicizia`.`dataAmicizia`, `amicizia`.`accettata` 
        FROM `amicizia` 
        WHERE `amicizia`.`codFollowed` = ? AND `amicizia`.`codFollower` = ? AND `amicizia`.`accettata` = ?";
        $stmt = $this->db->prepare($query2);
        $stmt->bind_param('iii', $idUser, $idFriend, 1);
        $stmt->execute();
        if(mysqli_num_rows($result)){
          return true;
        }
        return false;
      }
      return false;
    }

    /**
     * Restituisce tutte le richieste di amicizia
     */
    public function getFriendRequests($idUser){
      $query = "SELECT `amicizia`.`codFollower`, `amicizia`.`accettata`, `utente`.`username`
      FROM `amicizia`, `utente`
      WHERE `amicizia`.`codFollower` = `utente`.`idUtente` AND `amicizia`.`codFollowed` = ? AND `amicizia`.`accettata` = ?";
      $stmt = $this->db->prepare($query);
      $stmt->bind_param('ii', $idUser, 0);
      $stmt->execute();
      $result = $stmt->get_result();
      return $result->fetch_all(MYSQLI_ASSOC);
    }
        
=======
    public function isUserFriend($idUtente){}

>>>>>>> 8bf2a317104f9813f0cb83b7276765897020899a
    /**
     * Restituisce gli amici di un utente
     */
    public function getFriends($username){}

    /**
     * Restituisce tutti i followers
     */
    public function getFollowers($idUtente){}

    /**
     * Restituisce tutta la gente seguita dall'utente
     */
    public function getFollowed($idUtente){}

    /**
     * Manda una richiesta di follow o inizia a seguire un profilo
     */
    public function follow($username){
      
    }

    /**
     * Controlla se l'utente ha ricevuto nuove notifiche
     */
    public function hasNotifications($idUtente){
      $query = "SELECT `notifica`.`idNotifica`
      FROM `notifica`
      WHERE `notifica`.`codUtenteDestinatario` = ? AND `notifica`.`presaVisione` = ?";
      $stmt = $this->db->prepare($query);
      $stmt->bind_param('ii', $idUtente, 0);
      $stmt->execute();
      $result = $stmt->get_result();
      if(mysqli_num_rows($result)){
        return true;
      }
      return false;
    }

    /**
     * Restituisce tutte le notifiche di un utente
     */
    public function getNotifications($idUtente){
      $query = "SELECT `notifica`.`idNotifica`, `notifica`.`descrizioneNotifica`, `notifica`.`dataNotifica`, `notifica`.`codUtenteMittente`, `utente`.`username`
      FROM `notifica`, `utente`
      WHERE `notifica`.`codUtenteMittente` = `utente`.`idUtente` AND `notifica`.`codUtenteDestinatario` = ? ORDER BY `notifica`.`presaVisione` DESC, `notifica`.`dataNotifica` DESC";
      $stmt = $this->db->prepare($query);
      $stmt->bind_param('i', $idUtente);
      $stmt->execute();
      $result = $stmt->get_result();
      return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function sendNotification($idUtenteDestinatario, $testo, $codMittente=-1){
      if($codMittente > 0){
        $query = "INSERT INTO `notifica` (`descrizioneNotifica`, codUtenteDestinatario, `CodUtenteMittente`) VALUES (?, ?, ?)";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('sii', $testo, $idUtenteDestinatario, $codMittente);
        $stmt->execute();
        return $stmt->insert_id;
      }else{
        $query2 = "INSERT INTO `notifica` (`descrizioneNotifica`, codUtenteDestinatario) VALUES (?, ?)";
        $stmt = $this->db->prepare($query2);
        $stmt->bind_param('si', $testo, $idUtenteDestinatario);
        $stmt->execute();
        return $stmt->insert_id;
      }
    }

}
?>
