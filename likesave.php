<?php
require_once 'bootstrap.php';

if (isset($_GET['like'])){
  $dbh->setPostliked($_SESSION["idUtente"], $_GET["post"]);
} 
if (isset($_GET['save'])){
  $dbh->setPostSaved($_SESSION["idUtente"], $_GET["post"]);
}
header("location: index.php#post".$_GET['post']);
?>