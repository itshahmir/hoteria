<?php

include("include/classes/session.php");

class Process
{

   function __construct()
   {
      global $session;

      if (isset($_POST['sublogin'])) {
         $this->procLogin();
      } else if (isset($_POST['add_reservation'])) {
         $this->add_reservation();
      } else if (isset($_POST['add_rooms'])) {
         $this->add_rooms();
      }else if (isset($_POST['edit_order'])) {
         $this->edit_order();
      } else if (isset($_POST['add_order'])) {
         $this->add_order();
      }else if (isset($_POST['add_order_manual'])) {
         $this->add_order_manual();
      }else if (isset($_POST['add_order_extra_new'])) {
         $this->add_order_extra_new();
      } else if (isset($_POST['deleteorder'])) {
         $this->deleteorder();
      } else if (isset($_POST['deliverorder'])) {
         $this->deliverorder();
      } else if (isset($_POST['add_checkin'])) {
         $this->add_checkin();
      } else if (isset($_POST['add_to_checkin'])) {
         $this->add_to_checkin();
      } else if (isset($_POST['edit_reservation'])) {
         $this->edit_reservation();
      } else if (isset($_POST['edit_room'])) {
         $this->edit_room();
      }else if (isset($_POST['edit_checkin'])) {
         $this->edit_checkin();
      } else if (isset($_POST['add_inventory'])) {
         $this->add_inventory();
      } else if (isset($_POST['add_order_extra'])) {
         $this->add_order_extra();
      }  else if (isset($_POST['add_receiving'])) {
         $this->add_receiving();
      } 
else if (isset($_POST['add_receiving11'])) {
         $this->add_receiving11();
      }
      else if (isset($_POST['edit_in'])) {
         $this->edit_inventory();
      } else if (isset($_POST['add_employees'])) 
{
         $this->add_employees();
} 
else if (isset($_POST['edit_employees'])) 
{
         $this->edit_employees();
}
else if (isset($_POST['add_cutting'])) 
{
         $this->add_cutting();
} 

else if (isset($_POST['add_cutting_next'])) 
{
         $this->add_cutting_next();
} 
else if (isset($_POST['add_salary'])) 
{
         $this->add_salary();
}
else if (isset($_POST['add_salary_next'])) 
{
         $this->add_salary_next();
}
else if ($session->logged_in) {
         $this->procLogout();
      } else {
         header("Location: login.php");
      }
   }
   function edit_order()
   {
      global $database, $session, $form;
      $item = $_POST['item'];
      $roomno = $_POST['roomno'];
      $arraye = array();
      $order_id = $_POST['order_id'];

      $database->delete_orders($order_id);

      for ($i = 0; $i < count($_POST['name1']); $i++) {

         $arraye[$i] = array(
            "name" => $_POST['name1'][$i],
            "item" => $_POST['item'][$i],
            "price" => $_POST['price'][$i],
            "type" => $_POST['type'][$i]
         );
      }

      $total_price = 0;


      // echo json_encode($arraye);
      foreach ($arraye as $id => $ary) {
         $price_p =  $ary['item'] * $ary['price'];
         $total_price = $total_price + $price_p;
         if ($price_p != 0) {
            $database->add_order($ary['name'], $ary['item'], $ary['price'], $ary['type'], $order_id);
         }
      }
      $retval = $database->update_orders_edit($total_price, $order_id, $roomno);

      if ($retval == 0) {
         $_SESSION['reguname'] = $_POST['user'];
         $_SESSION['regsuccess'] = true;
         header("Location: vieworders.php?&&OrderUpdatedSuccessfully");
      } else if ($retval == 1) {
         $_SESSION['value_array'] = $_POST;
         $_SESSION['error_array'] = $form->getErrorArray();
         header("Location: resturant.php?&&InvalidOrNullValueEntered");
      } else if ($retval == 2) {
         $_SESSION['reguname'] = $_POST['user'];
         $_SESSION['regsuccess'] = false;
         header("Location: resturant.php?&DatabaseError");
      }
   }
   function add_employees()
{
   global $database, $session, $form;
   
   $name = $_POST['name'];
   $cnic = $_POST['cnic'];
   $number_n = $_POST['number_n'];
   $base_salary = $_POST['base_salary'];
   $hiring_date = $_POST['hiring_date'];
   $pay_date = $_POST['pay_date'];

   $filename = $_FILES['emp_pic']['name'];
   $filetmpname = $_FILES['emp_pic']['tmp_name'];

   
    $base_name = "image_";
    $filename1 = $name.$base_name.rand().'.png';
   
   $filename_2 = $_FILES['agreement']['name'];
   $filetmpname_2 = $_FILES['agreement']['tmp_name'];

    define('UPLOAD_PATH', 'employee/agreements/');   
    $base_name = "agreement_";
    $filename2 = $name.$base_name.rand().'.pdf';

   $retval = $database->add_employees($name, $cnic,$number_n,$base_salary, $hiring_date,$pay_date,$filename1, $filename2);

      if ($retval) {

      if($filetmpname != ""){
      
         move_uploaded_file($filetmpname, 'employee/images/'.$filename1);
      }
      if($filetmpname_2 != ""){
         
         move_uploaded_file($filetmpname_2, 'employee/agreements/'.$filename2);
      }
      
      $_SESSION['reguname'] = $_POST['user'];
      $_SESSION['regsuccess'] = true;
      header("Location: view_employees.php?&&EmployeeAddedSuccessfully");
   } else if ($retval == 1) {
      $_SESSION['value_array'] = $_POST;
      $_SESSION['error_array'] = $form->getErrorArray();
      header("Location: add_employees.php?&&FormError");
   } else if ($retval == 2) {
      $_SESSION['reguname'] = $_POST['user'];
      $_SESSION['regsuccess'] = false;
      header("Location: add_employees.php?&&DbError");
   }
}


function edit_employees()
{
   global $database, $session, $form;
   $id = $_POST['id'];
   $name = $_POST['name'];
   $cnic = $_POST['cnic'];
   $number_n = $_POST['number_n'];
   $base_salary = $_POST['base_salary'];
   $hiring_date = $_POST['hiring_date'];
   $pay_date = $_POST['pay_date'];

   $result= $database->get_employees_details($id);
   $old_filename_1 =  $result[7];
   $old_filename_2 =  $result[8];

   $filename = $_FILES['emp_pic']['name'];
   $filetmpname = $_FILES['emp_pic']['tmp_name'];
    
   
    $base_name = "image_";
    $filename1 = $name.$base_name.rand().'.png';
   
   $filename_2 = $_FILES['agreement']['name'];
   $filetmpname_2 = $_FILES['agreement']['tmp_name'];
 
    $base_name = "agreement_";
    $filename2 = $name.$base_name.rand().'.pdf';

    if($filetmpname == ""){
      $filename1 = $old_filename_1;
    }
    if($filetmpname_2 == ""){
      $filename2 = $old_filename_2;
   }
   $retval = $database->edit_employees($id, $name, $cnic,$number_n,$base_salary, $hiring_date,$pay_date,$filename1, $filename2);

      if ($retval) {

      if($filetmpname != ""){
         unlink('employee/images/'.$old_filename_1);
         move_uploaded_file($filetmpname, 'employee/images/'.$filename1);
      }
      if($filetmpname_2 != ""){
         unlink('employee/agreements/'.$old_filename_2);
         move_uploaded_file($filetmpname_2, 'employee/agreements/'.$filename2);
      }
      $_SESSION['reguname'] = $_POST['user'];
      $_SESSION['regsuccess'] = true;
      header("Location: view_employees.php?&&EmployeeEditedSuccessfully".$filetmpname);
   } else if ($retval == 1) {
      $_SESSION['value_array'] = $_POST;
      $_SESSION['error_array'] = $form->getErrorArray();
      header("Location: edit_employees.php?&&FormError");
   } else if ($retval == 2) {
      $_SESSION['reguname'] = $_POST['user'];
      $_SESSION['regsuccess'] = false;
      header("Location: edit_employees.php?&&DbError");
   }
}

function add_salary()
{
   global $database, $session, $form;
   
   $id = $_POST['id'];
   $amount = $_POST['new_amount']; 
   $base_amount = $_POST['base_amount']; 
   $bonus = $_POST['bonus']; 
   $cutting = $_POST['cutting']; 
   
   

   $retval = $database->add_salary($id, $amount , $bonus, $cutting,  $base_amount);

      if ($retval) {
      
      $_SESSION['reguname'] = $_POST['user'];
      $_SESSION['regsuccess'] = true;
      header("Location: view_employees.php?&&PayAddedSuccessfully" );
   } else if ($retval == 1) {
      $_SESSION['value_array'] = $_POST;
      $_SESSION['error_array'] = $form->getErrorArray();
      header("Location: view_employees.php?&&FormError" );
   } else if ($retval == 2) {
      $_SESSION['reguname'] = $_POST['user'];
      $_SESSION['regsuccess'] = false;
      header("Location: view_employees.php?&&DbError");
   }

}

function add_salary_next()
{
   global $database, $session, $form;
   
   $id = $_POST['id'];
   $amount = $_POST['new_amount']; 
   $base_amount = $_POST['base_amount']; 
   $bonus = $_POST['bonus']; 
   $cutting = $_POST['cutting']; 
   $date = $_POST['date'];
   
   

   $retval = $database->add_salary_next($id, $amount , $bonus, $cutting,  $base_amount, $date);

      if ($retval) {
      
      $_SESSION['reguname'] = $_POST['user'];
      $_SESSION['regsuccess'] = true;
      header("Location: view_employees.php?&&PayAddedSuccessfully" );
   } else if ($retval == 1) {
      $_SESSION['value_array'] = $_POST;
      $_SESSION['error_array'] = $form->getErrorArray();
      header("Location: view_employees.php?&&FormError" );
   } else if ($retval == 2) {
      $_SESSION['reguname'] = $_POST['user'];
      $_SESSION['regsuccess'] = false;
      header("Location: view_employees.php?&&DbError");
   }

}



function add_cutting_next()
{
   global $database, $session, $form;
   
   $id = $_POST['id'];
   $amount = $_POST['amount'];
   $date = $_POST['date'];

   $array3 = $database->get_employees_details($id);
   $base_salary = ($array3[4]);

   $array = $database->get_nextmonthcutting_details($id, $date);
   if($array != "")
   {
      $id_c = ($array[0]);
      $prev_c = ($array[3]);
      $month = ($array[2]);
   }
   else{
      $id_c = "";
   }
  

   if($id_c == ""){
      if($amount < $base_salary)
      {
         $retval = $database->add_cutting_next($id, $amount, $date);
      }
      else{
         $retval = 3;
      }
      
   }
   else{

      $amount = $prev_c + $amount;
      if($amount < $base_salary)
      {
         $retval = $database->update_cutting($id, $amount, $month);
      }
      else{
         $retval = 3;
      }
   }
      if ($retval == 0) {
      
      $_SESSION['reguname'] = $_POST['user'];
      $_SESSION['regsuccess'] = true;
      header("Location: view_employees.php?&&CuttingAddedSuccessfully" );
   } else if ($retval == 1) {
      $_SESSION['value_array'] = $_POST;
      $_SESSION['error_array'] = $form->getErrorArray();
      header("Location: view_employees.php?&&FormError" );
   } else if ($retval == 2) {
      $_SESSION['reguname'] = $_POST['user'];
      $_SESSION['regsuccess'] = false;
      header("Location: view_employees.php?&&DbError");
   }
   else if ($retval == 3) {
      $_SESSION['reguname'] = $_POST['user'];
      $_SESSION['regsuccess'] = false;
      header("Location: view_employees.php?variable=1&Error(CuttingMoreThanBasicSallery)");
   }

}


function add_cutting()
{
   global $database, $session, $form;
   
   $id = $_POST['id'];
   $amount = $_POST['amount'];

   $array = $database->get_cutting_details($id);
   if($array != "")
   {
      $id_c = ($array[0]);
      $prev_c = ($array[3]);
      $month = ($array[2]);
   }
   else{
      $id_c = "";
   }
  

   if($id_c == ""){
      $retval = $database->add_cutting($id, $amount);
   }
   else{
      $amount = $prev_c + $amount;
      $retval = $database->update_cutting($id, $amount, $month);
   }
      if ($retval) {
      
      $_SESSION['reguname'] = $_POST['user'];
      $_SESSION['regsuccess'] = true;
      header("Location: view_employees.php?&&CuttingAddedSuccessfully" );
   } else if ($retval == 1) {
      $_SESSION['value_array'] = $_POST;
      $_SESSION['error_array'] = $form->getErrorArray();
      header("Location: view_employees.php?&&FormError" );
   } else if ($retval == 2) {
      $_SESSION['reguname'] = $_POST['user'];
      $_SESSION['regsuccess'] = false;
      header("Location: view_employees.php?&&DbError");
   }

}
   function procLogin()
   {
      global $session, $form;
      $retval = $session->login($_POST['user'], $_POST['pass']);

      if ($retval) {
         header("Location: index.php");
      } else {
         $_SESSION['value_array'] = $_POST;
         $_SESSION['error_array'] = $form->getErrorArray();
         header("Location: " . $session->referrer);
      }
   }

