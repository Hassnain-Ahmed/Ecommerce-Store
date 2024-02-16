<title>Search - Ecommerce</title>
<link rel="stylesheet" href="Css/search.css">


<?php
include("usernavbar.php");
?>


<br>
<div class="container-fluid my-5">
    <div class="container">

        <div class="d-flex justify-content-center" id="search">
            <div class="col-10">

                <div id="wrapper">
                    <div id="search-bar-wrapper">
                        <input type="text" class="" id="search_input" placeholder="Search for Products" required>
                        <button type="submit" title="Search"><i class="bi-search"></i></button>
                    </div>

                    <div class="db_searched_data">
                        <div class="data"></div>
                    </div>
                </div>
            </div>
        </div>


        <h5 class="after-bar-1 text-center">Suggested Categories</h5>
        <div class="d-flex justify-content-center" id="category">

            <?php
            $queryCty = mysqli_query($con, "SELECT * from category order by cty_id desc");
            while ($get = mysqli_fetch_assoc($queryCty)) {
                echo
                    "
                    <div class=' col-sm-3' id='category_item'>
                        <a href='category_products.php?cty_name=" . $get['cty_name'] . "'>
                            <img src='../admin/uploads/" . $get['cty_img'] . "' alt='' class='img-fluid'>
                            <div id='category_item_text'>
                                <h3>" . $get['cty_name'] . "</h3>
                            </div>
                        </a>
                    </div>
                    ";
            }

            ?>

        </div>

    </div>
</div>


<script src="scripts/search.js"></script>

<?php
include("userfooter.php");
?>