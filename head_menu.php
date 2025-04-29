
<div class="sticky-top">
<header class="bg-secondary">
     <div>
         <nav class="navbar navbar-expand-md no-gutters navbar-default" role="navigation">
            
             <div class="col-3  text-left ">



                <div class="row">
                    <div class="col-12"><h6 style=a class="btn btn-danger m-1 hover-zoom toggle-btn_1"href="username.php"style="font-size:5px;"><?php echo $session->username; ?></h6></div>
                    <div class="col-12">  </div>
                </div>
                 
               


             </div>
             <button class="navbar-toggler" type="button" data-toggle="collapse" data-target=".navbar-collapse-4"
                 aria-controls="navbarNav15" aria-expanded="false" aria-label="Toggle navigation">
                 <span class="navbar-toggler-icon"></span>
             </button>

             <div class="collapse navbar-collapse navbar-collapse-4 justify-content-center col-md-6" id="navbarNav15">
                 <ul class="navbar-nav justify-content-center">
                    <a href="index.php" class="mr-6\4 pr-4">

                     <img src="./imgs/Full_Logo.png" height="55" alt="image">
                 </a>
                     <li class="nav-item dropdown">
                         <a class="nav-link  dropdown-toggle" href="#" data-bs-toggle="dropdown"><span class="badge badge-pill badge-danger"><?php echo $database->get_tot_reservations(); ?></span> Reservations</a>
                         <ul class="dropdown-menu">
                             <li><a class="dropdown-item" href="addreservation.php">Add</a></li>
                             <li><a class="dropdown-item" href="viewreservation.php">View</a></li>
                         </ul>
                     </li>
                     <li class="nav-item dropdown">
                         
                         <a class="nav-link  dropdown-toggle" href="#" data-bs-toggle="dropdown"><span class="badge badge-pill badge-danger"><?php echo $database->get_t_checkins(); ?></span> Bookings</a>
                         <ul class="dropdown-menu">
                             <li><a class="dropdown-item" href="addcheckin.php">Add</a></li>
                             <li><a class="dropdown-item" href="viewcheckin.php">View </a></li>
                         </ul>
                     </li>


                     </li>
                     <li class="nav-item dropdown">
                         <a class="nav-link  dropdown-toggle" href="#" data-bs-toggle="dropdown"><?php echo $database->get_t_orders_live(); ?> Restaurant</a>
                         <ul class="dropdown-menu">
                             <li><a class="btn m-1 hover-zoom toggle-btn_1"dropdown-item href="resturant.php">Add</a></li>
                             <li><a class="btn m-1 hover-zoom toggle-btn_1"dropdown-item href="vieworders.php">View</a></li>
                             <li><a class="btn m-1 hover-zoom toggle-btn_1"dropdown-item href="deliveredOrders.php">delivered</a></li>
                             <li><a class="btn m-1 hover-zoom toggle-btn_1"dropdown-item href="res_p.php">Live Orders</a></li>
                         </ul>
                     </li>
                 </ul>
             </div>

             <div class="collapse navbar-collapse navbar-collapse-4">
                 <ul class="navbar-nav ml-auto justify-content-end">
                     <li class="nav-item">
                     </li>
                 </ul>
                 <a class="btn btn-danger m-1 hover-zoom toggle-btn_1" href="resturant_manual.php"style="font-size:0px;">Add Manual Order</a>
                 <a class="btn btn-danger m-1 hover-zoom toggle-btn_1" href="resturant.php" style="font-size:15px;"
                 >Add Order</a>
                
             </div>
         </nav>

     </div>
 </header>
  <header style="background-color:lightgrey;max-height: 60px;">
        <div>
            
            <nav class="navbar navbar-expand-md">
                
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent1" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent1">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            <li class="nav-item dropdown">
                                <a class="nav-link  dropdown-toggle" href="#" data-bs-toggle="dropdown"><span class="badge badge-pill badge-danger"><?php echo $database->get_rooms; ?></span> </a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="addroom.php">Add</a></li>
                                    <li><a class="dropdown-item" href="view_rooms.php">View </a></li>
                                </ul>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="btn btn-outline-danger m-1 hover-zoom toggle-btn_1nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" style="font-size:12px;">Inventory</a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="add_inventory.php">Add</a></li>
                                    <li><a class="dropdown-item" href="view_inventory.php">View</a></li>
                                </ul>
                            </li>
                            <li class="nav-item dropdown">
                                <a style="font-size:12px;" class="btn btn-outline-danger m-1 hover-zoom toggle-btn_1 dropdown-toggle" nav-link dropdown-toggle href="#" data-bs-toggle="dropdown"><span class="badge badge-pill badge-danger"></span> Employees</a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="add_employees.php">Add</a></li>
                                    <li><a class="dropdown-item" href="view_employees.php">View</a></li>
                                  
                                </ul>
                            </li>
                            <li class="nav-item dropdown">
                                <a style="font-size:12px;" class="btn btn-outline-danger m-1 hover-zoom toggle-btn_1 dropdown-toggle" nav-link dropdown-toggle href="#" data-bs-toggle="dropdown"><span class="badge badge-pill badge-danger"></span> Expenses</a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="expensesheet.php">Main</a></li>
                                    <li><a class="dropdown-item" href="expensesheet_personal.php">Personal</a></li>
                                </ul>
                            </li>
                        </ul>
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            <li><a class="btn btn-outline-danger m-1 hover-zoom toggle-btn_1"nav-link href="cavity_print.php" style="font-size:13px;">Roti bill</a></li>
                            <li class="nav-item dropdown">
                                <a class="btn btn-outline-danger m-1 hover-zoom toggle-btn_1"nav-link dropdown-toggle href="#" data-bs-toggle="dropdown" style="font-size:13px;">Reports</a>
                                <ul class="dropdown-menu">
                                    <?php if ($session->userlevel == 8) {
                                    ?>
                                        <li><a class="btn btn-outline-danger m-1 hover-zoom"dropdown-item" href="Booking_report.php">Bookings Report</a></li>
                                        <li><a class="dropdown-item" href="monthly_report.php">Monthly Report</a></li>
                                        <li><a class="btn btn-outline-danger m-1 hover-zoom"dropdown-item" href="unpaid_report.php" style="color:red">Unpaid Invoices Report</a></li>
                                        <li><a class="dropdown-item" href="amount_recieved_report.php">Amount Recieved Report</a></li>
                                        <li><a class="dropdown-item" href="resturant_report.php">Resturant Bills</a></li>
                                    <?php
                                    }  ?>
                                    <li><a class="dropdown-item" href="police_report.php">Police Report</a></li>
                                    <li><a class="dropdown-item" href="cavity_report.php">Roti Bill</a></li>
                                    <li><a class="dropdown-item" href="import_db.php">Export Database</a></li>
                                    <!--   <li><a class="dropdown-item" href="import_db.php">Import Database</a></li> -->
                                </ul>
                            </li>
                        </ul>
                        
                        <div class="collapse navbar-collapse navbar-collapse-4"></div>
                        
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0 justify-content-end">
                            <li class="nav-link"><?php if ($session->userlevel == 8) { ?>
                                    <span class="badge badge-pill badge-danger "><?php 
                                     echo $database->get_unpaid_orders();
                                   
                                    ?></span>
                                    <a class="btn btn-danger m-1 hover-zoom toggle-btn_1" href="add_receiving_button.php" style="font-size:12px;">Receiving Button</a>
                                <?php } ?>
                            </li>
                            <li class="nav-link"><a class="btn btn-secondary m-1 hover-zoom toggle-btn_1" href="process.php" style="font-size:14px;">Logout</a></li>
                        </ul>
                    </div>
                </div>
            </nav>
        </div>
    </header>
</div>
<div class="overlay"></div>
<script>
    function show_loader() {
        $("body").addClass("loading");
    }
</script>


