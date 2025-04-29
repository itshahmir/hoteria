<?php

include 'include/classes/session.php';
$id = $_GET['id'];
$date = $_GET['date'];
$database->change_rec_st($id,$date);
header("Location: add_receiving_button.php");
?>