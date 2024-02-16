<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: category_products.php");
}
include("adminnavbar.php");

?>


<link rel="stylesheet" href="css/category_products.css">
<div class="container-fluid" id="category_products">

    <?php

    if (!isset($_GET['cty_id'])) {
        include("../DB-Con/db.con.php");
        $ProductsQuery = mysqli_query($con, "SELECT * from add_products join category on category.cty_id = add_products.ap_id where ap_deleted = '0'");
        $ProductsQueryGet = mysqli_fetch_assoc($ProductsQuery);

        $getRowsQuery = mysqli_fetch_assoc(mysqli_query($con, "SELECT count(ap_id) as count from add_products"));

        // $cty_id = $ProductsQueryGet['add_products.cty_id'];
    }



    if (isset($_GET['cty_id'])) {
        include('../DB-Con/db.con.php');
        $cty_id = $_GET['cty_id'];

        $ProductsQuery = mysqli_query($con, "SELECT * from add_products join category on category.cty_id = add_products.ap_id where add_products.cty_id = '" . $cty_id . "' and ap_deleted = '0'");
        $getRowsQuery = mysqli_fetch_assoc(mysqli_query($con, "SELECT count(ap_id) as count from add_products where add_products.cty_id = '$cty_id' and ap_deleted = '0'"));

        $whereClause = "and category.cty_id = '" . $cty_id . "'";


        $getTableName = mysqli_fetch_assoc(mysqli_query($con, "SELECT cty_name from category where cty_id = '" . $cty_id . "'"));
        $cty_name = $getTableName['cty_name'];
        echo "<title>$cty_name | Category</title>";

    } else {
        $cty_name = "All Products";
        $whereClause = "";
    }




    ?>

    <h5>
        <?php echo $cty_name ?>
    </h5>
    <p class="after-bar-1">
        <a href="admin.php">Admin</a> /
        <a href="Categories.php">Categories</a> /
        <a href="#" onclick="return false" class="active-a">
            <?php echo $cty_name ?>
        </a>
    </p>



    <div id="category-items-wrapper">

        <?php

        $result = $getRowsQuery['count'];
        $results_per_page = 5;
        $rows = $result;
        $no_pages = ceil($rows / $results_per_page);

        if (!isset($_GET['page'])) {
            $page_l = 1;
        } else {
            $page_l = $_GET["page"];
        }
        $limit_f = ($page_l - 1) * $results_per_page;

        $getcty_query = mysqli_query($con, "SELECT * from add_products right join category on add_products.cty_id = category.cty_id where ap_deleted = '0'$whereClause order by ap_id desc limit $limit_f , $results_per_page");
        if ($getcty_query) {
            while ($getcty = mysqli_fetch_assoc($getcty_query)) {
                $img = explode(",", $getcty['ap_img_gal'])[0];
                echo
                    "
                        <div class='col-2 m-2'>
                            <div id='card'>
                                <img src='uploads/$img' class='img-fluid rounded'>
                                <div id='card-text'>
                                    <h5 class='h5 my-0'> " . $getcty['ap_name'] . " <span class=''>" . $getcty['ap_price'] . "Rs</span></h5>
                                    <p class='text-truncate'>" . $getcty['ap_desc'] . "</p>
                                    <a href='edit_product.php?p_id=" . $getcty['ap_id'] . "' class='button btn-style-2 d-flex px-2 justify-content-center'>
                                        <span class='material-symbols-rounded'>edit</span>
                                        <span class='mx-1'>Edit Product</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                            ";
            }

        }
        ?>
    </div>


    <?php
    $prev_page = $page_l - 1;
    $next_page = $page_l + 1;
    if ($prev_page == 0) {
        $prev_page = 1;
    }

    if (isset($_GET['cty_id'])) {
        $ctyPageParam = "cty_id=" . $cty_id . "&";
    } else {
        $ctyPageParam = "";
    }

    echo
        "
    <div id='page-number-wrapper'>
        <div class='text-center'>
            <ul>
                <a href='category_products.php?" . $ctyPageParam . "page=$prev_page'>
                <i class='fa fa-circle-chevron-left'></i>
                Previous
                </a>
    ";
    for ($page = 1; $page <= $no_pages; $page++) {
        if ($page == $page_l) {
            $active = "active-a";
        } else {
            $active = "";
        }
        echo
            "
        <a href='category_products.php?" . $ctyPageParam . "page=$page' class='$active'><li>$page</li></a>
        ";
    }
    echo
        "
                <a href='category_products.php?" . $ctyPageParam . "page=$next_page'>
                    Next
                    <i class='fa fa-circle-chevron-right'></i>
                </a>
            </ul>
        </div>
    </div>
    ";
    ?>


</div>








</body>

</html>