<?php
require_once 'bootstrap.php';
if(!isset($_SESSION["username"])){
  header("location: login-opt.php");
}

$templateParams["notifications"] = $dbh->getNotifications($_SESSION["idUtente"]);
$templateParams["css"] = array("css/style.css");
$templateParams["js"] = array("https://unpkg.com/axios/dist/axios.min.js", "js/notifications.js");

require 'template/base.php';
?>