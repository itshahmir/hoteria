<?php
include 'include/classes/session.php';

$database->change_checkin_status($_GET['id'],$_GET['name'], $_GET['number']);
header("location: viewcheckin.php");
?>