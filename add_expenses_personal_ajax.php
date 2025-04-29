<?php 
include 'include/classes/session.php';
$date = $_GET['date'];
$details = $_GET['details'];
$amount = $_GET['amount'];
$q = "INSERT INTO `personal_expenses`(`id`,`details`,`date`,`amount`,`user_id`) VALUES ('','$details','$date','$amount','$session->userid')";
$database->query($q);
header("Location: expensesheet.php");
 ?>