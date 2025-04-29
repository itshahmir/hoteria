<?php

error_reporting(0);
include("constants.php");

class MySQLDB
{
   var $connection;
   var $num_active_users;
   var $num_active_guests;
   var $num_members;

   function __construct()
   {
      date_default_timezone_set('Asia/Karachi');
      $this->connection = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME) or die('Connect Error (' . mysqli_connect_errno() . ') ' . mysqli_connect_error());

      $this->num_members = -1;

      if (TRACK_VISITORS) {

         $this->calcNumActiveUsers();

         $this->calcNumActiveGuests();
      }
   }

   function confirmUserPass($username, $password)
   {

      $username = str_replace('&lt;', "~", str_replace('<', "~&gt;", strip_tags(mysqli_real_escape_string($this->connection, $username))));

      $q = "SELECT password FROM " . TBL_USERS . " WHERE username = '$username'";
      $result = mysqli_query($this->connection, $q);
      if (!$result || (mysqli_num_rows($result) < 1)) {
         return 1;
      }

      $dbarray = mysqli_fetch_array($result);
      $dbarray['password'] = stripslashes($dbarray['password']);
      $password = stripslashes($password);

      if ($password == $dbarray['password']) {
         return 0;
      } else {
         return 2;
      }
   }

   function add_employees($name, $cnic, $number_n, $base_salary, $hiring_date, $pay_date, $filename1, $filename2)
   {
      $q = "INSERT INTO `add_employees`(`name`, `cnic`, `phone_no`, `base_salary`, `hiring_date`, `pay_date`, `emp_pic`, `agreement`) 
      VALUES ('$name','$cnic','$number_n','$base_salary','$hiring_date','$pay_date','$filename1','$filename2')";
      
      return mysqli_query($this->connection, $q);
   }

   function edit_employees($id, $name, $cnic, $number_n, $base_salary, $hiring_date, $pay_date, $filename1, $filename2)
   {
      $q = "UPDATE `add_employees` SET `name`='$name',`cnic`='$cnic',`phone_no`='$number_n',`base_salary`='$base_salary',`hiring_date`='$hiring_date',`pay_date`='$pay_date',`emp_pic`='$filename1',`agreement`='$filename2' WHERE id = '$id'";
      return mysqli_query($this->connection, $q);
   }

   function add_cutting($id, $amount)
   {
      $date = date('m-Y');
      $q = "INSERT INTO `add_cutting`(`emp_id`, `month`, `amount`) VALUES ('$id','$date','$amount')";
      return mysqli_query($this->connection, $q);
   }

    function add_cutting_next($id, $amount, $date)
   {
      
      $q = "INSERT INTO `add_cutting`(`emp_id`, `month`, `amount`) VALUES ('$id','$date','$amount')";
      return mysqli_query($this->connection, $q);
   }
   function employees_dateDetails($date,$id,$pay)
   {
      global $session;
      $emp_id = $id;
      
      $myYearMonth = $date;
      
      $year = date('Y', strtotime($myYearMonth));
      $month = date('m', strtotime($myYearMonth));
      $total_days= cal_days_in_month(CAL_GREGORIAN,$month,$year);
      //
      $total = 0;
      $total_advance=0;
     $per_day_salary=$pay/$total_days;
     $day_salary = number_format($per_day_salary);
$start = new DateTime(date('Y-m-01', strtotime($myYearMonth)));
$end = new DateTime(date('Y-m-t', strtotime($myYearMonth)));

$diff = DateInterval::createFromDateString('1 day');
$periodStart = new DatePeriod($start, $diff, $end);

$i=0;

for($j=0;$j<$total_days;$j++){
 $i++;


   $total=$total + $per_day_salary;
   $date = $start->format( "d-m-Y" );

   $q = "SELECT * FROM `employee_date_details` WHERE `emp_id` = '$emp_id' AND date = '$date'";
   $query = mysqli_query($this->connection, $q);

   $row = mysqli_fetch_array($query);
   $advance = $row['advance'];
   $total_advance=$total_advance + $advance;
   $new_total = $total -$total_advance ;
   $color = "#fff";
  if($row['leave_emp']>0){
   $color = "yellow";
  }
  $color1 = "#fff";
  if($row['advance']>0){
   $color1 = "#FCA56C";
  }
  $color2 = "#fff";
  if($row['bonus']>0){
   $color2 = "#6CFCED";
  }




  echo '<tr><td>'.$date.'</td> <td>'.$per_day_salary .'</td>
  
  <form  method="post" id="fupForm'.$i.'">
  <td><input id="id'.$i.'" type="hidden" name="id'.$i.'" class="form-control" value="'.$emp_id.' " placeholder="-" /> 
  <input id="date'.$i.'" type="hidden" name="date'.$i.'" class="form-control" value="'.$date.'" placeholder="-" />
  <input id="leave'.$i.'" type="number" name="leave'.$i.'" style="background-color:'.$color.'" class="form-control" value="'.$row['leave_emp'].'" placeholder="-" /></td>
  <td> <input id="bonus'.$i.'" type="number" name="bonus'.$i.'" style="background-color:'.$color2.'" class="form-control" value="'.$row['bonus'].'" placeholder="-" /></td>
  <td> <input id="advance'.$i.'" type="number" name="advance'.$i.'" style="background-color:'.$color1.'" class="form-control" value="'.$row['advance'].'" placeholder="-" /></td>
  <td>'.$new_total.' </td>
  <td> <input type="button" name="save" class="btn btn-primary m-1 hover-zoom toggle-btn_1" value="Save to database" id="butsave'.$i.'"> </form></td>


  <script  type="text/javascript">
  $(document).ready(function() {
  $("#butsave'.$i.'").on("click", function() {
      
      var date = $("#date'.$i.'").val();
  var leave = $("#leave'.$i.'").val();
  var bonus = $("#bonus'.$i.'").val();
  var advance = $("#advance'.$i.'").val();
  var id = $("#id'.$i.'").val();
  
     $.ajax({
        url: "saveDate_detailsAjax.php",
        type: "POST",
        data: {
              date:date,
           leave: leave,
           bonus: bonus,
           advance: advance,
           id: id       
        },
        
        success: function(data){
           
           location.reload();
        }
         
     });
      
     
  });
  });
  </script> 
 
  </tr>';
  $start->modify('+1 day');
} 



     
   }



   function update_bill_resturant($rooms_id, $room_number, $total, $recieved)
   {
     


      $q = "SELECT * FROM `resturant_bills` WHERE `rooms_id` = '$rooms_id' AND room_number = '$room_number'";
      $result = mysqli_query($this->connection, $q);

      $num = mysqli_num_rows($result);

      $q1 = "SELECT * FROM `resturant_bills` WHERE `rooms_id` = '$rooms_id' AND room_number = '$room_number'";
      $result1 = mysqli_query($this->connection, $q1);
      $num1 = mysqli_num_rows($result1);

      if ($num < 1) {
         $q = "INSERT INTO `resturant_bills`(`rooms_id`, `room_number`, `total`, `rec`) VALUES ('$rooms_id','$room_number','$total','$recieved')";
         $result = mysqli_query($this->connection, $q);
      } else {
         $q = "UPDATE `resturant_bills` SET `total`='$total',`rec`='$recieved' WHERE `rooms_id` = '$rooms_id' AND `room_number` = '$room_number'";
         $result = mysqli_query($this->connection, $q);
      }

      if ($num1 < 1) {
         return 0;
      } else {
         $recieved = mysqli_fetch_row($result1);
         return $recieved[4];
      }
   }

   function fetch_recieved_bill($rooms_id, $room_number)
   {
      $q = "SELECT * FROM `resturant_bills` WHERE `rooms_id` = '$rooms_id' AND room_number = '$room_number'";
     
      $result = mysqli_query($this->connection, $q);
      $num = mysqli_num_rows($result);

      if ($num < 1) {
         return 0;
      } else {
         $recieved = mysqli_fetch_row($result);
         return $recieved[4];
      }
   }
   function update_cutting($id, $amount, $month)
   {
      $date = date('m-Y');
      $q = "UPDATE `add_cutting` SET `amount`='$amount' WHERE `emp_id` = '$id' and `month`='$month'";
      return mysqli_query($this->connection, $q);
   }

   function add_salary($id, $amount, $bonus, $cutting, $base_amount)
   {
      if ($bonus != "") {
         $newamount = $amount + $bonus;
      } else {
         $newamount = $amount;
      }

      if ($cutting == "") {
         $cutting = 0;
      }

      if ($bonus == "") {
         $bonus = 0;
      }
      $date = date('m-Y');

      $q = "INSERT INTO `add_pay`(`emp_id`, `base_salary`, `bonus`, `cutting`, `to_pay`, `month`)
         VALUES ('$id',' $base_amount','$bonus','$cutting', '$newamount' ,'$date')";
      return mysqli_query($this->connection, $q);
   }

   function add_salary_next($id, $amount, $bonus, $cutting, $base_amount, $date)
   {
      if ($bonus != "") {
         $newamount = $amount + $bonus;
      } else {
         $newamount = $amount;
      }

      if ($cutting == "") {
         $cutting = 0;
      }

      if ($bonus == "") {
         $bonus = 0;
      }

      $q = "INSERT INTO `add_pay`(`emp_id`, `base_salary`, `bonus`, `cutting`, `to_pay`, `month`)
         VALUES ('$id',' $base_amount','$bonus','$cutting', '$newamount' ,'$date')";
      return mysqli_query($this->connection, $q);
   }

   function get_employees_details($id)
   {

      $q = "SELECT * FROM `add_employees` WHERE `id` = '$id'";
      $row = mysqli_fetch_row(mysqli_query($this->connection, $q));
      return $row;
   }

   function get_nextmonthcutting_details($id, $date2)
   {      
   
      $q = "SELECT * FROM `add_cutting` WHERE `emp_id` = '$id' and `month` = '$date2'";
      $row = mysqli_fetch_row(mysqli_query($this->connection, $q));
      return $row;
   }



   function get_pay_details($id, $month)
   {

      $q = "SELECT * FROM `add_pay` WHERE `emp_id` = '$id' and `month` = '$month'";
      $row = mysqli_fetch_row(mysqli_query($this->connection, $q));
      return $row;
   }

   function get_latest_pay_details($id)
   {

      $q = "SELECT * FROM `add_pay` WHERE `emp_id`= '$id' ORDER BY `id` DESC LIMIT 1";
      $row = mysqli_fetch_row(mysqli_query($this->connection, $q));
      return $row;
   }

   function get_cutting_details($id)
   {
      $date = date('m-Y');
      $q = "SELECT * FROM `add_cutting` WHERE `emp_id` = '$id' and `month` = '$date'";
      $row = mysqli_fetch_row(mysqli_query($this->connection, $q));
      return $row;
   }
   function confirmUserID($username, $userid)
   {
      $username = str_replace('&lt;', "~", str_replace('<', "~&gt;", strip_tags(mysqli_real_escape_string($this->connection, $username))));
      $userid = str_replace('&lt;', "~", str_replace('<', "~&gt;", strip_tags(mysqli_real_escape_string($this->connection, $userid))));

      $q = "SELECT userid FROM " . TBL_USERS . " WHERE username = '$username'";
      $result = mysqli_query($this->connection, $q);
      if (!$result || (mysqli_num_rows($result) < 1)) {
         return 1;
      }

      $dbarray = mysqli_fetch_array($result);
      $dbarray['userid'] = stripslashes($dbarray['userid']);
      $userid = stripslashes($userid);

      if ($userid == $dbarray['userid']) {
         return 0;
      } else {
         return 2;
      }
   }

   function usernameTaken($username)
   {
      $username = str_replace('&lt;', "~", str_replace('<', "~&gt;", strip_tags(mysqli_real_escape_string($this->connection, $username))));

      $q = "SELECT username FROM " . TBL_USERS . " WHERE username = '$username'";
      $result = mysqli_query($this->connection, $q);
      return (mysqli_num_rows($result) > 0);
   }

   function usernameBanned($username)
   {
      $username = str_replace('&lt;', "~", str_replace('<', "~&gt;", strip_tags(mysqli_real_escape_string($this->connection, $username))));

      $q = "SELECT username FROM " . TBL_BANNED_USERS . " WHERE username = '$username'";
      $result = mysqli_query($this->connection, $q);
      return (mysqli_num_rows($result) > 0);
   }

   ////// START Custom Functions
   function select_room($type)
   {
      $date = date("Y-m-d");
      $q = "SELECT * FROM `checkin` WHERE `date_in` = '$date'";
      $r = mysqli_query($this->connection, $q);
      $res = mysqli_fetch_all($r);

      //already checked in rooms
      $room_list = array();

      foreach ($res as $id => $array) {
         $e = $array[6];
         $q = "SELECT * FROM room WHERE rooms_id = '$e'";
         $d = mysqli_query($this->connection, $q);
         $rex = mysqli_fetch_all($d);
         foreach ($rex as $key => $value) {
            array_push($room_list, $value[3]);
         }
      }

      //all rooms
      $q = "SELECT * FROM rooms WHERE category = '$type'";

      $result = mysqli_query($this->connection, $q);

      $ary = mysqli_fetch_all($result);

      $available = array();
      foreach ($ary as $id => $array) {
         array_push($available, $array[2]);
      }
      // reserved rooms
      $q = "SELECT * FROM reservations WHERE `date` = '$date'";
      $l = mysqli_fetch_row(mysqli_query($this->connection, $q));
      $reserved = array();
      if ($l) {
         foreach ($l as $valuesss) {
            array_push($reserved, $l[4]);
         }
      }

      $data = array_diff($available, $room_list, $reserved);

      return $data;
   }
   function clientdata($username)
   {
      $username = str_replace('&lt;', "~", str_replace('<', "~&gt;", strip_tags(mysqli_real_escape_string($this->connection, $username))));
      $q = "SELECT * FROM users where username='$username'";
      $result = mysqli_query($this->connection, $q);

      if (!$result || (mysqli_num_rows($result) < 1)) {
         return NULL;
      }

      $dbarray = mysqli_fetch_array($result);
      return $dbarray;
   }

   function addNewUser($username, $password, $email)
   {
      $username = str_replace('&lt;', "~", str_replace('<', "~&gt;", strip_tags(mysqli_real_escape_string($this->connection, $username))));
      $password = str_replace('&lt;', "~", str_replace('<', "~&gt;", strip_tags(mysqli_real_escape_string($this->connection, $password))));
      $email = str_replace('&lt;', "~", str_replace('<', "~&gt;", strip_tags(mysqli_real_escape_string($this->connection, $email))));

      $time = time();

      if (strcasecmp($username, ADMIN_NAME) == 0) {
         $ulevel = ADMIN_LEVEL;
      } else {
         $ulevel = MASTER_LEVEL;
      }
      $q = "INSERT INTO " . TBL_USERS . " VALUES ('$username', '$password', '0', $ulevel, '$email', $time)";
      return mysqli_query($this->connection, $q);
   }

   function add_reservation($res_id, $cust_name, $cust_mobile_no, $reservation_rooms_id, $cnic, $city, $date_in, $date_out, $rate, $discount, $price, $advance)
   {

      $q = "INSERT INTO `reservations`(`res_id`, `cust_name`, `cust_mobile_no`, `reservation_rooms_id`, `cnic_number`, `city`, `date_in`, `date_out`, `rate`, `discount`, `price`, `advance`) VALUES ('$res_id','$cust_name','$cust_mobile_no','$reservation_rooms_id','$cnic','$city','$date_in','$date_out','$rate','$discount','$price','$advance')";

      mysqli_query($this->connection, $q);
   }


 function add_rooms($rest_name, $category, $number, $rate)
   {
 $q1 = "select * from `rooms`where number='$number'";

      $result1 =  mysqli_query($this->connection, $q1);
       $row1 = mysqli_fetch_row($result1);
if(empty($row1))
{

      $q = "INSERT INTO `rooms`(`category`, `number`, `rate`,`rest_name`) VALUES ('$category','$number','$rate','$rest_name')";

      mysqli_query($this->connection, $q);
      }

      else
      {
        return 1;
      
      }
   }


