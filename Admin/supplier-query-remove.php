<?php
include("../DB-Con/db.con.php");
$id = $_GET['su_id'];
if (mysqli_query($con, "DELETE from supplier where su_id = '$id' ")) {
    header("Location: supplier.php");
}
?>