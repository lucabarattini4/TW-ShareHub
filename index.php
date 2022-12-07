<?php
require_once 'bootstrap.php';

if(!isset($_SESSION["username"])){
  header("location: login-opt.php");
}
$templateParams["nome"] = "lista-post.php";
$templateParams["post"] = $dbh->getPosts();
$templateParams["css"] = array("css/style.css");
$templateParams["js"] = array("script/comment-section.js");
 

require 'template/base.php';
?>
