<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: edit_product.php");
}

include("adminnavbar.php");
include('../DB-Con/db.con.php');
$query = mysqli_query($con, "SELECT * from add_products right join category on add_products.cty_id = category.cty_id where ap_id = '" . $_GET['p_id'] . "' and ap_deleted = '0'");



if ($query) {
    $get = mysqli_fetch_assoc($query);

    $ap_id = $_GET['p_id'];
    $ap_name = $get['ap_name'];
    $ap_img_gal = explode(",", $get['ap_img_gal']);
    $img = explode(",", $get['ap_img_gal'])[0];
    $ap_desc = $get['ap_desc'];
    $ap_price = $get['ap_price'];
    $ap_qty = $get['ap_max_qty'];
    $ap_max = $get['ap_avail_stock'];
    $ap_prdct_ctgry = $get['cty_name'];
    $ap_prdct_dtl = $get['ap_prdct_dtl'];

    $ctyQuery = mysqli_query($con, "SELECT cty_id,cty_name from category");
}
echo "<title>$ap_name - $ap_prdct_ctgry</title>";

?>


<link rel="stylesheet" href="css/edit_product.css">

<div class="row justify-content-center" id="product_details">

    <div class="col-sm-4">

        <div id="product_primary_img">
            <div id="card">
                <img src="../admin/uploads/<?php echo $img ?>" alt="" class="img-fluid rounded" id="p-img">
            </div>
        </div>

        <br>

        <div id="product_gallary">
            <?php
            for ($i = 0; $i < count($ap_img_gal); $i++) {
                echo "<img src='../admin/uploads/" . trim($ap_img_gal[$i]) . "' alt='" . $ap_img_gal[$i] . "' class='img-thumbnail'>";
            }
            ?>
        </div>

    </div>





    <div class="col-sm-4" id="product_information">

        <form action="" method="post" enctype="multipart/form-data">

            <div class="product_input_wrapper">
                <input name="p_name" id="p_name" type="text" value="<?php echo $ap_name ?>" reg class="product_name h4"
                    title="Edit this Feild" placeholder="Product Name">
            </div>

            <div class="product_input_wrapper my-1">
                <textarea name="p_desc" id="p_text" cols="30" rows="auto" title="Edit this Feild" reg
                    placeholder="Product Description"><?php echo $ap_desc ?></textarea>
            </div>

            <label for="product_category" class="mx-1 fs-5 h5">Product Category</label><br>
            <select name="p_ctgry" id="product_category" class="w-100 p-2 rounded">
                <?php
                while ($cty_get = mysqli_fetch_assoc($ctyQuery)) {

                    $cty_name = $cty_get['cty_name'];
                    $cty_id = $cty_get['cty_id'];

                    if ($ap_prdct_ctgry != $cty_name) {
                        echo "<option value='" . $cty_id . "'> $cty_name</option>";
                    } else {
                        echo "<option value='" . $cty_id . "' selected> $cty_name</option>";
                    }
                }
                ?>
            </select>

            <br><br>

            <label for="s_text" class="h5 mx-1 m-0">Product Specifications</label>
            <div class="product_input_wrapper m-0">
                <textarea name="p_detail" id="s_text" cols="30" rows="auto" title="Edit this Feild" reg
                    placeholder="Product Details"><?php echo $ap_prdct_dtl ?></textarea>
            </div>

            <label for="price_text" class="fs-4">Product Cost</label>
            <div class="product_input_wrapper fs-2">
                <span class="fs-6">Rs </span>
                <input name="p_price" type="number" id="price_text" value="<?php echo $ap_price ?>"
                    title="Edit this Feild" reg placeholder="Price">
            </div>

            <label for="upd_max" class="fw-bold">Max Allowed Per Customer: </label>
            <div class="product_input_wrapper d-inline">
                <input name="ap_max" type="number" id="upd_max" value="<?php echo $ap_max ?>" title="Edit this Feild"
                    reg placeholder="Quantity">
            </div>
            <br>

            <label for="upd_qty" class="fw-bold">Update Quantity: </label>
            <div class="product_input_wrapper d-inline">
                <input name="p_qty" type="number" id="upd_qty" value="<?php echo $ap_qty ?>" title="Edit this Feild" reg
                    placeholder="Quantity">
            </div>

            <br><br>

            <div class="wrapper-wrapper">
                <label for="img_file" class="m-0">Upload Product Images: </label>
                <div class="product_input_wrapper m-0 px-0">
                    <input type="file" name="img_file[]" id="img_file" multiple accept=" .jpg , .jpeg , .png">
                </div>
                <div id="reader-result">
                </div>
            </div>

            <div class="py-3">
                <button class="btn btn-secondary" type="submit" name="update-btn" id="btn_upd">Update Product</button>
                <button class="btn btn-danger mx-2" type="button" id="btn_rm">Remove This Item </button>
            </div>
        </form>
    </div>
