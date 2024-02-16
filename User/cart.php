<?php
include_once("usernavbar.php");
if (!isset($_SESSION['user_id'])) {
    $signinmsg = "<h6><a href='../login/index.php?signin=1'>Sign in</a> or <a href='../login/index.php?signup=1'>Sign up</a> to add Items to the Cart</h6>";
} else {
    include("../DB-Con/db.con.php");
    $query = mysqli_query($con, "SELECT * from add_products join category on add_products.cty_id = category.cty_id right join cart on cart.ap_id = add_products.ap_id where u_id = '" . $_SESSION['user_id'] . "'");
    if (mysqli_num_rows($query) < 1) {
        $signinmsg = "<h6>No items in the cart <a href='home.php'>Browse Items</a> to buy</h6>";
    } else {
        $signinmsg = "";
    }
}
?>



<title>Cart - Ecommerce</title>
<!-- External CSS Document File -->
<link rel="stylesheet" href="Css/cart.css">



<div class="container-fluid">
    <div class="container" id="cart">

        <h5 id="c-title">My Cart</h5>
        <div class="text-center">
            <?php echo $signinmsg ?>
        </div>
        <?php
        if (mysqli_num_rows($query) > 0) {

            while ($get = mysqli_fetch_assoc($query)) {
                displayCart(
                    $get['ap_id'],
                    $get['ap_img_gal'],
                    $get['ap_name'],
                    $get['cty_name'],
                    $get['ap_desc'],
                    $get['ap_max_qty'],
                    $get['ap_price'],
                    $get['c_id'],
                    $get['c_qty']
                );
            }
            echo
                "
            <div class='d-flex justify-content-center buyall-wrapper my-2 p-2'>
                <button class='btn btn-outline-1 px-5 buyall'>
                    Buy All
                </button>
            </div>
            ";
        }
        ?>



        <?php
        function displayCart($id, $img, $name, $ctgry, $desc, $qty, $price, $c_id, $c_qty)
        {

            $imgg = explode(",", $img)[0];
            echo
                "
            <div class='row justify-content-center' id='added_item'>
                <div class='col-2'>
                    <img src='../admin/uploads/$imgg' alt='' class='img-fluid'>
                </div>
                <div class='col-8'>
                    <h4>$name <span class='fs-6 text-secondary'>$ctgry</span></h4>
                    <p>$desc</p>
                    <input type='hidden' value='$c_id' class='c_id'>
                    <div id='remove-product'>
                        <a href='cart-query.php?remove_p_id=$c_id'>
                            <i class='fa fa-trash'></i>
                        </a>
                        <div id='r-p-message'>
                            <i class='ic fa fa-caret-up'></i>
                            Remove
                        </div>
                    </div>
                    <div id='Quantity-inputs'>
                        Quantity 

                        <select name='qty' class='c_qty' aria-valuetext='$id'>
                        <option value='$c_qty' selected>" . $c_qty . "x</option>
                        ";

            for ($i = 1; $i <= $qty; $i++) {
                echo
                    "
                            <option value='$i'>" . $i . "x</option>
                ";
            }
            echo "
                        </select>
                    </div> <br>
                    <div id='price-bracket'>
                        <h5>Rs: $price</h5>
                        <sub>*Per Unit</sub>
                    </div>

                    <div id='buynow-btn'>
                        <a href='buynow.php?p_id=$id'><button class='button btn-style-2'> Buy now <span class='material-symbols-rounded'>payments</span></button></a>
                    </div>
                </div>
            </div>
            ";
        }
        ?>
    </div>
</div>

<script src="Scripts/cart.js"></script>




<?php
include("userfooter.php");
?>