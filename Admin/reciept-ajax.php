<?php
if (isset($_POST['data'])) {

    include("../DB-Con/db.con.php");
    $data = $_POST['data'];
    print_r($data);


    for ($i = 0; $i < count($data); $i++) {

        $dataItem = explode("|", $data[$i]);
        for ($j = 0; $j < count($dataItem); ) {

            $o_id = $dataItem[$j];
            $j++;

            $u_id = $dataItem[$j];
            $j++;

            $s_id = $dataItem[$j];
            $j++;

            $ap_id = $dataItem[$j];
            $j++;

        }
        $query = mysqli_query($con, "INSERT into print(p_id, o_id, u_id, s_id, ap_id) values('', '$o_id', '$u_id', '$s_id', '$ap_id')");
        if (!$query) {
            mysqli_query($con, "INSERT into print(p_id, o_id, u_id, s_id, ap_id) values('', '$o_id', '$u_id', '$s_id', '$ap_id')");
        }
    }

} else {
    echo 0;
}

if (isset($_POST['clear'])) {
    include("../DB-Con/db.con.php");
    mysqli_query($con, "DELETE from print");
}
?>