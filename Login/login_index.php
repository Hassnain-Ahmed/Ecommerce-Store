<?php
if (isset($_POST['login'])) {
    loginUser($_POST['u_user'], $_POST['u_pass']);
}
function loginUser($user, $pass)
{
    if ($user === "admin77" && $pass === "123") {
        session_start();
        $_SESSION['admin'] = "admin";
        header("Location: /Ecommerce/admin/admin.php");

    } else {
        include ("../DB-Con/db.con.php");
        $query = mysqli_query($con, "SELECT u_id, u_username , u_password from user where u_username = '" . $user . "' and u_password = '" . $pass . "'");

        if (mysqli_num_rows($query) == 1) {
            $get = mysqli_fetch_assoc($query);
            session_start();
            $_SESSION['user_id'] = $get['u_id'];
            header("Location: ../User/Home.php");
        } else {
            header("Location: index.php");
        }
    }

}


if (isset($_POST['create_account'])) {
    $inserted = insertUser($_POST['u_name'], $_POST['u_email'], $_POST['u_phone'], $_POST['u_username'], $_POST['u_pass']);
    if ($inserted) {
        header("Location:index.php");
    }
}

function insertUser($u_name, $u_email, $u_phone, $u_username, $u_password)
{
    include ("../DB-Con/db.con.php");
    $insertQuery = mysqli_query($con, "INSERT into user(u_name, u_email, u_phone, u_username, u_password) values ('$u_name' ,  '$u_email', '$u_phone' , '$u_username' , '$u_password')");
    if ($insertQuery) {
        return $msg = "$u_name your Account has been created Successfully";
    } else {
        return $msg = "An Error occured please Try Again";
    }
}




?>