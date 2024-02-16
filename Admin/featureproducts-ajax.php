<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: featureproducts-ajax.php");
}

searchItems($_POST["search"], $_POST["select"]);


function searchItems($input, $select)
{
    include("../DB-Con/db.con.php");
    $query = mysqli_query($con, "SELECT * from add_products left join category on category.cty_id = add_products.cty_id where ap_name like '%$input%' and category.cty_name like '%$select%' ");

    while ($get = mysqli_fetch_assoc($query)) {
        $img = explode(",", $get["ap_img_gal"])[0];
        echo
            "
        <a href='featureproducts-insert.php?fp_id=" . $get["ap_id"] . "'>
            <div class='row rounded my-1 fp_item'>
                <div class='col-2'>
                    <img src='uploads/" . $img . "' alt='' class='w-100 rounded'>
                </div>
                <div class='col-6'>
                    <h5 class='m-0 d-inline'>" . $get['ap_price'] . "<span class='fw-normal fs-6'>Rs </span></h5>
                    <h6 class='m-0 d-inline'>" . $get["ap_name"] . "</h6>
                    <p class='m-0'>" . $get["cty_name"] . "</p>
                </div>
            </div>
        </a>
        ";
    }
}