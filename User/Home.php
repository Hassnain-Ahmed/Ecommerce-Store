<?php
include('usernavbar.php');

?>

<title>User - Homepage</title>
<link rel="stylesheet" href="Css/home.css">


<div class="container-fluid g-0">
    <div id="home-slider">

        <div id="carouselExampleDark" class="carousel carousel-dark slide" data-bs-ride="carousel">
            <?php
            include("../DB-Con/db.con.php");
            $query2 = mysqli_query($con, "SELECT s_id , slider.ap_id , add_products.ap_id , ap_img_gal , s_img , s_title , s_about , s_status, ap_deleted from slider left join add_products on add_products.ap_id = slider.ap_id  order by s_id and slider.ap_id desc");
            $numRows = mysqli_num_rows($query2);

            echo "<div class='carousel-inner'>";
            while ($get_query2 = mysqli_fetch_assoc($query2)) {

                if ($get_query2['ap_id']) {
                    $href = "product.php?p_id=" . $get_query2['ap_id'] . "";
                } else {
                    $href = "#";
                }
                if ($get_query2['ap_deleted'] == 1) {
                    $href = "#";
                }

                if (strlen($get_query2['s_img']) > 0) {
                    $s_img = "../admin/uploads/slider/" . $get_query2['s_img'];
                }

                if (strlen($get_query2['ap_img_gal']) > 0) {
                    $s_img = "../admin/uploads/" . explode(",", $get_query2['ap_img_gal'])[0];
                }


                if ($get_query2['s_status'] == "Primary") {
                    echo
                        "
                        <div class='carousel-item active' data-bs-interval='5000'>
                            <a href='$href'>
                                <img src='$s_img' class='d-block w-100' alt='" . $get_query2['s_img'] . "'>
                                <div class='carousel-caption d-none d-md-block'>
                                    <h2>" . $get_query2["s_title"] . "</h2>
                                    <p>" . $get_query2["s_about"] . "</p>
                                </div>
                            </a>
                        </div>
                ";
                }
                if ($get_query2['s_status'] != "Primary") {
                    echo
                        "
                        <div class='carousel-item' data-bs-interval='5000'>
                            <a href='$href'>
                                <img src='$s_img' class='d-block w-100' alt='" . $get_query2['s_img'] . "'>
                                <div class='carousel-caption d-none d-md-block'>
                                    <h2>" . $get_query2["s_title"] . "</h2>
                                    <p>" . $get_query2["s_about"] . "</p>
                                </div>
                                </a>
                        </div>
                        ";
                }
            }
            echo "</div>";

            if ($numRows > 0) {
                echo
                    "
                <button class='carousel-control-prev' type='button' data-bs-target='#carouselExampleDark' data-bs-slide='prev'>
                    <span class='carousel-control-prev-icon' aria-hidden='true'></span>
                    <span class='visually-hidden'>Previous</span>
                </button>
                <button class='carousel-control-next' type='button' data-bs-target='#carouselExampleDark' data-bs-slide='next'>
                    <span class='carousel-control-next-icon' aria-hidden='true'></span>
                    <span class='visually-hidden'>Next</span>
                </button>
                ";
            }
            ?>
        </div>

    </div>
</div>




<div class="container-fluid" id="home-f-p">

    <?php
    $FP_query = mysqli_query($con, "SELECT add_products.ap_id, feature.ap_id , ap_avail_stock,ap_name , ap_price , ap_desc , ap_img_gal from add_products right join feature on add_products.ap_id = feature.ap_id where ap_deleted = '0'");
    if (mysqli_num_rows($FP_query) > 0) {
        echo
            "
            <div class='text-center my-4'>
                <h2>Featured Products</h2>
                <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Corporis, assumenda.</p>
            </div>
            <div class='products_wrapper'>
            ";
    }

    while ($get_fp = mysqli_fetch_assoc($FP_query)) {

        $classForWishlist = wishlist($get_fp['ap_id']);
        $img = explode(",", $get_fp["ap_img_gal"])[0];
        if ($get_fp['ap_avail_stock'] == 0) {
            $outOfStockWrapper = "<div class='outofstock-item'></div>";
            // $outOfStockdisable = "disabled";
        } else {
            $outOfStockWrapper = "";
            // $outOfStockdisable = "";
    
        }


        echo
            "
            <div class='products'>
            <a href='Product.php?p_id=" . $get_fp['ap_id'] . "'>
                <div class='img-holder'>
                    <img src='../admin/uploads/" . $img . "' alt='' class='img-fluid'>
                    $outOfStockWrapper
                </div>
                <div>
                    <span class='fs-6'>" . $get_fp['ap_name'] . "</span>
                    <span class='fs-5'>Rs." . $get_fp['ap_price'] . "</span>
                    <p class='text-truncate my-1 text-secondary'>" . $get_fp["ap_desc"] . "</p>
                    <a href='check_user.php?home&p_id=" . $get_fp["ap_id"] . "'>
                        <button type='button' class='button btn-style-1 px-2' id='add_to_wishlist'>
                            <span class='material-symbols-rounded $classForWishlist'>favorite</span>
                            Add To Wishlist
                        </button>
                    </a>
                </div>
            </a>
            </div>
            ";
    }
    echo "</div>";
    ?>
</div>



