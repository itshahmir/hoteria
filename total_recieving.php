<?php
include 'include/classes/session.php';
$id = $_GET['id'];
$rm_id = $_GET['rm'];
$date_in = $_GET['date_in'];
$total = $_GET['total'];
//$rm_id = $_GET['rm_id'];
 $date_out = date('Y-m-d', strtotime($date_in . ' +1 day'));
      $dates_from_user = $database->getDatesFromRange($date_in, $date_out);
      $checkin_array = $database->get_checkedin_bill($id);
      $rooms_id = $checkin_array[6];

      $array_rooms = $database->rm_rooms($rooms_id);
 
      $array_of_array = array();
      foreach ($array_rooms as $key => $value) {
         $number = $value[3];
         $name = $value[4];

         $query_where_condition = "SELECT * FROM `orders` WHERE (name = '$name' AND status = 1 AND room_number = '$number') AND";
         foreach ($dates_from_user as $index => $date) {
            if ($index == 0) {
               $query_where_condition .= "(date(date_a) = '$date'";
            } else {
               $query_where_condition .= " OR date(date_a) = '$date'";
            }
         }
         $query_where_condition .= ")";
          
         $array_of_array[$key] = mysqli_fetch_all(mysqli_query($database->connection, $query_where_condition));
      }
      $order_id = $array_of_array[$key][0][0];
      
      
       global $session;
      $username = $session->username;

      if ($session->userlevel == 8) {
         $st = 1;
      } else {
         $st = 0;
      }
      $date = date('Y-m-d');
   
      if ($total != 0) {

         $q = "INSERT INTO `receiving`(`checkin_id`, `username`, `type`, `amount`, `date`, `recieved_status`) VALUES ('$id','$username','Room','$total','$date','$st')";

         mysqli_query($database->connection, $q);
      } else {
         return 0;
      }
     $qc = "UPDATE checkin set advance = '$total' WHERE id = '$id'";
$database->query($qc);
$q = "DELETE FROM orders WHERE id = '$order_id'";
$database->query($q);
$q1 = "DELETE FROM order_menu WHERE order_id = '$order_id'";
$database->query($q1);
header("Location: ".$_SERVER['HTTP_REFERER']);
?>