function edit_room($id,$rest_name, $category, $number, $rate)
   {
      $q = "UPDATE `rooms` SET `category`= '$category',`number`='$number',`rate`='$rate',`rest_name`= '$rest_name'  WHERE `id` = '$id'";
      
      return mysqli_query($this->connection, $q);
   }


   function updateUserField($username, $field, $value)
   {
      $username = str_replace('&lt;', "~", str_replace('<', "~&gt;", strip_tags(mysqli_real_escape_string($this->connection, $username))));
      $field = str_replace('&lt;', "~", str_replace('<', "~&gt;", strip_tags(mysqli_real_escape_string($this->connection, $field))));
      $value = str_replace('&lt;', "~", str_replace('<', "~&gt;", strip_tags(mysqli_real_escape_string($this->connection, $value))));
      $q = "UPDATE " . TBL_USERS . " SET " . $field . " = '$value' WHERE username = '$username'";
      return mysqli_query($this->connection, $q);
   }
   function get_checkout_user($id){
      $q = "SELECT * FROM checkout WHERE checkin_id = '$id'";
      $result = mysqli_query($this->connection, $q);
      $row = mysqli_fetch_row($result);
      return $row[1];
   }
   function report_booking($date)
   {
      global $session;
      $q = "SELECT * FROM `booked_dates` WHERE `date_n` = '$date'";
      $array = mysqli_fetch_all(mysqli_query($this->connection, $q));
      $num = mysqli_num_rows(mysqli_query($this->connection, $q));
      $checkin_ids = array();
      for ($i = 0; $i < $num; $i++) {
         array_push($checkin_ids, $array[$i][1]);
      }

      foreach ($checkin_ids as $key => $value) {
         $q = "SELECT * FROM checkin WHERE id = '$value' order by id ASC";
         $are = mysqli_fetch_all(mysqli_query($this->connection, $q));
         $number = mysqli_num_rows(mysqli_query($this->connection, $q));
         for ($i = 0; $i < $number; $i++) {

            if ($are[$i][12] == $are[$i][9]) {
               $color = "style='color:green;font-weight:500;'";
            } else {
               $color = "style='color:red;font-weight:500;'";
            }
            $v = $i + 1;
            $new_date_format = date('d-m-Y', strtotime('' . $are[$i][4] . ''));
            if ($are[$i][13] == "0") {
               $checkout_status = '<span style="color:red;">Not Checked out</span>';
            } else {
               $checkout_status = '<span style="color:green;">Checked out</span>';
            }
            $new_date_format1 = date('Y-m-d', strtotime('' . $are[$i][5] . ''));
            $new_date_format1 = date('Y-m-d', (strtotime('+1 day', strtotime($new_date_format1))));
            $date1 = new DateTime($are[$i][4]);
            $date2 = new DateTime($new_date_format1);
            $dayss = $date2->diff($date1)->format('%a');
            $total = $are[$i][9] / $dayss;
            $left_amt = $are[$i][9] - $are[$i][12];
            if ($are[$i][12] == $are[$i][9]) {
               $color = "style='color:green;font-weight:500;'";
            } else {
               $color = "style='color:red;font-weight:500;'";
            }
            echo '<tr>
<td>';
            $this->groupdata("get_rooms_list_grey", $are[$i][6], "", "", "");
            echo '</td>
<td>' . $are[$i][1] . '</td>
<td>' . $are[$i][4] . '</td>
<td>' . $are[$i][2] . '</td>
<td>' . $are[$i][11] . '</td>
<td class="count-me">' . $total . '</td>
<td ' . $color . '>' . $are[$i][12] . '/' . $are[$i][9] . '  Remaining Amount: ' . $left_amt . '</td>
<td>' . $are[$i][14] . '<br><b>Time</b> : ' . $are[$i][15] . '</td>
<td>'; echo $this->get_checkout_user($are[$i][0]); echo '<br><b>Time</b> : ' . $are[$i][16] . '</td>
<td><a href="addcheckin.php?name=' . $are[$i][1] . '&cnic=' . $are[$i][2] . '&number=' . $are[$i][11] . '" class="btn btn-info hover-zoom">ReCheckin</a>';

            if ($session->userlevel == "8") {
               echo '
<a href="delete_cin.php?id=' . $are[$i][0] . '" class="btn btn-danger hover-zoom">Delete</a>';
            }
            echo '</td>
</tr>
';
         }
      }
   }
   function getBillingDate()
   {
      $q = "SELECT * FROM `billing_date` WHERE id = 1";
      $da = mysqli_fetch_row(mysqli_query($this->connection,$q));
      $date = $da[1];
      return $date;
   }

      function getExpenseNum()
   {
      $q = "SELECT * FROM `expenses`";
      $da = mysqli_num_rows(mysqli_query($this->connection,$q));
      return $da;
   }
   
   function getDailyIncome($date)
   {
      $q = "SELECT * FROM `checkin` WHERE date_in = '$date'";
      $da = mysqli_fetch_all(mysqli_query($this->connection,$q));
      $total = 0;
      foreach ($da as $key => $value) {
         $total += $value[12];
        
      }
      if ($total == ""){
         $total = 0;
      }
    return $total;
   }
 function getDailyExpense($date)
   {
      $q = "SELECT * FROM `expenses` WHERE `date` = '$date'";
      $da = mysqli_fetch_all(mysqli_query($this->connection,$q));
      $total = 0;
      foreach ($da as $key => $value) {
         $total += $value[3];
        
      }
        if ($total == ""){
         $total = 0;
      }
    return $total;
   }

    function expenses($date)
   {
      global $session;

     if($date == ""){
      $q = "SELECT * FROM `expenses` ";
     }else{
      $q = "SELECT * FROM `expenses` WHERE `date` = '$date'";
     }
      
      $array = mysqli_fetch_all(mysqli_query($this->connection, $q));
      $num = mysqli_num_rows(mysqli_query($this->connection, $q));
      
      foreach ($array as $key => $value) {
        
            echo "
            <tr>
            <td width='5px'>".$value[0]."</td>
             <td width='15px'>".$value[1]."</td>
       
               <td width='5px' class='count-me' id='count-me'>".$value[3]."</td>
                <td width='5px'> <a href='delete_expenses.php?id=".$value[0]."' class='btn btn-danger m-1 hover-zoom toggle-btn_1'>Delete</a></td>
            </tr>
            ";
         
         }
      }
   
function expenses_personal($date)
   {
      global $session;

     if($date==""){
          $q = "SELECT * FROM `personal_expenses` WHERE  user_id='$session->userid'";
     }else{
         $q = "SELECT * FROM `personal_expenses` WHERE  `date` = '$date' AND user_id='$session->userid'";
     }
     
      $array = mysqli_fetch_all(mysqli_query($this->connection, $q));
      $num = mysqli_num_rows(mysqli_query($this->connection, $q));
      
      foreach ($array as $key => $value) {
        
            echo "
            <tr>
            <td width='5px'>".$value[0]."</td>
             <td width='15px'>".$value[1]."</td>
       
               <td width='5px' class='count-me' id='count-me'>".$value[3]."</td>
                <td width='5px'> <a href='delete_personal_expenses.php?id=".$value[0]."' class='btn btn-danger m-1 hover-zoom toggle-btn_1'>Delete</a></td>
            </tr>
            ";
         
         }
      }
   

   function report_resturant_unpaid()
   {
      global $session;
      $q = "SELECT * FROM `checkin` WHERE `checkout_status` <> 0 AND receiving_status = 0";

      $array = mysqli_fetch_all(mysqli_query($this->connection, $q));

      $num = mysqli_num_rows(mysqli_query($this->connection, $q));

      $checkin_ids = array();

      for ($i = 0; $i < $num; $i++) {
         $c_id = $array[$i][0];
         $name = $array[$i][1];
         $room_bill = $array[$i][9];
         $advance = $array[$i][12];
         $rmN = $ary[$i][3];
         $date_in = $array[$i][4];
         $date_out = $array[$i][5];
         $rooms_id = $array[$i][6];

     

         $dates_from_user = $this->getDatesFromRange($date_in, $date_out);

         $rooms_from_rooms_id = array();

         $q1 = "SELECT * FROM `room` WHERE `rooms_id` = '$rooms_id' order by `room_number`";

         $result = mysqli_query($this->connection, $q1);

         $ary = mysqli_fetch_all($result);

         $nume = mysqli_num_rows($result);

         for ($i1 = 0; $i1 < $nume; $i1++) {
            array_push($rooms_from_rooms_id, $ary[$i1][3]);
         }

        

            $array_of_array = array();

            $query_where_condition = "SELECT * FROM `orders` WHERE (name = '$name' AND status = 1 AND room_number = $rooms_from_rooms_id[0]) AND";
            foreach ($dates_from_user as $index => $date) {
               if ($index == 0) {
                  $query_where_condition .= "(date(date_a) = '$date'";
               } else {
                  $query_where_condition .= " OR date(date_a) = '$date'";
               }
            }
            $query_where_condition .= ")";
           
            $array_of_array[$key] = mysqli_fetch_all(mysqli_query($this->connection, $query_where_condition));

            $total = 0;
            foreach ($array_of_array[$key] as $idid => $valval) {
              $extra = $valval[7];
               $new_t = $valval[2]-$valval[7];
               
               $total += $new_t;
               
            }
           
           

               $qeq = "SELECT * FROM `resturant_bills` WHERE `rooms_id` = '$rooms_id'";
    
               $row = mysqli_fetch_all(mysqli_query($this->connection, $qeq));

               $row_num = mysqli_num_rows(mysqli_query($this->connection, $qeq));
               $received = 0;
               if ($row_num < 1) {
                  $received = 0;
               } else {

                  for ($i525 = 0; $i525 < $row_num; $i525++) {
                     $received += $row[$i525][4];
                  }
               }

              
               //if ($received == 0 || $received < $total) {
                  $total_p = (15 / 100) * $total + $total;
                  $total = $total_p + $extra;
                  $rest_rema = $room_bill-$advance;
                  $total = $total + $received;
                  $new_recieved = $advance + $received;
                 
                 $ord_rem = $total - $received;
                 $new_bill =  $rest_rema +$ord_rem;
                 $new_bill_tot =  $total +$room_bill;
                  $date_in = date("d-m-Y", strtotime($date_in));
                  
                  if($new_bill != 0){
                   
                     echo '<tr>
                     <td>';
                     $this->groupdata("get_rooms_list_grey", $rooms_id, "", "", "");
                     echo '</td>
                     <td>' . $name . '</td>
                     <td>' . $date_in . '</td>
                    
                    
                     <td class="count-me1__1">' . $new_recieved . '</td>
                     <td class="count-me__1">' . $new_bill . '</td>
                    
                     <td><a href="bill.php?id=' . $array[$i][0] . '&id1=' . $array[$i][6] . '&total=' . $array[$i][9] . '&advance=' . $array[$i][12] . '&rm=' . $array[$i][6] . '&name=' . $array[$i][1] . '&date_in=' . $array[$i][4] . '&date_out=' . $array[$i][5] . '&rooms=';
                     $this->groupdata("get_rooms_list", $array[$i][6], "", "", "");
                     echo '" class="btn btn-info hover-zoom m-1" id="rm_rm">Print Bill</a>';
                     echo '</td>
                     </tr>
                              ';
                  }  
               //}
                 
               
            
         
      }
   }

   function report_resturant_unpaid_count()
   {
      global $session;
      $q = "SELECT * FROM `checkin` WHERE `checkout_status` <> 0";
      $end = 0;
      $array = mysqli_fetch_all(mysqli_query($this->connection, $q));

      $num = mysqli_num_rows(mysqli_query($this->connection, $q));

      $checkin_ids = array();

      for ($i = 0; $i < $num; $i++) {
         $c_id = $array[$i][0];
         $name = $array[$i][1];
         $date_in = $array[$i][4];
         $date_out = $array[$i][5];
         $rooms_id = $array[$i][6];

         $dates_from_user = $this->getDatesFromRange($date_in, $date_out);

         $rooms_from_rooms_id = array();

         $q1 = "SELECT * FROM `room` WHERE `rooms_id` = '$rooms_id' order by `room_number`";

         $result = mysqli_query($this->connection, $q1);

         $ary = mysqli_fetch_all($result);

         $nume = mysqli_num_rows($result);

         for ($i1 = 0; $i1 < $nume; $i1++) {
            array_push($rooms_from_rooms_id, $ary[$i1][3]);
         }

         foreach ($rooms_from_rooms_id as $key => $value) {

            $array_of_array = array();

            $query_where_condition = "SELECT * FROM `orders` WHERE (name = '$name' AND status = 1 AND room_number = '$value') AND";
            foreach ($dates_from_user as $index => $date) {
               if ($index == 0) {
                  $query_where_condition .= "(date_a = '$date'";
               } else {
                  $query_where_condition .= " OR date_a = '$date'";
               }
            }
            $query_where_condition .= ")";
            $array_of_array[$key] = mysqli_fetch_all(mysqli_query($this->connection, $query_where_condition));

            $total = 0;
            foreach ($array_of_array[$key] as $idid => $valval) {

               $total += $valval[2];
            }
            if ($total != 0) {

               $qeq = "SELECT * FROM `resturant_bills` WHERE `rooms_id` = '$rooms_id'";

               $row = mysqli_fetch_all(mysqli_query($this->connection, $qeq));

               $row_num = mysqli_num_rows(mysqli_query($this->connection, $qeq));
               $received = 0;
               if ($row_num < 1) {
                  $received = 0;
               } else {

                  for ($i525 = 0; $i525 < $row_num; $i525++) {
                     $received += $row[$i525][4];
                  }
               }
               if ($received == 0 || $received < $total) {
                  $total = (15 / 100) * $total + $total;
                  $total = $total + $received;
                  $end++;
               }

               
            }
         }
      }
      return $end;
   }


   function report_resturant_unpaid_with_id($id)
   { 
      global $session;
      $q = "SELECT * FROM `checkin` WHERE id = '$id'";

      $array = mysqli_fetch_all(mysqli_query($this->connection, $q));

      $num = mysqli_num_rows(mysqli_query($this->connection, $q));

      $checkin_ids = array();

      for ($i = 0; $i < $num; $i++) {
         $c_id = $array[$i][0];
         $name = $array[$i][1];
         $date_in = $array[$i][4];
         $date_out = $array[$i][5];
         $rooms_id = $array[$i][6];

         $dates_from_user = $this->getDatesFromRange($date_in, $date_out);

         $rooms_from_rooms_id = array();

         $q1 = "SELECT * FROM `room` WHERE `rooms_id` = '$rooms_id' order by `room_number`";
 
         $result = mysqli_query($this->connection, $q1);

         $ary = mysqli_fetch_all($result);

         $nume = mysqli_num_rows($result);

         for ($i1 = 0; $i1 < $nume; $i1++) {
            array_push($rooms_from_rooms_id, $ary[$i1][3]);
         }

         foreach ($rooms_from_rooms_id as $key => $value) {

            $array_of_array = array();

            $query_where_condition = "SELECT * FROM `orders` WHERE (name = '$name' AND status = 1 AND room_number = '$value') AND";
            foreach ($dates_from_user as $index => $date) {
               if ($index == 0) {
                  $query_where_condition .= "(date_a = '$date'";
               } else {
                  $query_where_condition .= " OR date_a = '$date'";
               }

            }
            $query_where_condition .= ")";
            $array_of_array[$key] = mysqli_fetch_all(mysqli_query($this->connection, $query_where_condition));

            $total = 0;
            foreach ($array_of_array[$key] as $idid => $valval) {

               $total += $valval[2];
            }

            // if ($total != 0) {

               $qeq = "SELECT * FROM `resturant_bills` WHERE `rooms_id` = '$rooms_id'";

               $row = mysqli_fetch_all(mysqli_query($this->connection, $qeq));

               $row_num = mysqli_num_rows(mysqli_query($this->connection, $qeq));
               $received = 0;
               if ($row_num < 1) {
                  $received = 0;
               } else {

                  for ($i525 = 0; $i525 < $row_num; $i525++) {
                     $received += $row[$i525][4];
                  }
               }

               if ($received == 0 || $received < $total) {
                  $total = (15 / 100) * $total + $total;
                  $total = $total + $received;
               }

               return $received;
            //}
         }
      }
   }
   function get_checkin_dates($id)
   {
      $q = "SELECT * FROM `checkin` WHERE `id` = '$id'";
      $row = mysqli_fetch_row(mysqli_query($this->connection, $q));
      $start = $row[4];
      $end = $row[5];
      $range = $this->getDatesFromRange($start, $end);
      return $range;
   }

   function add_booked_dates($checkin_id, $date)
   {
      $q = "INSERT INTO `booked_dates`(`id`, `checkin_id`, `date_n`) VALUES ('','$checkin_id','$date')";
      return mysqli_query($this->connection, $q);
   }
   function add_reserved_dates($res_id, $date)
   {
      $q = "INSERT INTO `reserved_dates`(`id`, `reservation_id`, `date_n`) VALUES ('','$res_id','$date')";
      return mysqli_query($this->connection, $q);
   }

   function add_cavity($id, $date, $qty, $total)
   {
      global $session;
      $user = $session->username;
      $month = date('M', strtotime($date));
      $q = "INSERT INTO `roti_bill`(`sr_id`, `date`, `qty`, `total`, `month`, `user`) VALUES ('$id','$date','$qty','$total','$month', '$user')";
      return mysqli_query($this->connection, $q);
   }

   function add_res_rep($id, $rooms, $date_in, $total)
   {
      global $session;
      $user = $session->username;

      $q = "INSERT INTO `report_restuant`(`room_numbers`, `date_in`, `total`, `serial`, `user`) VALUES ('$rooms','$date_in','$total','$id', '$user')";
      return mysqli_query($this->connection, $q);
   }

   function getDatesFromRange($start, $end, $format = 'Y-m-d')
   {
      $array = array();
      $interval = new DateInterval('P1D');

      $realEnd = new DateTime($end);
      $realEnd->add($interval);

      $period = new DatePeriod(new DateTime($start), $interval, $realEnd);

      foreach ($period as $date) {
         $array[] = $date->format($format);
      }

      return $array;
   }

   function get_rooms_new_all($category_name)
   {

      $cat_q = "SELECT `number`, `rate`, `id` FROM `rooms` WHERE `category` = '$category_name'";
      $res = mysqli_query($this->connection, $cat_q);
      $ary_cat = mysqli_fetch_all($res, MYSQLI_ASSOC);
      $num = mysqli_num_rows($res);

      for ($i = 0; $i < count($ary_cat); $i++) {

         $price = $ary_cat[$i]['rate'];
         $num = $ary_cat[$i]['number'];
         $id = $ary_cat[$i]['id'];
         echo '<div class="row">
                           <input id="' . $id . '" type="checkbox" name="number[]" value="' . $num . '" data-overlay="' . $price . '">
                           <label for="' . $id . '">&nbsp;&nbsp;' . $num . ' (PKR ' . $price . ')</label>
                        </div>
                        ';

         echo " <script>
         $('#" . $id . "').change(function() {
            var text = $(this).attr('data-overlay');

    if(this.checked) {

      var a = parseInt($('#t_rate').val());
        var b = parseInt(text);
        var days = document.getElementById('t_days').value;
        var t = b * days;
        var total = a+t;

        $('#t_rate').val(total);

    }else{
        var b = parseInt(text);
        var a = parseInt($('#t_rate').val());
         var days = document.getElementById('t_days').value;
        var t = b * days;
        var total = a-t;

        $('#t_rate').val(total);
    }
});
      </script>";
      }
   }

   function get_rooms_new($category_name, $checkin_date, $days_of_stay)
   {

$q = "SELECT * FROM `rooms` WHERE category = '$category_name'";
      $result = mysqli_query($this->connection, $q);
      $array_room_cat = array();
      while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
         array_push($array_room_cat, $row['number']);
      }
      $desdaf = date('Y-m-d');
      if ($days_of_stay != "1") {
         $checkoutdate = date('Y-m-d', strtotime($checkin_date . ' + ' . $days_of_stay . ' days'));
      } else {
         $checkoutdate = date('Y-m-d', strtotime($checkin_date));
      }

      $result1 = $this->get_only_available_rooms($checkin_date, $checkoutdate);

      $result = array();
      foreach ($array_room_cat as $data) {
         if (in_array($data, $result1)) {
            array_push($result, $data);
         }
      }

      for ($i = 0; $i < count($result); $i++) {
         $ary = $this->get_room_price($result[$i]);
         $id = $ary[0];
         $price = $ary[3];
         $num = $ary[2];
         echo '<div class="row">
                           <input id="' . $id . '" type="checkbox" name="number[]" value="' . $num . '" data-overlay="' . $price . '">
                           <label for="' . $id . '">&nbsp;&nbsp;' . $num . ' (PKR ' . $price . ')</label>
                        </div>
                        ';

         echo " <script>
         $('#" . $id . "').change(function() {
            var text = $(this).attr('data-overlay');

    if(this.checked) {

      var a = parseInt($('#t_rate').val());

        var b = parseInt(text);
        var days = document.getElementById('t_days').value;
        var t = b * days;
        var total = a+t;


        $('#t_rate').val(total);

    }else{
        var b = parseInt(text);
        var a = parseInt($('#t_rate').val());
        var days = document.getElementById('t_days').value;
        var t = b * days;
        var total = a-t;

        $('#t_rate').val(total);
    }
});
      </script>";
      }
   }

 function get_rooms_new_value($checkin_date, $checkoutdate)
   {

$q = "SELECT * FROM `rooms`";
      $result = mysqli_query($this->connection, $q);
      $array_room_cat = array();
      while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
         array_push($array_room_cat, $row['number']);
      }
      


      $result1 = $this->get_only_available_rooms($checkin_date, $checkoutdate);

      $result = array();

      $rr = array_diff($array_room_cat, $result1);
    
      return count($rr); }



   function get_resered($id)
   {
      $q = "SELECT * FROM reservations WHERE res_id = '$id'";
      $row = mysqli_fetch_row(mysqli_query($this->connection, $q));
      $rooms_id = $row[3];
      $q = "SELECT room_number FROM reservation_rooms WHERE rooms_id = '$rooms_id'";
      $result = mysqli_query($this->connection, $q);
      $arry = mysqli_fetch_all($result);
      $num = mysqli_num_rows($result);
      $array = array();
      for ($i = 0; $i < $num; $i++) {
         array_push($array, $arry[$i][0]);
      }

      return $array;
   }

   function get_leave_details($id)
   {
      $date = date('Y-m-d');

      $q = "SELECT * FROM `attendance` WHERE `emp_id` = '$id' and `date` = '$date'";
      $row = mysqli_fetch_row(mysqli_query($this->connection, $q));
      return $row;
   }

