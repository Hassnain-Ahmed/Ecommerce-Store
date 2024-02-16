<?php
include("adminnavbar.php");
include("../DB-Con/db.con.php");

$query = mysqli_query($con, "SELECT *, concat(u_shippingaddr, ', ', u_city, '-', u_province, ', ',u_postal) as addr from user where u_id != '5' order by u_id desc");

?>


<title>Customers - Admin</title>
<link rel="stylesheet" href="Css/supplier.css">

<div class="container-fluid">

    <div class="m-4 after-bar-1">
        <h4 class="my-0">About Customers</h4>
        <p>All the information about the Customers and their Accounts</p>
    </div>


    <div class="mx-auto wrapper-container">
        <div class="wrapper">
            <!-- <h6>Click to <a href="#" class="create-btn fw-bold">Create</a> a new Supplier Record</h6> -->

            <div class="table-wrapper">
                <?php

                echo "<table class='table' id='table'>
                <tr>
                    <th>ID</th>
                    <th>Profile</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Username</th>
                    <th>Password</th>
                    <th>Complete Address</th>
                    <th>Purchase History</th>
                    <th>Change Password</th>
                    <th>Ban</th>
                </tr>
                ";
                while ($db = mysqli_fetch_assoc($query)) {
                    if ($db['u_ban'] == 1) {
                        $class = "banned";
                        $bannedRow = "<a href='#' aria-valuetext='" . $db['u_id'] . "' class='un-ban-show'>UN-BAN</a>";
                    } else {
                        $class = '';
                        $bannedRow = "<a href='#' aria-valuetext='" . $db['u_id'] . "' class='ban-show'>BAN</a>";
                    }

                    if (empty($db['u_profilepicture'])) {
                        $img = "assets/img/undraw_pic_profile_re_7g2h.svg";
                    } else {
                        $img = "uploads/profile/" . $db['u_profilepicture'];
                    }
                    if (!$db['addr']) {
                        $addr = "Not Entered";
                    } else {
                        $addr = $db['addr'];
                    }


                    echo
                        "
                        <tr class='$class'>
                            <td>CUS-" . $db['u_id'] . "</td>
                            <td><img src='" . $img . "'/></td>
                            <td>" . $db['u_name'] . "</td>
                            <td class='text-truncate' title='" . $db['u_email'] . "'>" . $db['u_email'] . "</td>
                            <td>" . $db['u_phone'] . "</td>
                            <td>" . $db['u_username'] . "</td>
                            <td>" . $db['u_password'] . "</td>
                            <td>" . $addr . "</td>
                            <td><a href='#' aria-valuetext='" . $db['u_id'] . "' class='view-history' >View</a></td>
                            <td><a href='#' aria-valuetext='" . $db['u_id'] . "' class='change' >Change</a></td>
                            <td>$bannedRow</td>
                        </tr>
                        "
                    ;
                }
                echo "</table>";
                ?>
            </div>
        </div>
    </div>
</div>


<div class="wrapper-wrapper">
    <div class="create-wrapper">
        <div class="close-icon"><span class="material-symbols-rounded">close</span></div>
        <h6 class="my-0">Change name's Password</h6>
        <!-- <p>Fill below feilds to continue</p> -->

        <div class="create">
            <input type="hidden" id="u_id">

            <div class="input-container">
                <input value="" class="input-field" placeholder="Name" type="text" id="cus-name" readonly>

                <label for="input-field" class="input-label">Customer Name</label>
                <span class="input-highlight"></span>
            </div>

            <div class="input-container">
                <input placeholder="New Password" class="input-field" type="text" id="cus-pass" required>

                <label for="input-field" class="input-label">Password</label>
                <span class="input-highlight"></span>
            </div>

            <div class="msg-wrapper">
                <p class="m-0">All Feilds Are required</p>
            </div>

            <div class="d-flex justify-content-center">
                <button class="button-outline btn-outline-1 change-update" id="">Change</button>
            </div>
        </div>


    </div>
</div>




<div class="history-wrapper">
    <div class="history">
        <h5 class="m-0">History</h5>
        <p>Below is the purchase History of names purchase
            <a href="" class="text-secondary float-end viewallorders"><span>View All</span></a>
        </p>
        <div class="close-icon history-close">
            <span class="material-symbols-rounded">close</span>
        </div>

        <div class='history-table-wrapper'>
            <div class="wrap">
                <div class="loader"></div>
            </div>
        </div>

        <div class="print-wrapper">
            <div class="print" id="print">
                <div class="elements"></div>
                <button class="btn btn-outline-2 print-btn">Print Recipt(s)</button>
            </div>
        </div>
    </div>
</div>



<div class="ban-wrapper">
    <div>
        <h5>Are you sure you want to <span class='unban-text'></span>Ban <b class='ban-name'></b> Account?</h5>
        <button class="btn btn-outline-1 px-3 un_ban">Un Ban</button>
        <button class="btn btn-outline-danger px-4 ban-yes">Yes</button>
        <button class="btn btn-outline-secondary px-3 ban-no">No</button>
    </div>
</div>

<script src="Scripts/customers.js"></script>

</body>

</html>