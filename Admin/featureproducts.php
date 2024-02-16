<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: featureproducts.php");
}
?>
<?php
include('adminnavbar.php');
?>

<title>Admin - Feature Products</title>
<!-- External CSS Document File -->
<link rel="stylesheet" href="Css/featureproducts.css">






<div class="container-fluid my-3" id="f-p-home">
    <div class="container">

        <div class="after-bar-1 my-2">
            <h3>Feature Products</h3>
            <p class="m-1">Select the products that are to be Featured on the Homepage</p>
        </div>

        <div id="select_items">
            <select name="" id="select">
                <option value="" disabled selected>Choose Category</option>
                <?php
                include("../DB-Con/db.con.php");
                $category_query = mysqli_query($con, "SELECT cty_name from category");
                while ($category_query_get = mysqli_fetch_assoc($category_query)) {
                    echo "<option value='" . $category_query_get['cty_name'] . "'>" . $category_query_get['cty_name'] . "</option>";
                }
                ?>
            </select>

            <div class="searchbar_wrapper">
                <input type="text" name="" id="search_items" placeholder="Search Items">
                <div class="db_table_wrapper"></div>
            </div>

        </div>

        <div id="product">
            <h5> Currently Featuring </h5>
        </div>
        <p>
            <?php if (isset($_GET['already_exits'])) {
                echo "Item is Already Featuring";
            } ?>
        </p>


        <div class="" id="category-card-scroll">
            <?php
            include("../DB-Con/db.con.php");
            $fp_query = mysqli_query($con, "SELECT * from feature left join add_products on feature.ap_id = add_products.ap_id where ap_deleted = '0'");
            while ($get_fp = mysqli_fetch_assoc($fp_query)) {
                $img = explode(",", $get_fp["ap_img_gal"])[0];
                echo
                    "
                    <div id='card'>
                        <a href='edit_product.php?p_id=" . $get_fp['ap_id'] . " '>
                            <img src='uploads/" . $img . "' class='img-fluid rounded'>
                            <div id='card-text'>
                                <h6 class='fw-normal text-truncate my-0'>" . $get_fp["ap_name"] . "</h6>
                                <h6 class='my-0 price-tag'>Rs." . $get_fp["ap_price"] . "</h6>
                                <p class='text-truncate'>" . $get_fp["ap_desc"] . "</p>
                                <a href='featureproducts-remove.php?fp_id=" . $get_fp['ap_id'] . "'><button class='button btn-style-1 px-2'>Remove</button></a>
                            </div>
                        </a>
                    </div>
                ";
            }
            ?>
        </div>

    </div>

</div>




<script src="scripts/featureproducts.js"></script>

</body>

</html>