function get_leave_count($id)
   {
      $date = date('Y-m-d');
      $day = "01";
      $day2 = date("t");
      $month = date('m');
      $year = date('Y');

      $date1 = $day.'-'.$month.'-'.$year;
      $date2 = $day2.'-'.$month.'-'.$year;

     $timestamp_1 = strtotime($date1);
     $timestamp_2 = strtotime($date2);

            
      $q = "SELECT COUNT(id) as empcnt FROM `attendance` WHERE `emp_id` = '$id' AND `timestamp` BETWEEN '$timestamp_1' AND '$timestamp_2'";
      $row = mysqli_fetch_array(mysqli_query($this->connection, $q));
      return $row;
   }



   function get_checkedin($id)
   {
      $q = "SELECT * FROM checkin WHERE id = '$id'";
      $row = mysqli_fetch_row(mysqli_query($this->connection, $q));
      $rooms_id = $row[6];
      $q = "SELECT room_number FROM room WHERE rooms_id = '$rooms_id'";
      $result = mysqli_query($this->connection, $q);
      $arry = mysqli_fetch_all($result);
      $num = mysqli_num_rows($result);
      $array = array();
      for ($i = 0; $i < $num; $i++) {
         array_push($array, $arry[$i][0]);
      }

      return $array;
   }
   // get checkin_details
   function get_checkedin_bill($id)
   {
      $q = "SELECT * FROM checkin WHERE id = '$id'";
      
      $row = mysqli_fetch_row(mysqli_query($this->connection, $q));

      return $row;
   }
   function change_checkin_status($id, $name, $num)
   {  
      global $session;
      $username = $session->username;
      $time = date("H:i A");
      $q = "UPDATE `checkin` SET `checkout_status`= '1' WHERE `id` = '$id'";
      
      // $cURLConnection = curl_init();

      // curl_setopt($cURLConnection, CURLOPT_URL, 'http://shahams.shop/arduino/anees/index.php');
      // curl_setopt($cURLConnection, CURLOPT_RETURNTRANSFER, true);

      // $phoneList = curl_exec($cURLConnection);
      // curl_close($cURLConnection);

      // $jsonArrayResponse = json_decode($phoneList);
      // $num = substr($num, 1);
      // $postRequest = array(
      //    'insert' => '0',
      //    'number' => $num,
      //    'name' => $name,
      //    'message' => ' You have Checked-out from Hotel Almas at ' . date('d-m-Y h:i') . ', We wish you had a happy stay. Please do visit us again!"'
      // );

      // $cURLConnection = curl_init('http://shahams.shop/arduino/anees/index.php');
      // curl_setopt($cURLConnection, CURLOPT_POSTFIELDS, $postRequest);
      // curl_setopt($cURLConnection, CURLOPT_RETURNTRANSFER, true);

      // $apiResponse = curl_exec($cURLConnection);
      // curl_close($cURLConnection);

      // $apiResponse - available data from the API request
      mysqli_query($this->connection, $q);
      $q = "INSERT INTO `checkout` (`checkin_id`,`user`) VALUES ('$id','$username')";
      return mysqli_query($this->connection, $q);
       }


   function change_checkin_status_clean($id)
   {
      $q = "UPDATE `checkin` SET `checkout_status`= '2' WHERE `id` = '$id'";
     
      return mysqli_query($this->connection, $q);
   }

   function get_rooms_new_with_id($category_name, $checkin_date, $days_of_stay, $id)
   {

      $q = "SELECT * FROM `rooms` WHERE category = '$category_name'";
      $result = mysqli_query($this->connection, $q);
      $array_room_cat = array();
      while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
         array_push($array_room_cat, $row['number']);
      }
