<?php
session_start();
if (isset($_SESSION['user_id'])) {

    if (isset($_GET['productpage'])) {
        if (isset($_GET['wishlist_p_id'])) {
            header("Location: wishlist-query.php?productpage&p_id=" . $_GET['wishlist_p_id'] . "");
        }

        if (isset($_GET['cart_p_id'])) {
            header("Location: cart-query.php?productpage&c_qty=" . $_POST['c_qty'] . "&p_id=" . $_GET['cart_p_id'] . "");
        }

        if (isset($_GET['buynow_p_id'])) {
            header("Location: buynow.php?productpage&p_id=" . $_GET['buynow_p_id'] . "");
        }
    }

    if (isset($_GET['category'])) {
        if (isset($_GET['cty_p_id'])) {
            header("Location: wishlist-query.php?category&cty_name=" . $_GET['cty_name'] . "&p_id=" . $_GET['cty_p_id'] . "");
        }
    }

    if (isset($_GET['home'])) {
    }





} else {
    header("Location: ../login/index.php?signin=1");
}
?>