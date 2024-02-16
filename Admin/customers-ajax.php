<?php
include("../DB-Con/db.con.php");

$u_id = $_POST['user'];
if (isset($_POST['ban'])) {
    $getName = mysqli_fetch_assoc(mysqli_query($con, "select u_name from user where u_id = '$u_id'"));
    echo $getName['u_name'];
} else if (isset($_POST['ban_yes'])) {
    mysqli_query($con, "UPDATE user set u_ban = '1' where u_id = '$u_id' ");
} else if (isset($_POST['un_ban'])) {
    mysqli_query($con, "UPDATE user set u_ban = '0' where u_id = '$u_id' ");
}

if (isset($_POST['change'])) {

    $getPass = mysqli_fetch_assoc(mysqli_query($con, "SELECT u_name, u_password from user where u_id = '$u_id'"));
    echo $getPass['u_name'] . "," . $getPass['u_password'];
} else if (isset($_POST['cus_pass'])) {
    $passVal = $_POST['cus_pass'];
    if (mysqli_query($con, "UPDATE user set u_password = '$passVal' where u_id = '$u_id' ")) {
        echo "success_update";
    }
}

if (isset($_POST['history'])) {
    $Historyquery = mysqli_query($con, "SELECT orders.o_id, sale.s_id, add_products.ap_id, add_products.ap_name, ap_img_gal, ap_price, user.u_name , s_sold_qty, u_shippingaddr, s_payment_method, o_date, ap_deleted, o_status, (ap_price*s_sold_qty) as total, user.u_id as u_id from sale right join orders on sale.o_id = orders.o_id join add_products on orders.ap_id = add_products.ap_id join user on orders.u_id = user.u_id where user.u_id = '$u_id' and user.u_id != '5' order by orders.o_date desc limit 5");
    echo "<table class='table'>";

    echo
        "
    <tr>
        <th>ID</th>
        <th>Image</th>
        <th>Product</th>
        <th>Quantity</th>
        <th>Stauts</th>
        <th>Payment Mode</th>
        <th>Total</th>
        <th>Print Receipt</th>
    </tr>
    ";

    if (mysqli_num_rows($Historyquery) > 0) {
        while ($getHistory = mysqli_fetch_assoc($Historyquery)) {
            $img = trim(explode(",", $getHistory['ap_img_gal'])[0]);
            echo
                "
                <tr>
                    <td>OR-" . $getHistory['o_id'] . "</td>
                    <td><img src='uploads/$img' /></td>
                    <td>" . $getHistory['ap_name'] . "</td>
                    <td>" . $getHistory['s_sold_qty'] . "x</td>
                    <td>" . $getHistory['o_status'] . "</td>
                    <td>" . $getHistory['s_payment_method'] . "</td>
                    <td>Rs. " . $getHistory['total'] . "</td>
                    <td><label for='pr' class='d-flex justify-content-center my-4'><input type='checkbox' aria-valuenow='" . $getHistory['u_id'] . "'  aria-valuetext='" . $getHistory['o_id'] . "|" . $getHistory['u_id'] . "|" . $getHistory['s_id'] . "|" . $getHistory['o_id'] . "' class='print form-check-input' id='pr'></label></td>
                </tr>
            ";
        }
    } else {
        echo "<div><h5>No Purchases Made by this User</h5></div>";
    }

    echo "</table>";
}

?>
<script src="Scripts/category-ajax-print.js"></script>