   function add_inventory()
   {
      global $database;
      $retval = $database->add_inventory($_POST['item'], $_POST['qty']);

      if ($retval) {
         header("Location: view_inventory.php");
      }
   }

      function add_receiving()
   {
      global $database, $session;
     
$rooms_id = $_POST['rom_id'];

$procTotal = $_POST['total'];

$advance = $_POST['advance'];

$received = $_POST['received'];

$total = $advance + $received;

$retotal = $total - $advance - $received;

$random_id = $database->checkin_id_from_rm($rooms_id);
$database->add_recieving($random_id, "Room", $received);
       $retval = $database->add_receiving($rooms_id, $total);
      if ($retval) {
         header("Location: ".$session->referrer."?id=" . $rooms_id . "&total=" . $procTotal ."&advance=" . $total);
      }
   }
      function add_receiving11()
   {
      global $database, $session;
     
$rooms_id = $_POST['rom_id'];

$procTotal = $_POST['total'];

$advance = $_POST['advance'];

$received = $_POST['received'];

$total = $advance + $received;

$retotal = $total - $advance - $received;

$random_id = $database->checkin_id_from_rm($rooms_id);

$database->add_recieving11($random_id, "Room", $received);
       $retval = $database->add_receiving($rooms_id, $total);

         header("Location: unpaid_report.php");
   
   }
   function edit_inventory()
   {
      global $database;
      $retval = $database->edit_inventory($_POST['id'], $_POST['item'], $_POST['qty']);

      if ($retval) {
         header("Location: view_inventory.php");
      }
   }


