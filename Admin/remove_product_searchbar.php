<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: remove_product_searchbar.php");
}


include("../DB-Con/db.con.php");
$searchVal = $_POST["search"];
$query = mysqli_query($con, "SELECT ap_id, ap_img_gal , ap_name , add_products.cty_id , cty_name from add_products right join category on add_products.cty_id = category.cty_id where ap_name like '%" . $searchVal . "%' and ap_deleted = '0' ");

if (mysqli_num_rows($query) >= 1) {
    while ($get = mysqli_fetch_assoc($query)) {

        $img = explode(",", $get["ap_img_gal"])[0];
        echo
            "
            <a href='removeproducts.php?ap_id=" . $get["ap_id"] . "' name='ap_id'>
                <div class='db_table d-flex'>
                    <div class='col-1'>
                        <img src='uploads/$img' alt='Image' class='w-100'>
                    </div>
                    <div class='col-5 mx-3 my-2'>
                        <h5 class='m-0'>" . $get['ap_name'] . "</h5>
                        <label>" . $get['cty_name'] . "</label>
                    </div>
                </div>
            </a>
        ";
    }
} else {
    echo "No items found with <b>$searchVal</b> as Product Name";
}