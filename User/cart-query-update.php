<?php
$id = $_POST['c_id'];
$qty = $_POST['cty_qty'];

updateCart($id, $qty);

function updateCart($id, $qty)
{
    include("../DB-Con/db.con.php");
    $q = mysqli_query($con, "UPDATE cart set c_qty = '$qty' where ap_id = '$id'");
    if ($q) {
        echo "Success";
    } else {
        echo "error";
    }
}
?>