   function add_to_checkin()
   {
      global $database;
      $date_out = Date("Y-m-d", strtotime($_POST['date'] . " +" . $_POST['t_days'] . " Days"));
      $date_out = date('Y-m-d', (strtotime('-1 day', strtotime($date_out))));

      $date_in = $_POST['date'];

      $dates = $database->getDatesFromRange($date_in, $date_out);

      $random_id = $_POST['checkin_id'];

      foreach ($dates as $key => $value) {
         $database->add_booked_dates($random_id, $value);
      }

      $rand = $_POST['rooms_id'];
      $rand = "rms_".$rand."_rsvp";
      $advance = $_POST['advance'];
      $cnic = $_POST['cnic'];
      $cnic = preg_replace('/\s+/', '', $cnic);
      $a = substr($cnic, 2);
      $city_code = substr($a, 0, -10);

      $city = $database->check_citi($city_code);

      $database->add_checkin($random_id, $_POST['name'], $_POST['cnic'], $city, $_POST['date'], $date_out, $rand, $_POST['rate'], $_POST['discount'], $_POST['price'], $_POST['numbere'], $advance);

      $numbers = $database->get_resered($random_id);

      for ($i = 0; $i < count($numbers); $i++) {
         $database->add_room($rand, $numbers[$i], $_POST['name']);
      }



      $id = $_POST['checkin_id'];
      $q = "SELECT `reservation_rooms_id` FROM reservations WHERE res_id = '$id'";
      $ry = $database->query($q);

      $rooms_id_ry = mysqli_fetch_row($ry);
      $rooms_id = $rooms_id_ry[0];

      $q = "DELETE FROM `reservation_rooms` WHERE `rooms_id` = '$rooms_id'";
      $database->query($q);

      $q = "DELETE FROM `reservations` WHERE `res_id` = '$id'";
      $database->query($q);

      $q = "DELETE FROM `reserved_dates` WHERE `reservation_id` = '$id'";
      $database->query($q);
      header("Location: viewcheckin.php?index=sucess");
   }

