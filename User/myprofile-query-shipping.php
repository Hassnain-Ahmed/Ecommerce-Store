<?php
if (isset($_POST['trigger_shipping'])) {

    $u_id = $_POST['u_id'];
    $u_phone = $_POST['u_phone'];
    $u_addr = $_POST['u_addr'];
    $u_city = $_POST['u_city'];
    $u_postal = $_POST['u_postal'];
    $u_province = $_POST['u_province'];
    updateValues($u_id, $u_phone, $u_addr, $u_city, $u_postal, $u_province);
}

if (isset($_POST['trigger_profile'])) {

    $u_id = $_POST['u_id'];
    $u_name = $_POST['u_name'];
    $u_username = $_POST['u_username'];
    $u_phone = $_POST['u_phone'];
    $u_email = $_POST['u_email'];
    $u_pass = $_POST['password'];
    $profile = '';

    updateProfile($u_id, $u_name, $u_phone, $u_email, $u_username, $u_pass, $profile);
}


if (isset($_POST['getOrder'])) {
    if ($_POST["getOrder"] == 1) {
        Fetch();
    }
}

if (isset($_POST['getCancelled'])) {
    if ($_POST["getCancelled"] == 1) {
        Fetch();
    }
}

if (isset($_POST['getReviews'])) {
    getReviews();
}

function getReviews()
{
    include("../DB-Con/db.con.php");
    session_start();
    $u_id = $_SESSION['user_id'];

    $query = mysqli_query($con, "SELECT add_products.ap_id, ap_name, ap_img_gal, r_comment, r_ratting, date(r_date) as r_date from review LEFT JOIN add_products on add_products.ap_id = review.ap_id join user on user.u_id = review.u_id where user.u_id = '$u_id' ");
    $arr = array();
    if (mysqli_num_rows($query) > 0) {
        while ($get = mysqli_fetch_assoc($query)) {
            $arr[] = $get;
        }
        echo json_encode($arr);
    }
}

function Fetch()
{
    include("../DB-Con/db.con.php");
    session_start();
    $u_id = $_SESSION['user_id'];

    $query = mysqli_query($con, "SELECT concat('OR-', orders.o_id) as o_id, add_products.ap_id ,ap_name, s_sold_qty, u_shippingaddr, s_payment_method, date(o_date) as o_date, o_status from orders left join add_products on add_products.ap_id = orders.ap_id join sale on sale.o_id = orders.o_id join user on orders.u_id = user.u_id where user.u_id = '$u_id' ");
    $arr = array();
    if (mysqli_num_rows($query) > 0) {
        while ($get = mysqli_fetch_assoc($query)) {
            $arr[] = $get;
        }
        echo json_encode($arr);
    }
}

function updateProfile($id, $name, $phone, $email, $u_username, $pass, $profile)
{
    include("../DB-Con/db.con.php");
    $query = mysqli_query($con, "UPDATE user set u_name='$name', u_phone='$phone', u_email='$email', u_username='$u_username', u_password = '$pass', u_profilepicture='$profile' where u_id = '$id'");
    if ($query) {
        return "success";
    }
}
function updateValues($u_id, $u_phone, $u_addr, $u_city, $u_postal, $u_province)
{
    include("../DB-Con/db.con.php");
    $query = mysqli_query($con, "UPDATE user set u_phone='$u_phone' , u_shippingaddr='$u_addr', u_city='$u_city', u_postal='$u_postal', u_province='$u_province' where u_id='$u_id' ");
    if ($query) {
        echo "success";
    }
}
?>