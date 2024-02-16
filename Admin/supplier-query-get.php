<?php
include("../DB-Con/db.con.php");
$id = $_POST['id'];
$query = mysqli_query($con, "SELECT * from supplier where su_id = '" . $id . "'");
while ($db = mysqli_fetch_assoc($query)) {
    echo json_encode($db);
}
?>