</div>


<?php
if (isset($_POST["update-btn"])) {
    insertQuery(
        $_GET['p_id'],
        $_POST['p_name'],
        $_POST['p_desc'],
        $_POST['p_ctgry'],
        $_POST['p_detail'],
        $_POST['p_price'],
        $_POST['p_qty'],
        $_POST['ap_max'],
        $_FILES['img_file']
    );
}
?>



<div class="msg-box-wrapper">
    <div class="msg-box">
        <h5>Removing Item will permanatly Delete the Product.</h5>
        <a><button class="btn btn-danger px-4" id="proceed">Proceed</button></a>
        <button class="btn btn-secondary" id="btn-cancel">Cancel</button>
    </div>
</div>

<script>
    $("#proceed").click(function () {
        $.post("deletedproducts.php", {
            p_id: <?php echo "" . $get['ap_id'] . "" ?>
        }, function (e) {
            window.location.href = "category_products.php";
            console.log(e);
        });
    });
</script>


<?php
function insertQuery($id, $name, $desc, $ctgry, $detail, $price, $qty, $max, $img)
{
    include("../DB-Con/db.con.php");
    $insertQuery = mysqli_query($con, "UPDATE add_products set ap_name='$name' , ap_desc='$desc' , cty_id='$ctgry' , ap_prdct_dtl='$detail' , ap_price='$price' , ap_avail_stock='$max', ap_max_qty='$qty' , ap_updated='" . date("Y/m/d h:i:s") . "' where ap_id = '$id' ");
    if (isset($img)) {
        imageFile($id, $_FILES['img_file']);
    }
    if ($insertQuery) {
        echo "<script>window.location.href='edit_product.php?p_id=$id'</script>";
    }
}
function imageFile($id, $img)
{
    foreach ($img['name'] as $key => $index) {
        $uplaodOk = 1;

        $allowedExt = ['jpg', 'jpeg', 'png'];
        $imgName = "uploads/" . basename($img['name'][$key]);
        $imgExt = pathinfo($imgName, PATHINFO_EXTENSION);

        if (!in_array($imgExt, $allowedExt)) {
            $uplaodOk = 0;
        }
        if ($img['size'][$key] > 2000000) {
            $uplaodOk = 0;
        }

        if ($uplaodOk == 1) {

            $from = $img['tmp_name'][$key];
            $to = basename($img['name'][$key]);

            if (move_uploaded_file($from, "uploads/" . $to)) {
                $imgg = implode(",", $img['name']);
                include('../DB-Con/db.con.php');
                if (mysqli_query($con, "UPDATE add_products set ap_img_gal = '" . $imgg . "' where ap_id = '$id'")) {
                    echo "<script>window.location.href='edit_product.php?p_id=$id'</script>";
                }
            }
        }
    }
}
?>


<script src="Scripts/edit_products.js"></script>

</body>

</html>