   //      function add_reservation(){
   // global $database;

   // $date_in = $_POST['date'];
   // $date_out = Date("Y-m-d", strtotime($_POST['date']." +".$_POST['t_days']." Days"));
   // $date_out = date('Y-m-d',(strtotime ( '-1 day' , strtotime ($date_out) ) ));    

   // $dates = $database->getDatesFromRange($date_in,$date_out);

   // $res_id = rand(0000,1111);

   // foreach ($dates as $key => $value) {
   //   $database->add_reserved_dates($res_id, $value);
   // }

   // $cnic = $_POST['cnic'];
   // $cnic = preg_replace('/\s+/', '', $cnic);
   //  $a = substr($cnic,2);
   // $city_code = substr($a,0, -10);




   //    $cust_name = $_POST['name'];   
   //    $cust_mobile_no = $_POST['number_n'];
   //    $reservation_rooms_id = rand(0000,1111);
   //    for ($i=0; $i < count($_POST['number']); $i++) { 
   //      $database->add_room_reserved($reservation_rooms_id, $_POST['number'][$i],$_POST['name']); 
   //    }


   //    $rate = $_POST['rate'];
   //    $discount = $_POST['discount'];
   //    $price = $_POST['price'];
   //    $advance = $_POST['advance'];
   //    $city = $database->check_citi($city_code);
   //    $cnic = $_POST['cnic'];




   // $database->add_reservation($res_id,$cust_name,$cust_mobile_no,$reservation_rooms_id,$cnic,$city,$date_in,$date_out,$rate,$discount,$price,$advance);   
   // header("Location: viewreservation.php?index=sucess");
   //    }

