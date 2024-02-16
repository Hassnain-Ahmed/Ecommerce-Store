<?php
if (!isset($_GET['p_id'])) {
    header("Location:Home.php");
}

include('usernavbar.php');
include("../DB-Con/db.con.php");
$query = mysqli_query($con, "SELECT add_products.cty_id, category.cty_id, cty_name, add_products.ap_id ,ap_name , ap_desc , ap_img_gal , ap_price  , ap_prdct_dtl , ap_max_qty , ap_avail_stock, r_ratting  from add_products join category on add_products.cty_id = category.cty_id left join review on review.ap_id = add_products.ap_id where add_products.ap_id=" . $_GET['p_id'] . " and add_products.ap_deleted = '0' ");
$get = mysqli_fetch_assoc($query);

$reviewTrigger = mysqli_query($con, "SELECT r_id from review where u_id = '$sessionId' and ap_id = '" . $_GET['p_id'] . "'");
if (mysqli_num_rows($reviewTrigger) >= 1) {
    $disableReviews = 'disabled';
} else {
    $disableReviews = '';
}


if ($get['ap_avail_stock'] < 1) {
    $outOfStockdisable = "disabled";
    $outOfStockWrapper = "<div class='outofstock'></div>";
} else {
    $outOfStockdisable = "";
    $outOfStockWrapper = '';
}

// 
echo "<title>" . $get['ap_name'] . " - " . $get['cty_name'] . "</title>";
// 

$cty_name = $get['cty_name'];
$img = explode(",", $get['ap_img_gal']);
$li = explode(",", $get['ap_prdct_dtl']);
$location = "../admin/uploads/";
$class = wishlist();
?>

<br>


