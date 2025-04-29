<?php
include 'include/classes/session.php';
$date = $_GET['date'];
if($_GET['expense'] == 0){
	echo $database->getDailyExpense($date);
} else {
	echo $database->getDailyIncome($date);
}
?>
