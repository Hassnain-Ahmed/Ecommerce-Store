<?php
session_start();
$sessionId = "0";
if (isset($_SESSION['user_id'])) {
    include("../DB-Con/db.con.php");
    $profile_query = mysqli_query($con, "SELECT * from user where u_id ='" . $_SESSION['user_id'] . "'");
    if ($profile_query) {
        $getprofile = mysqli_fetch_assoc($profile_query);
    }
    $profile = " <img src='../admin/assets/img/undraw_pic_profile_re_7g2h.svg' class='img-fluid' ></img> <abbr>&nbsp;" . $getprofile['u_name'] . "</abbr>";
    $script = " <script> $('.profile').click(function () { $('#profile_div').stop().toggle({ duration: 1 }); }); </script>";
    $sessionId = $_SESSION['user_id'];
} else {
    $profile = " <a href='../Login/index.php?signin=1'> <i class='fa fa-user' id='nav-fa-icon'></i> Signin / Signup </a>
    ";
}
date_default_timezone_set("Asia/Karachi");
$navbar_date = date("Y/m/d h:i:s");

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap -->
    <link rel="stylesheet" href="assets/bootstrap5/bootstrap-5.0.2-dist/css/bootstrap.min.css">
    <script src="assets/bootstrap5/bootstrap-5.0.2-dist/js/bootstrap.min.js"></script>

    <!-- FontAwesome -->
    <link rel="stylesheet" href="assets/fontawesome/fontawesome-free-6.2.1-web/css/all.css">
    <script src="assets/fontawesome/fontawesome-free-6.2.1-web/js/all.min.js"></script>

    <!-- Jquery -->
    <script src="assets/Jquery/jquery.min.js"></script>

    <!-- AOS-Master -->
    <!-- <link rel="stylesheet" href="assets/aos-master/aos-master/dist/aos.css">
    <script src="assets/aos-master/aos-master/dist/aos.js"></script> -->

    <!-- Bootstrap Icons -->
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css">

    <!-- Animate Style -->
    <link rel="stylesheet" href="assets/AnimateStyle/AnimateStyle.min.css">


    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />


    <!-- External CSS Document File -->
    <link rel="stylesheet" href="Css/usernavbar.css">
    <link rel="stylesheet" href="Css/after-btn.css">


</head>


<body>







    <?php
    include("../DB-Con/db.con.php");
    $query = mysqli_query($con, "SELECT count(*) as wish from wishlist where u_id ='" . $sessionId . "'");
    $wish = mysqli_fetch_assoc($query);
    ?>


    <div class="container-fluid">
        <div class="navbar row" id="nav">

            <div class="col-sm-3">
                <a href="Home.php"><img src="assets/img/Logo2.png" alt="" class="img-fluid d-block w-50"></a>
            </div>

            <div class="col-sm-6 text-center">
                <ul>
                    <li><a href="Home.php">HOME</a></li>
                    <li>
                        <a href="Categories.php">CATEGORY</a>
                        <ul>
                            <?php
                            $getCtyQuery = mysqli_query($con, "SELECT cty_name from category where cty_deleted != '1' limit 5");
                            while ($getCtyItem = mysqli_fetch_assoc($getCtyQuery)) {
                                echo "<li><a href='category_products.php?cty_name=" . $getCtyItem['cty_name'] . "'>" . $getCtyItem['cty_name'] . "</a></li>";
                            }
                            ?>
                        </ul>
                    </li>
                    <!-- <li><a href="#">FLASH DEALS</a></li> -->
                    <li><a href="about.php">ABOUT US</a></li>
                    <li><a href="contact.php">CONTACT</a></li>
                </ul>
            </div>

            <div class="col-sm-3 text-end" id="icons-bar">


                <div id="icon">
                    <a href="search.php">
                        <i class="fa fa-search" id="nav-fa-icon"></i>
                    </a>
                </div>

                <div id="icon">
                    <a href="cart.php">
                        <i class="fa fa-cart-shopping" id="nav-fa-icon"></i>
                    </a>
                </div>

                <div id="icon">
                    <a href="wishlist.php">
                        <i class="fa fa-heart" id="nav-fa-icon"></i>
                        <span>
                            <?php echo implode(",", $wish); ?>
                        </span>
                    </a>
                </div>

                <div id="icon">
                    <div class="profile">
                        <?php echo $profile ?>
                    </div>
                    <div id="profile_div">
                        <div id="profile_div-pointer"><i class="fp fa fa-caret-down"></i></div>

                        <div id="profile_options">
                            <ul>
                                <a href="myprofile.php">
                                    <li> <i class="fa fa-edit"></i> My Profile</li>
                                </a>
                                <!-- <a href="myprofile.php?myOrders">
                                    <li> <i class="fa fa-clipboard"></i> My Orders</li>
                                </a> -->
                                <!-- <a href="">
                                    <li></li>
                                </a> -->
                                <a href="../Login/logout-user.php">
                                    <li> <i class="fa fa-right-from-bracket"></i> Logout</li>
                                </a>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php
    if (isset($script)) {
        echo $script;
    }
    ?>