<?php
date_default_timezone_set("Asia/karachi");
$navbar_date = date("Y/m/d h:i:s");



?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- <title>Homepage - Admin</title> -->


    <!-- Bootstrap -->
    <link rel="stylesheet" href="assets/bootstrap5/bootstrap-5.0.2-dist/css/bootstrap.min.css">
    <script src="assets/bootstrap5/bootstrap-5.0.2-dist/js/bootstrap.min.js"></script>

    <!-- FontAwesome -->
    <link rel="stylesheet" href="assets/fontawesome/fontawesome-free-6.2.1-web/css/all.css">
    <script src="assets/fontawesome/fontawesome-free-6.2.1-web/js/all.js"></script>

    <!-- Jquery -->
    <script src="assets/Jquery/jquery.min.js"></script>

    <!-- AOS-Master -->
    <link rel="stylesheet" href="assets/aos-master/aos-master/dist/aos.css">
    <script src="assets/aos-master/aos-master/dist/aos.js"></script>

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="assets/bootstrap-icons/Bootstrap Icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">

    <!-- Animate Style -->
    <!-- <link rel="stylesheet" href="assets/AnimateStyle/AnimateStyle.min.css"> -->

    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />



    <!-- External CSS Document File -->
    <link rel="stylesheet" href="Css/adminnavbar.css">
    <link rel="stylesheet" href="../User/Css/after-btn.css">



</head>

<body>

    <div class="container-fluid" id='nav-wrapper'>
        <div class="navbar row" id="nav">

            <div class="col-sm-3">
                <a href="admin.php"><img src="assets/img/Logo2.png" alt="" class="img-fluid d-block w-50"></a>
            </div>

            <div class="col-sm-6 text-center" id="a-nav-items">
                <ul>
                    <li><a href="admin.php" title="Edit">HOME <i class="bi-pencil-square"></i></a> </li>
                    <li>
                        <a href="Category.php" title="Edit">CATEGORY <i class="bi-pencil-square"></i> </a>
                    </li>
                    <li><a href="#" title="Edit"> FLASH DEALS <i class="bi-pencil-square"></i> </a> </li>
                    <li><a href="about.html" title="Edit">ABOUT US <i class="bi-pencil-square"></i> </a> </li>
                    <li><a href="contact.php" title="Edit">CONTACT <i class="bi-pencil-square"></i> </a> </li>
                </ul>
            </div>

            <div class="col-sm-3 text-end" id="icons-bar">
                <a href="#" id="a-m-open-btn">
                    <div id="icon" class="admin_menu_btn">
                        <i class="fa-solid fa-bars"></i>
                        Menu
                    </div>
                </a>

            </div>
        </div>
    </div>


    <div class="" id="admin_menu">

        <div id="a-m-bar" class="text-center row gx-1">

            <div class="col-3">
                <a href="admin.php">
                    <div>
                        <i class="fa fa-regular fa-user"></i> <br>
                        <span>Admin</span>
                    </div>
                </a>
            </div>

            <!-- <div class="col-3">
                <a href="#">
                    <div>
                        <i class="fa fa-regular fa-bell"></i> <br>
                        <span>Alerts</span>
                    </div>
                </a>
            </div> -->

            <div class="col-3">
                <a href="dashboard.php">
                    <div>
                        <i class="fa fa-solid fa-chart-line"></i> <br>
                        <span>Stats</span>
                    </div>
                </a>
            </div>

            <div class="col-3">
                <a href="orders.php" id="">
                    <div>
                        <i class="fa fa-solid fa-bag-shopping"></i> <br>
                        <span>Orders</span>
                    </div>
                </a>
            </div>

            <div class="col-3">
                <a href="../Login/logout-admin.php" id="">
                    <div>
                        <i class="fa fa-solid fa-arrow-right-from-bracket"></i> <br>
                        <span>Logout</span>
                    </div>
                </a>
            </div>

        </div>

        <div id="a-m-body">

            <h5>Homepage</h5>
            <ul>
                <a href="productslider.php">
                    <li>Edit Slider</li>
                </a>
                <a href="featureproducts.php">
                    <li>Feature Products</li>
                </a>
                <!-- <a href="dashboard.php">
                    <li>Dashboard</li>
                </a> -->
                <a href="Socials.php">
                    <li>Change Social Media Handles</li>
                </a>
            </ul>


            <h5>Products</h5>
            <ul>
                <a href="addproducts.php">
                    <li>Add new Product</li>
                </a>
                <a href="removeproducts.php">
                    <li>Remove Product</li>
                </a>
                <a href="">
                    <li>View All</li>
                </a>
                <a href="">
                    <li>Categories</li>
                </a>
            </ul>

            <h5>Dashboard</h5>
            <ul>
                <a href="dashboard.php">
                    <li>Monthly Sales</li>
                </a>
                <a href="dashboard_table.php">
                    <li>Sales</li>
                </a>
                <a href="dashboard_table.php">
                    <li>Products</li>
                </a>
            </ul>


            <h5>Orders</h5>
            <ul>
                <a href="orders.php">
                    <li>Orders History</li>
                </a>
                <!-- <a href="">
                    <li>Completed Orders</li>
                </a> -->
                <a href="orders_inshipment.php">
                    <li>In Process</li>
                </a>
            </ul>


            <!-- <h5>Socials</h5>
            <ul>
                <a href="Socials.php">
                    <li>Socails Media Handles</li>
                </a>
            </ul> -->



        </div>


        <div id="a-m-footer">
            <a href="#" id="a-m-close-btn">
                <div>
                    <i class="fa-solid fa-arrow-right-from-bracket"></i>
                    <span>Close</span>
                </div>
            </a>
            <p>Click to close the Menu</p>
        </div>


    </div>

    <script src="Scripts/adminnavbar.js"></script>