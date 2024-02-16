<?php
include_once("usernavbar.php");
if (!isset($_SESSION['user_id'])) {
    $signinmsg = "<h6><a href='../login/index.php'>Sign in</a> or <a href='../login/index.php?signup=1'>Sign up</a> to add Items to the Cart</h6>";
} else {
    include("../DB-Con/db.con.php");
    $wish_query = mysqli_query($con, "SELECT add_products.ap_id, wishlist.ap_id, wishlist.u_id, ap_name, ap_desc, ap_img_gal from add_products right join wishlist on add_products.ap_id = wishlist.ap_id where wishlist.u_id = '" . $sessionId . "'");
    if (mysqli_num_rows($wish_query) < 1) {
        $signinmsg = "<h6>No items in the cart <a href='home.php'>Browse Items</a> to buy</h6>";
    } else {
        $signinmsg = "";
    }
}
?>

<title>Wishlist - Ecommerce</title>
<!-- External CSS Document File -->
<link rel="stylesheet" href="Css/wishlist.css">


<div class="container-fluid">

    <div class="container" id="wishlist-home">

        <h5 class="after-bar-1">My Wishlist</h5>
        <div class="text-center m-3">
            <?php echo $signinmsg ?>
        </div>
        <div>

            <?php
            if (isset($wish_query)) {
                while ($get_wish = mysqli_fetch_assoc($wish_query)) {
                    whislist_items(
                        $get_wish["ap_id"],
                        $get_wish['ap_img_gal'],
                        $get_wish['ap_name'],
                        $get_wish['ap_desc']
                    );
                }
            }

            ?>

        </div>

    </div>

</div>

<?php

function whislist_items($id, $img, $name, $desc)
{
    $imgg = explode(",", $img)[0];
    echo
        "
    <div class='col-sm-2'>
        <a href='product.php?p_id=" . $id . "'>
            <img src='../admin/uploads/" . $imgg . "' alt='' class='img-fluid'>
            <div class='p-2'>
                <h5 class='m-0 text-truncate'>" . $name . " <i style='font-size: small; color: #555;' class='fa fa-arrow-up-right-from-square'></i></h5>
                <p class='text-truncate my-1'>" . $desc . "</p>
                <a href='wishlist-query.php?wishlist-remove-pid=" . $id . "'><button class='button btn-style-2 py-0'>Remove</button></a>
            </div>
        </a>
    </div>
    ";
}



include("userfooter.php");
?>