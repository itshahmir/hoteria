<!DOCTYPE html>
<html>
<?php include 'head.php'; ?>   

<style type="text/css">
      .room_br{
        background-color: black;
    max-width: 75px;
    max-height: 85px;
    margin: 4px;
    border-radius: 20px;
    padding: 5px 19px 0px 22px;
    box-shadow:  1px 1px 4px 2px;
    color: red;
      }
      .room_by{
        background-color: black;
    max-width: 75px;
    max-height: 85px;
    margin: 5px;
    border-radius: 22px;
    padding: 5px 19px 0px 22px;
    box-shadow: RED 1px 1px 4px 2px;
    color: RED;
      }
      .room_bg{
            border-radius: 40px;
    box-shadow: black 30px 5px 20px 10px;
      }
       .room_bg > *{
        color: black;

      }
      .room_br > *{
        color: white;
      }
      .room_by > *{
        color: white;
      }
      .side_room{
            position: fixed;
    top: 160px;
    right: 30px;
    max-height: 100%;
      }
      .side_left{
            position: fixed;
    top: 160px;
    left: 50px;
    max-height: 100%;
      }
 body{
  background-color:grey;
 }
 .room_bg:hover {
    border-radius: 15px;
    box-shadow: grey 5px 0px 25px 5px;
    transform: scale(1.1) !important;
 

  transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out, border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;

}
    </style>

   <?php include 'foot.php'; ?>

<body>
<?php include 'head_menu.php'; ?> 

    <section class="fdb-block mt-5 mt-5">

      <div class="container">
        <div class="row text-left justify-content-sm-center">

          
                  
          <div class="col-12 col-sm-8 col-lg-3 col-xl-3 ml-xl-auto mr-xl-auto pt-3 pt-lg-0 text-center">
            <h3><strong>Available Rooms <strong></h3>
           <h4><?php echo $database->get_available_rooms(); ?></h4>
          </div>  
        
    
      </div>
<div class="row m-4 p-4 justify-content-sm-center text-center">
   <div class="col"><h5>FROM</h5></div>
 <div class="col"><input type="date" id="today" class="form-control" data-date-format="DD MMMM YYYY" value="<?php echo date("Y-m-d"); ?>" style="width: 150px"></div>
 <div class="col"><h5>TO</h5></div>
 <div class="col"><input type="date" id="today_out" class="form-control" data-date-format="DD MMMM YYYY" value="<?php echo (date("Y-m-d")); ?>" style="width: 150px"></div>
</div>

<span id="texter"></span>
<h2 class="text-center" style="margin-bottom: -40px !important;"><strong/>Checkout Rooms<strong/></h2>
<table id="tableee" class="table table-striped table-bordered" >

    <thead>
        <tr style="background-color: darkgrey ;">
            <th>Serial</th>
            <th>Room(s)</th>
            <th>Name</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php $database->groupdata("checkins_clean","","","",""); ?>
    </tbody>
      
</table>
    </section>
<script type="text/javascript">
  $('#today_out').change(function() {
    var date = $('#today').val();
    var date_out = $('#today_out').val();
       $.ajax({ type: "GET", url: "chart.php",data: {date : date, date_out: date_out},success  : function(data) { $("#texter").html(data);}});
       });
$('#today').change(function() {
    var date = $('#today').val();
    var date_out = $('#today_out').val();
       $.ajax({ type: "GET", url: "chart.php",data: {date : date, date_out: date_out},success : function(data) { $("#texter").html(data);}});
       });
  $( document ).ready(function() {
    var date = $('#today').val();

       $.ajax({ type: "GET", url: "chart.php",data: {date : date},success : function(data) { $("#texter").html(data);}});
       });
</script>

  
</body>
</html>
