


<!DOCTYPE html>
<html>
   <style>
      @media only screen and (max-width: 830px){
    #fdb{
      overflow-x: scroll;
    }
  }
   </style>
   <?php include 'head.php'; ?>    
   <body style="background-color: #a3a3a347;">
      <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js" type="text/javascript"></script>
      <?php include 'head_menu.php'; ?>
      <?php 
$pay = $_GET['pay'];
$name = $_GET['name'];
$id = $_GET['id'];

?>

<div class="container">
     <div class="col text-center mt-5">
                <h1><?php echo date('F'); ?></h1>
             <br><br>


<input type="date" id='gMonth1' onchange="show_month()" data-date-format="DD MMMM YYYY" value="<?php echo date('Y-m-d'); ?>">
    
              </div>
   <div class="row">
    <div class="col-md-3 col-xl-3 col-lg-3 col-sm-6"><h3>Basic Salary:</h3></div>
     <div class="col-md-3 col-xl-3 col-lg-3 col-sm-6"><h3><?php
     echo $pay; 
    ?></h3></div>
    <!-- <div class="col-md-"></div> -->
    <div class="col-md-3 col-xl-3 col-lg-3 col-sm-6"><h3>Name:</h3></div>
    <div class="col-md-3 col-xl-3 col-lg-3 col-sm-6"><h3><?php
     echo $name; 
    ?></h3></div>
   </div>
</div>
   <div id="datata" class="container"></div>

<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.22/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js"></script>
     
     
<script type="text/javascript">
 function show_month(){
    var month = $('#gMonth1').val();
   
    $.post("employee_details_ajax.php",
  {
    date:month,
     id:<?php echo $id; ?>,
     pay:<?php echo $pay; ?>
  },
  function(data, status){
     
    $("#datata").html(data);
     $('#tb1').dataTable({
    paging: false
});
  });
 }

  
    </script>


    <?php include 'foot.php'; ?>
   
   </body>
</html>