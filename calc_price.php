
<?php include 'include/classes/session.php';
echo json_encode($database->get_rate($_POST['room']));



?>