   function add_checkin()
   {
      global $database;

      $date_out = Date("Y-m-d", strtotime($_POST['date'] . " +" . $_POST['t_days'] . " Days"));
      $date_out = date('Y-m-d', (strtotime('-1 day', strtotime($date_out))));

      $date_in = $_POST['date'];

      $dates = $database->getDatesFromRange($date_in, $date_out);

      $random_id = rand(0000, 1111);


      $check_id = $database->check_id($random_id);


      if ($database->check_id($random_id) == 0) {
         $random_id = rand(111, 999);
         $r = rand(11111,99999);
         $database->update_code($r);
      }
      $cc_code = $database->check_code();
      $random_id = $random_id.$cc_code;



      foreach ($dates as $key => $value) {
         $database->add_booked_dates($random_id, $value);
      }

      $rand = rand(11111, 99999);
      $advance = $_POST['advance'];
      $cnic = $_POST['cnic'];
      $cnic = preg_replace('/\s+/', '', $cnic);
      $a = substr($cnic, 2);
      $city_code = substr($a, 0, -10);
      $name = preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $_POST['name']);

      // $cURLConnection = curl_init();

      // curl_setopt($cURLConnection, CURLOPT_URL, 'http://shahams.shop/arduino/anees/index.php');
      // curl_setopt($cURLConnection, CURLOPT_RETURNTRANSFER, true);

      // $phoneList = curl_exec($cURLConnection);
      // curl_close($cURLConnection);

      // $jsonArrayResponse = json_decode($phoneList);
      // $num = substr($_POST['numbere'], 1);
      // $postRequest = array(
      //    'insert' => '0',
      //    'number' => $num,
      //    'name' => $name,
      //    'message' => ' You have Checked inn to Almas Hotel, We wish you a happy stay!'
      // );

      // $cURLConnection = curl_init('http://shahams.shop/arduino/anees/index.php');
      // curl_setopt($cURLConnection, CURLOPT_POSTFIELDS, $postRequest);
      // curl_setopt($cURLConnection, CURLOPT_RETURNTRANSFER, true);

      // $apiResponse = curl_exec($cURLConnection);
      // curl_close($cURLConnection);

      $city = $_POST['city'];



      $database->add_checkin($random_id, $name, $_POST['cnic'], $city, $_POST['date'], $date_out, $rand, $_POST['rate'], $_POST['discount'], $_POST['price'], $_POST['numbere'], $advance);
$database->add_recieving($random_id, "Room", $advance);


      for ($i = 0; $i < count($_POST['number']); $i++) {
         $database->add_room($rand, $_POST['number'][$i], $_POST['name']);
      }




