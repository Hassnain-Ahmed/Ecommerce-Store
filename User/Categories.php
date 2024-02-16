<title>Categories - Ecommerce</title>
<link rel="stylesheet" href="Css/categories.css">

<?php
include('usernavbar.php');
?>


<div class="container-fluid p-5">
    <div class="container">

        <div class="" id="admin-category">
            <h5 class="my-0">All Categories</h5>
            <p class="after-bar-1">Below are all the Product Categories</p>

            <div class="row category-wrapper">

                <?php
                include("../DB-Con/db.con.php");
                $query = mysqli_query($con, "SELECT * from category where cty_deleted != '1' order by cty_id desc");
                while ($get = mysqli_fetch_assoc($query)) {
                    echo
                        '
                    <div class="col-2">
                        <a href="category_products.php?cty_name=' . $get['cty_name'] . '">
                            <img src="../admin/uploads/' . $get['cty_img'] . '" alt="" class="w-100">
                            <div id="text-box">
                                <h5>' . $get['cty_name'] . '</h5>
                                <p class="fs-6">Click to view Category Products</p>
                            </div>
                        </a>
                    </div>
                    ';
                }
                ?>

            </div>
        </div>
    </div>
</div>



<?php
include('userfooter.php');
?>