<?php
include("usernavbar.php");

use function PHPSTORM_META\type;


if (!isset($_GET["cty_name"])) {
    $table_category = "All Products";
} else {
    $table_category = $_GET["cty_name"];
}
?>
<title>
    <?php echo $table_category ?> - Ecommerce
</title>
<link rel="stylesheet" href="Css/category_products.css">


<br>
<div class="container-fluid" id="category_products">


    <h5 id="title" class="">
        <?php echo $table_category ?>
    </h5>

    <!-- <div id="filter-wrapper">
        <a href="#" id="filter-btn" onclick="return false"><i class="f fa fa-filter" id="f"></i></a>
        <form action="" method="post">

            <div id="filter-wrapper-text">
                <i class="f fa fa-caret-up"></i>
                <input type="radio" name="s_price" id="price1"> <label for="price1">High Price</label> <br>
                <input type="radio" name="s_price" id="price2"> <label for="price2">Low Price</label>
            </div>

        </form>
        <script>
        $("#filter-btn").click(function() {
            $("#filter-wrapper-text").fadeToggle({
                duration: 200
            });
        })
    </script>
    </div> -->

    <p class="after-bar-1">
        <a href="Home.php">Home</a> /
        <a href="Categories.php">Categories</a> /
        <a href="#" onclick="return false" class="active-a">
            <?php echo $table_category ?>
        </a>
    </p>

    <div id="category-items-wrapper">

        <?php
        include("../DB-Con/db.con.php");

        $where_clause = "";
        if (isset($_GET['cty_name'])) {

            $cty_name = $_GET['cty_name'];

            if ($cty_name == "All Products") {

                $rowQuery = "SELECT ap_id from add_products";
                $where_clause = "";

            } else {

                $rowQuery = "SELECT add_products.cty_id, category.cty_id, cty_name from add_products join category on add_products.cty_id = category.cty_id where cty_name = '" . $cty_name . "'";
                $where_clause = "where cty_name = '" . $cty_name . "'";
            }
        }


        $results_per_page = 5;
        $result = mysqli_query($con, $rowQuery);
        $rows = mysqli_num_rows($result);
        $no_pages = ceil($rows / $results_per_page);

        if (!isset($_GET['page'])) {
            $page_l = 1;
        } else {
            $page_l = $_GET["page"];
        }
        $limit_f = ($page_l - 1) * $results_per_page;

        $query = mysqli_query($con, "SELECT add_products.cty_id, category.cty_id, cty_name, ap_id , ap_name , ap_img_gal , ap_desc , ap_price from add_products join category on add_products.cty_id = category.cty_id $where_clause order by ap_price limit $limit_f , $results_per_page");
        while ($get = mysqli_fetch_assoc($query)) {
            displayProducts(
                $get['ap_id'],
                $get['ap_img_gal'],
                $get['ap_price'],
                $get['ap_name'],
                $get['ap_desc'],
                $table_category
            );
        }


        $prev_page = $page_l - 1;
        $next_page = $page_l + 1;
        if ($prev_page == 0) {
            $prev_page = 1;
        }

        echo
            "
        <div id='page-number-wrapper'>
            <div class='text-center'>
                <ul>
                    <a href='category_products.php?cty_name=$table_category&page=$prev_page'>
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
            <a href='category_products.php?cty_name=$table_category&page=$page' class='$active'><li>$page</li></a>
            ";
        }
        echo
            "
                    <a href='category_products.php?cty_name=$table_category&page=$next_page'>
                        Next
                        <i class='fa fa-circle-chevron-right'></i>
                    </a>
                </ul>
            </div>
        </div>
        ";


        function displayProducts($id, $img, $price, $name, $desc, $cty_name)
        {
            $class = "material-symbols-rounded";
            $img0 = explode(",", $img)[0];
            echo
                "
            <div class='col-2 my-2'>
                <a href='Product.php?p_id=" . $id . "'>
                    <div id='card'>
                        <img src='../admin/uploads/$img0' class='img-fluid rounded'>
                        <div id='card-text'>
                            <h5 class='h6 m-0'> " . $name . " <span class='fs-5'>" . $price . "Rs</span></h5>
                            <p class='text-truncate'>" . $desc . "</p>
                            <a href='check_user.php?category&cty_p_id=" . $id . "&cty_name=$cty_name'><button class='button btn-style-1'><span class='$class'>favorite</span> Add to Wishlist</button></a>
                        </div>
                    </div>
                </a>
            </div>
            ";
        }

        ?>
    </div>

</div>


<?php
include("userfooter.php");
?>