<!-- Product Page Css -->
<link rel="stylesheet" href="Css/Product.css">
<div class="container my-5">
    <div class="product">

        <div class="img_wrapper">
            <div class="img_holder">
                <div class="img">
                    <img src="<?php echo $location . $img[0] ?>" alt="Product Picture" class="img-fluid" id="p_img">
                    <a href="check_user.php?productpage&wishlist_p_id=<?php echo $get['ap_id'] ?>"
                        class="<?php echo $class ?>">
                        <span class="material-symbols-rounded">favorite</span>
                    </a>
                    <?php echo $outOfStockWrapper ?>
                </div>

                <div class="skeleton"></div>
                <div class="img_gallary" id="gallary">
                    <?php
                    for ($i = 0; $i < count($img); $i++) {
                        echo "<img src='" . $location . trim($img[$i]) . "' alt=''>";
                    }
                    ?>
                </div>
            </div>
        </div>


        <?php

        ?>


        <div class="product_details">
            <form action="check_user.php?productpage&cart_p_id=<?php echo $_GET['p_id'] ?>" method="post">

                <h5>Product Name</h5>
                <h2>
                    <?php echo $get['ap_name'] ?>
                </h2>

                <h5>About Product</h5>
                <h4>
                    <?php echo $get['ap_desc'] ?>
                </h4>
                <img src="" alt="">
                <h5>Prodcut Specifications</h5>
                <ul class="fs-4">
                    <?php
                    for ($i = 0; $i < count($img); $i++) {
                        echo "<li>" . $li[$i] . "</li>";
                    }
                    ?>
                </ul>

                <label class="fs-5" for="select_qty">Select Quantity</label>
                <select name="c_qty" id="select_qty" class="fs-5 px-1" <?php echo $outOfStockdisable ?>>
                    <?php
                    if ($get['ap_avail_stock'] < $get['ap_max_qty']) {
                        $len = $get['ap_avail_stock'];
                    } else {
                        $len = $get['ap_max_qty'];

                    }
                    for ($i = 1; $i <= $len; $i++) {
                        if ($i == 1) {
                            echo "<option value='" . $i . "' selected>" . $i . "x</option>";
                        } else {
                            echo "<option value='" . $i . "'>" . $i . "x</option>";
                        }
                    }

                    ?>
                </select>

                <h5>Price</h5>
                <h4>
                    <?php echo $get['ap_price'] ?>Rs
                </h4>

                <div class="product_rating d-flex">
                    <label for="">Product Rating</label>
                    <?php
                    echo "&nbsp;<b> " . $get['r_ratting'] . " / 5 </b>";
                    for ($i = 1; $i <= 5; $i++) {
                        if ($i <= $get['r_ratting']) {
                            echo "<span class='material-symbols-rounded stars active'>star</span>";
                        } else {
                            echo "<span class='material-symbols-rounded stars'>star</span>";
                        }
                    }
                    ?>
                </div>

                <div class="btn_wrapper my-4">
                    <button type="submit" class="btn btn-outline-1 py-1 px-4" <?php echo $outOfStockdisable ?>>
                        <span class="material-symbols-rounded mx-2">shopping_cart</span>
                        Add to Cart
                    </button>
                </div>

            </form>
        </div>

    </div>


    <div class="review-section">
        <p class="px-2 r-s-t">
            <span class="fs-5">Reviews</span>
            <a href="" class="text-decoration-none text-secondary float-end"><span class="">View All</span></a>
        </p>

        <div class="reviews">

            <?php
            $getReviewQuery = mysqli_query($con, "SELECT u_name, r_ratting, r_comment, u_profilepicture from review left join user on review.u_id = user.u_id where ap_id = '" . $_GET['p_id'] . "'");
            if (mysqli_num_rows($getReviewQuery) > 0) {
                while ($getReview = mysqli_fetch_assoc($getReviewQuery)) {
                    if (strlen($getReview['u_profilepicture']) == 0) {
                        $img = "../admin/assets/img/undraw_pic_profile_re_7g2h.svg";
                    } else {
                        $img = "../admin/uploads/profile/" . trim($getReview['u_profilepicture']);
                    }
                    $ratelen = $getReview['r_ratting'];


                    echo
                        "
                        <div class='review-profile-wrapper'>
                            <div class='row align-items-center'>
                                <div class='col-2'>
                                    <img src='$img' alt='' class='w-100 rounded-circle'>
                                </div>
                                <div class='col-5'>
                                    <h5 class='m-0 w-100'>" . $getReview['u_name'] . "</h5>
                                    <div class='verified'>
                                        <span class='material-symbols-rounded'>verified</span>
                                        Purchase Verified
                                    </div>

                                    <div class='rattings'>
                                    ";
                    for ($i = 1; $i <= 5; $i++) {
                        if ($ratelen >= $i) {
                            echo "<span class='material-symbols-rounded stars active'>star</span>";
                        } else {
                            echo "<span class='material-symbols-rounded stars'>star</span>";
                        }
                    }
                    echo "<label>$ratelen / 5</label>";
                    echo "
                                    </div>
                                </div>
                            </div>
                            <div class='review-profile-text'>
                                " . $getReview['r_comment'] . "
                            </div>
                        </div>
                    ";
                }
            } else {
                echo "<h5>No Reviews Yet</h5>";
            }
            ?>

            <!-- <div class="review-profile-wrapper">
                <div class="row align-items-center">
                    <div class="col-2">
                        <img src="assets/img/img1.jpg" alt="" class="w-100 rounded-circle">
                    </div>
                    <div class="col-5">
                        <h5 class="m-0 w-100">Username </h5>
                        <div class="verified">
                            <span class="material-symbols-rounded">verified</span>
                            Purchase Verified
                        </div>

                        <div class="rattings">
                            <span class="material-symbols-rounded stars active">star</span>
                            <span class="material-symbols-rounded stars active">star</span>
                            <span class="material-symbols-rounded stars active">star</span>
                            <span class="material-symbols-rounded stars active">star</span>
                            <span class="material-symbols-rounded stars">star</span>
                            <label>4/5</label>
                        </div>
                    </div>
                </div>
                <div class="review-profile-text">
                    Lorem ipsum dolor sit amet consectetur, adipisicing elit. Itaque, doloremque.
                </div>
            </div> -->


        </div>

        <!-- <form action=""> -->
        <div class="post_review-wrapper my-3 rounded">
            <div class="post_review-title">
                <h5 class="m-0 text-white">Write a Review</h5>
                <p class="text-white">Let People know your Thoughts</p>
            </div>
            <div class="post_review">
                <div class="comment-wrapper" id="c-w">
                    <input type="text" id="comment" placeholder="">
                    <label for="comment">Post Your Comment </label>
                    <button type="button" id="post-review" <?php echo $disableReviews ?>>
                        <span class="material-symbols-rounded send">send</span>
                    </button>
                </div>
                <div class="rate">
                    <input type="radio" id="star5" class='rate_input' name="rate" value="5" required>
                    <label for="star5" title="text"><span class="material-symbols-rounded">star</span></label>
                    <input type="radio" id="star4" class='rate_input' name="rate" value="4">
                    <label for="star4" title="text"><span class="material-symbols-rounded">star</span></label>
                    <input type="radio" id="star3" class='rate_input' name="rate" value="3">
                    <label for="star3" title="text"><span class="material-symbols-rounded">star</span></label>
                    <input type="radio" id="star2" class='rate_input' name="rate" value="2">
                    <label for="star2" title="text"><span class="material-symbols-rounded">star</span></label>
                    <input type="radio" id="star1" class='rate_input' name="rate" value="1">
                    <label for="star1" title="text"><span class="material-symbols-rounded">star</span></label>
                </div>
            </div>
        </div>
        <!-- </form> -->

    </div>

