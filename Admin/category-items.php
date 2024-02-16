<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: category_items.php");
}

include("adminnavbar.php");
?>

<title>Supplier Products - Admin</title>
<link rel="stylesheet" href="css/category.css">


<div class="container">
    <div class="row select-search" id="new_category">

        <div class="col-12 m-2">
            <h5 class="my-0">
                Supplier Products
            </h5>
            <p>Exactly what it says</p>
            <form action="" method="post">

                <div id="table-wrapper">
                    <?php
                    if (isset($_GET['su_id'])) {
                        $id = $_GET['su_id'];
                    } else {
                        $id = 0;
                    }
                    include("../DB-Con/db.con.php");
                    $getnameQuery = mysqli_query($con, "SELECT * from supplier where su_id='$id'");
                    $getName = mysqli_fetch_assoc($getnameQuery);

                    echo "<h6>Showing Products supplied by <b>" . $getName['su_name'] . "</b></h6>";

                    ?>

                    <table class="table my-2">
                        <tr>
                            <!-- <th>SU-ID</th> -->
                            <th>P-ID</th>
                            <th>Image</th>
                            <th>Product Name</th>
                            <th>Category Name</th>
                            <th>Description</th>
                            <th>Price</th>
                        </tr>

                        <?php

                        $query = mysqli_query($con, "SELECT ap_id, ap_name, ap_img_gal, ap_price, ap_desc, su_name,cty_name ,add_products.cty_id, add_products.su_id, supplier.su_id from add_products left join supplier on add_products.su_id = supplier.su_id join category on add_products.cty_id = category.cty_id where supplier.su_id = '$id' order by ap_date desc");
                        while ($get = mysqli_fetch_assoc($query)) {

                            $img = explode(",", $get['ap_img_gal'])[0];
                            echo
                                "
                                <tr>
                                    <td>P-" . $get['ap_id'] . "</td>
                                    <td><a href='edit_product.php?p_id=" . $get['ap_id'] . "'><img src='uploads/$img' class='rounded'></a></td>
                                    <td>" . $get['ap_name'] . "</td>
                                    <td>" . $get['cty_name'] . "</td>
                                    <td>" . $get['ap_desc'] . "</td>
                                    <td>" . $get['ap_price'] . "Rs</td>
                                </tr>
                            ";
                        }
                        ?>
                    </table>
                    <?php
                    if (mysqli_num_rows($query) < 1) {
                        echo "<h5 class='text-secondary text-center my-5'>No Items From <b>" . $getName['su_name'] . "</b></h5>";
                    }
                    ?>
                </div>
            </form>
        </div>

        <div class="msg-box-wrapper">
            <div id="msg-box">
                <i class="f fa fa-close" title="close"></i>
                <p>If you Remove the Category All the Items in it will be permanantly Lost!!</p>
                <button>Proceed</button>
            </div>
        </div>
    </div>
</div>



</body>

</html>