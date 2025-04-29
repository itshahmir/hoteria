<?php
include 'include/classes/session.php';
$id = $_GET['id'];
$q = "DELETE FROM expenses WHERE id = '$id'";
$database->query($q);
header("Location: ".$_SERVER['HTTP_REFERER']);
?>