<?php
if (isset($_POST['statusID'])) {

    $id = $_POST['statusID'];
    $val = $_POST['statusVal'];

    updateStatus($id, $val);


}
function updateStatus($id, $updateVal)
{
    include("../DB-Con/db.con.php");
    mysqli_query($con, "UPDATE orders set o_status = '$updateVal' where o_id = '$id'");
}

?>