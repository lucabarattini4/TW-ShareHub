<?php
require_once 'bootstrap.php';

if(!isset($_SESSION["username"])){
  header("location: login-opt.php");
}

$cookie_name = "id";
$cookie_value = $_SESSION["idUtente"];
setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/");
$templateParams["nome"] = "lista-amici-chat.php";
$templateParams["friends"] = $dbh->getUsersFollower($_SESSION["idUtente"]);
$templateParams["friends2"] = $dbh->getUsersFollowed($_SESSION["idUtente"]);
$templateParams["css"] = array("css/style.css");


require 'template/base.php';
?>
