<?php
require_once 'bootstrap.php';

if(isset($_POST["logout"])){
  sec_session_destroy();
}

header('Content-Type: application/json');
echo json_encode($result);
?>