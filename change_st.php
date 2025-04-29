<?php
include 'include/classes/session.php';
$id = $_GET['id'];

$database->change_checkin_status_clean($id);
header("Location: index.php");
?>