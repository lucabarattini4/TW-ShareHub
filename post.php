<?php
require_once 'bootstrap.php';

if(!isset($_SESSION["username"])){
  header("location: login-opt.php");
}

$templateParams["css"] = array("css/style.css");
$templateParams["js"] = array("https://unpkg.com/axios/dist/axios.min.js","js/like.js", "js/save.js", "js/comment.js", "js/single-post.js");

require 'template/base.php';