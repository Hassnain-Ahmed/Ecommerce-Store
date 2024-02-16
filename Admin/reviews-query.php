<?php
include("../DB-Con/db.con.php");
if (isset($_POST['ap_id'])) {
    $ap_id = $_POST['ap_id'];
    $get = mysqli_fetch_assoc(mysqli_query($con, "SELECT * from review left join user on user.u_id = review.u_id where ap_id = '$ap_id'"));
    $arr[] = $get;
    echo json_encode($arr);
}

if (isset($_POST['hide'])) {
    $r_id_h = $_POST['r_id_h'];
    mysqli_query($con, "UPDATE review set r_show = '0' where r_id = '$r_id_h' ");
}
if (isset($_POST['unhide'])) {
    $r_id_u = $_POST['r_id_u'];
    mysqli_query($con, "UPDATE review set r_show = '1' where r_id = '$r_id_u' ");
}
if (isset($_POST['delete'])) {
    $r_id_d = $_POST['r_id_d'];
    mysqli_query($con, "DELETE from review where r_id = '$r_id_d' ");
}

?>