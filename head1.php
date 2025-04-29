<header class="header_section bg-secondary">
        <div class="container-fluid">
            <nav class="navbar navbar-expand-lg custom_nav-container ">
                <div class="btn btn-outline-warning m-1 hover-zoom toggle-btn_1">
                    <h6 style="color: grey-space: nowrap;margin-top: 10px;font-style:italic;font-size: 15px"><?php echo $session->username; ?></h6>
                </div>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class=""> </span>
                </button>
                <div class="collapse navbar-collapse justify-content-center navbar-collapse-4 " id="navbarSupportedContent">
                    <ul class="navbar-nav">
                        <a href="index.php" class="mr-4 pr-4">

                            <img src="./imgs/Full_Logo.png" height="55" alt="image">
                        </a>
                        <li class="nav-item dropdown">
                            <a class="nav-link  dropdown-toggle" href="#" data-bs-toggle="dropdown"><span class="badge badge-pill badge-danger"><?php echo $database->get_tot_reservations(); ?></span><strong> Reservations</a>
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
                        <li class="nav-item dropdown">
                            <a class="nav-link  dropdown-toggle" href="#" data-bs-toggle="dropdown"><?php echo $database->get_t_orders_live(); ?> Restaurant</a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="resturant.php">Add</a></li>
                                <li><a class="dropdown-item" href="vieworders.php">View</a></li>
                                <li><a class="dropdown-item" href="deliveredOrders.php">delivered</a></li>
                                <li><a class="dropdown-item" href="res_p.php">Live Orders</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
                <div class="collapse navbar-collapse navbar-collapse-4 justify-content-center" id="navbarSupportedContent">
                    <ul class="navbar-nav ml-auto justify-content-end">
                        <li class="nav-item">
                        </li>
                        <li class="nav-item">
                            <a class="btn btn-outline-warning m-1 hover-zoom toggle-btn_1" href="resturant_manual.php" style="font-size:13px;">Add Manual Order</a>
                        </li>
                        <li class="nav-item">
                            <a class="btn btn-outline-warning m-1 hover-zoom toggle-btn_1" href="resturant.php" style="font-size:17px;">Add Order</a>
                        </li>
                    </ul>

                </div>
            </nav>
        </div>
    </header>