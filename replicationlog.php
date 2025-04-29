<?php
include("include/classes/database.php");

 $q = "SELECT * FROM `reservations`";
 $rse = $database->query($q);
      $row = mysqli_fetch_all($rse);
      // var_dump($row);
      foreach ($row as $key => $value) {
      	var_dump($value);
      	echo "<br><br>";
          $database->groupdata("get_reserved_list", "", "", "", "");
      }

?>