<div class="container-fluid" id="products-fluid">

    <?php
    $P_query = mysqli_query($con, "SELECT ap_id , ap_name , ap_price , ap_desc , ap_img_gal, ap_avail_stock from add_products where ap_deleted = '0' order by ap_id desc limit 6");
    $numRows = mysqli_num_rows($P_query);
    if ($numRows > 0) {
        echo
            "
        <div id='product'>
            <h4> " . "All Products" . " </h4>
            <a href='category_products.php?page=1&cty_name=All Products' class=''>View All</a>
        </div>
        <div class='row' id='category-card-scroll'>
        ";
    }
    while ($get_p = mysqli_fetch_assoc($P_query)) {
        $img = explode(",", $get_p["ap_img_gal"])[0];
        $classForWishlist = wishlist($get_p['ap_id']);

        if ($get_p['ap_avail_stock'] == 0) {
            $outOfStockWrapper = "<div class='outofstock-item'></div>";
        } else {
            $outOfStockWrapper = "";

        }
        echo
            "
        <div class='col-sm-2'>
            <div id='card'>
                <a href='Product.php?p_id=" . $get_p['ap_id'] . "'>
                    <div class='img-holder'>
                        <img src='../admin/uploads/" . $img . "' class='img-fluid'>
                        $outOfStockWrapper
                    </div>
                    <div id='card-text'>
                        <h5 class='h5'> " . $get_p['ap_name'] . " <span class=''>" . $get_p['ap_price'] . "$</span></h5>
                        <p class='text-truncate'>" . $get_p['ap_desc'] . "</p>
                        <a href='check_user.php?home&p_id=" . $get_p['ap_id'] . "'>
                            <button class='button btn-style-2'>
                                <span class='material-symbols-rounded $classForWishlist'>favorite</span>
                                <span class='mx-1'>Wishlist</span>
                            </button>
                        </a>
                    </div>
                </a>
            </div>
        </div>
        ";
    }
    echo " </div> ";
    ?>
</div>



<?php
$q = mysqli_query($con, "SELECT cty_name from category where cty_deleted = '0'");
$arr = array();
$i = 0;
while ($g = mysqli_fetch_assoc($q)) {
    $arr[$i] = $g["cty_name"];
    $i++;
}
for ($n = 0; $n < count($arr); $n++) {
    $numRows = mysqli_num_rows($P_query);
    if ($numRows > 0) {
        if (mysqli_num_rows(mysqli_query($con, "SELECT add_products.cty_id, category.cty_id, cty_name, ap_id, ap_avail_stock,ap_img_gal, ap_name, ap_desc, ap_price from add_products join category on add_products.cty_id = category.cty_id where cty_name ='$arr[$n]' and add_products.ap_deleted = '0' ")) > 0) {
            echo
                "
        <div class='container-fluid' id='products-fluid'>

            <div id='product'>
                <h4> " . $arr[$n] . " </h4>
                <a href='category_products.php?cty_name=$arr[$n]' class=''>View All</a>
            </div>
            <div class='row' id='category-card-scroll'>
        ";
        } else {
            continue;
        }

    }

    $item = mysqli_query($con, "SELECT add_products.cty_id, category.cty_id, cty_name, ap_id, ap_avail_stock,ap_img_gal, ap_name, ap_desc, ap_price from add_products join category on add_products.cty_id = category.cty_id where cty_name ='$arr[$n]' and add_products.ap_deleted = '0' ");
    while ($get_item = mysqli_fetch_assoc($item)) {
        $imgEXP = explode(",", $get_item['ap_img_gal'])[0];
        mysqlData(
            $get_item['ap_id'],
            $imgEXP,
            $get_item['ap_price'],
            $get_item['ap_name'],
            $get_item['ap_desc'],
            wishlist(
                $get_item['ap_id']
            ),
            $get_item['ap_avail_stock']
        );
    }
    echo "</div>";
    echo "</div>";
}

function mysqlData($id, $img, $price, $name, $desc, $class, $stock)
{
    if ($stock == 0) {
        $outOfStockWrapper = "<div class='outofstock-item'></div>";
    } else {
        $outOfStockWrapper = "";

    }
    echo
        "
    <div class='col-sm-2'>
        <div id='card'>
            <a href='Product.php?p_id=" . $id . "'>
                <div class='img-holder'>
                    <img src='../admin/uploads/" . $img . "' class='img-fluid'>
                    $outOfStockWrapper
                </div>
                <div id='card-text'>
                    <h5 class='h5'> " . $name . " <span class=''>" . $price . "$</span></h5>
                    <p class='text-truncate'>" . $desc . "</p>
                    <a href='check_user.php?home_p_id=" . $id . "'>
                        <button class='button btn-style-2'>
                            <span class='material-symbols-rounded $class'>favorite</span>
                            <span class='mx-1'>Wishlist</span>
                        </button>
                    </a>
                </div>
            </a>
        </div>
    </div>
    ";
}



function wishlist($id)
{
    include("../DB-Con/db.con.php");
    if (isset($_SESSION['user_id'])) {
        $clauseForWishlist = "and u_id=" . $_SESSION['user_id'];
    } else {
        $clauseForWishlist = "and u_id=0";
    }

    $wish = mysqli_query($con, "SELECT ap_id from wishlist where ap_id = $id $clauseForWishlist");
    if (mysqli_num_rows($wish) > 0) {
        return $wishlist = 'material-symbols-rounded-filled red-color';
    } else
        return $wishlist = 'material-symbols-rounded-filled  black-color'; {
    }
}

?>




<?php
include('userfooter.php');
?>