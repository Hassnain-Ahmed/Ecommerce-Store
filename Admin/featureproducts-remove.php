<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: featureproducts-remove.php");
}
?>


<?php

include("../DB-Con/db.con.php");
$query = mysqli_query($con, "DELETE from feature where ap_id = '" . $_GET['fp_id'] . "' ");

if ($query) {
    header("Location:featureproducts.php?status=success");
} else {
    header("Location:featureproducts.php?status=faliure");
}