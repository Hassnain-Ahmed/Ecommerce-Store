<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Lcoation: category-remove.php");
} else {

    if (isset($_GET['cty_id'])) {
        include("../DB-Con/db.con.php");
        if (mysqli_query($con, "DELETE from category where cty_id = '" . $_GET['cty_id'] . "' ")) {
            header("Location:category.php");
        } else {
            header("Location:category.php?faliure=1");
        }
    }
}

?>