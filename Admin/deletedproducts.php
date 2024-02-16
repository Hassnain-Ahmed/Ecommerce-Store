<?php
include("../DB-Con/db.con.php");
date_default_timezone_set("Asia/Karachi");
$date = date("Y/m/d H:i:s");


if (isset($_POST['p_id'])) {

    if (isset($_POST['p_id'])) {

        $id = $_POST['p_id'];

        $query = mysqli_query($con, "UPDATE add_products set ap_deleted = 1 where ap_id = '$id'");
        if ($query) {
            mysqli_query($con, "INSERT into removed_items(ri_id, ri_date, ap_id) values('','$date','$id')");
            // echo "success";
        }
    }
}

if (isset($_POST['cty_id'])) {

    $id = $_POST['cty_id'];

    $query = mysqli_query($con, "UPDATE category set cty_deleted = 1 where cty_id = '$id'");
    if ($query) {
        mysqli_query($con, "INSERT into removed_items(ri_id, ri_date, cty_id) values('','$date','$id')");
    }
}

?>