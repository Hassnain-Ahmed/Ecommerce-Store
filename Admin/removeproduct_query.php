<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: removeproduct_query.php");
}

include("../DB-Con/db.con.php");
$row_query = mysqli_query($con, "SELECT ap_id from add_products where ap_id = " . $_GET["ap_id"] . "");


if (mysqli_num_rows($row_query) > 0) {
    $del_query = mysqli_query($con, "UPDATE add_products SET ap_deleted = '1' where ap_id = '" . $_GET['ap_id'] . "' ");
    if ($del_query) {
        header("Location:removeproducts.php?status=success_query");
    } else {
        header("Location:removeproducts.php?status=error_query");
    }
} else {
    header("Location:removeproducts.php?status=error_query");
}