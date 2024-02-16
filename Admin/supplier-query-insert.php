<?php
date_default_timezone_set("Asia/Karachi");
$date = date("Y/m/d h:i:s");
$su_name = $_POST['su_name'];
$su_companyname = $_POST['su_companyname'];
$su_contact = $_POST['su_contact'];
$su_email = $_POST['su_email'];


insert($su_name, $su_companyname, $su_contact, $su_email, $date);


function insert($su_name, $su_companyname, $su_contact, $su_email, $date)
{
    include("../DB-Con/db.con.php");
    if (mysqli_query($con, "INSERT into supplier(su_id, su_name, su_companyname, su_contact, su_email, su_date) values('', '" . $su_name . "', '" . $su_companyname . "', '" . $su_contact . "', '" . $su_email . "', '" . $date . "' ) ")) {
        echo "Success";
    }
}

?>