<?php
//session_start();
define("UPLOAD_DIR_POST", "./upload/post/");
define("UPLOAD_DIR_PROFILE", "./upload/profile/");
define("UPLOAD_DIR_ICONS", "./upload/webpageIcons/");
require_once("utils/functions.php");
require_once("db/database.php");
sec_session_start();
$dbh = new DatabaseHelper("localhost", "root", "", "sharehub");
?>