if ($days_of_stay != "1") {
         $checkoutdate = date('Y-m-d', strtotime($checkin_date . ' + ' . $days_of_stay . ' days'));
      } else {
         $checkoutdate = date('Y-m-d', strtotime($checkin_date));
      }


      //all rooms against this reservations id
      $reserved_rooms_against_id = $this->get_resered($id);
      //all rooms against this checkin id
      $checked_in_rroms = $this->get_checkedin($id);

      $result1 = $this->get_only_available_rooms_with_id($checkin_date, $checkoutdate, $id);

      $result = array();
      foreach ($array_room_cat as $data) {
         if (in_array($data, $result1)) {
            array_push($result, $data);
         }
      }

      $avai = array();
      for ($i = 0; $i < count($result); $i++) {
         $ary = $this->get_room_price($result[$i]);
         $id = $ary[0];
         $price = $ary[3];
         $num = $ary[2];
         if (in_array($num, $reserved_rooms_against_id)) {
            array_push($avai, $num);
         } else if (in_array($num, $checked_in_rroms)) {
            array_push($avai, $num);
         }
      }

      for ($i = 0; $i < count($result); $i++) {
         $ary = $this->get_room_price($result[$i]);
         $id = $ary[0];
         $price = $ary[3];
         $num = $ary[2];
         if (in_array($num, $avai)) {
            $checked = "checked='true'";
         } else {
            $checked = '';
         }
         echo '<div class="row">
                           <input id="' . $id . '" type="checkbox" name="number[]" value="' . $num . '" data-overlay="' . $price . '" ' . $checked . '>
                           <label for="' . $id . '">&nbsp;&nbsp;' . $num . ' (PKR ' . $price . ')</label>
                        </div>
                        ';

         echo " <script>
         $('#" . $id . "').change(function() {
            var text = $(this).attr('data-overlay');

    if(this.checked) {

      var a = parseInt($('#t_rate').val());

        var b = parseInt(text);
        var days = document.getElementById('t_days').value;
        var t = b * days;
        var total = a+t;


        $('#t_rate').val(total);

    }else{
        var b = parseInt(text);
        var a = parseInt($('#t_rate').val());
        var days = document.getElementById('t_days').value;
        var t = b * days;
        var total = a-t;

        $('#t_rate').val(total);
    }
});
      </script>";
      }
   }

   function groupdata($type, $var0, $var1, $var2, $CSRF_Code)
   {
      
      global $session;
      $type = str_replace('&lt;', "~", str_replace('<', "~&gt;", strip_tags(mysqli_real_escape_string($this->connection, $type))));

      $jumo2 = "";
      $CSRF_Code = "";

      if ($type == "get_all_cities") {
         $q = "SELECT * FROM cities";
      }
      if ($type == "checkins_clean") {
         $q = "SELECT * FROM checkin WHERE checkout_status=1";
      }
      if ($type == "view_inventory") {
         $q = "SELECT * FROM inventory";
      }
      if ($type == "get_room_edit") {
         $q = "SELECT * FROM rooms";
      }
      if ($type == "cavity_report") {
         $q = "SELECT * FROM `roti_bill` WHERE month = '$var0'";
      }
      if ($type == "get_food_categories_edit") {
         $q = "SELECT * FROM food_categories";
      }
      if ($type == "food_cat_button") {
         $q = "SELECT * FROM food_categories";
      }

      if ($type == "get_food_product_edit") {
         $q = "SELECT * FROM food_product where cat_id = '$var0' order by product_id ASC";
      }
      // Out of CKRF
      if ($type == "stp_fieldset_more") {
         $q = "SELECT username FROM users order by username ASC";
      }
      if ($type == "checkins") {
         $q = "SELECT * FROM checkin WHERE checkout_status = 0 order by id ASC";
      }
      if ($type == "Recieveing_By") {
         $q = "SELECT * FROM receiving WHERE recieved_status = 0 order by id ASC";
      }
      if ($type == "employees") {
         $q = "SELECT * FROM add_employees ORDER BY `id` ASC";
      }

 if ($type == "rooms") {
         $q = "SELECT * FROM rooms ORDER BY `id` ASC";
      }

      if ($type == "employees_salary") {
         $q = "SELECT * FROM add_employees ORDER BY `id` ASC";
      }
      if ($type == "employees_salary_detail") {
         $q = "SELECT * FROM `add_pay` WHERE `emp_id` = '$var0' ORDER BY `id` ASC";
      }
      if ($type == "add_reservation") {
         $q = "SELECT * FROM checkin WHERE checkout_status = 1 order by id ASC";
      }
      if ($type == "checkins_reports") {

         $q = "SELECT * FROM checkin WHERE date_in = '$var0' order by id ASC";
      }
      if ($type == "checkins_reports_unpaid") {
         $q = "SELECT * FROM checkin WHERE checkout_status <> 0 AND advance <> total order by id ASC";
      }
      if ($type == "checkins_reports_unpaid_count") {
         $q = "SELECT * FROM checkin WHERE checkout_status <> 0 AND advance <> total order by id ASC";
      }
      if ($type == "amount_recieved") {
         $q = "SELECT * FROM receiving WHERE recieved_status = 1 order by id ASC";
      }
      if ($type == "checkins_reports_all") {
         if($var0 == ""){
            $q = "SELECT * FROM checkin  order by id ASC";
         }else{
             
            $q = "SELECT * FROM checkin WHERE date_in BETWEEN '$var0' and '$var1' order by id ASC";
            
         }
         
      }
      if ($type == "checkins_reports_police") {
          if($var0 == ""){
            $q = "SELECT * FROM checkin  order by id ASC";
         }else{
             
           $q = "SELECT * FROM checkin WHERE date_in = '$var0' order by id ASC";
            
         }
         
         
      }
      if ($type == "resturants_reports") {
         $q = "SELECT * FROM orders where date(date_a) = '$var0' AND Status = 1";
        
      }
      if ($type == "get_rooms_list") {
         $q = "SELECT * FROM room WHERE rooms_id = '$var0'";
      }
      if ($type == "get_reserved_list_grey") {
         $q = "SELECT * FROM reservation_rooms WHERE rooms_id = '$var0'";
      }
      if ($type == "get_reserved_list") {
         $q = "SELECT * FROM reservation_rooms WHERE rooms_id = '$var0'";
      }
      if ($type == "get_rooms_list_grey") {
         $q = "SELECT * FROM room WHERE rooms_id = '$var0'";
      }

      if ($type == "reservation") {
         $q = "SELECT * FROM reservations ORDER BY `date_in` ASC";
      }
      if ($type == "get_food_categories") {
         $q = "SELECT * FROM food_categories";
      }
      if ($type == "get_food_categories_breakfast") {
         $q = "SELECT * FROM food_categories";
      }

      if ($type == "get_room") {
         $q = "SELECT * FROM rooms";
      }
      if ($type == "all_usernames") {
         $q = "SELECT * FROM users";
      }
      if ($type == "get_orders") {
         $today = date('Y-m-d h:i:sa');
         $q = "SELECT * FROM orders where date_a = '$today' AND Status = 0 or  Status = ''";
      }

       if ($type == "get_order_cavity") {
         $today = date('Y-m-d');

         $q = "SELECT * FROM orders where date(date_a) = '$today' AND order_id = '$var0'";
        
      }

      if ($type == "get_orders_delivered") {
         
         $q = "SELECT * FROM orders where Status = 1 order by date_a DESC";
      }
      if ($type == "get_order_item") {
         $q = "SELECT * FROM order_menu where order_id = $var0";
      }
      if ($type == "get_notification_item") {
         $q = "SELECT * FROM `checkin` WHERE advance <> total order by id ASC";
      }
      if ($type == "get_food_product") {
         $q = "SELECT * FROM food_product where cat_id = '$var0' order by product_id ASC";
      }

      if ($type == "res_p") {
         $q = "SELECT * FROM orders where Status = 0 or  Status = ''";
      }
      //start query process


      $result = mysqli_query($this->connection, $q);
      $num_rows = mysqli_num_rows($result);
      if (!$result || ($num_rows < 0)) {
         echo "";
         return;
      }
      if ($num_rows == 0) {
         echo "";
         return;
      }

      for ($i = 0; $i < $num_rows; $i++) {

         mysqli_data_seek($result, $i);
         $row = mysqli_fetch_row($result);

         //Out of CKRF
         if ($type == "all_usernames") {
            if ($row[3] == "8") {
               echo '<option selected>' . $row[0] . '</option>';
            } else {
               echo '<option>' . $row[0] . '</option>';
            }
         }
         if ($type == "employees_salary_detail") {

            $date = date('m-Y');
            $basic =$row[2];
            $bonus = $row[3];
            $cutting = $row[4];
            $after = $row[5];
            $month = $row[6];

            echo '<tr>
                        <td>' . $month . '</td>
                        <td>' . $basic . '</td>
                        <td>' . $bonus . '</td> 
                        <td>' . $cutting . '</td>
                        <td>' . $after . '</td>
                        <td><a class="btn btn-secondary m-1 hover-zoom toggle-btn_1" href="employee_details.php?id=' . $row[0] . '&& month='.$month.'&&pay='.$basic.'&&name='.$row[1].'">Employee Details</a></td>
                      </tr>';
         }

         if ($type == "employees_salary") {

            $date = date('d-m-Y');
            $id = $row[0];
            $name = $row[1];
            $basic = $row[4];
            $phone_no = $row[3];

            $sql_1 = "SELECT sum(cutting) as ccunt FROM add_pay WHERE (emp_id = '$id') group by emp_id";
            $res_1 = mysqli_query($this->connection, $sql_1);
            $row_1 = mysqli_fetch_array($res_1);
            if ($row_1 != "") {
               $cutting = ($row_1['ccunt']);
            } else {
               $cutting = 0;
            }
            $sql_2 = "SELECT sum(to_pay) as pcunt FROM add_pay WHERE (emp_id = '$id') group by emp_id";
            $res_2 = mysqli_query($this->connection, $sql_2);
            $row_2 = mysqli_fetch_array($res_2);
            if ($row_2 != "") {
               $pay_count = ($row_2['pcunt']);
            } else {
               $pay_count = 0;
            }

            $sql_3 = "SELECT sum(bonus) as bcunt FROM add_pay WHERE (emp_id = '$id') group by emp_id";
            $res_3 = mysqli_query($this->connection, $sql_3);
            $row_3 = mysqli_fetch_array($res_3);
            if ($row_3 != "") {
               $bonus = ($row_3['bcunt']);
            } else {
               $bonus = 0;
            }

            echo '<tr>
                        <td>' . $name . '</td>
                        <td>' . $phone_no . '</td>
                        <td>' . $basic . '</td> 
                        <td>' . $bonus . '</td>
                        <td>' . $cutting . '</td>
                        <td>' . $pay_count . '</td>
                        <td>';
            if ($session->userlevel == "8") {
               echo '
                              <a class="btn btn-secondary m-1 hover-zoom toggle-btn_1" href="view_salary_detail.php?id=' . $id . '">View Detail</a>';
            }
            echo '
                        </td>
                      </tr>';
         }
       
       
       
       
         if ($type == "employees") {
           
            $date_latest = 0; 
            $date = date('d-m-Y');
            $array = $this->get_latest_pay_details($row[0]);
            
            if ($array != "") {
              $id = ($array[0]);
              $date_latest = ($array[6]);
            } else {
              $id = "";
              
            }
            
           
              $date2 = date('d-m-Y', strtotime("1-".$date_latest."". ' + 1 month'));
               
              $array2 = $this->get_pay_details($row[0], $date2)??"";
                
              $id2 = ($array2[0])??"";
              $modal_id = "gg" . $row[0]??"";
               
            $modal_id_2 = "bb" . $row[0]??"";
            $leave = "";
             
            $array_leave = $this->get_leave_details($row[0])??"";
            
            $leave = ($array_leave[0])??"";
            $leave_count = 0;
            // $array_leave = $this->get_leave_count($row[0])??"";
            $leave_count = ($array_leave['empcnt'])??"";

            $value = "Are you sure you want to delete the employee?";
            $h_date = strtotime($row[5])??"";
            $p_date = strtotime($row[6])??"";
           
            echo '<tr>
            <td>' . $row[1] . '</td>
            <td>' . $row[2]. '</td>
            <td>' . $row[3] . '</td>
            <td>' . $row[4] . '</td>
            <td>' . date('d-m-Y', $h_date) . '</td>
            <td>' . date('d-m-Y', $p_date) . '</td>
             <td><img src="employee/images/' . $row[7] . '" alt="Employee Image" width="150" height="150"></img></td>
            <td><a href="employee/agreements/' . $row[8] . '">Agreement</a></td>
            <td>' . $date2 . '</td>
            <td>' . $leave_count . '</td>
            <td>';
            if ($session->userlevel == "8" && $row[9] == 0) {
              
              echo '
                  <a class="btn btn-secondary m-1 hover-zoom toggle-btn_1" href="edit_employees.php?id=' . $row[0] . '">Edit</a>
                  <a class="btn btn-danger m-1 hover-zoom toggle-btn_1" href="delete_emp.php?id=' . $row[0] . '">Delete</a><br>
                  ';

                  if ($leave == "") {
                     echo '
                        <br><a class="btn btn-secondary m-1 hover-zoom toggle-btn_1" href="employee_details.php?id=' . $row[0] . '&& month='.$date.'&&pay='.$row[4].'&&name='.$row[1].'">Details</a>
                     ';
                  }
   

               
            }
            if($row[9] != 0)
            {
              echo 'Deleted';
            }

            echo '
              </td>
         </tr>';

   
   
    
   
   
  
         }



  if ($type == "rooms") {

            echo '<tr><td>' . $row[0] . '</td><td>' . $row[4] . '</td><td>' . $row[1] . '</td><td>' . $row[2] . '</td><td>' . $row[3] . '</td>';
            if ($session->userlevel == "8") {

               echo '
  <td><a href="edit_rooms.php?id=' . $row[0] . '&rest_name=' . $row[4] . '&category=' . $row[1] . '&number=' . $row[2] . '&rate=' . $row[3] .'" class="btn btn-success m-1 hover-zoom toggle-btn_1">Edit</a> <a href="delete_rooms.php?id=' . $row[0] . '" class="btn btn-danger m-1 hover-zoom toggle-btn_1">Delete</a> </td>';
            } else {
               echo '<td>Only Admin Access</td>';
            }
            echo '

  </tr>';
         }














         if ($type == "view_inventory") {

            echo '<tr><td>' . $row[0] . '</td><td>' . $row[1] . '</td><td>' . $row[2] . '</td>';
            if ($session->userlevel == "8") {

               echo '
  <td><a href="edit_inventory.php?id=' . $row[0] . '&item=' . $row[1] . '&qty=' . $row[2] . '" class="btn btn-success m-1 hover-zoom toggle-btn_1">Edit</a> <a href="delete_inventory.php?id=' . $row[0] . '" class="btn btn-danger m-1 hover-zoom toggle-btn_1">Delete</a> </td>';
            } else {
               echo '<td>Only Admin Access</td>';
            }
            echo '

  </tr>';
         }
         if ($type == "get_all_cities") {
            echo '<option value="' . $row[0] . '">';
         }

         if ($type == "stp_fieldset_getnamereg") {
            echo '<option value="' . $row[0] . '">' . $row[1] . '</option>';
         }

         if ($type == "cavity_report") {
            echo ' <tr>
            <td>' . $row[0] . '</td>
            <td>' . $row[1] . '</td>
            <td class="count-me1">' . $row[2] . '</td>
            <td class="count-me">' . $row[3] . '</td>
            <td>' . $row[4] . '</td>
            <td>' . $row[5] . '</td>
        </tr>';
         }

         if ($type == "get_room") {
            echo '    <option value="' . $row[2] . '">' . $row[2] . '</option>';
         }

         if ($type == "get_orders_delivered") {
            $new_date_format = date('d-m-Y h:i:sa', strtotime('' . $row[5] . ''));
            echo '<tr class="content">
      <td>' . $row[3] . '</td>
       <td>' . $new_date_format . '</td>
      <td>' . $row[1] . '</td>
      <td>';
            $this->groupdata("get_order_item", $row[1], "", "", "");
            echo '</td>
      <td>' . $row[2] . '</td>
      <td>
      ';
            if ($row[4] == "" || $row[4] == "0") {
               echo '
         <form action="process.php" method="POST" enctype="multipart/form-data" >
         <input type="hidden" value="' . $row[1] . '" name="order_id">
         <button class="btn btn-danger m-1 hover-zoom toggle-btn_1" name="deleteorder">Delete</button>
         <button class="btn btn-success ml-2 m-1 hover-zoom toggle-btn_1" name="deliverorder">Mark As Delivered</button> <a href="edit_order.php?order_id=' . $row[1] . '&&room_no=' . $row[3] . '" class="btn btn-info m-1 hover-zoom toggle-btn_1" >Edit Order</a></td>
         </form>
         </tr>';
            } else {
               echo '
         Delivered ';

               if ($session->userlevel == 8) {
                  echo '
         <form action="process.php" method="POST" enctype="multipart/form-data" >
         <input type="hidden" value="' . $row[1] . '" name="order_id">
         <button class="btn btn-danger m-1 hover-zoom toggle-btn_1" name="deleteorder">Delete</button>
         
         </td>
         </form>';
               }
               echo '
         </tr></td>
         </form>
         </tr>';
            }
         }

         if ($type == "amount_recieved") {

            if ($row[3] == "Room") {
               $type = "Room bill receiving";
            } else {
               $type = "Restaurant bill receiving";
            }
            $ide = $this->rm_from_checkin($row[1]);

            echo '<tr><td>';
            $this->groupdata("get_rooms_list_grey", $ide, "", "", "");
            echo '</td><td>' . $row[2] . '</td><td>' . $type . '</td><td class="count-me">' . $row[4] . '</td></tr>';
         }

         if ($type == "res_p") {
            echo '<div class="col-4"><div class="card" style="width:400px">
    <div class="card-body">
      <h4 class="card-title">' . $row[3] . '</h4>
      <h4 class="card-text">';
            $this->groupdata("get_order_item", $row[1], "", "", "");
            echo '</h4>
    <form action="process.php" method="POST" enctype="multipart/form-data" >
         <input type="hidden" value="' . $row[1] . '" name="order_id">
         <button class="btn btn-danger m-1 hover-zoom toggle-btn_1" name="deleteorder">Delete</button>
         <button class="btn btn-success ml-2 m-1 hover-zoom toggle-btn_1" name="deliverorder">Mark As Delivered</button>
         </form>
     
    </div>
  </div></div>';
         }

         if ($type == "get_room_edit") {
            if ($row[2] == $var0) {
               echo '    <option value="' . $row[2] . '" selected >' . $row[2] . '</option>';
            } else {
               echo '    <option value="' . $row[2] . '">' . $row[2] . '</option>';
            }
         }
         if ($type == "food_cat_button") {
            echo '<button type="button" class="btn btn-dark m-1 hover-zoom toggle-btn_' . $row[0] . '" style="font-size:20px;" onclick="togglebtn_' . $row[0] . '()">' . $row[1] . '</button>';


            echo "<script>
                function togglebtn_" . $row[0] . "(){

               var state = $('#table_" . $row[0] . "').css('display');
               var total_tables = " . $num_rows . ";
total_tables++;


               if(state === 'block'){
                  $('#table_" . $row[0] . "').css('display','none');
               } else {
                   $('#table_" . $row[0] . "').css('display','block');


                   for (let i = 0; i < total_tables; i++) {
                  $('#table_'+i).css('display','none');
}

$('#table_" . $row[0] . "').css('display','block');

               }
         
    }


    </script>";
         }
         if ($type == "get_food_categories_edit") {
            echo '   <table class="table table-striped table-bordered" style="width: 575px; margin-left:10px; margin-top:20px;"><br>
                  <thead style="color: #184d40;">
                     <tr>';
            if ($row[0] == 2 || $row[0] == 4) {
               echo '<th >
                              ' . $row[1] . '
                        </th>
                     
                        <th>
                              Quantity
                        </th>
                  
                        <th >
                              Quantity
                        </th>
                        ';
            } else {
               echo '<th>
                              ' . $row[1] . '
                        </th>
                        <th >
                              Price 
                        </th>
                        <th  >
                              Quantity
                        </th>';
            }
            $this->groupdata("get_food_product_edit", $row[0], $var0, "", "");
            echo ' </tr>
                  </thead>
               </table>';
         }

         if ($type == "get_food_product_edit") {

            $result_get = $this->get_quantity($var1, $row[2]);

            if ($result_get != "") {
               $value_edit = $result_get['qty'];
            } else {
               $value_edit = "";
            }

            echo '    <tr>
         ';
            if ($var0 == 2 || $var0 == 4) {
               if ($row[3] == 0) {
                  echo '<th colspan="3" style="width:200px; " >' . $row[2] . '</th>';
               } else {
                  echo '<th style="width:200px; " >' . $row[2] . '</th>';
               }
            } else {
               echo '
            <th  style="width:200px; " >' . $row[2] . '</th>
            ';
            }
            if ($var0 == 2 || $var0 == 4) {
               if ($row[3] != 0) {
                  echo '<th id="hidden_div" >' . $row[3] . '</th>
                           <th id="hidden_div1"><div class="quantity">';
                  if ($value_edit != "") {
                     echo '<input type="number" name="item[]" step="1" value="' . $value_edit . '">';
                  } else {
                     echo '<input type="number" name="item[]" step="1" value="0">';
                  }
                  echo '
                           </div>
                           <input type="hidden" value="' . $row[2] . '" name="name1[]">
                           <input type="hidden" value="half" name="type[]">
                           <input type="hidden" value="' . $row[3] . '" name="price[]">
                           </th>';
                  echo '
                           <th >' . $row[4] . '</th>
                           <th><div class="quantity">';
                  if ($value_edit != "") {
                     echo '<input type="number" name="item[]" step="1" value="' . $value_edit . '">';
                  } else {
                     echo '<input type="number" name="item[]" step="1" value="0">';
                  }
                  echo '
                           </div>
                           <input type="hidden" value="' . $row[2] . '" name="name1[]">
                           <input type="hidden" value="full" name="type[]">
                           <input type="hidden" value="' . $row[4] . '" name="price[]">
                           </th>';
               } else {
                  echo '
                        <th  >' . $row[4] . '</th> 
                        <th><div class="quantity">';
                  if ($value_edit != "") {
                     echo '<input type="number" name="item[]" step="1" value="' . $value_edit . '">';
                  } else {
                     echo '<input type="number" name="item[]" step="1" value="0">';
                  }
                  echo '
                        </div>
                        <input type="hidden" value="' . $row[2] . '" name="name1[]">
                        <input type="hidden" value="full" name="type[]">
                        <input type="hidden" value="' . $row[4] . '" name="price[]">
                        </th>';
               }
            } else {
               echo '
                        <th  >' . $row[4] . '</th>
                        <th>
                        <div class="quantity">';
               if ($value_edit != "") {
                  echo '<input type="number" name="item[]" step="1" value="' . $value_edit . '">';
               } else {
                  echo '<input type="number" name="item[]" step="1" value="0">';
               }
               echo '
                        </div>
                        <input type="hidden" value="' . $row[2] . '" name="name1[]">
                        <input type="hidden" value="full" name="type[]">
                        <input type="hidden" value="' . $row[4] . '" name="price[]">
                        </th>';
            }
         }
            if ($type == "get_order_cavity") {
            $new_date_format = date('d-m-Y', strtotime('' . $row[5] . ''));


         echo '<tr class="row14">
                     <td class="column1 style3 null" style="font-size:30px;">' . $row[3] . '</td>
                     <td class="column2 style4 null" style="font-size:22px;">'; $this->groupdata("get_order_item", $row[1], "", "", ""); echo'</td>
             <input type="hidden" id="price" value="16" onchange="calc_t()" style="width:60px;border: none;font-size:25px;">
                     <td class="column4 style4 null" >' . $row[2] . '</td>
                     <td class="column5 style3 null" style="font-size:22px;">' . $row[5] . '</td>
                     <td class="column6">&nbsp;</td>
                   </tr>';


       
         }

         if ($type == "get_orders") {
            $new_date_format = date('d-m-Y h:i:sa', strtotime('' . $row[5] . ''));
            echo '<tr class="content">
      <td>' . $row[3] . '</td>
      <td>' . $new_date_format . '</td>
      <td>' . $row[1] . '</td>
      <td>';
            $this->groupdata("get_order_item", $row[1], "", "", "");
            echo '</td>
      <td>' . $row[2] . '</td>
      <td>
      ';
            if ($row[4] == "" || $row[4] == "0") {
               echo '
         <form action="process.php" method="POST" enctype="multipart/form-data" >
         <input type="hidden" value="' . $row[1] . '" name="order_id">
         <button class="btn btn-danger m-1 hover-zoom toggle-btn_1" name="deleteorder">Delete</button>
         <a href="restaurant_extra.php?order_id=' . $row[1] . '&&room_no=' . $row[3] . '&&total=' . $row[2] . '" class="btn btn-info m-1 hover-zoom toggle-btn_1" >Add extra Item</a>
         <button class="btn btn-success ml-2 m-1 hover-zoom toggle-btn_1" name="deliverorder">Mark As Delivered</button> <a href="edit_order.php?order_id=' . $row[1] . '&&room_no=' . $row[3] . '" class="btn btn-info m-1 hover-zoom toggle-btn_1" >Edit Order</a> <a href="cavity-resturant.php?order_id=' . $row[1] . '&&room_no=' . $row[3] . '" class="btn btn-info m-1 hover-zoom toggle-btn_1" >Print Cavity</a></td>
         </form>
         </tr>';
            } else {
               echo '
         Delivered </td>
         </form>
         </tr>';
            }
         }
         if ($type == "get_order_item") {
            if ($row[4] > 1) {
               echo $row[2] . ' (' . $row[4] . '), ';
            } else {
               echo $row[2] . ', ';
            }
         }

         if ($type == "get_food_categories") {

            if ($row[1] != "Breakfast") {

               echo '   
          

           <table class="table table-striped table-bordered" id="table_' . $row[0] . '" style="width: 500px; margin-left:10px; margin-top:20px; display:none;">


               
               <thead style="color: #184d40;">
                  <tr>';
               if ($row[0] == 2 || $row[0] == 4) {
                  echo '<th style=" color: Black;">
                  ' . $row[1] . '
                     </th>
                     
                     <th>
                           Quantity
                     </th>
                  
                     <th >
                           Quantity
                     </th>
                     ';
               } else {

                  echo '<th>
                  ' . $row[1] . '
                    
                     </th>
                     <th >
                           Quantity
                     </th>';
               }
            }

            if ($row[1] != "Breakfast") {
               $this->groupdata("get_food_product", $row[0], "", "", "");
            }
            echo ' </tr>
               </thead>
            </table>';
         }
         if ($type == "get_food_categories_breakfast") {

            if ($row[1] == "Breakfast") {

               echo '   <table class="table table-striped table-bordered" id="table_' . $row[0] . '" style="width: 500px; margin-left:10px; margin-top:20px; display:none;">
               <thead style="color: #184d40;">
                  <tr>';
               if ($row[0] == 2 || $row[0] == 4) {
                  echo '<th >
                           ' . $row[1] . '
                     </th>
                    
                     <th>
                           Quantity
                     </th>
                     
                     <th >
                           Quantity
                     </th>
                     ';
               } else {

                  echo '<th style="min-width: 403px;">
                           ' . $row[1] . '
                    
                     </th>
                  
                     <th>
                           Quantity
                     </th>';
               }
            }

            if ($row[1] == "Breakfast") {
               $this->groupdata("get_food_product", $row[0], "", "", "");
            }
            echo ' </tr>
               </thead>
            </table>';
         }

         if ($type == "get_food_product") {

            echo '<tr>';

            if ($var0 == 2 || $var0 == 4) {
               if ($row[3] == 0) {
                  if ($row[1] == 1) {
                     echo '<th colspan="5" style="height:10px;" >' . $row[2] . '</th>';
                  } else {

                     echo '<th colspan="3" style="height:10px;" >' . $row[2] . '</th>';
                  }
               } else {
                  echo '<th style="height:10px;user-select: none;"onclick="item_asd_' . $row[0] . '()">' . $row[2] . '</th>

                  <script>
function item_asd_' . $row[0] . '(){
   
   var a = document.getElementById("ada_' . $row[0] . '").value;
   var b = a++;

   document.getElementById("ada_' . $row[0] . '").value = a;
}
</script>';
               }
            } else {
               echo '
      <th  style="height:10px;user-select: none;"onclick="item_asd_' . $row[0] . '()">' . $row[2] . '</th>
<script>
function item_asd_' . $row[0] . '(){
   
   var a = document.getElementById("ada_' . $row[0] . '").value;
   var b = a++;

   document.getElementById("ada_' . $row[0] . '").value = a;
}
</script>

      ';
            }
            if ($var0 == 2 || $var0 == 4) {
               if ($row[3] != 0) {
                  echo '
                     <th id="hidden_div1"><div class="quantity">
                     <input type="number" name="item[]" step="1" value="0">
                     </div>
                     <input type="hidden" value="' . $row[2] . '" name="name1[]">
                     <input type="hidden" value="half" name="type[]">
                     <input type="hidden" value="' . $row[3] . '" name="price[]">
                     </th>';
                  echo '
                     
                     <th><div class="quantity">
                        <input type="number" name="item[]" step="1" value="0" id="ada_' . $row[0] . '">
                     </div>
                     <input type="hidden" value="' . $row[2] . '" name="name1[]">
                     <input type="hidden" value="full" name="type[]">
                     <input type="hidden" value="' . $row[4] . '" name="price[]">
                     </th>';
               } else {
                  echo '
                  
                  <th><div class="quantity">
                     <input type="number" name="item[]" step="1" value="0" id="ada_' . $row[0] . '">
                  </div>
                  <input type="hidden" value="' . $row[2] . '" name="name1[]">
                  <input type="hidden" value="full" name="type[]">
                  <input type="hidden" value="' . $row[4] . '" name="price[]">
                  </th>';
               }
            } else {
               echo '
                  
                  <th>
                  <div class="quantity">
                     <input type="number" name="item[]" step="1" value="0" id="ada_' . $row[0] . '">
                  </div>
                  <input type="hidden" value="' . $row[2] . '" name="name1[]">
                  <input type="hidden" value="full" name="type[]">
                  <input type="hidden" value="' . $row[4] . '" name="price[]">
                  </th>';
            }
         }
         if ($type == "get_rooms_list") {
            $lastElement = end($row);
            if ("1" == $num_rows || $row['3'] == $lastElement) {
               echo $row['3'];
            } else {
               echo $row['3'] . ', ';
            }
         }
         if ($type == "get_rooms_list_grey") {
            $lastElement = end($row);
            if ("1" == $num_rows || $row['3'] == $lastElement) {

               echo '<span style="border: 1px solid grey; background-color: #c5c5c5; margin:2px;"> ' . $row['3'] . ' </span>';
            } else {
               echo '<span style="border: 1px solid grey; background-color: #c5c5c5; margin:2px;"> ' . $row['3'] . ' </span>';
            }

            if ($i > 2) {
               if ($i % 3 == 0) {
                  echo "<br>";
               }
            }
         }

         if ($type == "get_reserved_list_grey") {
            $lastElement = end($row);
            if ("1" == $num_rows || $row['3'] == $lastElement) {

               echo '<span style="border: 1px solid grey; background-color: #c5c5c5; margin:2px;"> ' . $row['3'] . ' </span>';
            } else {
               echo '<span style="border: 1px solid grey; background-color: #c5c5c5; margin:2px;"> ' . $row['3'] . ' </span>';
            }

            if ($i > 2) {
               if ($i % 3 == 0) {
                  echo "<br>";
               }
            }
         }
         if ($type == "get_reserved_list") {
            $lastElement = end($row);
            if ("1" == $num_rows || $row['3'] == $lastElement) {

               echo $row['3'];
            } else {
               echo $row['3'].", ";
            }

            if ($i > 2) {
               if ($i % 3 == 0) {
                  echo "<br>";
               }
            }
         }
         if ($type == "reservation") {
            $new_date_format = date('d-m-Y', strtotime('' . $row[6] . ''));
            $new_date_format1 = date('d-m-Y', strtotime('' . $row[7] . ''));
            $earlier = new DateTime($row[6]);
            $later = new DateTime($row[7]);

            $abs_diff = $later->diff($earlier)->format("%a");
            $abs_diff = $abs_diff + 1;

         

            $date1 = new DateTime($new_date_format);
            $date2 = new DateTime($new_date_format1);
            $dayss = $date2->diff($date1)->format('%a');

        

      

            echo '<tr>
         <td>';
            $this->groupdata("get_reserved_list_grey", $row[3], "", "", "");
            echo '</td>
         <td>' . $row[1] . '</td>
         <td>' . $new_date_format . '<br><b>'.$dayss.' Night(s)</b></td>
         <td>' . $new_date_format1 . '</td>
         <td>' . $row[2] . '</td>
         <td>' . $row[10] . '</td>
         
         <td>';
         $new_modal = $row[0];
        
            if ($session->userlevel == "8") {
               echo '<a class="btn btn-danger" href="deletereservation.php?index=reservation&id=' . $row[0] . '">Delete</a> <a class="btn btn-secondary m-1 hover-zoom toggle-btn_1" href="editreservation.php?id=' . $row[0] . '">Edit</a><a href="#exampleModal" data-toggle="modal" data-target="#exampleModal' . $row[0] . '" class="submit btn btn-info" >Check In</a>';
            }else{
               echo '
            <a href="#exampleModal" data-toggle="modal" data-target="#exampleModal' . $row[0] . '" class="submit btn btn-info" >Check In</a>
            <a href="editreservationuser.php?index=reservation&id=' . $row[0] . '" class="submit btn btn-secondary m-1 hover-zoom toggle-btn_1" >Edit</a>
            </td>
      </tr>';
            }
            echo '
            <!-- Modal -->
            
         <div class="modal fade" id="exampleModal' . $row[0] . '" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
         
         <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel" style="display: inline-block; ">Add To CheckIns From Reservation</h5>
               <button type="button" class="close m-1 hover-zoom toggle-btn_1" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
              <br>
            </div>';
                     echo "
            <div class='modal-body' >";
                     echo '
                     <form action="process.php" method="post">
                  <label for="cnc">CNIC</label>
                  <input type="text" class="form-control" value="' . $row[4] . '" name="cnic" id="cnc"/><br>
                  <label for="f2">Rate</label>
                   <input type="text" class="form-control" readonly="" value="' . $row[10] . '">
                  
                  <input type="hidden" class="form-control" readonly="" value="' . $row[0] . '" name="checkin_id">
                  <input type="hidden" class="form-control" readonly="" value="' . $row[3] . '" name="rooms_id">
                  <input type="hidden" class="form-control" readonly="" value="' . $row[1] . '" name="name">
                  <input type="hidden" class="form-control" readonly="" value="' . $row[2] . '" name="numbere">
                  <input type="hidden" class="form-control" readonly="" value="' . $row[3] . '" name="room_type"><br>
                  <input type="hidden" class="form-control" readonly="" value="' . $row[6] . '" name="date">
                  <input type="hidden" class="form-control" readonly="" value="' . $row[6] . '" name="t_days">
                  <label for="f2">Advance</label>
                  <input type="text" class="form-control" readonly="" value="' . $row[11] . '" name="advance"><br>
                  <label for="f2">Price</label>
                  <input type="text" class="form-control" readonly="" value="' . $row[10] . '" name="price"><br>
                  <input type="hidden" class="form-control" readonly="" value="' . $row[9] . '" name="discount"><br>
                  <input type="hidden" class="form-control" readonly="" value="' . $row[8] . '" name="rate">
                  <label>Rooms </label>';
         
                     $this->groupdata("get_reserved_list_grey", $row[3], "", "", "");
                     echo '<br>
                  <input type="hidden" class="form-control" readonly="" value="' . $row[5] . '" name="city"><br>
                  <input type="text" class="form-control"  readonly="" value="' . $row[6] . '" name="date"><br>
                  <input type="hidden" class="form-control" value="' . $abs_diff . '" name="t_days"><br>
                  <input type="submit" name="add_to_checkin" class="btn btn-info m-1 hover-zoom toggle-btn_1" value="Add To CheckIn">
                  </form>
            </div>
            <div class="modal-footer">
             </div>
          </div>
         </div>
         </div>
         
         </div> ';
            
         }
         if ($type == "checkins") {

            if ($row[12] == $row[9]) {
               $color = "style='color:green;font-weight:500;'";
            } else {
               $color = "style='color:red;font-weight:500;'";
            }

            $v = $i + 1;
          
            $new_date_format = date('d-m-Y', strtotime('' . $row[4] . ''));
            
            if ($row[13] == "0") {
               $checkout_status = '<span style="color:red;">Not Checked out</span>';
            } else {
               $checkout_status = '<span style="color:green;">Checked out</span>';
            }
              if($row[9]==""){
                  $row[9] = "0";
              }
            $left_amt = $row[9] - $row[12];

            $new_date_format1 = date('d-m-Y', strtotime('' . $row[5] . ''));
            $new_date_format1 = date('d-m-Y', (strtotime('+0 day', strtotime($new_date_format1))));

            $new_date_format11 = date('d-m-Y', strtotime('' . $row[5] . ''));

            $date1 = new DateTime($new_date_format);
            $date2 = new DateTime($new_date_format1);
            $dayss = $date2->diff($date1)->format('%a');

            if ($new_date_format11 < date('d-m-Y')) {
               $c = 'class="blink_me"';
            } else {
               $c = "";
            }

            $mystring = $row[1];
$findme   = 'jpg';
if($session->contains($mystring, $findme)){
    $name = '<img src="../img/'.$row[1].'" width="170px">';
} else {
    $name = $row[1];
}

            echo '<tr><td style="font-size: 40px;background-color: #c5c5c5;">' . $v . '</td><td>';
            $this->groupdata("get_rooms_list_grey", $row[6], "", "", "");
            echo '</td>
            <td>' . $name . '</td>
            <td>' . $new_date_format . '<br><b>' . $dayss . ' Nights</b></td>
            <td ' . $c . '>' . $new_date_format11 . ' (12:00)</td>
            <td ' . $color . '>' . $row[12] . '/' . $row[9] . '  Remaining Amount: ' . $left_amt . '</td>
            <td><a href="checkout.php?id=' . $row[0] . '&name=' . $row[1] . '&number=' . $row[11] . '" class="btn btn-danger hover-zoom">Checkout</a></td>
            <td><a href="bill.php?id=' . $row[0] . '&id1=' . $row[6] . '&total=' . $row[9] . '&advance=' . $row[12] . '&rm=' . $row[6] . '&name=' . $row[1] . '&date_in=' . $row[4] . '&date_out=' . $row[5] . '&rooms=';
            $this->groupdata("get_rooms_list", $row[6], "", "", "");
            echo '" class="btn btn-info hover-zoom m-1" id="rm_rm">Print Bill</a> <a href="edit_checkin.php?id=' . $row[0] . '" class="btn btn-secondary hover-zoom">Edit</a> ';
            if ($session->userlevel == "8") {
               echo '
<a href="delete_cin.php?id=' . $row[0] . '" class="btn btn-danger hover-zoom">Delete</a> 

';
            }

            echo '
            
            </td></tr>
';
         }

         if ($type == "Recieveing_By") {

            if ($row[3] == "Room") {
               $type = "Rooms Bill Receiving";
            } else {
               $type = "Resturant Bill Receiving";
            }

            $new_date_format = date('d-m-Y', strtotime('' . $row[5] . ''));

            echo '<tr><td>';

            echo '</td><td>' . $row[2] . '</td><td>' . $type . '</td><td>' . $row[4] . '</td><td>' . $row[5] . '</td><td><a href="recieve_admin.php?id=' . $row[0] . '"</td></tr>
';
         }

         if ($type == "get_notification_item") {

            echo "<li>Pending Payment of room ";
            echo $this->groupdata("get_rooms_list", $row[6], "", "", "");

            echo '
            <a href="add_recieving.php?id=' . $row[6] . '&total=' . $row[9] . '&advance=' . $row[12] . '" class="btn btn-primary hover-zoom">Recieve Amount</a>
            
            </li>
';
         }

         if ($type == "checkins_clean") {

            $v = $i + 1;
            if ($row[13] == "1") {
               $checkout_status = '<span style="color:red;">Not Cleaned</span>';
            }

            echo '<tr><td style="font-size: 40px;background-color: #c5c5c5;">' . $v . '</td><td>';
            $this->groupdata("get_rooms_list_grey", $row[6], "", "", "");
            echo '</td><td>' . $row[1] . '</td><td>' . $checkout_status . '</td><td><a href="change_st.php?id=' . $row[0] . '" class="btn btn-info hover-zoom m-1">Cleaned</a></td></tr>
';
         }

         if ($type == "checkins_reports_unpaid") {

            if ($row[12] == $row[9]) {
               $color = "style='color:green;font-weight:500;'";
            } else {
               $color = "style='color:red;font-weight:500;'";
            }
            $v = $i + 1;
            $new_date_format = date('d-m-Y', strtotime('' . $row[4] . ''));
            if ($row[13] == "0") {
               $checkout_status = '<span style="color:red;">Not Checked out</span>';
            } else {
               $checkout_status = '<span style="color:green;">Checked out</span>';
            }

            echo '<tr>
<td>';
            $this->groupdata("get_rooms_list_grey", $row[6], "", "", "");
            echo '</td>
<td>' . $row[1] . '</td>
<td>' . $new_date_format . '</td>
<td class="count-me">' . $row[9] . '</td>
<td class="count-me1">' . $row[12] . '</td>
<td><a href="add_recieving_new.php?id=' . $row[6] . '&total=' . $row[9] . '&advance=' . $row[12] . '" class="btn btn-primary hover-zoom">Recieve Amount</a> <a href="bill.php?id=' . $row[0] . '&id1=' . $row[6] . '&total=' . $row[9] . '&advance=' . $row[12] . '&rm=' . $row[6] . '&name=' . $row[1] . '&date_in=' . $row[4] . '&date_out=' . $row[5] . '&rooms=';
            $this->groupdata("get_rooms_list", $row[6], "", "", "");
            echo '" class="btn btn-info hover-zoom m-1" id="rm_rm">Print Bill</a>';
            echo '</td>
</tr>
';
         }
         if ($type == "checkins_reports_unpaid_count") {

            return $num_rows;
         }

         if ($type == "checkins_reports") {

            if ($row[12] == $row[9]) {
               $color = "style='color:green;font-weight:500;'";
            } else {
               $color = "style='color:red;font-weight:500;'";
            }
            $v = $i + 1;
            $new_date_format = date('d-m-Y', strtotime('' . $row[4] . ''));
            if ($row[13] == "0") {
               $checkout_status = '<span style="color:red;">Not Checked out</span>';
            } else {
               $checkout_status = '<span style="color:green;">Checked out</span>';
            }
            $new_date_format1 = date('Y-m-d', strtotime('' . $row[5] . ''));
            $new_date_format1 = date('Y-m-d', (strtotime('+1 day', strtotime($new_date_format1))));
            $date1 = new DateTime($row[4]);
            $date2 = new DateTime($new_date_format1);
            $dayss = $date2->diff($date1)->format('%a');
            $total = $row[9] / $dayss;

            echo '<tr>
<td>';
            $this->groupdata("get_rooms_list_grey", $row[6], "", "", "");
            echo '</td>
<td>' . $row[1] . '</td>
<td>' . $row[4] . '</td>
<td>' . $row[2] . '</td>
<td>' . $row[11] . '</td>
<td class="count-me">' . $total . '</td>
<td class="count-me1">' . $row[12] . '</td>
<td>' . $row[14] . '</td>
<td><a href="addcheckin.php?name=' . $row[1] . '&cnic=' . $row[2] . '&number=' . $row[11] . '" class="btn btn-info hover-zoom">ReCheckin</a>';
            if ($session->userlevel == "8") {
               echo '
<a href="delete_cin.php?id=' . $row[0] . '" class="btn btn-danger hover-zoom">Delete</a> ';
            }
            echo '</td>
</tr>
';
         }

         if ($type == "checkins_reports_all") {

            if ($row[12] == $row[9]) {
               $color = "style='color:green;font-weight:500;'";
            } else {
               $color = "style='color:red;font-weight:500;'";
            }
            $v = $i + 1;
            $new_date_format = date('Y/m/d', strtotime('' . $row[4] . ''));
            if ($row[13] == "0") {
               $checkout_status = '<span style="color:red;">Not Checked out</span>';
            } else {
               $checkout_status = '<span style="color:green;">Checked out</span>';
            }

            echo '<tr>
<td>';
            $this->groupdata("get_rooms_list_grey", $row[6], "", "", "");
            echo '</td>
<td>' . $row[1] . '</td>
<td>' . $new_date_format . '</td>
<td>' . $row[2] . '</td>
<td>' . $row[11] . '</td>
<td class="count-me">' . $row[9] . '</td>
<td class="count-me1">' . $row[12] . '</td>
<td>' . $row[14] . '</td>
<td>
    <a href="bill.php?id=' . $row[0] . '&id1=' . $row[6] . '&total=' . $row[9] . '&advance=' . $row[12] . '&rm=' . $row[6] . '&name=' . $row[1] . '&date_in=' . $row[4] . '&date_out=' . $row[5] . '&rooms=';
$this->groupdata("get_rooms_list", $row[6], "", "", "");
echo '" class="btn btn-info hover-zoom m-1" id="rm_rm">Print Bill</a>
<a href="addcheckin.php?name=' . $row[1] . '&cnic=' . $row[2] . '&number=' . $row[11] . '" class="btn btn-info hover-zoom">ReCheckin</a>



</td>
</tr>
';
         }

         if ($type == "checkins_reports_police") {

            if ($row[12] == $row[9]) {
               $color = "style='color:green;font-weight:500;'";
            } else {
               $color = "style='color:red;font-weight:500;'";
            }
            $v = $i + 1;
            $new_date_format = date('d-m-Y', strtotime('' . $row[4] . ''));
            if ($row[13] == "0") {
               $checkout_status = '<span style="color:red;">Not Checked out</span>';
            } else {
               $checkout_status = '<span style="color:green;">Checked out</span>';
            }

            echo '<tr>
<td>';
            $this->groupdata("get_rooms_list_grey", $row[6], "", "", "");
            echo '</td>
<td>' . $row[1] . '</td>
<td>' . $row[4] . '</td>
<td>' . $row[2] . '</td>
<td>' . $row[11] . '</td>

<td>' . $row[14] . '</td>
<td>
    <a href="bill.php?id=' . $row[0] . '&id1=' . $row[6] . '&total=' . $row[9] . '&advance=' . $row[12] . '&rm=' . $row[6] . '&name=' . $row[1] . '&date_in=' . $row[4] . '&date_out=' . $row[5] . '&rooms=';
$this->groupdata("get_rooms_list", $row[6], "", "", "");
echo '" class="btn btn-info hover-zoom m-1" id="rm_rm">Print Bill</a>
<a href="addcheckin.php?name=' . $row[1] . '&cnic=' . $row[2] . '&number=' . $row[11] . '" class="btn btn-info hover-zoom">ReCheckin</a>



</td>
</tr>
';
         }

         if ($type == "resturants_reports") {

            echo '<tr>
<td>' . $row[0] . '</td>
<td>' . $row[3] . '</td>
<td>' . $row[5] . '</td>
<td class="count-me">' . $row[3] . '</td>
<td>' . $row[6] . '</td>
</tr>
';
         }
         // END Out of CKRF

      }
   }

   //get rooms against rooms id
   function rm_rooms($id)
   {
      $q = "SELECT * FROM room WHERE rooms_id = '$id'";
      $result = mysqli_query($this->connection, $q);

      return $dbarray = mysqli_fetch_all($result);
   }

   function rm($id)
   {
      $q = "SELECT * FROM room WHERE rooms_id = '$id'";
      $result = mysqli_query($this->connection, $q);

      $dbarray = mysqli_fetch_all($result);

      //get checkin
      $q = "SELECT * FROM checkin WHERE rooms_id = '$id'";
      $resultx = mysqli_query($this->connection, $q);
      $checkin = mysqli_fetch_all($resultx);

      $num = mysqli_num_rows($result);
      for ($i = 0; $i < $num; $i++) {
         echo ' <article>
      <h2>Name:</h2>
     <p> <input type="text" value="' . $dbarray[$i][4] . '"></p>

      <h3>Room(s):</h3>
      <p>' . $dbarray[$i][3] . '</p>

      <h4>PKR.';

         $rate = $this->get_rate($dbarray[$i][3]);
         $total = $checkin[0][7];
         $discount = $checkin[0][8];
         $a = $discount / $total * 100;
         $discount_value = ($rate / 100) * $a;
         $new_price = $rate - $discount_value;
         echo (int)$new_price . '/-</h4>
      <ul>
        <li>Tax: included</li>
        <li>Reciept No. ' . $checkin[0][0] . '</li>
        <li>Date: ' . $checkin[0][4] . '</li>
      </ul>

    </article><br>';
      }
   }

   ///////END Custom Functions
   function get_quantity($val1, $val2)
   {

      $r = "SELECT * FROM `order_menu` WHERE `order_id`= '$val1' AND `name` = '$val2' order BY id DESC LIMIT 1";
      $result_edit = mysqli_query($this->connection, $r);

      if (!$result_edit || (mysqli_num_rows($result_edit) < 1)) {
         return NULL;
      }

      $dbarray_edit = mysqli_fetch_array($result_edit);
      return $dbarray_edit;
   }

   function delete_orders($order_id)
   {
      $order_id = str_replace('&lt;', "~", str_replace('<', "~&gt;", strip_tags(mysqli_real_escape_string($this->connection, $order_id))));
      $q = "DELETE FROM order_menu WHERE order_id = '$order_id'";
      mysqli_query($this->connection, $q);
   }

   function update_orders_edit($total_price, $order_id, $roomno)
   {
      $total_price = str_replace('&lt;', "~", str_replace('<', "~&gt;", strip_tags(mysqli_real_escape_string($this->connection, $total_price))));
      $order_id = str_replace('&lt;', "~", str_replace('<', "~&gt;", strip_tags(mysqli_real_escape_string($this->connection, $order_id))));
      $roomno = str_replace('&lt;', "~", str_replace('<', "~&gt;", strip_tags(mysqli_real_escape_string($this->connection, $roomno))));
      $q = "Update orders SET total='$total_price', room_number='$roomno' WHERE order_id = '$order_id' ";
      mysqli_query($this->connection, $q);
   }

   function getUserInfo($username)
   {
      $username = str_replace('&lt;', "~", str_replace('<', "~&gt;", strip_tags(mysqli_real_escape_string($this->connection, $username))));
      $q = "SELECT * FROM " . TBL_USERS . " WHERE username = '$username'";
      $result = mysqli_query($this->connection, $q);

      if (!$result || (mysqli_num_rows($result) < 1)) {
         return NULL;
      }

      $dbarray = mysqli_fetch_array($result);
      return $dbarray;
   }

   function getUserOnly($username)
   {
      $username = str_replace('&lt;', "~", str_replace('<', "~&gt;", strip_tags(mysqli_real_escape_string($this->connection, $username))));
      $q = "SELECT username FROM " . TBL_USERS . " WHERE username = '$username'";
      $result = mysqli_query($this->connection, $q);

      if (!$result || (mysqli_num_rows($result) < 1)) {
         return NULL;
      }

      $dbarray = mysqli_fetch_array($result);
      return $dbarray;
   }

   function get_t_reservations()
   {
      $t = date("Y-m-d");
      $q = "SELECT * FROM reservations WHERE `date_in` = '$t'";
      return mysqli_num_rows(mysqli_query($this->connection, $q));
   }
   function get_tot_reservations()
   {

      $q = "SELECT * FROM reservations";
      return mysqli_num_rows(mysqli_query($this->connection, $q));
   }
   function get_rooms()
   {

      $q = "SELECT * FROM rooms";
      return mysqli_num_rows(mysqli_query($this->connection, $q));
   }

   function get_t_checkins()
   {
      $t = date("Y-m-d");
      $q = "SELECT * FROM checkin WHERE `date_in` = '$t' AND checkout_status = 0 ";
      return mysqli_num_rows(mysqli_query($this->connection, $q));
   }
   function get_unpaid_orders()
   {
       global $session;
      $q = "SELECT * FROM `checkin` WHERE `checkout_status` <> 0 AND receiving_status = 0";

      $array = mysqli_fetch_all(mysqli_query($this->connection, $q));

      $num = mysqli_num_rows(mysqli_query($this->connection, $q));

      $checkin_ids = array();

      for ($i = 0; $i < $num; $i++) {
         $c_id = $array[$i][0];
         $name = $array[$i][1];
         $room_bill = $array[$i][9];
         $advance = $array[$i][12];
         $rmN = $ary[$i][3];
         $date_in = $array[$i][4];
         $date_out = $array[$i][5];
         $rooms_id = $array[$i][6];

     

         $dates_from_user = $this->getDatesFromRange($date_in, $date_out);

         $rooms_from_rooms_id = array();

         $q1 = "SELECT * FROM `room` WHERE `rooms_id` = '$rooms_id' order by `room_number`";

         $result = mysqli_query($this->connection, $q1);

         $ary = mysqli_fetch_all($result);

         $nume = mysqli_num_rows($result);

         for ($i1 = 0; $i1 < $nume; $i1++) {
            array_push($rooms_from_rooms_id, $ary[$i1][3]);
         }

        

            $array_of_array = array();

            $query_where_condition = "SELECT * FROM `orders` WHERE (name = '$name' AND status = 1 AND room_number = $rooms_from_rooms_id[0]) AND";
            foreach ($dates_from_user as $index => $date) {
               if ($index == 0) {
                  $query_where_condition .= "(date(date_a) = '$date'";
               } else {
                  $query_where_condition .= " OR date(date_a) = '$date'";
               }
            }
            $query_where_condition .= ")";
           
            $array_of_array[$key] = mysqli_fetch_all(mysqli_query($this->connection, $query_where_condition));

            $total = 0;
            foreach ($array_of_array[$key] as $idid => $valval) {
              $extra = $valval[7];
               $new_t = $valval[2]-$valval[7];
               
               $total += $new_t;
               
            }
           
           

               $qeq = "SELECT * FROM `resturant_bills` WHERE `rooms_id` = '$rooms_id'";
    
               $row = mysqli_fetch_all(mysqli_query($this->connection, $qeq));

               $row_num = mysqli_num_rows(mysqli_query($this->connection, $qeq));
               $received = 0;
               if ($row_num < 1) {
                  $received = 0;
               } else {

                  for ($i525 = 0; $i525 < $row_num; $i525++) {
                     $received += $row[$i525][4];
                  }
               }

              
               //if ($received == 0 || $received < $total) {
                  $total_p = (15 / 100) * $total + $total;
                  $total = $total_p + $extra;
                  $rest_rema = $room_bill-$advance;
                  $total = $total + $received;
                  $new_recieved = $advance + $received;
                 
                 $ord_rem = $total - $received;
                 $new_bill =  $rest_rema +$ord_rem;
                 $new_bill_tot =  $total +$room_bill;
                  $date_in = date("d-m-Y", strtotime($date_in));
                  
                  if($new_bill != 0){
                   
                  $a++;
                  }  
               //}
                 
               
            
         
      }
      return $a;
   }

   function get_t_orders()
   {
      $t = date("Y-m-d");
      $q = "SELECT * FROM orders WHERE `date_a` = '$t'";
      return mysqli_num_rows(mysqli_query($this->connection, $q));
   }
   function get_t_orders_live()
   {
      $q = "SELECT * FROM `orders` WHERE `Status` = 0";
      $num = mysqli_num_rows(mysqli_query($this->connection, $q));

      if ($num > 0) {
         echo '<span class="badge badge-pill badge-danger blink_me">' . $num . '</span>';
      } else {
         echo '<span class="badge badge-pill badge-danger">' . $num . '</span>';
      }
   }
   function get_leave()
   {
      $myYearMonth = $_GET['month'];
      $id = $_GET['id'];

$start = new DateTime(date('Y-m-01', strtotime($myYearMonth)));
$end = new DateTime(date('Y-m-t', strtotime($myYearMonth)));
$date_start = $start->format( "d-m-Y" );
$date_end = $end->format( "d-m-Y" );

$q = "SELECT SUM(leave_emp) as sum_leave,SUM(bonus) as sum_bonus,SUM(advance) as sum_advance FROM employee_date_details WHERE date >= '$date_start' AND date <= '$date_end' AND emp_id = $id";

$query = mysqli_query($this->connection, $q);

   $row = mysqli_fetch_array($query);
   $sum_leave = $row['sum_leave'];
return $sum_leave;

      
   }
   function get_bonus()
   {
      $myYearMonth = $_GET['month'];
      $id = $_GET['id'];

$start = new DateTime(date('Y-m-01', strtotime($myYearMonth)));
$end = new DateTime(date('Y-m-t', strtotime($myYearMonth)));
$date_start = $start->format( "d-m-Y" );
$date_end = $end->format( "d-m-Y" );

$q = "SELECT SUM(leave_emp) as sum_leave,SUM(bonus) as sum_bonus,SUM(advance) as sum_advance FROM employee_date_details WHERE date >= '$date_start' AND date <= '$date_end' AND emp_id = $id";

$query = mysqli_query($this->connection, $q);

   $row = mysqli_fetch_array($query);
   $sum_advance = $row['sum_bonus'];
return $sum_advance;

      
   }
   function get_advance()
   {
      $myYearMonth = $_GET['month'];
      $id = $_GET['id'];

$start = new DateTime(date('Y-m-01', strtotime($myYearMonth)));
$end = new DateTime(date('Y-m-t', strtotime($myYearMonth)));
$date_start = $start->format( "d-m-Y" );
$date_end = $end->format( "d-m-Y" );

$q = "SELECT SUM(leave_emp) as sum_leave,SUM(bonus) as sum_bonus,SUM(advance) as sum_advance FROM employee_date_details WHERE date >= '$date_start' AND date <= '$date_end' AND emp_id = $id";

$query = mysqli_query($this->connection, $q);

   $row = mysqli_fetch_array($query);
   $sum_advance = $row['sum_advance'];
return $sum_advance;

      
   }
   function get_available_rooms()
   {
      date_default_timezone_set('Asia/Karachi');
      $t = date("Y-m-d");
      $q = "SELECT * FROM checkin WHERE `date_in` = '$t' AND checkout_status = 0";
      
      $result = mysqli_query($this->connection, $q);
      $ary = mysqli_fetch_all($result);
      $num = mysqli_num_rows($result);
      $rooms_taken = array();
      for ($i = 0; $i < $num; $i++) {
         array_push($rooms_taken, $ary[$i][6]);
      }
    
      $rooms_t = array();
      foreach ($rooms_taken as $key => $value) {
         $rooms_t[$key] = $this->rooms_against_roomid($value);
      }
 
      $rooms_final_taken = array();
      for ($i = 0; $i < count($rooms_t); $i++) {
         foreach ($rooms_t[$i] as $key => $value) {
            array_push($rooms_final_taken, $value);
         }
      }
 
      $all_rooms = $this->rooms_all();

      $result = array_diff($all_rooms, $rooms_final_taken);

      return count($result);
      // return $result;

   }

   function get_room_price($room_num)
   {
      $q = "SELECT * FROM rooms WHERE `number` = '$room_num'";
      $row = mysqli_fetch_row(mysqli_query($this->connection, $q));
      return $row;
   }
   function checkin_id_from_rm($value)
   {
      $q = "SELECT * FROM checkin WHERE rooms_id = '$value'";
      $row = mysqli_fetch_row(mysqli_query($this->connection, $q));
      return $row[0];
   }

   function rm_from_checkin($value)
   {
      $q = "SELECT * FROM checkin WHERE id = '$value'";
      $row = mysqli_fetch_row(mysqli_query($this->connection, $q));
      return $row[6];
   }

   function add_recieving($checkin, $type, $amount)
   {
      global $session;
      $username = $session->username;

      if ($session->userlevel == 8) {
         $st = 1;
      } else {
         $st = 0;
      }
      $date = date('Y-m-d');
   
      if ($amount != 0) {

         $q = "INSERT INTO `receiving`(`checkin_id`, `username`, `type`, `amount`, `date`, `recieved_status`) VALUES ('$checkin','$username','$type','$amount','$date','$st')";

         return mysqli_query($this->connection, $q);
      } else {
         return 0;
      }
   }

   function add_recieving11($checkin, $type, $amount)
   {
      global $session;
      $username = $session->username;

      if ($session->userlevel == 8) {
         $st = 1;
      } else {
         $st = 0;
      }
      $date = date('Y-m-d');
      $q1 = "Update `checkin` set receiving_status='1' where id='$checkin'";
      mysqli_query($this->connection, $q1);
      if ($amount != 0) {

         $q = "INSERT INTO `receiving`(`checkin_id`, `username`, `type`, `amount`, `date`, `recieved_status`) VALUES ('$checkin','$username','$type','$amount','$date','$st')";

         return mysqli_query($this->connection, $q);
      } else {
         return 0;
      }
   }

   function get_order_total($room_id, $name, $date_in, $date_out)
   {

      $dates_from_user = $this->getDatesFromRange($date_in, $date_out);
      $array = $this->rooms_against_roomid($room_id);

      $row = array();
      foreach ($array as $id => $value) {
         $query_where_condition = "SELECT * FROM `orders` WHERE room_number = '$value' AND ";

         foreach ($dates_from_user as $index => $date) {
            if ($index == 0) {
               $query_where_condition .= " date_a = '$date'";
            } else {
               $query_where_condition .= " OR date_a = '$date'";
            }
         }

         array_push($row, mysqli_fetch_all(mysqli_query($this->connection, $query_where_condition . "AND name = '$name'")));
      }
      return $row;
   }

   function chart_available($t, $t_out)
   {

      $result = $this->get_only_available_rooms($t, $t_out);
      foreach ($result as $key => $value) {
         $room = $this->get_room_category($value);
         if ($room == "Family Suite") {
            $s = "h3";
         } else {
            $s = "h1";
         }

         echo '<div class="col-2 m-1 room_bg">
        <' . $s . '>' . $value . '</' . $s . '>
        <h6>' . $room . '</h6>
      </div>';
      }

      // return $result;

   }

   function report_amount($date)
   {

      $q = "SELECT * FROM receiving WHERE recieved_status = '1' AND date = '$date' order by id ASC";

      $row = mysqli_fetch_all(mysqli_query($this->connection, $q));

      for ($i = 0; $i < mysqli_num_rows(mysqli_query($this->connection, $q)); $i++) {
         if ($row[$i][3] == "Room") {
            $type = "Room bill receiving";
         } else {
            $type = "Restaurant bill receiving";
         }
         $ide = $this->rm_from_checkin($row[$i][1]);
         if($ide == ""){
            $ide = $row[$i][1];
         }
         echo '<tr><td>';
         $this->groupdata("get_rooms_list_grey", $ide, "", "", "");
         echo '</td><td>' . $row[$i][2] . '</td><td>' . $type . '</td><td class="count-me">' . $row[$i][4] . '</td><td class="count-me">' . $row[$i][5] . '</td></tr>';
      }
   }

   function rec_amount($type)
   {

      $q = "SELECT * FROM receiving WHERE recieved_status = '0' AND type = '$type' order by id DESC";

      $row = mysqli_fetch_all(mysqli_query($this->connection, $q));

      for ($i = 0; $i < mysqli_num_rows(mysqli_query($this->connection, $q)); $i++) {
         if ($row[$i][3] == "Room") {
            $type = "Room bill receiving";
         } else {
            $type = "Restaurant bill receiving";
         }
         $ide = $this->rm_from_checkin($row[$i][1]);

         $date = date('Y-m-d');
         echo '<tr><td>';
         $this->groupdata("get_rooms_list_grey", $ide, "", "", "");
         echo '</td><td>' . $row[$i][2] . '</td><td class="count-me">' . $row[$i][4] . '</td><td>' . $row[$i][5] . '</td><td><a href="rec_amt_ajx.php?id=' . $row[$i][0] . '&date=' . $date . '" class="btn" style="background-color:crimson;color:white;">Recieve</a></td></tr>';
      }
   }

 function recieve_amount_all($user) {
      $date = date('Y-m-d');
   $q = "UPDATE `receiving` SET `recieved_status`= '1', `date` = '$date' WHERE `username` = '$user' AND `recieved_status`= '0'";
      return mysqli_query($this->connection, $q);
   }

   function recAmountCollective($user){
      $q = "SELECT * FROM receiving WHERE username = '$user' AND recieved_status = '0' GROUP BY `checkin_id`";
      $result = mysqli_query($this->connection, $q);
      $array = mysqli_fetch_all($result);
      return $array;
   }
    function recAmountCollectiveExtended($c_id){
      $q = "SELECT * FROM receiving WHERE checkin_id = '$c_id' AND recieved_status = '0'";
      $result = mysqli_query($this->connection, $q);
      $array = mysqli_fetch_all($result);
      return $array;
   }


   function change_rec_st($value, $date)
   {
      $q = "UPDATE `receiving` SET `recieved_status`= '1', `date` = '$date' WHERE `id` = '$value'";
      return mysqli_query($this->connection, $q);
   }

   function receive_amount()
   {

      $q = "SELECT * FROM users";
      $users = mysqli_fetch_all(mysqli_query($this->connection, $q));

      for ($i = 0; $i < mysqli_num_rows(mysqli_query($this->connection, $q)); $i++) {
         if ($users[$i][3] != 8) {
            $usr = $users[$i][0];
            $q = "SELECT DISTINCT checkin_id FROM receiving WHERE recieved_status = '0' AND username = '$usr' order by id ASC";

            $row = mysqli_fetch_all(mysqli_query($this->connection, $q));
           

            // echo '<div>
            //  <table border="0" cellpadding="0" cellspacing="0" id="sheet0" class="sheet0 gridlines">
            //      <col class="col0">
            //      <col class="col1">
            //      <col class="col2">
            //      <tbody>
            //        <tr class="row0">
            //          <td class="column0 style1 null style1"></td>
            //          <td class="column1 style2 s style2">'.$users[$i][0].'</td>
            //          <td class="column2 style3 null style3"></td>
            //        </tr>
            //        <tr class="row2">
            //          <td class="column0 style7 s">ROOM NUMBERS</td>
            //          <td class="column1 style8 s">amount</td>
            //          <td class="column2 style9 null"></td>
            //        </tr>
            //        <tr class="row3">
            //          <td class="column0 style11 null"></td>
            //          <td class="column1 style12 null"></td>
            //          <td class="column2 style24 null"></td>
            //        </tr>
            //        <tr class="row4">
            //          <td class="column0 style14 n">206</td>
            //          <td class="column1 style13 null"></td>
            //          <td class="column2 style25 null"></td>
            //        </tr>
            //        <tr class="row5">
            //          <td class="column0 style15 s">Restaurant bill reciving</td>
            //          <td class="column1 style16 n">300</td>
            //          <td class="column2 style17 s">RECIVED   BUTTON </td>
            //        </tr>
            //        <tr class="row6">
            //          <td class="column0 style15 s">Room bill reciving</td>
            //          <td class="column1 style16 n">1800</td>
            //          <td class="column2 style17 s">RECIVED   BUTTON </td>
            //        </tr>
            //        <tr class="row7">
            //          <td class="column0 style18 null style20" colspan="3"></td>
            //        </tr>
            //        <tr class="row8">
            //          <td class="column0 style14 n">105</td>
            //          <td class="column1 style13 null"></td>
            //          <td class="column2 style10 null"></td>
            //        </tr>
            //        <tr class="row9">
            //          <td class="column0 style15 s">Restaurant bill reciveing</td>
            //          <td class="column1 style16 n">1100</td>
            //          <td class="column2 style17 s">RECIVED   BUTTON </td>
            //        </tr>
            //        <tr class="row10">
            //          <td class="column0 style15 s">Room bill reciving</td>
            //          <td class="column1 style16 n">2200</td>
            //          <td class="column2 style17 s">RECIVED   BUTTON </td>
            //        </tr>
            //        <tr class="row11">
            //          <td class="column0 style18 null style20" colspan="3"></td>
            //        </tr>
            //        <tr class="row12">
            //          <td class="column0 style15 null"></td>
            //          <td class="column1 style13 null"></td>
            //          <td class="column2 style10 null"></td>
            //        </tr>
            //        <tr class="row13">
            //          <td class="column0 style15 null"></td>
            //          <td class="column1 style13 null"></td>
            //          <td class="column2 style10 null"></td>
            //        </tr>
            //        <tr class="row14">
            //          <td class="column0 style18 null style20" colspan="3"></td>
            //        </tr>
            //        <tr class="row15">
            //          <td class="column0 style21 null"></td>
            //          <td class="column1 style22 null"></td>
            //          <td class="column2 style23 null"></td>
            //        </tr>
            //      </tbody>
            //  </table></div>';}

         }
      }
   }
   function chart_available_today($t)
   {

      $q = "SELECT * FROM checkin WHERE `date_in` = '$t' AND checkout_status <> 2";
      $result = mysqli_query($this->connection, $q);
      $ary = mysqli_fetch_all($result);
      $num = mysqli_num_rows($result);
      $rooms_taken = array();
      for ($i = 0; $i < $num; $i++) {
         array_push($rooms_taken, $ary[$i][6]);
      }
      $rooms_t = array();
      foreach ($rooms_taken as $key => $value) {
         $rooms_t[$key] = $this->rooms_against_roomid($value);
      }

      $rooms_final_taken = array();
      for ($i = 0; $i < count($rooms_t); $i++) {
         foreach ($rooms_t[$i] as $key => $value) {
            array_push($rooms_final_taken, $value);
         }
      }

      $all_rooms = $this->rooms_all();
      $tout = date('d-m-Y', (strtotime('+1 day', strtotime($t))));
      $rooms_reserved = $this->get_all_reserved_rooms($t, $tout);
      $result1 = array_diff($all_rooms, $rooms_final_taken);

      $result = array_diff($result1, $rooms_reserved);

      $rsss = array();
      foreach ($result as $key => $value) {
         array_push($rsss, $value);
      }

      foreach ($rsss as $key => $value) {
         $room = $this->get_room_category($value);
         if ($room == "Family Suite") {
            $s = "h3";
         } else {
            $s = "h1";
         }

         echo '<div class="col-2 m-1 room_bg" >
        <' . $s . '>' . $value . '</' . $s . '>
        <h6>' . $room . '</h6>
      </div>';
      }
   }

   function rooms_against_roomid($rooms_id)
   {

      $q = "SELECT * FROM `room` WHERE `rooms_id` = '$rooms_id' order by  `room_number`";
      $result = mysqli_query($this->connection, $q);
      $ary = mysqli_fetch_all($result);
      $num = mysqli_num_rows($result);
      $arraye = array();
      for ($i = 0; $i < $num; $i++) {
         array_push($arraye, $ary[$i][3]);
      }
      return $arraye;
   }
   function reservations_against_roomid($rooms_id)
   {

      $q = "SELECT * FROM `reservation_rooms` WHERE `rooms_id` = '$rooms_id' order by  `room_number`";
      $result = mysqli_query($this->connection, $q);
      $ary = mysqli_fetch_all($result);
      $num = mysqli_num_rows($result);
      $arraye = array();
      for ($i = 0; $i < $num; $i++) {
         array_push($arraye, $ary[$i][3]);
      }
      return $arraye;
   }
   function rooms_all()
   {

      $q = "SELECT * FROM `rooms` order by `number`";
      $result = mysqli_query($this->connection, $q);
      $ary = mysqli_fetch_all($result);
      $num = mysqli_num_rows($result);
      $arraye = array();
      for ($i = 0; $i < $num; $i++) {
         array_push($arraye, $ary[$i][2]);
      }
      return $arraye;
   }
   function chart_occupied_today($t)
   {
      $q = "SELECT * FROM checkin WHERE `date_in` = '$t'";
      $result = mysqli_query($this->connection, $q);
      $ary = mysqli_fetch_all($result);
      $num = mysqli_num_rows($result);
      $rooms_ids = array();
      for ($i = 0; $i < $num; $i++) {
         array_push($rooms_ids, $ary[$i][6]);
      }

      $rooms_t = array();

      foreach ($rooms_ids as $key => $value) {
         $rooms_t[$key] = $this->rooms_against_roomid($value);
      }

      for ($i = 0; $i < count($rooms_t); $i++) {
         foreach ($rooms_t[$i] as $key => $value) {
            $room = $this->get_room_category($value);
            if ($room == "master") {
               $room = "Master Bed";
            } else if ($room == "4bed") {
               $room = "4 Bed";
            } else if ($room == "3bed") {
               $room = "3 Bed";
            } else if ($room == "3bed_d") {
               $room = "3 Bed Delux";
            } else if ($room == "family") {
               $room = "Family Suite";
            }

            echo '<div class="col-4 m-1 room_br">
         

    <h5>' . $value . '</h5>
    

  </div>';
         }
      }
   }

   function chart_reserved_today($t)
   {
      $q = "SELECT * FROM reservations WHERE `date_in` = '$t'";
      $result = mysqli_query($this->connection, $q);
      $ary = mysqli_fetch_all($result);
      $num = mysqli_num_rows($result);
      $rooms_ids = array();
      for ($i = 0; $i < $num; $i++) {
         array_push($rooms_ids, $ary[$i][3]);
      }

      $rooms_t = array();

      foreach ($rooms_ids as $key => $value) {
         $rooms_t[$key] = $this->reservations_against_roomid($value);
      }

      for ($i = 0; $i < count($rooms_t); $i++) {
         foreach ($rooms_t[$i] as $key => $value) {
            $room = $this->get_room_category($value);
            if ($room == "master") {
               $room = "Master Bed";
            } else if ($room == "4bed") {
               $room = "4 Bed";
            } else if ($room == "3bed") {
               $room = "3 Bed";
            } else if ($room == "3bed_d") {
               $room = "3 Bed Delux";
            } else if ($room == "family") {
               $room = "Family Suite";
            }

            echo '<div class="col-4 m-1 room_by">
    <h5>' . $value . '</h5>

  </div>';
         }
      }
   }

   function chart_occupied($t, $t_out)
   {

      $result = $this->get_only_available_rooms($t, $t_out);
      $rooms_t = $this->rooms_all();
      $reserved = $this->get_all_reserved_rooms($t, $t_out);

      $result = array_diff($rooms_t, $result);
      $result1 = array_diff($result, $reserved);

      foreach ($result1 as $key => $value) {
         $room = $this->get_room_category($value);
         if ($room == "master") {
            $room = "Master Bed";
         } else if ($room == "4bed") {
            $room = "4 Bed";
         } else if ($room == "3bed") {
            $room = "3 Bed";
         } else if ($room == "3bed_d") {
            $room = "3 Bed Delux";
         } else if ($room == "family") {
            $room = "Family Suite";
         }

         echo '<div class="col-6 mt-1 room_br">
         

    <h5>' . $value . '</h5>
    
  </div>';
      }
   }

   function chart_reserved($t, $t_out)
   {

      $result = $this->get_all_reserved_rooms($t, $t_out);

      foreach ($result as $key => $value) {
         $room = $this->get_room_category($value);
         if ($room == "master") {
            $room = "Master Bed";
         } else if ($room == "4bed") {
            $room = "4 Bed";
         } else if ($room == "3bed") {
            $room = "3 Bed";
         } else if ($room == "3bed_d") {
            $room = "3 Bed Delux";
         } else if ($room == "family") {
            $room = "Family Suite";
         }

         echo '<div class="col-6 mt-1 room_by">
         

    <h5>' . $value . '</h5>
  </div>';
      }
   }

   function get_reservation_details($id)
   {

      $q = "SELECT * FROM `reservations` WHERE `res_id` = '$id'";
      $row = mysqli_fetch_row(mysqli_query($this->connection, $q));
      return $row;
   }

   function get_checkins_details($id)
   {

      $q = "SELECT * FROM `checkin` WHERE `id` = '$id'";
      $row = mysqli_fetch_row(mysqli_query($this->connection, $q));
      return $row;
   }

   function get_room_category($room)
   {

      $q = "SELECT `category` FROM `rooms` where `number` = '$room' order by `number` ASC";
      $result = mysqli_query($this->connection, $q);
      $row = mysqli_fetch_row($result);
      $room = $row[0];
      if ($room == "master") {
         $room = "Master Bed";
      } else if ($room == "4bed") {
         $room = "4 Bed";
      } else if ($room == "3bed") {
         $room = "3 Bed";
      } else if ($room == "3bed_d") {
         $room = "3 Bed Delux";
      } else if ($room == "family") {
         $room = "Family Suite";
      }

      return $room;

   }

    function get_room_rest_name($room)
   {

      $q = "SELECT `rest_name` FROM `rooms` where `number` = '$room' order by `number` ASC";
      $result = mysqli_query($this->connection, $q);
      $row = mysqli_fetch_row($result);
      $rest_name = $row[0];
   

      return $rest_name;

   }

   function get_n_orders($t, $date_in, $date_out)
   {
      $date_out = date('Y-m-d', strtotime($date_in . ' +1 day'));
      $dates_from_user = $this->getDatesFromRange($date_in, $date_out);
      $checkin_array = $this->get_checkedin_bill($t);
      $rooms_id = $checkin_array[6];

      $array_rooms = $this->rm_rooms($rooms_id);

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
          
         $array_of_array[$key] = mysqli_fetch_all(mysqli_query($this->connection, $query_where_condition));
      }
      
      return $array_of_array;
   }
   // get orders against specific room
   function get_n_orders_room($room_n, $name, $date_in, $date_out)
   {

      $date_in = date('Y-m-d', strtotime($date_in . ' -1 day'));
      $dates_from_user = $this->getDatesFromRange($date_in, $date_out);

      $number = $room_n;
 
      $query_where_condition = "SELECT * FROM `orders` WHERE (name = '$name' AND status = 1 AND room_number = '$number') AND";
      foreach ($dates_from_user as $index => $date) {
         if ($index == 0) {
            $query_where_condition .= " (date(date_a) >= '$date'";
         } else {
            $query_where_condition .= " OR date(date_a) >= '$date'";
         }
      }
      $query_where_condition .= ")";
    
     
      $array_of_array = mysqli_fetch_all(mysqli_query($this->connection, $query_where_condition));

      return $array_of_array;
   }

   function get_n_menu($t)
   {
      $q = "SELECT * FROM order_menu WHERE order_id = '$t'";
      return mysqli_fetch_all(mysqli_query($this->connection, $q));
   }

   function delete_order($order_id)
   {
      $order_id = str_replace('&lt;', "~", str_replace('<', "~&gt;", strip_tags(mysqli_real_escape_string($this->connection, $order_id))));

      $q = " DELETE FROM order_menu WHERE order_id = '$order_id'";
      mysqli_query($this->connection, $q);
      $q = " DELETE FROM orders WHERE order_id = '$order_id'";
      mysqli_query($this->connection, $q);
   }

   function deliver_order($order_id)
   {

      $order_id = str_replace('&lt;', "~", str_replace('<', "~&gt;", strip_tags(mysqli_real_escape_string($this->connection, $order_id))));
      $q = "Update orders SET Status='1' WHERE order_id = '$order_id'";
      mysqli_query($this->connection, $q);
   }
   function add_room($id, $room, $name)
   {
      $cat = $this->check_cat($room);
      $q = "INSERT INTO room VALUES ('', '$id','$cat','$room','$name')";
      return mysqli_query($this->connection, $q);
   }

   function add_room_reserved($id, $room, $name)
   {
      $cat = $this->check_cat($room);
      $q = "INSERT INTO `reservation_rooms` VALUES ('', '$id','$cat','$room')";
      return mysqli_query($this->connection, $q);
   }

   function check_cat($room_n)
   {
      $q = "SELECT * FROM `rooms` WHERE `number` = '$room_n'";
      $r = mysqli_query($this->connection, $q);
      $ary = mysqli_fetch_row($r);
      return $ary[1];
   }

   function get_rate($room)
   {
      $q = "SELECT * FROM rooms WHERE `number` = '$room'";
      $result = mysqli_query($this->connection, $q);
      $ary = mysqli_fetch_row($result);
      return $ary[3];
   }
   function add_order_extra($name, $quantity, $price, $type, $order_id,$total,$roomno)
   {
      
      $name = str_replace('&lt;', "~", str_replace('<', "~&gt;", strip_tags(mysqli_real_escape_string($this->connection, $name))));
      $quantity = str_replace('&lt;', "~", str_replace('<', "~&gt;", strip_tags(mysqli_real_escape_string($this->connection, $quantity))));
      $price = str_replace('&lt;', "~", str_replace('<', "~&gt;", strip_tags(mysqli_real_escape_string($this->connection, $price))));
      $type = str_replace('&lt;', "~", str_replace('<', "~&gt;", strip_tags(mysqli_real_escape_string($this->connection, $type))));
      $extra = "1";
      $price_no = $quantity*$price;
      $f_total = $price_no + $total;
      $q_select = "select * from orders where order_id=$order_id AND room_number = $roomno";
      $result = mysqli_query($this->connection, $q_select);
      $row = mysqli_fetch_assoc($result);
$extra_total = $row['extra_total'];

$extra = $extra_total + $price_no;
      
      $qn = "INSERT INTO order_menu (order_id, name, price, qty, type,extra)
      VALUES('$order_id', '$name', '$price', '$quantity', '$type', '$extra')";
      
      mysqli_query($this->connection, $qn);
      $qn_u = "update orders set total='$f_total' , extra_total = '$extra' where order_id=$order_id AND room_number = $roomno";
      
      mysqli_query($this->connection, $qn_u);
   }
   function add_order($name, $quantity, $price, $type, $order_id)
   {
      
      $name = str_replace('&lt;', "~", str_replace('<', "~&gt;", strip_tags(mysqli_real_escape_string($this->connection, $name))));
      $quantity = str_replace('&lt;', "~", str_replace('<', "~&gt;", strip_tags(mysqli_real_escape_string($this->connection, $quantity))));
      $price = str_replace('&lt;', "~", str_replace('<', "~&gt;", strip_tags(mysqli_real_escape_string($this->connection, $price))));
      $type = str_replace('&lt;', "~", str_replace('<', "~&gt;", strip_tags(mysqli_real_escape_string($this->connection, $type))));

      $q = "INSERT INTO order_menu (order_id, name, price, qty, type)
      VALUES('$order_id', '$name', '$price', '$quantity', '$type')";
      mysqli_query($this->connection, $q);
   }
   function add_order_manual($name, $quantity, $price, $type, $order_id)
   {
      
      $name = str_replace('&lt;', "~", str_replace('<', "~&gt;", strip_tags(mysqli_real_escape_string($this->connection, $name))));
      $quantity = str_replace('&lt;', "~", str_replace('<', "~&gt;", strip_tags(mysqli_real_escape_string($this->connection, $quantity))));
      $price = str_replace('&lt;', "~", str_replace('<', "~&gt;", strip_tags(mysqli_real_escape_string($this->connection, $price))));
      $type = str_replace('&lt;', "~", str_replace('<', "~&gt;", strip_tags(mysqli_real_escape_string($this->connection, $type))));
      $extra = "1";
      $q = "INSERT INTO order_menu (order_id, name, price, qty, type,extra)
      VALUES('$order_id', '$name', '$price', '$quantity', '$type', '$extra')";
      mysqli_query($this->connection, $q);
   }

   function check_citi($code)
   {

      $q = "SELECT * from cities WHERE District_Code = '$code'";
      $result = mysqli_query($this->connection, $q);
      $ary = mysqli_fetch_row($result);
      return $ary[0];
   }
   function add_checkin($id, $name, $cnic, $city, $date_in, $date_out, $rand, $rate, $discount, $price, $number, $adv)
   {
      global $session;
      $user = $session->username;
      $time = date("H:i A");
      $q = "INSERT INTO checkin VALUES ('$id', '$name','$cnic','$city','$date_in','$date_out','$rand','$rate','$discount','$price','$name','$number','$adv','0','$user', '0')";
     
      return mysqli_query($this->connection, $q);
   }
   function check_id($id)
   {


      $q = "SELECT * FROM `booked_dates` WHERE checkin_id = '$id'";
      $result = mysqli_query($this->connection, $q);

      if (!$result || (mysqli_num_rows($result) < 1)) {
         return 1;
      }else{
         return 0;
      }



   }
   function check_reserved_rooms_id($id)
   {


      $q = "SELECT * FROM `reservations` WHERE res_id = '$id'";
      $result = mysqli_query($this->connection, $q);

      if (!$result || (mysqli_num_rows($result) < 1)) {
         return 1;
      }else{
         return 0;
      }



   }
   function check_code()
   {


      $q = "SELECT * FROM `code`";
      $result = mysqli_query($this->connection, $q);
      $row = mysqli_fetch_row($result);
      return $row[1];



   }
   function update_code($r)
   {

      $q = "UPDATE `code` SET code = '$r'";
      return mysqli_query($this->connection, $q);
   }
   function add_to_checkin($res_id, $name, $cnic, $city, $date_in, $date_out, $rand, $rate, $discount, $price, $number, $advance)
   {
      global $session;
      $user = $session->username;
      $q = "INSERT INTO checkin VALUES ('$res_id', '$name','$cnic','$city','$date_in','$date_out','$rand','$rate','$discount','$price','$name','$number','$advance','0','$user', '', '', '')";
      mysqli_query($this->connection, $q);

      $q = "DELETE FROM reservations WHERE res_id = '$res_id'";
      mysqli_query($this->connection, $q);
   }

   function get_rooms_id($room)
   {
      $date = date('Y-m-d');
      $q = "SELECT * FROM room WHERE room_number = '$room'";
      $resx = mysqli_query($this->connection, $q);
      $ary = mysqli_fetch_all($resx);
      $num = mysqli_num_rows($resx);
      $ary_rooms_against = array();
      for ($i = 0; $i < $num; $i++) {
         array_push($ary_rooms_against, $ary[$i][1]);
      }

      $q = "SELECT * FROM `checkin` WHERE `checkout_status` = 0";
      $rexy = mysqli_query($this->connection, $q);
      $num = mysqli_num_rows($rexy);
      $ary_roms = mysqli_fetch_all($rexy);
      $rooms_avail = array();
      for ($i = 0; $i < $num; $i++) {
         array_push($rooms_avail, $ary_roms[$i][6]);
      }

      $result = array_intersect($ary_rooms_against, $rooms_avail);
      return $result;
   }

   function add_orders($total_price, $roomno, $order_id)
   {

      $total_price = str_replace('&lt;', "~", str_replace('<', "~&gt;", strip_tags(mysqli_real_escape_string($this->connection, $total_price))));
      $roomno = str_replace('&lt;', "~", str_replace('<', "~&gt;", strip_tags(mysqli_real_escape_string($this->connection, $roomno))));
      $order_id = str_replace('&lt;', "~", str_replace('<', "~&gt;", strip_tags(mysqli_real_escape_string($this->connection, $order_id))));
      date_default_timezone_set('Asia/Karachi');
      $tee = Date("Y-m-d h:i:sa");
      

      $room_id = $this->get_rooms_id($roomno);

      foreach ($room_id as $key => $value) {
         $r = $value;
      }

      $idds = $r;

      $q = "SELECT * FROM room WHERE room_number = '$roomno' and rooms_id = '$idds'";
      $resultx = mysqli_query($this->connection, $q);
      $room = mysqli_fetch_row($resultx);
      $id = $room[1];

      $name = $room[4];

      $q = "INSERT INTO orders (order_id,total,room_number,date_a,name, extra_total)
      VALUES('$order_id', '$total_price', '$roomno', '$tee', '$name', '$total_price')";
      mysqli_query($this->connection, $q);
   }
   function add_orders_manual($total_price, $roomno, $order_id)
   {

      $total_price = str_replace('&lt;', "~", str_replace('<', "~&gt;", strip_tags(mysqli_real_escape_string($this->connection, $total_price))));
      $roomno = str_replace('&lt;', "~", str_replace('<', "~&gt;", strip_tags(mysqli_real_escape_string($this->connection, $roomno))));
      $order_id = str_replace('&lt;', "~", str_replace('<', "~&gt;", strip_tags(mysqli_real_escape_string($this->connection, $order_id))));
      date_default_timezone_set('Asia/Karachi');
      $tee = Date("Y-m-d h:i:sa");

      $room_id = $this->get_rooms_id($roomno);

      foreach ($room_id as $key => $value) {
         $r = $value;
      }

      $idds = $r;

      $q = "SELECT * FROM room WHERE room_number = '$roomno' and rooms_id = '$idds'";
      $resultx = mysqli_query($this->connection, $q);
      $room = mysqli_fetch_row($resultx);
      $id = $room[1];

      $name = $room[4];

      $q = "INSERT INTO orders (order_id,total,room_number,date_a,name)
      VALUES('$order_id', '$total_price', '$roomno', '$tee', '$name')";
      mysqli_query($this->connection, $q);
   }

   function update_orders($total_price, $order_id)
   {
      $total_price = str_replace('&lt;', "~", str_replace('<', "~&gt;", strip_tags(mysqli_real_escape_string($this->connection, $total_price))));
      $order_id = str_replace('&lt;', "~", str_replace('<', "~&gt;", strip_tags(mysqli_real_escape_string($this->connection, $order_id))));
      $q = "Update orders SET total='$total_price' WHERE order_id = '$order_id'";
      mysqli_query($this->connection, $q);
   }

   function getNumMembers()
   {
      if ($this->num_members < 0) {
         $q = "SELECT * FROM " . TBL_USERS;
         $result = mysqli_query($this->connection, $q);
         $this->num_members = mysqli_num_rows($result);
      }
      return $this->num_members;
   }

   function calcNumActiveUsers()
   {

      $q = "SELECT * FROM " . TBL_ACTIVE_USERS;
      $result = mysqli_query($this->connection, $q);
      $this->num_active_users = mysqli_num_rows($result);
   }

   function calcNumActiveGuests()
   {

      $q = "SELECT * FROM " . TBL_ACTIVE_GUESTS;
      $result = mysqli_query($this->connection, $q);
      $this->num_active_guests = mysqli_num_rows($result);
   }

   function addActiveUser($username, $time)
   {
      $username = str_replace('&lt;', "~", str_replace('<', "~&gt;", strip_tags(mysqli_real_escape_string($this->connection, $username))));
      $time = str_replace('&lt;', "~", str_replace('<', "~&gt;", strip_tags(mysqli_real_escape_string($this->connection, $time))));
      $q = "UPDATE " . TBL_USERS . " SET timestamp = '$time' WHERE username = '$username'";
      mysqli_query($this->connection, $q);

      if (!TRACK_VISITORS) return;
      $q = "REPLACE INTO " . TBL_ACTIVE_USERS . " VALUES ('$username', '$time')";
      mysqli_query($this->connection, $q);
      $this->calcNumActiveUsers();
   }

   function addActiveGuest($ip, $time)
   {
      $ip = str_replace('&lt;', "~", str_replace('<', "~&gt;", strip_tags(mysqli_real_escape_string($this->connection, $ip))));
      $time = str_replace('&lt;', "~", str_replace('<', "~&gt;", strip_tags(mysqli_real_escape_string($this->connection, $time))));
      if (!TRACK_VISITORS) return;
      $q = "REPLACE INTO " . TBL_ACTIVE_GUESTS . " VALUES ('$ip', '$time')";
      mysqli_query($this->connection, $q);
      $this->calcNumActiveGuests();
   }

   function removeActiveUser($username)
   {
      $username = str_replace('&lt;', "~", str_replace('<', "~&gt;", strip_tags(mysqli_real_escape_string($this->connection, $username))));
      if (!TRACK_VISITORS) return;
      $q = "DELETE FROM " . TBL_ACTIVE_USERS . " WHERE username = '$username'";
      mysqli_query($this->connection, $q);
      $this->calcNumActiveUsers();
   }

   function removeActiveGuest($ip)
   {
      $ip = str_replace('&lt;', "~", str_replace('<', "~&gt;", strip_tags(mysqli_real_escape_string($this->connection, $ip))));
      if (!TRACK_VISITORS) return;
      $q = "DELETE FROM " . TBL_ACTIVE_GUESTS . " WHERE ip = '$ip'";
      mysqli_query($this->connection, $q);
      $this->calcNumActiveGuests();
   }

   function removeInactiveUsers()
   {
      if (!TRACK_VISITORS) return;
      $timeout = time() - USER_TIMEOUT * 60;
      $q = "DELETE FROM " . TBL_ACTIVE_USERS . " WHERE timestamp < $timeout";
      mysqli_query($this->connection, $q);
      $this->calcNumActiveUsers();
   }

   function removeInactiveGuests()
   {
      if (!TRACK_VISITORS) return;
      $timeout = time() - GUEST_TIMEOUT * 60;
      $q = "DELETE FROM " . TBL_ACTIVE_GUESTS . " WHERE timestamp < $timeout";
      mysqli_query($this->connection, $q);
      $this->calcNumActiveGuests();
   }

   function orders_option($date)
   {

      $n = date('Y-m-d', strtotime($date . " +1 days"));
      $n1 = date('Y-m-d', strtotime($date . " -1 days"));
      $array = $this->get_only_checkin_rooms($n1, $n);
      

      foreach ($array as $id => $v) {
         echo '<option>' . $v . '</option>';
      }
   }
 function get_only_checkin_rooms($date_in, $date_out)
   {
      $dates_from_user = $this->getDatesFromRange($date_in, $date_out);

      $query_where_condition = "SELECT checkin_id, date_n FROM booked_dates ";
      foreach ($dates_from_user as $index => $date) {
         if ($index == 0) {
            $query_where_condition .= "WHERE date_n = '$date'";
         } else {
            $query_where_condition .= " OR date_n = '$date'";
         }
      }

      $res = mysqli_query($this->connection, $query_where_condition);
      $mysql_array_booked_dates = mysqli_fetch_all($res);

      $booked_dates_checkin_ids = array();
      foreach ($mysql_array_booked_dates as $array_index => $values) {
         array_push($booked_dates_checkin_ids, $values[0]);
      }
      $booked_dates_checkin_ids = array_unique($booked_dates_checkin_ids);

      $rooms_id_from_checkins = array();
      foreach ($booked_dates_checkin_ids as $indexs => $id) {
         $q = "SELECT * FROM `checkin` WHERE `id` = '$id' AND checkout_status = 0";
         $result = mysqli_fetch_row(mysqli_query($this->connection, $q));
         array_push($rooms_id_from_checkins, $result[6]);
      }

      $rooms_from_rooms_id = array();
      foreach ($rooms_id_from_checkins as $index => $id) {
         $q = "SELECT * FROM `room` WHERE `rooms_id` = '$id' order by  `room_number`";
         $result = mysqli_query($this->connection, $q);
         $ary = mysqli_fetch_all($result);
         $num = mysqli_num_rows($result);
         $arraye = array();
         for ($i = 0; $i < $num; $i++) {
            array_push($arraye, $ary[$i][3]);
         }
         $rooms_from_rooms_id[$index] = $arraye;
      }

      $rooms_taken = array();
      foreach ($rooms_from_rooms_id as $id => $value) {
         for ($i = 0; $i < count($value); $i++) {
            array_push($rooms_taken, $value[$i]);
         }
      }

            $all_rooms = $this->rooms_all();
      
      $available_rooms = array_diff($rooms_taken, $all_rooms);
      return $rooms_taken;
   }

   function getCheckinStatus($rooms_id){
      $query = "SELECT * FROM `checkin` where rooms_id = '$rooms_id'";
      $res = mysqli_query($this->connection,$query);
      $row = mysqli_fetch_row($res);
      return $row[13];
   }

   function get_only_available_rooms_sda($date_in, $date_out)
   {
      $dates_from_user = $this->getDatesFromRange($date_in, $date_out);

      $query_where_condition = "SELECT checkin_id, date_n FROM booked_dates ";
      foreach ($dates_from_user as $index => $date) {
         if ($index == 0) {
            $query_where_condition .= "WHERE date_n = '$date'";
         } else {
            $query_where_condition .= " OR date_n = '$date'";
         }
      }

      $res = mysqli_query($this->connection, $query_where_condition);
      $mysql_array_booked_dates = mysqli_fetch_all($res);

      $booked_dates_checkin_ids = array();
      foreach ($mysql_array_booked_dates as $array_index => $values) {
         array_push($booked_dates_checkin_ids, $values[0]);
      }
      $booked_dates_checkin_ids = array_unique($booked_dates_checkin_ids);

      $rooms_id_from_checkins = array();
      foreach ($booked_dates_checkin_ids as $indexs => $id) {
         $q = "SELECT * FROM `checkin` WHERE `id` = '$id' AND checkout_status <> 1";
         $result = mysqli_fetch_row(mysqli_query($this->connection, $q));
         array_push($rooms_id_from_checkins, $result[6]);
      }

      $rooms_from_rooms_id = array();
      foreach ($rooms_id_from_checkins as $index => $id) {
         $q = "SELECT * FROM `room` WHERE `rooms_id` = '$id' order by  `room_number`";
         $result = mysqli_query($this->connection, $q);
         $ary = mysqli_fetch_all($result);
         $num = mysqli_num_rows($result);
         $arraye = array();
         for ($i = 0; $i < $num; $i++) {
            array_push($arraye, $ary[$i][3]);
         }
         $rooms_from_rooms_id[$index] = $arraye;
      }

      $rooms_taken = array();
      foreach ($rooms_from_rooms_id as $id => $value) {
         for ($i = 0; $i < count($value); $i++) {
            array_push($rooms_taken, $value[$i]);
         }
      }

      $all_rooms = $this->rooms_all();
      $reserved_rooms = $this->get_all_reserved_rooms($date_in, $date_out);

      $available_rooms = array_diff($all_rooms, $rooms_taken);
      $available_rooms_including_reserved = array_diff($available_rooms, $reserved_rooms);
      return $available_rooms;
   }

   function get_only_available_rooms($date_in, $date_out)
   {
       
      $dates_from_user = $this->getDatesFromRange($date_in, $date_out);

      $query_where_condition = "SELECT checkin_id, date_n FROM booked_dates ";
     
       foreach ($dates_from_user as $index => $date) {
          if ($index == 0) {
             $query_where_condition .= "WHERE date_n = '$date'";
          } else {
             $query_where_condition .= " OR date_n = '$date'";
          }
       }

      $res = mysqli_query($this->connection, $query_where_condition);
      $mysql_array_booked_dates = mysqli_fetch_all($res);
 
      $booked_dates_checkin_ids = array();
      foreach ($mysql_array_booked_dates as $array_index => $values) {
         array_push($booked_dates_checkin_ids, $values[0]);
      }
      $booked_dates_checkin_ids = array_unique($booked_dates_checkin_ids);

      $rooms_id_from_checkins = array();

      foreach ($booked_dates_checkin_ids as $indexs => $id) {
         $q = "SELECT * FROM `checkin` WHERE `id` = '$id' AND `checkout_status` = 0";

         $result = mysqli_fetch_row(mysqli_query($this->connection, $q));
         array_push($rooms_id_from_checkins, $result[6]);
      }

      $rooms_from_rooms_id = array();
      foreach ($rooms_id_from_checkins as $index => $id) {
         $q = "SELECT * FROM `room` WHERE `rooms_id` = '$id' order by  `room_number`";

         $result = mysqli_query($this->connection, $q);
         $ary = mysqli_fetch_all($result);
         $num = mysqli_num_rows($result);

         $arraye = array();
         for ($i = 0; $i < $num; $i++) {
            array_push($arraye, $ary[$i][3]);
         }

         $rooms_from_rooms_id[$index] = $arraye;
      }

      $rooms_taken = array();

      foreach ($rooms_from_rooms_id as $id => $value) {
         for ($i = 0; $i < count($value); $i++) {
            array_push($rooms_taken, $value[$i]);
         }

      }

      $all_rooms = $this->rooms_all();

      // $date_in1 =  date('Y-m-d', strtotime($date_in . ' + 1 days'));
      $reserved_rooms = $this->get_all_reserved_rooms($date_in, $date_out);
 
      $available_rooms = array_diff($all_rooms, $rooms_taken);
 
      $available_rooms_including_reserved = array_diff($available_rooms, $reserved_rooms);
      

      return $available_rooms_including_reserved;
   }

   function get_only_available_rooms_with_id($date_in, $date_out, $idps)
   {

      $dates_from_user = $this->getDatesFromRange($date_in, $date_out);

      $query_where_condition = "SELECT checkin_id, date_n FROM booked_dates ";
      foreach ($dates_from_user as $index => $date) {
         if ($index == 0) {
            $query_where_condition .= "WHERE (date_n = '$date'";
         } else {
            $query_where_condition .= " OR date_n = '$date'";
         }
      }
      $query_where_condition .= ")";

      $res = mysqli_query($this->connection, $query_where_condition);
      $mysql_array_booked_dates = mysqli_fetch_all($res);

      $booked_dates_checkin_ids = array();
      foreach ($mysql_array_booked_dates as $array_index => $values) {
         if ($values[0] != $idps) {
            array_push($booked_dates_checkin_ids, $values[0]);
         }
      }

      $booked_dates_checkin_ids = array_unique($booked_dates_checkin_ids);
      // return $booked_dates_checkin_ids;
      $rooms_id_from_checkins = array();
      foreach ($booked_dates_checkin_ids as $indexs => $id) {

         $q = "SELECT * FROM `checkin` WHERE `id` = '$id' AND checkout_status = 0";
         $result = mysqli_fetch_row(mysqli_query($this->connection, $q));
         array_push($rooms_id_from_checkins, $result[6]);
      }

      $rooms_from_rooms_id = array();
      foreach ($rooms_id_from_checkins as $index => $id) {
         $q = "SELECT * FROM `room` WHERE `rooms_id` = '$id' order by `room_number`";
         $result = mysqli_query($this->connection, $q);
         $ary = mysqli_fetch_all($result);
         $num = mysqli_num_rows($result);
         $arraye = array();
         for ($i = 0; $i < $num; $i++) {
            array_push($arraye, $ary[$i][3]);
         }
         $rooms_from_rooms_id[$index] = $arraye;
      }

      // all rooms except with checkin id
      $rooms_taken = array();
      foreach ($rooms_from_rooms_id as $id => $value) {
         for ($i = 0; $i < count($value); $i++) {
            array_push($rooms_taken, $value[$i]);
         }
      }

      //return $rooms_taken;


      $all_rooms = $this->rooms_all();

      //all rooms except with reservation id
      $reserved_rooms = $this->get_all_reserved_rooms_with_id($date_in, $date_out, $idps);

      $available_rooms = array_diff($all_rooms, $rooms_taken);
      $available_rooms_including_reserved = array_diff($available_rooms, $reserved_rooms);
      return $available_rooms_including_reserved;
   }

   function get_all_reserved_rooms($date_in, $date_out)
   {
      $dates_from_user = $this->getDatesFromRange($date_in, $date_out);

      $query_where_condition = "SELECT reservation_id, date_n FROM reserved_dates ";
      foreach ($dates_from_user as $index => $date) {
         if ($index == 0) {
            $query_where_condition .= "WHERE date_n = '$date'  ";
         } else {
            $query_where_condition .= " OR date_n = '$date'";
         }
      }

      $res = mysqli_query($this->connection, $query_where_condition);
      $mysql_array_reserved_dates = mysqli_fetch_all($res);

      $reserved_dates_reserved_ids = array();
      foreach ($mysql_array_reserved_dates as $array_index => $values) {
         array_push($reserved_dates_reserved_ids, $values[0]);
      }

      $reserved_dates_reserved_ids = array_unique($reserved_dates_reserved_ids);

      $rooms_id_from_reservations = array();
      foreach ($reserved_dates_reserved_ids as $indexs => $id) {
         $q = "SELECT * FROM `reservations` WHERE `res_id` = '$id'";
         $result = mysqli_fetch_row(mysqli_query($this->connection, $q));
         array_push($rooms_id_from_reservations, $result[3]);
      }

      $rooms_from_rooms_id = array();
      foreach ($rooms_id_from_reservations as $index => $id) {
         $q = "SELECT * FROM `reservation_rooms` WHERE `rooms_id` = '$id' order by `room_number`";
         $result = mysqli_query($this->connection, $q);
         $ary = mysqli_fetch_all($result);
         $num = mysqli_num_rows($result);
         $arraye = array();
         for ($i = 0; $i < $num; $i++) {
            array_push($arraye, $ary[$i][3]);
         }
         $rooms_from_rooms_id[$index] = $arraye;
      }

      $rooms_taken = array();
      foreach ($rooms_from_rooms_id as $id => $value) {
         for ($i = 0; $i < count($value); $i++) {
            array_push($rooms_taken, $value[$i]);
         }
      }
      return $rooms_taken;
   }

   function get_all_reserved_rooms_with_id($date_in, $date_out, $rsid)
   {

      // $date_out = date('Y-m-d', strtotime($date_out. "+1 Day"));
      $dates_from_user = $this->getDatesFromRange($date_in, $date_out);

      $query_where_condition = "SELECT reservation_id, date_n FROM reserved_dates ";
      foreach ($dates_from_user as $index => $date) {
         if ($index == 0) {
            $query_where_condition .= "WHERE (date_n = '$date'";
         } else {
            $query_where_condition .= " OR date_n = '$date'";
         }
      }
      $query_where_condition .= ")";
      $res = mysqli_query($this->connection, $query_where_condition);
      $mysql_array_reserved_dates = mysqli_fetch_all($res);

      $reserved_dates_reserved_ids = array();
      foreach ($mysql_array_reserved_dates as $array_index => $values) {
         if ($values[0] != $rsid) {
            array_push($reserved_dates_reserved_ids, $values[0]);
         }
      }

      $reserved_dates_reserved_ids = array_unique($reserved_dates_reserved_ids);

      $rooms_id_from_reservations = array();
      foreach ($reserved_dates_reserved_ids as $indexs => $id) {

         $q = "SELECT * FROM `reservations` WHERE `res_id` = '$id'";
         $result = mysqli_fetch_row(mysqli_query($this->connection, $q));
         array_push($rooms_id_from_reservations, $result[3]);
      }

      $rooms_from_rooms_id = array();
      foreach ($rooms_id_from_reservations as $index => $id) {
         $q = "SELECT * FROM `reservation_rooms` WHERE `rooms_id` = '$id' order by  `room_number`";
         $result = mysqli_query($this->connection, $q);
         $ary = mysqli_fetch_all($result);
         $num = mysqli_num_rows($result);
         $arraye = array();
         for ($i = 0; $i < $num; $i++) {
            array_push($arraye, $ary[$i][3]);
         }
         $rooms_from_rooms_id[$index] = $arraye;
      }

      $rooms_taken = array();
      foreach ($rooms_from_rooms_id as $id => $value) {
         for ($i = 0; $i < count($value); $i++) {
            array_push($rooms_taken, $value[$i]);
         }
      }
      return $rooms_taken;
   }

   function add_inventory($item, $qty)
   {
      $q = "INSERT INTO `inventory`(`type`, `qty`) VALUES ('$item','$qty')";
      return mysqli_query($this->connection, $q);
   }

   function add_receiving($id, $amt)
   {
      $q = "UPDATE `checkin` SET `advance`='$amt' WHERE rooms_id = '$id'";
      return mysqli_query($this->connection, $q);
   }

   function edit_inventory($id, $item, $qty)
   {
      $q = "UPDATE `inventory` SET `type`= '$item',`qty`='$qty' WHERE `id` = '$id'";
      return mysqli_query($this->connection, $q);
   }

   function query($query)
   {
      return mysqli_query($this->connection, $query);
   }
};

$database = new MySQLDB;