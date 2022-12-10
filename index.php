<?php
require_once 'bootstrap.php';

if(!isset($_SESSION["username"])){
  header("location: login-opt.php");
}
$templateParams["nome"] = "lista-post.php";
$templateParams["post"] = $dbh->getPosts();
$templateParams["css"] = array("css/style.css");
$templateParams["js"] = array("js/comment-section.js", "https://unpkg.com/axios/dist/axios.min.js", "js/like.js", "js/save.js", "js/comment.js");
 

require 'template/base.php';
?>
