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

    public function getPosts($arr, $idUtente){
      $ids = $this->getFollowed($idUtente);
      $idarr = array();
      array_push($idarr, $idUtente);
      for($i = 0; $i < count($ids); $i++){
        array_push($idarr, $ids[$i]["codFollowed"]);
      }

      $in2  = str_repeat('?,', count($arr) - 1) . '?';
      $in = str_repeat('?,', count($idarr) -1). '?';
      $query = "SELECT idPost, idUtente, username, testo, immagine, immagineProfilo, descImmagine, dataPost FROM post, utente WHERE idUtente=codUtente AND idPost NOT IN ($in2) AND idUtente IN ($in) ORDER BY RAND() LIMIT 3";


      $stmt = $this->db->prepare($query);
      $types = str_repeat('i', count($arr));
      $types .= str_repeat('i', count($idarr));
      $stmt->bind_param($types, ...$arr, ...$idarr);

      $stmt->execute();
      $result = $stmt->get_result();

      return $result->fetch_all(MYSQLI_ASSOC);
    }

    /**
     * Restituisce tutti i post di un utente
     */
    public function getUserPosts($username, $arr){
      if($this->checkUsernameExistence($username)){
        $in  = str_repeat('?,', count($arr) - 1) . '?';
        $query = "SELECT idPost, idUtente, username, testo, immagine, immagineProfilo, descImmagine, dataPost FROM post, utente WHERE idUtente=codUtente AND username = ? AND idPost NOT IN ($in) ORDER BY dataPost DESC";
        $stmt = $this->db->prepare($query);
        $types = 's';
        $types .= str_repeat('i', count($arr));
        $stmt->bind_param($types, $username, ...$arr);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
      }
      return 0;
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

    public function getIdFromUsername($username){
      $query = "SELECT idUtente FROM utente WHERE username = ? LIMIT 1";
      $stmt = $this->db->prepare($query);
      $stmt->bind_param('s', $username);
      $stmt->execute();
      $result = $stmt->get_result();
      $row = $result->fetch_assoc();
      return $row['idUtente'];
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
    public function insertPostWithImg($testoPost, $imgPost, $descrizioneImmagine, $codUtente){
      $query = "INSERT INTO post (testo, immagine, descImmagine, codUtente) VALUES (?, ?, ?, ?)";
      $stmt = $this->db->prepare($query);
      $stmt->bind_param('sssi',$testoPost, $imgPost, $descrizioneImmagine, $codUtente);
      $stmt->execute();

      return $stmt->insert_id;
    }

    /**
     * Inserisce un post senza immagine
     * @param string $testoPost testo del post
     * @param string $dataPost data del post
     * @param int $codUtente utente autore del post
     */
    public function insertPostSimple($testoPost, $codUtente){
      $query = "INSERT INTO post (testo, codUtente) VALUES (?, ?)";
      $stmt = $this->db->prepare($query);
      $stmt->bind_param('si',$testoPost, $codUtente);
      $stmt->execute();

      return $stmt->insert_id;
    }


    public function deletePost($idPost){
      $query = "DELETE FROM `post` WHERE `idPost`=?";
      $stmt = $this->db->prepare($query);
      $stmt->bind_param('i', $idPost);
      $stmt->execute();
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
     * Controlla l'esistenza di un id
     */
    public function checkUsernameIdExistence($username){
      $query = "SELECT `utente`.`nome`, `utente`.`cognome`
      FROM `utente`
      WHERE `utente`.`idUtente` = ?";
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
     * Ritorna le info di un utente
     */
    public function getUserInfo($username){
      if($this->checkUsernameExistence($username)){
        $query = "SELECT idUtente, username, immagineProfilo FROM utente WHERE username = ?";
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
     * Restituisce id di una chat
     */
    public function getIdChatMessages($User,$UserFriend){
      $idFriend = $this->getIdFromUsername($UserFriend);



      $query = "SELECT `idChat`  FROM `partecipazione`as p1, `partecipazione`as p2, `chat`  WHERE `p1`.`codChat` = `p2`.`codChat` AND `p1`.`codChat` = `idChat` AND `p1`.`codUtente`=? AND p2.codUtente=? AND nomeChat IS NULL";
      $stmt = $this->db->prepare($query);
      $stmt->bind_param('ii',$User,$idFriend);
      $stmt->execute();
      $result = $stmt->get_result();
      return $result->fetch_all(MYSQLI_ASSOC);

    }



    /**
     * Restituisce tutte le chat singole di un determinato utente
     */
    public function getUserSingleChat($idUtente){
      $query = "SELECT `partecipazione`.`codChat`, `utente`.`idUtente`, `utente`.`immagineProfilo`, `utente`.`username`  FROM `partecipazione`, `utente`, `chat` WHERE `partecipazione`.`codUtente`=`utente`.`idUtente` AND `utente`.`idUtente` != ? AND `partecipazione`.`codChat`=`chat`.`idChat` AND `partecipazione`.`codChat`= ANY (SELECT `partecipazione`.`codChat` FROM `partecipazione`, `chat` WHERE `chat`.`idChat`=`partecipazione`.`codChat` AND `chat`.`nomeChat` IS NULL AND `partecipazione`.`codUtente` = ?) GROUP BY idUtente";
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
     * Restituisce  gli amici
     */
    public function getUsersFollowed($idUtente){
      $query = "SELECT idUtente,username,immagineProfilo FROM utente WHERE idUtente IN (SELECT codFollower FROM amicizia WHERE codFollowed=?  )";
      $stmt = $this->db->prepare($query);
      $stmt->bind_param('i', $idUtente);
      $stmt->execute();
      $result = $stmt->get_result();

      return $result->fetch_all(MYSQLI_ASSOC);
    }
    /**
     * Restituisce  gli amici
     */
    public function getUsersFollower($idUtente){
      $query = "SELECT idUtente,username,immagineProfilo FROM utente WHERE idUtente IN (SELECT codFollowed FROM amicizia WHERE codFollower=?  )";
      $stmt = $this->db->prepare($query);
      $stmt->bind_param('i', $idUtente);
      $stmt->execute();
      $result = $stmt->get_result();

      return $result->fetch_all(MYSQLI_ASSOC);
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

    /**
     * Restituisce gli amici di un utente
     */
    public function getFriends($username){}

    /**
     * Restituisce tutti i followers
     */
    public function getFollowers($idUtente){
      $query = "SELECT `amicizia`.`codFollower`, `utente`.`username`
      FROM `amicizia`, `utente`
      WHERE `amicizia`.`codFollower` = `utente`.`idUtente` AND `amicizia`.`codFollowed` = ?";
      $stmt = $this->db->prepare($query);
      $stmt->bind_param('i', $idUtente);
      $stmt->execute();
      $result = $stmt->get_result();
      return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function countFollowers($idUtente){
      return count($this->getFollowers($idUtente));
    }

    /**
     * Restituisce tutta la gente seguita dall'utente
     */
    public function getFollowed($idUtente){
      $query = "SELECT `amicizia`.`codFollowed`, `utente`.`username`
      FROM `amicizia`, `utente`
      WHERE `amicizia`.`codFollowed` = `utente`.`idUtente` AND `amicizia`.`codFollower` = ?";
      $stmt = $this->db->prepare($query);
      $stmt->bind_param('i', $idUtente);
      $stmt->execute();
      $result = $stmt->get_result();
      return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function countFollowed($idUtente){
      return count($this->getFollowed($idUtente));
    }

    public function getFollowedIds($idUtente){
      $query = "SELECT `amicizia`.`codFollowed`
      FROM `amicizia`, `utente`
      WHERE `amicizia`.`codFollowed` = `utente`.`idUtente` AND `amicizia`.`codFollower` = ?";
      $stmt = $this->db->prepare($query);
      $stmt->bind_param('i', $idUtente);
      $stmt->execute();
      $result = $stmt->get_result();
      $row = $result->fetch_assoc();
      return $row['codFollowed'];
    }

    /**
     * Manda una richiesta di follow o inizia a seguire un profilo
     */
    public function follow($usernameFollowed, $usernameFollower){
      $followed = $this->getIdFromUsername($usernameFollowed);
      $follower = $this->getIdFromUsername($usernameFollower);
      $follow = $this->isUserFollowed($usernameFollowed, $usernameFollower);
      if($follow){
        $query = "DELETE FROM `amicizia` WHERE `codFollowed`=? AND `codFollower`=?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('ii',$followed, $follower);
        $stmt->execute();
        return $stmt->insert_id;
      }else{
        $query2 = "INSERT INTO amicizia (`codFollowed`, `codFollower`, `dataAmicizia`, `accettata`) VALUES (?, ?, ?, ?)";
        $accettata = 1;
        $data = date("Y-m-d");
        $stmt = $this->db->prepare($query2);
        $stmt->bind_param('iisi',$followed, $follower, $data, $accettata);
        $stmt->execute();
        return $stmt->insert_id;
      }
    }

    public function followShareHub($idUtente){
      $shareHubUser = "ShareHub";
      $shareHubId = $this->getIdFromUsername($shareHubUser);
      $user = $this->getUsernameFromId($idUtente);
      $follow = $this->isUserFollowed($shareHubUser, $user);
      if(!$follow){
        $query2 = "INSERT INTO amicizia (`codFollowed`, `codFollower`, `dataAmicizia`, `accettata`) VALUES (?, ?, ?, ?)";
        $accettata = 1;
        $data = date("Y-m-d");
        $stmt = $this->db->prepare($query2);
        $stmt->bind_param('iisi',$shareHubId, $idUtente, $data, $accettata);
        $stmt->execute();
        return $stmt->insert_id;
      }
      return 0;
    }

    public function isUserFollowed($usernameFollowed, $usernameFollower){
      $query2 = "SELECT `amicizia`.`dataAmicizia`
      FROM `amicizia`
      WHERE `amicizia`.`codFollowed` = ? AND `amicizia`.`codFollower` = ? AND `amicizia`.`accettata` = ?";
      $followed = $this->getIdFromUsername($usernameFollowed);
      $follower = $this->getIdFromUsername($usernameFollower);
      $accettata = 1;
      $stmt = $this->db->prepare($query2);
      $stmt->bind_param('iii', $followed, $follower, $accettata);
      $stmt->execute();
      $result = $stmt->get_result();
      if($result->num_rows > 0){
        return true;
      }
      return false;
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
     *
     */
    public function getNewNotificationsNumber($idUtente){
      $query = "SELECT `notifica`.`idNotifica` FROM `notifica` WHERE `notifica`.`presaVisione` = 0 AND `notifica`.`codUtenteDestinatario` = ?";
      $stmt = $this->db->prepare($query);
      $stmt->bind_param('i', $idUtente);
      $stmt->execute();
      $result = $stmt->get_result();
      $rowcount = mysqli_num_rows($result);
      return $rowcount;
    }

    /**
     * Restituisce tutte le notifiche di un utente
     */
    public function getNotifications($idUtente){
      $query = "SELECT `notifica`.`idNotifica`, `notifica`.`descrizioneNotifica`, `notifica`.`dataNotifica`, `notifica`.`codUtenteMittente`, `utente`.`username`, `notifica`.`presaVisione`
      FROM `notifica`, `utente`
      WHERE `notifica`.`codUtenteMittente` = `utente`.`idUtente` AND `notifica`.`codUtenteDestinatario` = ? ORDER BY `notifica`.`presaVisione` ASC, `notifica`.`dataNotifica` DESC";
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

    public function getNotificationStatus($idNotifica){
      $query = "SELECT `notifica`.`presaVisione`
      FROM `notifica`
      WHERE `notifica`.`idNotifica` = ?";
      $stmt = $this->db->prepare($query);
      $stmt->bind_param('i', $idNotifica);
      $stmt->execute();
      $result = $stmt->get_result();
      $row = $result->fetch_assoc();
      return $row['presaVisione'];

    }

    public function changeNotificationStatus($idNotifica){

      if($this->getNotificationStatus($idNotifica) == 1){
        $val = 0;
      }else{
        $val = 1;
      }
      //setNotificationAsRead
      $query2 = "UPDATE `notifica` SET `presaVisione` = ? WHERE `idNotifica`=?";
      $stmt = $this->db->prepare($query2);
      $stmt->bind_param('ii', $val, $idNotifica);
      $stmt->execute();

      return $this->getNotificationStatus($idNotifica);
    }

    /**
     * crea chat
     */
    public function createChat(){
      $query = "INSERT INTO chat VALUES ()";
      $stmt = $this->db->prepare($query);

      $stmt->execute();

      return $stmt->insert_id;
    }

    /**
     * crea partecipazione
     */
    public function LinkChat($idChat,$idUser){
      $query = "INSERT INTO partecipazione (`codChat`, `codUtente`) VALUES (?, ?)";
      $stmt = $this->db->prepare($query);
      $stmt->bind_param('ii', $idChat,$idUser);
      $stmt->execute();

      return $stmt->insert_id;
    }

    /**
     * Scrive un messaggio in chat
     */
    public function writeMessage($idUtente, $idChat, $testo){
      $query = "INSERT INTO messaggio (`testo`, `codChat`, `codUtente`) VALUES (?, ?, ?)";
      $stmt = $this->db->prepare($query);
      $stmt->bind_param('sii',$testo, $idChat, $idUtente);
      $stmt->execute();

      return $stmt->insert_id;
    }



}
?>
