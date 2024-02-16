<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: orders.php");
}
include("adminnavbar.php");

include("../DB-Con/db.con.php");
$getAllCount = mysqli_fetch_assoc(mysqli_query($con, "SELECT count(o_id) as count from orders"));
$getShippedCount = mysqli_fetch_assoc(mysqli_query($con, "SELECT count(o_id) as count from orders where o_status = 'shipped'"));
$getCancelledCount = mysqli_fetch_assoc(mysqli_query($con, "SELECT count(o_id) as count from orders where o_status = 'cancelled'"));
$monthQuery = mysqli_query($con, "SELECT distinct(monthname(o_date)) as viewmonth from orders");

if (isset($_GET['u_id'])) {
    $u_id = $_GET['u_id'];
    $userRecordsQuery = mysqli_query($con, "SELECT orders.o_id, sale.s_id, add_products.ap_id, add_products.ap_name, ap_img_gal, ap_price, user.u_name , s_sold_qty, u_shippingaddr, s_payment_method, o_date, ap_deleted, o_status, (ap_price*s_sold_qty) as total, user.u_id as u_id from sale right join orders on sale.o_id = orders.o_id join add_products on orders.ap_id = add_products.ap_id join user on orders.u_id = user.u_id where user.u_id = '$u_id' and user.u_id != '5' order by orders.o_date desc");

    $getUserName = mysqli_fetch_assoc(mysqli_query($con, "SELECT u_name from user where u_id = '$u_id'"));
    $countUserRows = mysqli_fetch_assoc(mysqli_query($con, "SELECT count(o_id) as u_count from orders where u_id = '$u_id'"));

    $name = $getUserName['u_name'];
    $UserRows = $countUserRows['u_count'];
} else {
    $name = 'Admin';
    $UserRows = '';
}

?>


<title>
    <?php echo $name ?> - Orders
</title>
<link rel="stylesheet" href="Css/orders.css">

<div class="container-fluid" id="myprofile">

    <div class="wrapper">

        <br>
        <div class="row">

            <div class="col-2" id="col1">
                <h5>Order Information</h5>
                <ul>
                    <a href="#" id="mp-allorders">
                        <li>All Orders
                            <span>
                                <?php echo $getAllCount['count'] ?>
                            </span>
                        </li>
                    </a>
                    <a href="#" id="mp-shipped">
                        <li>Shipped
                            <span>
                                <?php echo $getShippedCount['count'] ?>
                            </span>
                        </li>
                    </a>
                    <a href="#" id="mp-canceled">
                        <li>Canceled
                            <span>
                                <?php echo $getCancelledCount['count'] ?>
                            </span>
                        </li>
                    </a>
                    <hr>
                    <a href="#" id="mp-user">
                        <li>User Records
                            <span>
                                <?php echo $UserRows; ?>
                            </span>
                        </li>
                    </a>
                </ul>

            </div>


            <div class="col-10 allorders-wrapper" id="col">

                <div id="profile-wrapper-title">
                    <div class="">
                        <h5>All Orders</h5>
                        <p>List of products that were ordered</p>
                    </div>

                    <div class="profile-search-wrapper">
                        <!-- <div class="input d-flex justify-content-baseline"> -->
                        <input type="text" placeholder="Search Record" class="" id="search">
                        <div style="width: 20px; height: 20px;" class="loader"></div>
                        <!-- </div>  -->
                    </div>

                    <div class='viewby'>
                        <label for="viewby">Showing Records of: </label>
                        <select name="" id="viewby">
                            <option value="all">All Time</option>
                            <?php
                            while ($get = mysqli_fetch_assoc($monthQuery)) {
                                echo "<option value='" . $get['viewmonth'] . "'>" . $get['viewmonth'] . "</option>";
                            }
                            ?>
                        </select>
                    </div>

                </div>

                <div id="table-wrapper">
                    <div class='original'></div>
                    <div class="fetched"></div>
                    <div class="viewbytable"></div>
                    <div class="print-wrapper">

                    </div>
                </div>

            </div>

            <div class="col-10 shipped-wrapper" id="col">

                <div id="profile-wrapper-title">
                    <div class="">
                        <h5>Shipped Orders</h5>
                        <p>List of products that were Shipped</p>
                    </div>
                </div>

                <div id="table-wrapper" class="fetch-shipped"></div>

            </div>

            <div class="col-10 canceled-wrapper" id="col">

                <div id="profile-wrapper-title">
                    <div class="">
                        <h5>Canceled Orders</h5>
                        <p>List of products that were Canceled</p>
                    </div>
                </div>

                <div id="table-wrapper" class="fetch-cancelled"></div>
            </div>

            <div class="col-10 user-wrapper" id="col">

                <div id="profile-wrapper-title">
                    <div class="">
                        <h5 class="m-0">
                            <?php echo $name . "'s" ?> Orders
                        </h5>
                        <p>Below are the products purchased by
                            <?php echo $name ?>
                        </p>
                    </div>
                </div>

                <div id="table-wrapper" class="">
                    <?php
                    if (isset($_GET['u_id'])) {
                        displayUser($userRecordsQuery);
                    }
                    ?>
                </div>
            </div>


        </div>
    </div>