      header("Location: viewcheckin.php?index=sucess");
   }


   function add_reservation()
   {
      global $database;

      $date_in = $_POST['date'];
      $date_out = Date("Y-m-d", strtotime($_POST['date'] . " +" . $_POST['t_days'] . " Days"));

      //$date_out = date('Y-m-d', (strtotime('-1 day', strtotime($date_out))));
 
      $dates = $database->getDatesFromRange($date_in, $date_out);

    //   if ($database->check_id($res_id) == 0) {
    //      $res_id = rand(111, 999);
    //      $r = rand(11111,99999);
    //      $database->update_code($r);
    //   }
    //   $cc_code = $database->check_code();
      $res_id = rand();
      $dates1=array_slice($dates,0,count($dates)-1);

      foreach ($dates1 as $key => $value) {
         $database->add_reserved_dates($res_id, $value);
      }

      $cnic = $_POST['cnic'];
      $cnic = preg_replace('/\s+/', '', $cnic);
      $a = substr($cnic, 2);
      $city_code = substr($a, 0, -10);


      $cust_name = preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $_POST['name']);
      $room_typebv = "";
      $cust_mobile_no = $_POST['number_n'];
      $reservation_rooms_id = rand(0000, 1111);
      for ($i = 0; $i < count($_POST['number']); $i++) {
         $database->add_room_reserved($reservation_rooms_id, $_POST['number'][$i], $cust_name);
         $cat = $database->check_cat($_POST['number'][$i]);
         if ($cat == "master") {
            $cat = "Master Bed";
         } else if ($cat == "4bed") {
            $cat = "4 Bed";
         } else if ($cat == "3bed") {
            $cat = "3 Bed";
         } else if ($cat == "3bed_d") {
            $cat = "3 Bed Delux";
         } else if ($cat == "family") {
            $cat = "Family Suite";
         }
         $room_typebv .= ", " . $cat;
      }


      $rate = $_POST['rate'];
      $discount = $_POST['discount'];
      $price = $_POST['price'];
      $advance = $_POST['advance'];
      $city = $_POST['city'];
      $cnic = $_POST['cnic'];
      $msg_date = date("d-m-Y", strtotime($date_in));

      // $cURLConnection = curl_init();

      // curl_setopt($cURLConnection, CURLOPT_URL, 'http://shahams.shop/arduino/anees/index.php');
      // curl_setopt($cURLConnection, CURLOPT_RETURNTRANSFER, true);

      // $phoneList = curl_exec($cURLConnection);
      // curl_close($cURLConnection);

      // $jsonArrayResponse = json_decode($phoneList);
      // $num = substr($cust_mobile_no, 1);
      // $postRequest = array(
      //    'insert' => '0',
      //    'number' => $num,
      //    'name' => $cust_name,
      //    'message' => ' Reservation of ' . $room_typebv . ' room(s) at Hotel Almas is confirmed on ' . $msg_date . ', You have Paid : ' . $advance . ''
      // );

      // $cURLConnection = curl_init('http://shahams.shop/arduino/anees/index.php');
      // curl_setopt($cURLConnection, CURLOPT_POSTFIELDS, $postRequest);
      // curl_setopt($cURLConnection, CURLOPT_RETURNTRANSFER, true);

      // $apiResponse = curl_exec($cURLConnection);
      // curl_close($cURLConnection);




      $database->add_reservation($res_id, $cust_name, $cust_mobile_no, $reservation_rooms_id, $cnic, $city, $date_in, $date_out, $rate, $discount, $price, $advance);
      $database->add_recieving($res_id, "Room", $advance);
      header("Location: viewreservation.php?index=sucess");
   }

   function edit_reservation()
   {
      global $database;

      $id = $_POST['res_id'];
       $rate = $_POST['rate'];
      $discount = $_POST['discount'];
      $price = $_POST['price'];
      $advance = $_POST['advance'];
//         $q1 = "SELECT * FROM `reservations` WHERE `res_id` = '$id'";
//       $ry1 = $database->query($q1);

//       $reserv = mysqli_fetch_row($ry1);
     

// $old_rate=$reserv[8];
// $old_discount=$reserv[9];
// $old_price=$reserv[10];
// $old_advance=$reserv[11];

// if($old_rate>$rate ||$old_discount>$discount ||$old_price>$price ||$old_advance> $advance)
// {
//    var_dump($old_rate); die;

// //   echo "<script>
// // alert('There are no fields to generate a report');
// // window.location.href='viewreservation.php';
// // </script>";
   

// }

      $q = "SELECT `reservation_rooms_id` FROM reservations WHERE res_id = '$id'";
      $ry = $database->query($q);

      $rooms_id_ry = mysqli_fetch_row($ry);
     
      $rooms_id = $rooms_id_ry[0];

      $q = "DELETE FROM `reservation_rooms` WHERE `rooms_id` = '$rooms_id'";
      $database->query($q);

      $q = "DELETE FROM `reservations` WHERE `res_id` = '$id'";
      $database->query($q);

      $q = "DELETE FROM `reserved_dates` WHERE `reservation_id` = '$id'";
      $database->query($q);



      $date_in = $_POST['date'];
      $date_out = Date("Y-m-d", strtotime($_POST['date'] . " +" . $_POST['t_days'] . " Days"));
      
      $date_out = date('Y-m-d', (strtotime('-0 day', strtotime($date_out))));

      $dates = $database->getDatesFromRange($date_in, $date_out);

      $res_id = $id;

      foreach ($dates as $key => $value) {
         $database->add_reserved_dates($res_id, $value);
      }

      $cnic = $_POST['cnic'];
      $cnic = preg_replace('/\s+/', '', $cnic);
      $a = substr($cnic, 2);
      $city_code = substr($a, 0, -10);




      $cust_name = preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $_POST['name']);
      $cust_mobile_no = $_POST['number_n'];
      $reservation_rooms_id = $rooms_id;
      for ($i = 0; $i < count($_POST['number']); $i++) {
         $database->add_room_reserved($reservation_rooms_id, $_POST['number'][$i], $cust_name);
      }


     
      $city = $database->check_citi($city_code);
      $cnic = $_POST['cnic'];




      $database->add_reservation($res_id, $cust_name, $cust_mobile_no, $reservation_rooms_id, $cnic, $city, $date_in, $date_out, $rate, $discount, $price, $advance);
      header("Location: viewreservation.php?index=sucess");
   }



   function add_rooms()
   {
      global $database;

     
$rest_name = $_POST['rest_name'];
      $category = $_POST['category'];

      $number = $_POST['number'];
     $rate = $_POST['rate'];
     



      $a=$database->add_rooms($rest_name, $category, $number, $rate);
if($a==1)
{
     echo "<script>
alert('Room Number Already Exist');
window.location.href='addroom.php';
</script>";
}
else
{
        header("Location: view_rooms.php?index=sucess");
}
   }



  function edit_room()
   {
      global $database;
      $retval = $database->edit_room($_POST['id'],$_POST['rest_name'], $_POST['category'], $_POST['number'], $_POST['rate']);

      if ($retval) {
         header("Location: view_rooms.php");
      }
   }








   function edit_checkin()
   {
      global $database;

      $id = $_POST['c_id'];
      $q = "SELECT `rooms_id` FROM checkin WHERE id = '$id'";
      $ry = $database->query($q);

      $rooms_id_ry = mysqli_fetch_row($ry);
      
      $rooms_id = $rooms_id_ry[0];

      $q = "DELETE FROM `room` WHERE `rooms_id` = '$rooms_id'";
      $database->query($q);

      $q = "DELETE FROM `checkin` WHERE `id` = '$id'";
      $database->query($q);

      $q = "DELETE FROM `booked_dates` WHERE `checkin_id` = '$id'";
      $database->query($q);


      $date_out = Date("Y-m-d", strtotime($_POST['date'] . " +" . $_POST['t_days'] . " Days"));
      $date_out = date('Y-m-d', (strtotime('-1 day', strtotime($date_out))));

      $date_in = $_POST['date'];

      $dates = $database->getDatesFromRange($date_in, $date_out);

      $random_id = $rooms_id;
      $rand = $id;
      foreach ($dates as $key => $value) {
         $database->add_booked_dates($rand, $value);
      }


      $cust_name = preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $_POST['name']);
   
      $advance = $_POST['advance'];
      $cnic = $_POST['cnic'];
      $cnic = preg_replace('/\s+/', '', $cnic);
      $a = substr($cnic, 2);
      $city_code = substr($a, 0, -10);

      $city = $database->check_citi($city_code);

      $database->add_checkin($rand, $cust_name, $_POST['cnic'], $city, $_POST['date'], $date_out, $random_id, $_POST['rate'], $_POST['discount'], $_POST['price'], $_POST['numbere'], $advance);



      for ($i = 0; $i < count($_POST['number']); $i++) {
         $database->add_room($random_id, $_POST['number'][$i], $cust_name);
      }

      $nq = "UPDATE `receiving` SET `checkin_id`='$random_id' WHERE checkin_id = '$rand'";
      $database->query($nq);

      header("Location: viewcheckin.php?index=sucess");
   }


   function deliverorder()
   {
      global $database, $session, $form;
      $order_id = $_POST['order_id'];



      $retval = $database->deliver_order($order_id);

      if ($retval == 0) {
         $_SESSION['reguname'] = $_POST['user'];
         $_SESSION['regsuccess'] = true;
         header("Location: vieworders.php?&&OrderDeletedSuccessfully" . $session->referrer);
      } else if ($retval == 1) {
         $_SESSION['value_array'] = $_POST;
         $_SESSION['error_array'] = $form->getErrorArray();
         header("Location: vieworders.php?&&OrderDeletedSuccessfully" . $session->referrer);
      } else if ($retval == 2) {
         $_SESSION['reguname'] = $_POST['user'];
         $_SESSION['regsuccess'] = false;
         header("Location: vieworders.php?&&OrderDeletedSuccessfully" . $session->referrer);
      }
   }

   function deleteorder()
   {
      global $database, $session, $form;
      $order_id = $_POST['order_id'];



      $retval = $database->delete_order($order_id);

      if ($retval == 0) {
         $_SESSION['reguname'] = $_POST['user'];
         $_SESSION['regsuccess'] = true;
         header("Location: vieworders.php?&&OrderDeletedSuccessfully");
      } else if ($retval == 1) {
         $_SESSION['value_array'] = $_POST;
         $_SESSION['error_array'] = $form->getErrorArray();
         header("Location: vieworders.php?&&InvalidOrNullValueEntered");
      } else if ($retval == 2) {
         $_SESSION['reguname'] = $_POST['user'];
         $_SESSION['regsuccess'] = false;
         header("Location: vieworders.php?&DatabaseError");
      }
   }
   function add_order_extra_new()
   {
      global $database, $session, $form;
      $order_id = $_POST['order_id'];
      $roomno = $_POST['room_no'];
      $total = $_POST['total'];
      $name1 = $_POST['name1'];
      $quantity = $_POST['item'];
      $price = $_POST['price'];
      $type = $_POST['type'];
      
      $database->add_order_extra($name1, $quantity, $price, $type, $order_id,$total,$roomno);
      header("Location: vieworders.php?&&OrderAddedSuccessfully");

   }

   function add_order()
   {
      global $database, $session, $form;
      $item = $_POST['item'];
      $roomno = $_POST['roomno'];
      $arraye = array();
      for ($i = 0; $i < count($_POST['name1']); $i++) {

         $arraye[$i] = array(
            "name" => $_POST['name1'][$i],
            "item" => $_POST['item'][$i],
            "price" => $_POST['price'][$i],
            "type" => $_POST['type'][$i]
         );
      }


      $total_price = 0;
      $order_id = rand();

      $database->add_orders($total_price, $roomno, $order_id);

      // echo json_encode($arraye);
      foreach ($arraye as $id => $ary) {
         $price_p =  $ary['item'] * $ary['price'];
         $total_price = $total_price + $price_p;
         if ($price_p != 0) {
            if ($ary['name'] == "Nestle Mineral Water") {
               $e = "SELECT * FROM `inventory` WHERE type = 'Nestle Mineral Water'";
               $x = $database->query($e);
               $r = mysqli_fetch_row($x);
               $qtyy = $r[2];
               $qty_f = $qtyy - $ary['item'];
               $id = $r[0];

               $res = "UPDATE `inventory` SET `qty`= '$qty_f' WHERE id = '$id'";
               $x = $database->query($res);
            }
            $database->add_order($ary['name'], $ary['item'], $ary['price'], $ary['type'], $order_id);
         }
      }
      $retval = $database->update_orders($total_price, $order_id);

      if ($retval == 0) {
         $_SESSION['reguname'] = $_POST['user'];
         $_SESSION['regsuccess'] = true;
         header("Location: vieworders.php?&&OrderAddedSuccessfully");
      } else if ($retval == 1) {
         $_SESSION['value_array'] = $_POST;
         $_SESSION['error_array'] = $form->getErrorArray();
         header("Location: resturant.php?&&InvalidOrNullValueEntered");
      } else if ($retval == 2) {
         $_SESSION['reguname'] = $_POST['user'];
         $_SESSION['regsuccess'] = false;
         header("Location: resturant.php?&DatabaseError");
      }
   }

   function add_order_manual()
   {
      global $database, $session, $form;
      $item = $_POST['item'];
      
      $roomno = $_POST['roomno'];
      $name = $_POST['name1'];
      
      $price = $_POST['price'];
      $type = $_POST['type'];

      $total_price = $item*$price;
      $order_id = rand();

     $a= $database->add_orders($total_price, $roomno, $order_id);

      // echo json_encode($arraye);
     
           $database->add_order_manual($name, $item, $price, $type, $order_id);
           header("Location: vieworders.php?&&OrderAddedSuccessfully");
   }

   function add_order_extra()
   {
      global $database, $session, $form;
      $roomno = $_POST['roomno'];

      $total_price = $_POST['total'];
      $order_id = $_POST['order_id'];

      $database->add_orders($total_price, $roomno, $order_id);
      $database->add_order($_POST['item'], $_POST['qty'], $_POST['total'], "Full", $order_id);
      $database->deliver_order($order_id);



      header("Location: viewcheckin.php?&&OrderAddedSuccessfully");
   }

   function procLogout()
   {
      global $session;
      $retval = $session->logout();
      header("Location: login.php");
   }



   function procRegister()
   {
      global $session, $form;
      if (ALL_LOWERCASE) {
         $_POST['user'] = strtolower($_POST['user']);
      }
      $retval = $session->register($_POST['user'], $_POST['pass'], $_POST['email']);


      if ($retval == 0) {
         $_SESSION['reguname'] = $_POST['user'];
         $_SESSION['regsuccess'] = true;
         header("Location: " . $session->referrer);
      } else if ($retval == 1) {
         $_SESSION['value_array'] = $_POST;
         $_SESSION['error_array'] = $form->getErrorArray();
         header("Location: " . $session->referrer);
      } else if ($retval == 2) {
         $_SESSION['reguname'] = $_POST['user'];
         $_SESSION['regsuccess'] = false;
         header("Location: " . $session->referrer);
      }
   }



   function procEditAccount()
   {
      global $session, $form;

      $retval = $session->editAccount($_POST['curpass'], $_POST['newpass'], $_POST['email']);


      if ($retval) {
         $_SESSION['useredit'] = true;
         header("Location: " . $session->referrer);
      } else {
         $_SESSION['value_array'] = $_POST;
         $_SESSION['error_array'] = $form->getErrorArray();
         header("Location: " . $session->referrer);
      }
   }
};


$process = new Process;