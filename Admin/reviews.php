<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location:reviews.php");
}

include("adminnavbar.php");
include("../DB-Con/db.con.php");

$getReviewsQuery = mysqli_query($con, "SELECT * from review left join add_products on review.ap_id = add_products.ap_id join category on category.cty_id = add_products.cty_id");
?>

<link rel="stylesheet" href="css/reviews.css">
<title>Reviews - Admin</title>


<div class="my-3"></div>

<div class="container-fluid" id="reviews">
    <div class="wrapper">

        <div class="after-bar-1">
            <h5 class="m-0">Reviews</h5>
            <p>Manage & View Reviews Given on Products</p>
        </div>

        <div class="container">
            <table class="table">
                <tr>
                    <th>ID</th>
                    <th>Image</th>
                    <th>Product Name</th>
                    <th>Category</th>
                    <th>Reviews</th>
                    <th>Hidden</th>
                    <th>View</th>
                </tr>
                <?php
                if (mysqli_num_rows($getReviewsQuery) > 0) {
                    while ($getReviews = mysqli_fetch_assoc($getReviewsQuery)) {
                        $countReview = mysqli_fetch_assoc(mysqli_query($con, "SELECT count(r_id) as reviewCount from review where ap_id = '" . $getReviews['ap_id'] . "'"));
                        $countHiddenReview = mysqli_fetch_assoc(mysqli_query($con, "SELECT count(r_id) as hiddenCount from review where ap_id = '" . $getReviews['ap_id'] . "' and r_show != '1'"));

                        $img = trim("uploads/" . explode(",", $getReviews['ap_img_gal'])[0]);
                        echo "
                        <tr>
                            <td>AP-" . $getReviews['ap_id'] . "</td>
                            <td><a href='edit_product.php?p_id=" . $getReviews['ap_id'] . "'><img src='$img' alt='' class='img-fluid rounded border'></a></td>
                            <td>" . $getReviews['ap_name'] . "</td>
                            <td>" . $getReviews['cty_name'] . "</td>
                            <td>Total Reviews:   <b>" . $countReview['reviewCount'] . "</b></td>
                            <td>Hidden Reviews:   <b>" . $countHiddenReview['hiddenCount'] . "</b></td>
                            <td><button class='btn btn-outline-secondary view-btn' aria-valuetext='" . $getReviews['ap_id'] . "'>View</button></td>
                        </tr>
                        ";

                    }
                } else {
                    echo "<h6>No reviews on any Products Yet</h6>";
                }
                ?>
            </table>
        </div>

    </div>

    <div class="show-reviews-wrapper">
        <div class="show-reviews">
            <span class="material-symbols-rounded close">close</span>
            <div class="reviews-items">
                <div class="">
                    <h6>Showing Records of <b>items</b>'s Reviews</h6>
                </div>
                <table class="table">
                    <tr>
                        <th>ID</th>
                        <th>Profile</th>
                        <th>Review By</th>
                        <th>Email</th>
                        <th>Ratting</th>
                        <th>Comment</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                    <tbody class='fetched-rows'></tbody>
                </table>

                <div class="loader-wrapper">
                    <div class="loader"></div>
                </div>
            </div>
        </div>
    </div>

</div>

<script src="Scripts/reviews.js"></script>

</body>

</html>