<?php
include("../DB-Con/db.con.php");
if (isset($_POST['id'])) {

    $id = $_POST['id'];

    $query = mysqli_query($con, "SELECT * from slider where s_id = '$id' ");
    if ($query) {
        $get = mysqli_fetch_assoc($query);

        if ($get['s_img'] == "") {
            $getap_img = mysqli_fetch_assoc(mysqli_query($con, "SELECT ap_img_gal from add_products where ap_id = '" . $get['ap_id'] . "'"));
            $img = "uploads/" . explode(",", $getap_img['ap_img_gal'])[0];
        } else {
            $img = "uploads/slider/" . $get['s_img'];
        }

        echo $get['s_title'] . "|" . $get['s_about'] . "|" . $img . "|" . $get['s_status'] . "|" . $get['ap_id'] . "|" . $get['s_id'];
    }
}


if (isset($_POST['trigger'])) {

    $id = $_POST['s_id'];
    $title = $_POST['title'];
    $about = $_POST['about'];
    $status = $_POST['stat'];

    $imgOri = '';
    $imglen = count(explode("/", $_POST['img']));
    if ($imglen == 3) {
        $img = explode("/", $_POST['img'])[2];
    } else if ($imglen == 2) {
        $imgOri = explode("/", $_POST['img'])[1];
    } else {
        $img = '';
        $imgOri = '';
    }

    echo $imgOri;
    $query = mysqli_query($con, "UPDATE slider set s_title='$title' , s_about='$about', s_status='$status' , s_img='$img', s_ori_img='$imgOri' where s_id = '$id' ");
    if ($query) {
        echo "updated";
    }
}



?>