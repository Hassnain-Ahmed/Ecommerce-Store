<?php
include("usernavbar.php");
?>

<title>
    <?php echo $getprofile['u_name'] ?> - Profile
</title>
<!-- External CSS Document File -->
<link rel="stylesheet" href="Css/myprofile.css">






<div class="container-fluid" id="myprofile">

    <div class="container">
        <br>



        <div class="row">

            <div class="col-3" id="col1">
                <h5>Your Personal Information</h5>
                <ul>
                    <a href="#" id="mp-profile">
                        <li>Profile</li>
                    </a>
                    <a href="#" id="mp-shipping">
                        <li>Shipping Info</li>
                    </a>
                    <a href="#" id="mp-order">
                        <li>Order</li>
                    </a>
                    <a href="#" id="mp-canceled">
                        <li>Canceled</li>
                    </a>
                    <a href="#" id="mp-reviews">
                        <li>Reviews</li>
                    </a>
                </ul>

            </div>


            <div class="col-8 profile-wrapper" id="col">

                <h5>Profile</h5>
                <p>Edit or Update your Profile Information</p>

                <input type="hidden" id="up-id" value="<?php echo $getprofile['u_id'] ?>">


                <div id="myprofile-profile-wrap">
                    <img src="../Admin/assets/img/undraw_pic_profile_re_7g2h.svg" alt="" class="">
                    <span for="" class="fs-4 mx-3">
                        <?php echo $getprofile['u_name'] ?>
                    </span>
                </div>


                <label for="">Name:</label>
                <input type="text" id="u_name" value="<?php echo $getprofile['u_name'] ?>"> <br>

                <label for="">Username:</label>
                <input type="text" id="u_username" readonly value="<?php echo $getprofile['u_username'] ?>"> <br>

                <label for="">Phone:</label>
                <input type="number" id="u_phone" value="<?php echo $getprofile['u_phone'] ?>"> <br>

                <label for="">Email:</label>
                <input type="email" id="u_email" value="<?php echo $getprofile['u_email'] ?>"> <br>

                <div class="wrapper-wrapper">
                    <label for="">Password:</label>
                    <div class="password-wrapper">
                        <input type="password" id="profile-password" class='pasval'
                            value="<?php echo $getprofile['u_password'] ?>">
                        <span class="material-symbols-rounded" id="show_pass">visibility</span>
                    </div>
                </div>

                <div class="my-2">
                    <label for="">Change Profile</label>
                    <input type="file" name="" id="u_profile" accept=".jpg/.png/.jpeg">
                </div>

                <div class="my-3">
                    <button class="button btn-style-1 px-2 upd-profile">Save Changes</button>
                </div>

            </div>

            <div class="col-8 shipping-wrapper" id="col">
                <h5>Shipping Information</h5>
                <p>Your Location / Product Shipment Information</p>

                <input type="hidden" id="id" value="<?php echo $getprofile['u_id'] ?>">
                <div>
                    <label for="phone">Phone: </label>
                    <input type="number" inputmode="numeric" id="phone" value="<?php echo $getprofile['u_phone'] ?>">
                </div>

                <div>
                    <label for="addr">Address: </label>
                    <input type="text" id="addr" value="<?php echo $getprofile['u_shippingaddr'] ?>">
                </div>

                <div>
                    <label for="city">City: </label>
                    <input type="text" id="city" value="<?php echo $getprofile['u_city'] ?>">
                </div>

                <div>
                    <label for="postal">Postal Address: </label>
                    <input type="number" id="postal" inputmode="numeric" value="<?php echo $getprofile['u_postal'] ?>">
                </div>

                <div>
                    <label for="province">Province: </label>
                    <input type="text" id="province" value="<?php echo $getprofile['u_province'] ?>">
                </div>

                <div class="d-flex justify-content-center my-3 w-50">
                    <a href="#" id="upd-btn">
                        <button class="button-outline btn-outline-2">Save Changes</button>
                    </a>
                </div>
            </div>


            <div class="col-8 order-wrapper" id="col">

                <h5>Order</h5>
                <p>Below are all the ordered and recieved Products</p>

                <div>
                    <table class="table">
                        <tr>
                            <th>Order Id</th>
                            <th>Product Name</th>
                            <th>Quantity</th>
                            <th>Shipping Address</th>
                            <th>Payment Method</th>
                            <th>Delivery Status</th>
                            <th>Order Date</th>
                        </tr>
                        <tbody class='orders-fetched'></tbody>
                    </table>
                </div>
            </div>


            <div class="col-8 canceled-wrapper" id="col">

                <h5>Canceled</h5>
                <p>Below are all the Canceled Products</p>

                <div>
                    <table class="table">
                        <tr>
                            <th>Order Id</th>
                            <th>Product Name</th>
                            <th>Quantity</th>
                            <th>Shipping Address</th>
                            <th>Payment Method</th>
                            <th>Order Date</th>
                        </tr>
                        <tbody class="cancelled-fetched"></tbody>

                    </table>
                </div>
            </div>

            <div class="col-8 reviews-wrapper" id="col">
                <h5>Reviews</h5>
                <p>Below are all of your Reviews on Products</p>

                <div>
                    <table class="table">
                        <tr>
                            <th>Product ID</th>
                            <th>Image</th>
                            <th>Product Name</th>
                            <th>Review</th>
                            <th>Rating</th>
                        </tr>
                        <tbody class="reviews-fetched"></tbody>

                    </table>
                </div>

            </div>

        </div>


    </div>

</div>


<script src="scripts/myprofile.js"></script>


<?php
include("userfooter.php");
?>