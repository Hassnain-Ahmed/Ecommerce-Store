<?php
date_default_timezone_set("Asia/Karachi");
$date = date("Y/m/d h:i:s");


$su_id = $_POST['su_id'];
$su_name = $_POST['su_name'];
$su_companyname = $_POST['su_companyname'];
$su_contact = $_POST['su_contact'];
$su_email = $_POST['su_email'];


update($su_name, $su_companyname, $su_contact, $su_email, $date, $su_id);


function update($su_name, $su_companyname, $su_contact, $su_email, $date, $su_id)
{
    include("../DB-Con/db.con.php");
    mysqli_query($con, "UPDATE supplier set su_name ='" . $su_name . "', su_companyname='" . $su_companyname . "', su_contact='" . $su_contact . "', su_email='" . $su_email . "', su_date='" . $date . "' where su_id = '" . $su_id . "' ");

}

?>