</div>
</div>

<div class="print-wrapper">
    <div class="print" id="print">
        <div class="elements"></div>
        <button class="btn btn-outline-2 print-btn">Print Recipt(s)</button>
    </div>
</div>

<div id="msg">
    <p class="m-0">This Product has been Deleted</p>
</div>




<script src="Scripts/orders.js"></script>
<script>
    $(document).ready(function () {
        const trigger = '<?php if (isset($_GET['u_id'])) {
            echo 'true';
        } ?>'
        if (trigger == 'true') {

            showUser();
            $("#mp-user").click(function () {
                showUser();
            });
        } else {
            $("#mp-user").hide();
            $(".user-wrapper").hide();
        }
    });
    function showUser() {
        $(".user-wrapper").show();

        $("#mp-user li").css("background-color", "#669999");
        $("#mp-user").css("color", "#000");


        $("#mp-allorders").css("color", "#555");
        $("#mp-shipped").css("color", "#555");
        $("#mp-canceled").css("color", "#555");

        $("#mp-allorders li").css("background-color", "rgb(214, 214, 214)");
        $("#mp-shipped li").css("background-color", "rgb(214, 214, 214)");
        $("#mp-canceled li").css("background-color", "rgb(214, 214, 214)")

        $(".allorders-wrapper").hide();
        $(".shipped-wrapper").hide();
        $(".canceled-wrapper").hide();
    }
</script>


<?php
function displayUser($query)
{
    if (mysqli_num_rows($query) >= 1) {
        $statusValues = array("Warehouse", "In Route", "Shipped", "Delivered", "Cancelled");
        echo
            "
            <table class='table'>
                <tr>
                    <th>Order Id</th>
                    <th>Sale Id</th>
                    <th>Product Name</th>
                    <th>Customer Name</th>
                    <th>Quantity</th>
                    <th>Shipping Address</th>
                    <th>Payment Method</th>
                    <th>Status</th>
                    <th>Order Date</th>
                </tr>
            ";

        while ($get = mysqli_fetch_assoc($query)) {
            if ($get['ap_deleted'] == 1) {
                $ap_id = '#';

                $msg = "This Item was Removed";
                $class = "text-danger deleted-msg";
            } else {
                $ap_id = 'edit_product.php?p_id=' . $get['ap_id'];
                $msg = $get['ap_name'];
                $class = '';
            }

            if ($get['s_payment_method'] == 'CRD') {
                $title = "Paid by Card";
            }
            if ($get['s_payment_method'] == 'COD') {
                $title = "Paid by Cash On Delivery";
            }
            echo
                "
                <tr class='table-row'>
                    <td>OR-" . $get['o_id'] . "</td>
                    <td><a href='dashboard_table.php?sale=1'>SI-" . $get['s_id'] . "</a></td>
                    <td><a href='" . $ap_id . "' title='$msg' class='$class'>" . $get['ap_name'] . "</a></td>
                    <td><a href='customers.php?u_id=" . $get['u_id'] . "'>" . $get['u_name'] . "</a></td>
                    <td>" . $get['s_sold_qty'] . "</td>
                    <td>" . $get['u_shippingaddr'] . "</td>
                    <td title='$title'>" . $get['s_payment_method'] . "</td>
                    <td>
                        <select title='Double Click To View by Status' class='select-status' aria-valuetext='" . $get['o_id'] . "'>
                        <option value='" . $get['o_status'] . "' selected>" . $get['o_status'] . "</option>
                            ";
            foreach ($statusValues as $ele) {
                if ($get['o_status'] == $ele) {
                    continue;
                } else {
                    echo "<option value='$ele'>$ele</option>";
                }
            }
            echo "
                        </select>
                    </td>
                    <td>" . $get['o_date'] . "</td>
                </tr>
            ";
        }
        echo "</table>";
    } else {
        echo "<h4 class='text-secondary'>No Records to Show</h4>";
    }
}
?>

</body>

</html>