</div>



<div class="container">

    <div class="row justify-content-center" id="product_more_categories">
        <div>
            <div id="p_m_c_title">
                <h4 class="">Similar Products</h4><span><a
                        href="category_products.php?cty_name=<?php echo $get['cty_name'] ?>">View All</a></span>
            </div>

            <div class="row justify-content-center p-5" id="category-card-scroll">

                <?php
                $similar_products_query = mysqli_query($con, "SELECT add_products.cty_id, category.cty_id, cty_name, ap_id , ap_img_gal , ap_desc , ap_price , ap_name  from add_products join category on add_products.cty_id = category.cty_id where cty_name = '" . $get['cty_name'] . "' and add_products.ap_id != '" . $_GET['p_id'] . "' and add_products.ap_deleted != '1'  limit 6");
                if (mysqli_num_rows($similar_products_query) > 0) {
                    while ($ret = mysqli_fetch_assoc($similar_products_query)) {
                        $img2 = explode(",", $ret['ap_img_gal'])[0];
                        echo
                            "
                        <div class='col-sm-3'>
                            <a href='product.php?p_id=" . $ret["ap_id"] . "'>
                                <div id='card'>
                                        <img src='" . $location . $img2 . "' class='img-fluid rounded'>
                                    <div id='card-text' class='p-2'>
                                        <span class='fs-5 my-1'>" . $ret['ap_name'] . "</span>
                                        <span class='float-end mx-1 fs-4'>" . $ret['ap_price'] . "Rs</span>
                                        <h6 class='mx-1'>
                                        </h6>
                                        <p class='text-truncate mx-1 my-0'>" . $ret['ap_desc'] . "</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                        ";
                    }
                    echo
                        "
                    <div id='browse-more-btn' class='my-4'>
                        <a href='category_products.php?cty_name=$cty_name' class='button btn-style-1 text-white p-1 px-2'>Browse More</a>
                    </div>
                    ";
                } else {
                    echo "<h4 class='text-center'>Sorry... No Products To Show!</h4>";
                }
                ?>

            </div>

        </div>
    </div>
</div>

<div class="msg">
    <div class='msg-icon'><span class="material-symbols-rounded">arrow_drop_up</span></div>
    <div class="msgs">
        <p class='m-0 text-white'>You have already Posted Your Review click profile to check your Reviews</p>
    </div>
</div>


<?php
function wishlist()
{
    if (isset($_SESSION['user_id'])) {
        $whereClause = "and u_id = " . $_SESSION['user_id'] . "";
    } else {
        $whereClause = "and u_id=0";
    }

    include("../DB-Con/db.con.php");
    $wish = mysqli_query($con, "SELECT ap_id from wishlist where ap_id = " . $_GET['p_id'] . " $whereClause");
    if (mysqli_num_rows($wish) > 0) {
        return $wishlist = 'red-color';
    } else
        return $wishlist = 'black-color'; {
    }
}
?>




<script>
    var okForInsert = 0;
    const u_id = <?php echo $sessionId ?>;
    const ap_id = <?php echo $_GET['p_id'] ?>;
    var rate = "";
    $(".rate_input").click(function () {
        rate = $(this).val()
    })
    $("#post-review").click(function () {

        if (rate.length == 1 && $("#comment").val().length >= 1) {
            okForInsert = 1;
        }
        if (rate.length < 1) {
            $(".rate").addClass("animate__animated animate__pulse")
            setTimeout(() => {
                $(".rate").removeClass("animate__animated animate__pulse")
            }, 1000);
        }
        if ($("#comment").val().length == 0) {
            $("#c-w").addClass("animate__animated animate__pulse")
            setTimeout(() => {
                $("#c-w").removeClass("animate__animated animate__pulse")
            }, 1000);
        }
        if (okForInsert == 1) {
            $.post("Product-review-query.php", {
                trigger_review: 1,
                r_ratting: rate,
                r_comment: $("#comment").val(),
                user_id: u_id,
                p_id: ap_id
            }, function (e) {
                history.go(0);
            });
        }
    });
    $(".send").click(function () {
        const post_btn = $("#post-review").attr('disabled');
        if (post_btn == "disabled") {
            $(".msg").animate({ right: "5px" });
            setTimeout(() => {
                $(".msg").animate({ right: "-100%" });
            }, 5000);
        };
    })

</script>



<script src="scripts/Product.js"></script>

<?php
include('userfooter.php');
?>