<?php
date_default_timezone_set("Asia/Karachi");
$date = date("Y-m-d h:i:s");
if (isset($_POST['trigger_review'])) {
    Review($_POST['user_id'], $_POST['r_comment'], $_POST['r_ratting'], $date, $_POST['p_id']);
}

if (isset($_POST['getReviews'])) {
    GetReviews();
}



function GetReviews()
{
    include("../DB-Con/db.con.php");
    $query = mysqli_query($con, "SELECT * from review");
    $arr = array();
    while ($get = mysqli_fetch_assoc($query)) {
        $arr[] = $get;
    }
    echo json_encode($arr);
}

function Review($u_id, $r_cmt, $rate, $date, $ap_id)
{
    include("../DB-Con/db.con.php");
    $query = mysqli_query($con, "INSERT into review(r_id, r_comment, r_ratting, r_date, ap_id, u_id) values('', '$r_cmt', '$rate', '$date', '$ap_id', '$u_id')");
    if ($query) {
        return "success";
    }
}
?>