<?php
include("usernavbar.php");

$user_id = $_SESSION['user_id'];

if (isset($_GET['p_id'])) {
    $productIdUrl = $_GET['p_id'];
    $query = mysqli_query($con, "SELECT add_products.ap_id, cart.ap_id, ap_name, ap_img_gal, ap_price, c_qty, ap_price from add_products right join cart on add_products.ap_id = cart.ap_id where cart.ap_id = '$productIdUrl' and u_id='$user_id'  ");
} else if (isset($_GET['all'])) {
    $query = mysqli_query($con, "SELECT add_products.ap_id, cart.ap_id, ap_name, ap_img_gal, ap_price, c_qty, ap_price from add_products right join cart on add_products.ap_id = cart.ap_id where buyAll='1' and u_id = '$user_id' ");
} else {
    echo "<script>window.location.href='cart.php'</script>";
}

?>


<link rel="stylesheet" href="css/buynow.css">
<div class="container-wrapper">

    <div class="buynow-wrapper">
        <div class="heading text-center w-25 p-2 rounded">
            <h5>Checkout To Place your Or der</h5>
            <div class="d-flex justify-content-evenly">
                <span class="step current" id="one">Personal Info</span>
                <span class="step material-symbols-rounded">arrow_right</span>
                <span class="step" id="two">Shipping</span>
                <span class="step material-symbols-rounded">arrow_right</span>
                <span class="step" id="three">Payment</span>
            </div>
        </div>




        <div class="item">

            <div class="info-wrapper">

                <div class="personal-info">
                    <h6>Contact Information</h6>

                    <?php $getuser = mysqli_fetch_assoc(mysqli_query($con, "SELECT * from user where u_id = '" . $_SESSION['user_id'] . "' ")); ?>

                    <div class="input-container">
                        <input placeholder="Email Address" class="input-field" type="email" id="u_email" required
                            value="<?php echo $getuser['u_email']; ?>">
                        <label for="input-field" class="input-label">Email Address</label>
                        <span class="input-highlight email-border"></span>
                    </div>

                    <div class="input-container">
                        <input placeholder="Phone" class="input-field" type="number" id="u_phone" required
                            value="<?php echo $getuser['u_phone']; ?>">
                        <label for="input-field" class="input-label">Phone Number</label>
                        <span class="input-highlight phone-border"></span>
                    </div>

                    <br>
                    <h6 class="my-3">Shipping Address</h6>

                    <div class="shipping-inputs">

                        <input type="text" placeholder="Address" id="u_address"
                            value="<?php echo $getuser['u_shippingaddr']; ?>">

                        <input type="text" placeholder="City" id="u_city" value="<?php echo $getuser['u_city']; ?>">

                        <input type="number" placeholder="Postal Address" id="u_postal"
                            value="<?php echo $getuser['u_postal']; ?>">

                        <input type="text" placeholder="Province" id="u_province"
                            value="<?php echo $getuser['u_province']; ?>">

                    </div>

                    <div class="d-flex justify-content-center my-4">
                        <button id="proceed-to-shipping" class="button-outline btn-outline-1">Proceed To
                            Shipping</button>
                    </div>

                </div>

                <div class="shipping-info">
                    <h6 class="">Your Shipping Information</h6>

                    <div class="info-item">
                        <h6 class="m-1">Your Address</h6>
                        <p class="m-1 fs-6" id="preview-address"></p>
                        <button class="previous-to-one button-outline btn-outline-2">Change</button>
                    </div>

                    <div class="info-item">
                        <h6 class="m-1">Recipient's Information</h6>
                        <p class="" id="person_info">
                            <span class="material-symbols-rounded" id="edit-person-info">edit</span>

                            <label for="name">Name:</label>
                            <input type="text" class="personal-info-input p-i-f" name="" id="name"
                                value="<?php echo $getprofile['u_name'] ?>">

                            <br>
                            <label for="Contact">Contact: </label>
                            <input type="text" class="personal-info-input" name="" id="Contact"
                                value="<?php echo $getprofile['u_phone'] ?>">
                        </p>
                    </div>


                    <div class="info-item my-3">
                        <h6 class="m-1">Shipping Method</h6>
                        <p class="">Your Shipping Cost sums upto <span class="fs-4 fw-bold">200rs</span> </p>
                    </div>

                    <div class="my-5 d-flex justify-content-center p-2">
                        <button class="button-outline btn-outline-2" id="proceed-to-payment">Proceed To
                            Payment Method</button>
                    </div>
                </div>
            </div>

        </div>




        <div class="item item-two">

            <div class="product-items-wrapper">
                <?php

                while ($get = mysqli_fetch_assoc($query)) {

                    $imgg = explode(",", $get['ap_img_gal'])[0];
                    $img = trim($imgg);
                    $c_qty = $get['c_qty'];
                    $ap_name = $get['ap_name'];
                    $ap_price = $get['ap_price'];
                    $ap_id = $get['ap_id'];

                    $total = $get['ap_price'] * $get['c_qty'];
                    echo
                        "
                    <div class='product-item'>
                        <div class='img-wrapper'>
                            <span>
                                $c_qty
                            </span>
                            <img src='../Admin/uploads/$img' alt='' class=''>
                        </div>
                        <div class='product-text'>
                            <h5 class='my-0'>
                                $ap_name
                            </h5>
                            <p>
                                Quantity:
                                $c_qty
                            </p>
            
                            <div class='price-bracket'>
                                Price:
                                <span>
                                $ap_price
                                </span>
                                Rs
                                <sub>*Per Unit</sub>
                            </div>
                        </div>
                    </div>
                    ";

                    $t[] = $total;
                    $id[] = $ap_id;
                    $qty[] = $c_qty;
                }

                ?>

            </div>

            <div class="sub-total-wrapper">
                <div>
                    <span>SubTotal</span>
                    <span class="subtotal">
                        <?php echo array_sum($t) ?> Rs
                    </span>
                </div>

                <div>
                    <span>Shipping</span>
                    <span class="shipping">---</span>
                </div>
            </div>

            <div class="total-wrapper">
                <div>
                    <span>Total: </span>
                    <span class="total"></span>
                    rs
                </div>
            </div>
            <form action="buynow-query-purchase.php<?php if (isset($_GET['all'])) {
                echo "?all=1";
            } ?>" method="post">

                <div class="payment-method">
                    <h6 class="text-secondary m-3">Choose Payment Method</h6>
                    <div class="">


                        <input type="text" name="ap_id" id="" value="<?php echo implode("|", $id) ?>">
                        <input type="text" name="c_qty" id="" value="<?php echo implode("|", $qty) ?>">

                        <input type="text" name="get_name" id="get-name">
                        <input type="text" name="get_phone" id="get-phone">


                        <div class="radio-inputs">
                            <label>
                                <input class="radio-input" type="radio" name="pay" required value="COD">
                                <span class="radio-tile">
                                    <span class="radio-icon">
                                        <span class="material-symbols-rounded">money</span>
                                    </span>
                                    <span class="radio-label">Cash On Delivery</span>
                                </span>
                            </label>

                            <label>
                                <input class="radio-input" type="radio" name="pay" required value="CRD">
                                <span class="radio-tile">
                                    <span class="radio-icon">
                                        <span class="material-symbols-rounded">local_atm</span>
                                    </span>
                                    <span class="radio-label">Pay with Credit Card</span>
                                </span>
                            </label>

                        </div>

                    </div>

                    <div class="d-flex justify-content-center my-5">
                        <button type="submit" class="btn btn-outline-secondary">Place Order</button>
                    </div>
                </div>
            </form>

            <div class='delivery-details'>
                <h6 class="m-0">Delivery To</h6>
                <p class="m-0" id="user_info">------</p>
                <p class="payment-review-p">-------</p>
            </div>


        </div>

    </div>

</div>





<script src="scripts/buynow.js"></script>


<?php
include("userfooter.php");
?>