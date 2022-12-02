<?php
require_once 'bootstrap.php';

if(!isset($_SESSION["username"])){
  header("location: login-opt.php");
}
$templateParams["nome"] = "lista-post.php";
$templateParams["post"] = $dbh->getPosts();


require 'template/base.php';
?>
