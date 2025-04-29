<?php
include 'include/classes/session.php';
$array = $database->select_room($_GET['name']);
header('Content-Type: application/json');
echo json_encode($array);
?>