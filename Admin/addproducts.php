<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: adminproducts.php");
}
?>

<title>Admin - Add Products</title>
<!-- External CSS Document File -->
<link rel="stylesheet" href="Css/addproducts.css">

<?php
#Navbar

use function PHPSTORM_META\type;

include('adminnavbar.php');
include("../DB-Con/db.con.php");

?>



<div class="container">

    <div class="row justify-content-center py-4" id="add_products">

        <div class="col-sm-8">

            <form action="" method="post" enctype="multipart/form-data">


                <h4>Add Product Details</h4>
                <p class="after-bar-1">Only Name and Price would be Visible to the Customer</p>


                <label for="">Product Name</label>
                <input type="text" name="ap_name" required> <br>

                <label for="">Description</label>
                <input type="text" name="ap_desc" required> <br>

                <label for="">Price (PKR)</label>
                <input type="number" name="ap_price" required> <br>

                <label for="">Available Stock</label>
                <input type="number" name="ap_stock" required> <br>

                <label for="">Max Quantity (Per Customer)</label>
                <input type="number" name="ap_qty" required> <br>



                <label for="">Product Category</label>
                <select name="ap_category" required>
                    <option value="" disabled selected>Choose Option</option>
                    <?php
                    $query = mysqli_query($con, "SELECT cty_id,cty_name from category order by cty_id desc");
                    while ($get = mysqli_fetch_assoc($query)) {
                        echo
                            '
                            <option value="' . $get['cty_id'] . '">' . $get['cty_name'] . '</option>
                        ';
                    }
                    ?>
                </select>
                <br>
                <label for="">Choose Supplier</label>
                <select name="su_id" required>
                    <option value="" disabled selected>Choose Option</option>
                    <?php
                    $GetSupQuery = mysqli_query($con, "SELECT su_id,su_name from supplier order by su_id desc");
                    while ($GetSup = mysqli_fetch_assoc($GetSupQuery)) {
                        echo
                            '
                            <option value="' . $GetSup['su_id'] . '">' . $GetSup['su_name'] . '</option>
                        ';
                    }
                    ?>
                </select>
                <br>

                <label for="">Product Details</label>
                <input type="text" name="ap_detail" required> <br>
                <span>Note: Add comma "," for seperation</span>

                <br><br><br>

                <h4>Add Product Gallary</h4>
                <p class="after-bar-1">Upload the pictures of the Product Max size(2MBs)</p>

                <input type="file" name="image_input[]" id="image_input" accept=".jpg, .png, .jpeg" multiple required>

                <div id="image_gallary" class="row">
                    <!-- <div id="img-box" class="col-2">
                        <img src="assets/img/img2.jpg" alt="">
                        <p>Lorem ipsum dolor, sit amet, <b>6786</b> (MBs)</p>
                    </div> -->
                </div>


                <div id="btn-wrapper">
                    <button type="submit" name="submit" class="">
                        Add Product
                    </button>
                </div>

            </form>

        </div>

    </div>

</div>


<script src="Scripts/addproducts.js"></script>



<?php

if (isset($_POST['submit'])) {
    get_imgs();
}


function get_imgs()
{

    $upload_ok = 1;
    $accepted_extenstion = array("jpg", "png", "jpeg");

    foreach ($_FILES["image_input"]["name"] as $key => $index) {

        $fileExt = "uploads/" . basename($_FILES["image_input"]["name"][$key]);
        $path = pathinfo($fileExt, PATHINFO_EXTENSION);

        #to get file extension
        if (!in_array($path, $accepted_extenstion)) {
            $upload_ok = 0;
            echo "Only " . implode(" , ", $accepted_extenstion) . " are accepted";
        }

        #Limit Upload size 2MBs
        if ($_FILES["image_input"]["size"][$key] > 2000000) {
            $upload_ok = 0;
            echo "File Size Must be Lower than 2MBs";
        }
        if ($upload_ok == 1) {
            $file_tmp = $_FILES["image_input"]["tmp_name"][$key];
            $basename = basename($_FILES["image_input"]["name"][$key]);
            move_uploaded_file($file_tmp, "uploads/$basename");
        }
    }
    if ($upload_ok == 1) {
        Sql_insert();
    }
}

function Sql_insert()
{
    date_default_timezone_set("Asia/Karachi");

    $ap_name = $_POST["ap_name"];
    $ap_price = $_POST["ap_price"];
    $ap_stock = $_POST["ap_stock"];
    $ap_qty = $_POST["ap_qty"];
    $ap_detail = $_POST["ap_detail"];
    $ap_desc = $_POST["ap_desc"];
    $su_id = $_POST["su_id"];
    $cty_id = $_POST["ap_category"];

    $ap_date = date("Y-m-d h:i:s");
    $ap_img_gal = implode(" , ", $_FILES["image_input"]["name"]);

    #Database Connection
    include("../DB-Con/db.con.php");

    mysqli_query(
        $con,
        "INSERT 
        into add_products (ap_id, ap_name, ap_price, ap_avail_stock, ap_max_qty, ap_prdct_dtl, ap_date, ap_updated, ap_img_gal, ap_desc, su_id, cty_id)
        values ('', '$ap_name', '$ap_price', '$ap_stock', '$ap_qty', '$ap_detail', '$ap_date', '$ap_date', '$ap_img_gal', '$ap_desc', '$su_id', '$cty_id')"
    );
}

?>


</body>

</html>