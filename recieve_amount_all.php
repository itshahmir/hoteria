<?php

include 'include/classes/session.php';
$id = $_GET['user'];
$database->recieve_amount_all($id);
header("Location: add_receiving_button.php");
?>