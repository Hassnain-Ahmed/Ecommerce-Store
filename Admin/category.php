<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: category.php");
}

include("adminnavbar.php");
?>

<title>Admin - Category</title>
<link rel="stylesheet" href="css/category.css">



<div class="container-fluid">
    <div class="container">

        <div class="" id="admin-category">

            <div id="admin-heading">
                <h5 class="my-0">All Categories</h5>
                <p class="after-bar-1">Below are all the Product Categories</p>
                <div class="search-wrapper">
                    <input type="text" name="" id="search_cty" placeholder="Search Category">
                </div>
            </div>

            <p class="option-c-r">
                Want to Create a new Category:
                <a href="category-create.php">View Form</a>
            </p>
            <div class="searched-values row"></div>

            <div class="row category-wrapper">

                <?php
                include("../DB-Con/db.con.php");
                $query = mysqli_query($con, "SELECT * from category order by cty_id desc");
                while ($get = mysqli_fetch_assoc($query)) {
                    $cty_id = $get['cty_id'];
                    echo
                        "
                        <div class='col-2'>
                            <a href='category_products.php?cty_id= " . $get['cty_id'] . " '>
                                <img src='uploads/" . $get['cty_img'] . "' alt='' class='w-100'>
                                <div id='text-box'>
                                    <h5>" . $get['cty_name'] . "</h5>
                                    <p class='fs-6'>Click to view Category Products</p>
                                    <a href='deletedproducts.php?cty_id=" . $get['cty_id'] . "' class='button btn-outline-2'>Remove</a>
                                </div>
                            </a>
                        </div>
                    ";
                }
                ?>
            </div>
        </div>

    </div>
</div>



<script src="scripts/category.js"></script>



</body>

</html>