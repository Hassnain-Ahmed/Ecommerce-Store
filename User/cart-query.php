<?php
date_default_timezone_set("Asia/karachi");
session_start();
if (isset($_SESSION['user_id'])) {
    include("../DB-Con/db.con.php");
    if (isset($_GET['p_id'])) {

        if (mysqli_query($con, "INSERT into cart(c_id,u_id,ap_id,c_date,c_qty) values ('','" . $_SESSION['user_id'] . "','" . $_GET['p_id'] . "', '" . date("Y/m/d h:i:s") . "' , '" . $_GET['c_qty'] . "')")) {
            header("Location:cart.php");
        } else {
            header("Location:product.php?p_id=" . $_GET['p_id'] . "");
        }
    }

    if (isset($_GET['remove_p_id'])) {
        if (mysqli_query($con, "DELETE from cart where c_id = " . $_GET['remove_p_id'] . " ")) {
            header("Location:cart.php");
        } else {
            header("Location:cart.php?p_id=" . $_GET['remove_p_id'] . "");
        }
    }

    if (isset($_POST['buyall'])) {
        $query = mysqli_query($con, "UPDATE cart set buyAll = '1' where u_id = '" . $_SESSION['user_id'] . "' ");
    }
} else {
    header("Location: home.php");
}