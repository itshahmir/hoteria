<?php
include 'include/classes/session.php';
$date = date('Y-m-d');
$q = "UPDATE billing_date SET currentdate = '$date' WHERE id = '1'";
$database->query($q);
header("Location: expensesheet.php")
?>