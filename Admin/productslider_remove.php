<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: productslider_remove.php");
}
?>

<?php

include("..//DB-Con/db.con.php");
$remove_query = mysqli_query($con, "DELETE from slider where s_id = " . $_GET["s_id"] . " ");
if ($remove_query) {
    header("Location:productslider.php");
} else {
    header("Location:productslider.php");
}