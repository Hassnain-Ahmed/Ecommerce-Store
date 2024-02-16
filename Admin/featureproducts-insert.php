<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: featureproducts-insert.php");
}


if (isset($_GET['fp_id'])) {
    include("../DB-Con/db.con.php");
    $fp_id = $_GET['fp_id'];
    if (mysqli_num_rows(mysqli_query($con, "SELECT * FROM feature WHERE ap_id = '$fp_id' ")) < 1) {
        $query = mysqli_query($con, "INSERT into feature values('' , '" . $_GET['fp_id'] . "' , '" . date('Y/m/d h:i:s') . "')");

        if ($query) {
            header("Location:featureproducts.php?status=success");
        } else {
            header("Location:featureproducts.php?status=faliure");
        }
    } else {
        header("Location:featureproducts.php?already_exits");

    }
} else {
    header("Location:featureproducts.php");
}