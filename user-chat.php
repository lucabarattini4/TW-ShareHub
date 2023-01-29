<?php
require_once 'bootstrap.php';

if(!isset($_SESSION["username"])){
  header("location: login-opt.php");
}
$cookie_name = "user";
$cookie_value = $_POST["user"];
setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/");
$cookie_name = "id";
$cookie_value = $_SESSION["idUtente"];
setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/");

$templateParams["js"] = array("https://unpkg.com/axios/dist/axios.min.js","js/chat.js", "js/notifications.js");
$templateParams["css"] = array("css/style.css","css/chat.css");


require 'template/base.php';
?>
