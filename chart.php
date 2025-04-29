<?php
include 'include/classes/session.php';
   if (isset($_REQUEST['date'])) {
      $date_in = $_REQUEST['date'];
       }
if (isset($_REQUEST['date_out'])) {
      $date_out = $_REQUEST['date_out'];
   }
?>
             

<?php if (isset($_REQUEST['date']) && isset($_REQUEST['date_out'])) {?>
	<div class="row m-4 p-4 justify-content-center">
<?php $database->chart_available($date_in,$date_out); ?>
          </div>
          

          
          <div class="side_room">
            <div class="ml-xl-auto mr-xl-auto pt-3 pt-md-0 pt-lg-0 pb-4 text-center">
            <h3><strong>Today Checkins</strong></h3>
           <h4><?php echo $database->get_t_checkins(); ?></h4>
 <a href="addcheckin.php" class="btn btn-danger  hover-zoom">Add</a>
             <a href="viewcheckin.php" class="btn btn-danger hover-zoom">View</a>
  <div class="row justify-content-center" style="max-width: 230px;">
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<h3>Checkins</h3>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <?php $database->chart_occupied($date_in,$date_out); ?>

</div></div>

<div class="side_left">
  <div class="ml-xl-auto mr-xl-auto pt-3 pt-md-0 pb-4 pt-lg-0 text-center">
<h3><strong>Today Reservations</strong></h3>
           <h4><?php echo $database->get_t_reservations(); ?></h4>
           <a href="addreservation.php" class="btn btn-danger  hover-zoom">Add</a>
             <a href="viewreservation.php" class="btn btn-danger hover-zoom">View</a>
   <div class="row justify-content-center" style="max-width: 230px;">
       &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<h3>Reservations</h3> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <?php $database->chart_reserved($date_in,$date_out); ?>
</div></div> <?php
} else {
	?>
  <div class="row m-4 p-4 justify-content-center">

            <?php $database->chart_available_today($date_in); ?>
          </div>
          <div class="side_room">
            <div class="ml-xl-auto mr-xl-auto pt-3 pt-md-0 pt-lg-0 pb-4 text-center">
            <h3><strong>Today Checkins</strong></h3>
           <h4><?php echo $database->get_t_checkins(); ?></h4>
 <a href="addcheckin.php" class="btn btn-danger  hover-zoom">Add</a>
             <a href="viewcheckin.php" class="btn btn-danger hover-zoom">View</a>
        <div class="row justify-content-center" style="max-width: 230px;">
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<h3>Checkins</h3>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <?php $database->chart_occupied($date_in,$date_out); ?>

</div></div>

<div class="side_left">
  <div class="ml-xl-auto mr-xl-auto pt-3 pt-md-0 pb-4 pt-lg-0 text-center">
<h3><strong>Today Reservations</strong></h3>
 <h4><?php echo $database->get_t_reservations(); ?></h4>
  <a href="addreservation.php" class="btn btn-danger  hover-zoom">Add</a>
  <a href="viewreservation.php" class="btn btn-danger hover-zoom">View</a>
  <div class="row justify-content-center" style="max-width: 230px;">
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<h3>Reservations</h3>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
 <?php $database->chart_reserved_today($date_in); ?>
</div></div> 
	<?php
} ?>


