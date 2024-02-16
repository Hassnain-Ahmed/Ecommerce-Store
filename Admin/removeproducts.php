<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: removeproducts.php");
}

include("adminnavbar.php");
?>

<!-- <title>Admin - Remove Product</title> -->
<!-- External CSS Document File -->
<link rel="stylesheet" href="Css/removeproducts.css">


<?php
$ap_name = "";
$ap_name = "";
$ap_price = "";
$ap_avail_stock = "";
$ap_max_qty = "";
$ap_prdct_ctgry = "";
$ap_prdct_dtl = "";
$ap_img_gal0 = "assets//img/undraw_image_upload_re_w7pm.svg";
$err = "";
$suc = "";
if (isset($_GET['ap_id'])) {
    include("../DB-Con/db.con.php");
    $ret = mysqli_query($con, "SELECT ap_id, ap_name,ap_price,ap_desc, ap_avail_stock , ap_max_qty , ap_prdct_dtl , ap_img_gal , add_products.cty_id , cty_name 
    from add_products right join category on category.cty_id = add_products.cty_id where ap_id = " . $_GET['ap_id'] . " and ap_deleted = '0' ");
    if ($ret) {
        $get = mysqli_fetch_assoc($ret);
        $ap_id = $get['ap_id'];
        $ap_name = $get['ap_name'];
        $ap_price = $get['ap_price'];
        $ap_avail_stock = $get['ap_avail_stock'];
        $ap_max_qty = $get['ap_max_qty'];
        $ap_prdct_ctgry = $get['cty_name'];
        $ap_prdct_dtl = $get['ap_prdct_dtl'];
        $ap_img_gal = explode(",", $get['ap_img_gal'])[0];
        $ap_img_gal0 = "uploads/" . $ap_img_gal;

        echo "<title>$ap_name - Remove Product</title>";
    }
} else {
    echo "<title>Admin - Remove Product</title>";
    $ap_id = '';
}

if (isset($_GET["status"])) {

    if ($_GET["status"] == "error_query") {
        $err = "An Error Occured Removing the Product";
    }

    if ($_GET["status"] == "success_query") {
        $suc = "Product Removed Successfully";
    }
}
?>



<div class="container">

    <div class="row justify-content-center" id="add_products">

        <div class="col-sm-8">


            <form action="removeproduct_query.php?ap_id=<?php echo $ap_id ?>" method="post" autocomplete="off">

                <h4>Remove Product</h4>
                <p class="after-bar-1">Search for the product that is to be removed & remove that Product.</p>

                <div class="row justify-content-center">

                    <div class="col-11" id="search-bar-wrapper">
                        <input type="text" placeholder="Search" id="searchbar" value="<?php echo $ap_name ?>" required>

                        <div class="db_table_wrapper"></div>
                    </div>

                </div>


                <div id="product-info" class="row">

                    <div class="col-9">
                        <label for="">Product Name</label>
                        <input type="text" value="<?php echo $ap_name ?>" required> <br>

                        <label for="">Price (PKR)</label>
                        <input type="number" readonly value="<?php echo $ap_price ?>"> <br>

                        <label for="">Available Stock</label>
                        <input type="number" readonly value="<?php echo $ap_avail_stock ?>"> <br>

                        <label for="">Max Quantity (Per Customer)</label>
                        <input type="number" readonly value="<?php echo $ap_max_qty ?>"> <br>



                        <label for="">Product Category</label>
                        <select name="" id="" disabled>
                            <option value="<?php echo $ap_prdct_ctgry ?>" disabled selected><?php echo $ap_prdct_ctgry ?></option>
                        </select>
                        <br>



                        <label for="ul">Product Details</label>
                        <ul id="ul">
                            <?php
                            $lenght = explode(",", $ap_prdct_dtl);

                            foreach ($lenght as $key => $index) {
                                echo "<li>" . $lenght[$key] . "</li>";
                            }
                            ?>
                        </ul>


                        <p for="" class="text-danger">
                            <?php echo $err ?>
                        </p>
                        <p for="" class="text-success">
                            <?php echo $suc ?>
                        </p>

                    </div>

                    <div class="col-3">
                        <img src="<?php echo $ap_img_gal0 ?>" alt="Product Image Here" class="img-fluid rounded-2"
                            title="Product Image">
                    </div>


                    <div>

                        <button type="submit" id="add_products-rm-btn">
                            Remove Product <i class="f fa fa-trash"></i>
                        </button>

                    </div>
                </div>

            </form>

        </div>
    </div>
</div>

<script src="Scripts/remove-products.js"></script>

</body>

</html>