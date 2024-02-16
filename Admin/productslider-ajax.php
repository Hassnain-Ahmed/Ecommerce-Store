<?php
include("../DB-Con/db.con.php");
$val = $_POST['val'];
retrive($val);

function retrive($val)
{
    include("../DB-Con/db.con.php");
    $query = mysqli_query($con, "SELECT ap_id , ap_img_gal , ap_price , ap_desc , ap_name from add_products where ap_id like '%$val%' or ap_name like '%$val%'");
    if ($query) {
        while ($get = mysqli_fetch_assoc($query)) {
            $img = explode(",", $get['ap_img_gal'])[0];
            echo
                "
                <a href='#' onclick='return false;' aria-valuetext='" . $get['ap_id'] . "' class='select-item'>
                    <div class='row justify-content-center align-items-center text-center'>
                        <div class='col-2'><img src='../admin/uploads/$img' class='' alt='' loading='lazy'></div>
                        <div class='col-1'>" . $get['ap_id'] . "</div>
                        <div class='col-3'>" . $get['ap_name'] . "</div>
                        <div class='col-2'>" . $get['ap_desc'] . "</div>
                        <div class='col-2'>" . $get['ap_price'] . "Rs</div>
                    </div>
                </a>
            ";
        }
    }

}
?>

<script src="Scripts/productslider-ajax.js"></script>