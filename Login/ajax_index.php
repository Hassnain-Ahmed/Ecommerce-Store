<?php
include("../DB-Con/db.con.php");

if (isset($_POST['u_username'])) {
    $u_username = $_POST['u_username'];

    $query = mysqli_query($con, "SELECT u_username from user where u_username = '" . $u_username . "'");
    if (mysqli_num_rows($query) > 0) {
        echo "This Username <b>$u_username</b> already exist";
    }
}

if (isset($_POST['u_email'])) {
    $u_email = $_POST['u_email'];

    $query = mysqli_query($con, "SELECT u_username from user where u_email = '" . $u_email . "'");
    if (mysqli_num_rows($query) > 0) {
        echo "This Email <b>$u_email</b> already exist";
    }
}

if (isset($_POST['signin_password'])) {

    $user = $_POST['signin_username'];
    $pass = $_POST['signin_password'];
    sign_in($user, $pass);

}

function sign_in($user, $pass)
{
    $load1 = $load2 = $load3 = "";
    include("../DB-Con/db.con.php");

    $query = mysqli_query($con, "SELECT u_username from user where u_username = '" . $user . "'");

    if (mysqli_num_rows($query) == 1) {
        $load1 = "";

        $pass_query = mysqli_query($con, "SELECT u_password from user where u_password = '" . $pass . "' and u_username ='" . $user . "' ");

        if (mysqli_num_rows($pass_query) == 1) {
            $load3 = "<span class='material-symbols-rounded'>check</span>";
        } else {
            $load2 = "<div class='loader'></div>";
        }

    } else {
        $load1 = "<div class='loader'></div>";
    }

    echo "$load1, $load2, $load3";
}

?>