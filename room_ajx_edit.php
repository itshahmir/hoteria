<?php
include 'include/classes/session.php';
$date_in = $_REQUEST['date_in'];
$days_of_stay = $_REQUEST['days'];
$id = $_REQUEST['id'];?>

                     <div class="col-3">
                        <div class="row">
                           <h5>Master Bed</h5>
                        </div>

                        <?php $database->get_rooms_new_with_id('master',$date_in,$days_of_stay,$id); ?>
                     </div>
                     <div class="col-3">
                        <div class="row align-items-center">
                           <h5>3 Bed Basic</h5>
                        </div>

                        <?php $database->get_rooms_new_with_id('3bed',$date_in,$days_of_stay,$id); ?>

                     </div>
                     <div class="col-3">
                        <div class="row align-items-center">
                           <h5>3 Bed Delux</h5>
                        </div>

                        <?php $database->get_rooms_new_with_id('3bed_d',$date_in,$days_of_stay,$id); ?>
                     </div>
                     <div class="col-3">
                        <div class="row align-items-center">
                           <h5>4 Bed</h5>
                        </div>

                        <?php $database->get_rooms_new_with_id('4bed',$date_in,$days_of_stay,$id); ?>
                     </div>
                     <div class="col-3">
                        <div class="row align-items-center">
                           <h5>Family Suit</h5>
                        </div>

                        <?php $database->get_rooms_new_with_id('family',$date_in,$days_of_stay,$id); ?>
                     </div>
      

