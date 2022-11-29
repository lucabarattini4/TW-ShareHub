<?php
class DatabaseHelper{
    private $db;

    public function __construct($servername, $username, $password, $dbname){
      $this->db = new mysqli($servername, $username, $password, $dbname);
      if ($this->db->connect_error) {
        die("Connection failed: " . $db->connect_error);
      }        
    }

    public function getPosts($n=-1){
      $query = "SELECT idPost, username, testo, immagine, immagineProfilo, descImmagine FROM post, utente WHERE idUtente=codUtente ORDER BY dataPost DESC";
        if($n > 0){
            $query .= " LIMIT ?";
        }
        $stmt = $this->db->prepare($query);
        if($n > 0){
            $stmt->bind_param('i',$n);
        }
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }
}
?>