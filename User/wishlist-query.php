<?php
session_start();
date_default_timezone_set("Asia/Karachi");

if (isset($_SESSION['user_id'])) {

    include("../DB-Con/db.con.php");
    if (isset($_GET['productpage'])) {
        $query = mysqli_query($con, "SELECT ap_id from wishlist where ap_id='" . $_GET['p_id'] . "'");
        if (mysqli_num_rows($query) < 1) {

            if (mysqli_query($con, "INSERT into wishlist(ap_id,u_id,c_date) values('" . $_GET['p_id'] . "','" . $_SESSION['user_id'] . "','" . date("Y/m/d H:i:s") . "')")) {
                header("Location:product.php?p_id=" . $_GET['p_id'] . "");
            }
        } else {

            if (mysqli_query($con, "DELETE from wishlist where ap_id = " . $_GET['p_id'] . "")) {
                header("Location:product.php?p_id=" . $_GET['p_id'] . "");
            }
        }
    }

    if (isset($_GET['category'])) {
        $query = mysqli_query($con, "SELECT ap_id from wishlist where ap_id='" . $_GET['p_id'] . "'");

        if (isset($_GET['page'])) {
            $page = "&page=" . $_GET['page'];
        } else {
            $page = "";
        }

        if (mysqli_num_rows($query) < 1) {

            if (mysqli_query($con, "INSERT into wishlist(ap_id,u_id,c_date) values('" . $_GET['p_id'] . "','" . $_SESSION['user_id'] . "','" . date("Y/m/d H:i:s") . "')")) {
                header("Location:category_products.php?cty_name=" . $_GET['cty_name'] . "" . $page . "&success");
            }
        } else {

            if (mysqli_query($con, "DELETE from wishlist where ap_id = " . $_GET['p_id'] . "")) {
                header("Location:category_products.php?cty_name=" . $_GET['cty_name'] . "" . $page . "&Faliure");
            }
        }
    }

    if (isset($_GET['home'])) {
        $query = mysqli_query($con, "SELECT ap_id from wishlist where ap_id='" . $_GET['p_id'] . "'");

        if (mysqli_num_rows($query) < 1) {

            if (mysqli_query($con, "INSERT into wishlist(ap_id,u_id,c_date) values('" . $_GET['p_id'] . "','" . $_SESSION['user_id'] . "','" . date("Y/m/d H:i:s") . "')")) {
                header("Location:home.php");
            }
        } else {

            if (mysqli_query($con, "DELETE from wishlist where ap_id = " . $_GET['p_id'] . "")) {
                header("Location:home.php");
            }
        }
    }



} else {
    header("Lcoation: ../login/index.php?signin=1");
}