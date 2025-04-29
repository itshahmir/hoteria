<?php
include 'include/classes/session.php';
$id = $_GET['id'];
$q = "DELETE FROM inventory WHERE id = '$id'";
$database->query($q);
header("Location: view_inventory.php");
?>