<?php
include 'include/classes/session.php';
$date_in = $_REQUEST['date_in'];
$days_of_stay = $_REQUEST['days'];?>

                     <div class="col-3">
                        <div class="row">
                           <h5>Master Bed</h5>
                        </div>

                        <?php $database->get_rooms_new('master',$date_in,$days_of_stay); ?>
                     </div>
                     <div class="col-3">
                        <div class="row align-items-center">
                           <h5>3 Bed Basic</h5>
                        </div>

                        <?php $database->get_rooms_new('3bed',$date_in,$days_of_stay); ?>

                     </div>
                     <div class="col-3">
                        <div class="row align-items-center">
                           <h5>3 Bed Delux</h5>
                        </div>

                        <?php $database->get_rooms_new('3bed_d',$date_in,$days_of_stay); ?>
                     </div>
                     <div class="col-3">
                        <div class="row align-items-center">
                           <h5>4 Bed</h5>
                        </div>

                        <?php $database->get_rooms_new('4bed',$date_in,$days_of_stay); ?>
                     </div>
                     <div class="col-3">
                        <div class="row align-items-center">
                           <h5>Family Suit</h5>
                        </div>

                        <?php $database->get_rooms_new('family',$date_in,$days_of_stay); ?>
                     </div>
      

