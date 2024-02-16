<?php

$server = "localhost";
$username = "root";
$password = "";
$db_name = "dummyecommerce";

$con = mysqli_connect($server, $username, $password, $db_name);

if (!$con) {
    die("Connection Error: " . mysqli_connect_error());
}
