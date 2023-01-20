<?php
require_once 'bootstrap.php';

$result["notifications"] = $dbh->getNotifications($_SESSION["idUtente"]);
$result["newNotificationsNumber"] = $dbh->getNewNotificationsNumber($_SESSION["idUtente"]);

if(isset($_POST["idNotifica"])){
  $result["seen"] = $dbh->changeNotificationStatus($_POST["idNotifica"]);
}

header('Content-Type: application/json');
echo json_encode($result);
?>