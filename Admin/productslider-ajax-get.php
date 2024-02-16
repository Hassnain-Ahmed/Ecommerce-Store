<?php
if (isset($_POST['id'])) {
    $id = $_POST['id'];

    include("../DB-Con/db.con.php");
    $get = mysqli_fetch_assoc(mysqli_query($con, "SELECT ap_id,ap_name, ap_desc, ap_img_gal from add_products where ap_id= '$id' "));
    $img = explode(",", $get['ap_img_gal'])[0];

    echo $get['ap_name'] . "|" . $get['ap_desc'] . "|" . "uploads/" . $img . "|" . $get['ap_id'];

}
?>