<?php
include("../DB-Con/db.con.php");

$searchVal = $_POST['search'];

$query = mysqli_query($con, "SELECT add_products.cty_id, category.cty_id, cty_name, ap_name, ap_id, ap_price, ap_desc, ap_img_gal from add_products join category on add_products.cty_id = category.cty_id where ap_name like '%" . $searchVal . "%'");

while ($get = mysqli_fetch_assoc($query)) {
    $img = explode(",", $get['ap_img_gal'])[0];
    echo
        "
        <a href='product.php?p_id=" . $get['ap_id'] . "'>
            <div class='row align-items-center text-center p-0 m-0'>
                <div class='col-2'>
                    <img src='../Admin/uploads/$img' alt=''>
                </div>
                <div class='col-2'>
                    <h4>" . $get['ap_name'] . "</h4>
                </div>
                <div class='col-2'>
                    <h6 class='text-truncate'>" . $get['ap_desc'] . "</h6>
                </div>
                <div class='col-2'>
                    <h6>" . $get['cty_name'] . "</h6>
                </div>
                <div class='col-2'>
                    <h5>" . $get['ap_price'] . "</h5>
                </div>
            </div>
        </a>
";
}

?>