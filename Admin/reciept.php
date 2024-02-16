<?php
include("adminnavbar.php");
include("../DB-Con/db.con.php");
?>
<title>Print</title>
<link rel="stylesheet" href="css/Reciept.css">
<?php
$countUser = mysqli_query($con, "SELECT distinct(u_name), user.u_id from print left join user on user.u_id = print.u_id");
if (mysqli_num_rows($countUser) > 1) {
    echo
        "
        <div class='select-user-wrapper'>
            <label>More than one User Record found: </label>
            <select class='select-user'>
                <option selected disabled>Select User</option>

                ";
    while ($get = mysqli_fetch_assoc($countUser)) {
        echo "<option value='" . $get['u_id'] . "'>" . $get['u_name'] . "</option>";
    }
    echo "
            </select>
        </div>
    ";
}


if (isset($_GET['u_id'])) {
    $getCusQuery = mysqli_query($con, "SELECT u_name, concat(u_shippingaddr,', ',u_city,'-',u_province,', ',u_postal) as addr, u_phone, orders.o_date, s_payment_method from print left join orders on orders.o_id = print.o_id join user on print.u_id = user.u_id join sale on sale.s_id = print.s_id where print.u_id = '" . $_GET['u_id'] . "'");
    if (mysqli_num_rows($getCusQuery) >= 1) {
        $getCus = mysqli_fetch_assoc($getCusQuery);
        $u_name = $getCus['u_name'];
        $u_addr = $getCus['addr'];
        $u_phone = $getCus['u_phone'];
        $pay = $getCus['s_payment_method'];
        $o_date = $getCus['o_date'];
    } else {
        $u_name = "";
        $u_addr = "";
        $u_phone = "";
        $pay = "";
        $o_date = "";
    }

} else {
    $u_name = "";
    $u_addr = "";
    $u_phone = "";
    $pay = "";
    $o_date = "";
}
?>



<div class="container-fluid">
    <div class="container">

        <div class="reciept-wrapper" id="reciept">

            <nav class="heading">
                <div class="heading-item">
                    <label for='' class="heading-order_id"></label>
                </div>
                <div class="heading-item"><img src="assets/img/Logo2.png" alt=""></div>
                <div class="heading-item">
                    <label class='date'></label>
                </div>
            </nav>

            <hr><br>

            <h5 class="m-0">Customer Information</h5>
            <section class="customer-info">


                <div class="parent">
                    <div class="div1">
                        <label for="">Name: </label>
                    </div>
                    <div class="div2">
                        <label class="u_name">
                            <?php echo $u_name ?>
                        </label>
                    </div>

                    <div class="div3">
                        <label for="">Address: </label>
                    </div>
                    <div class="div4">
                        <label class="u_addr">
                            <?php echo $u_addr ?>
                        </label>
                    </div>

                    <div class="div5">
                        <label for="">Contact: </label>
                    </div>
                    <div class="div6">
                        <label class="u_contact">
                            <?php echo $u_phone ?>
                        </label>
                    </div>
                    <div class="div7">
                        <label for="">Payment Method: </label>
                    </div>
                    <div class="div8">
                        <label class="payment">
                            <?php echo $pay ?>
                        </label>
                    </div>
                    <div class="div9"><label for="">Order Placement Date:</label></div>
                    <div class="div10 date">
                        <?php echo $o_date ?>
                    </div>
                </div>

            </section>

            <br><br>
            <h5 class="m-0">Order Information</h5>
            <section class="customer-info">

                <table class="table">
                    <tr>
                        <th>#</th>
                        <th>Product Name</th>
                        <th>Category</th>
                        <th>Attribuits</th>
                        <th>Quantity</th>
                        <th>Unit Price</th>
                        <th>Total</th>
                    </tr>
                    <tbody>
                        <?php
                        if (isset($_GET['u_id'])) {

                            $number = 0;
                            $item = mysqli_query($con, "SELECT s_payment_method, ap_name, s_sold_qty, ap_price, (add_products.ap_price * sale.s_sold_qty) as total from print left join orders on orders.o_id = print.o_id join user on print.u_id = user.u_id join add_products on add_products.ap_id = orders.ap_id join sale on sale.s_id = print.s_id where print.u_id = '" . $_GET['u_id'] . "'");
                            if (mysqli_num_rows($item) >= 1) {

                                while ($getItem = mysqli_fetch_assoc($item)) {
                                    $number++;
                                    echo
                                        "
                                    <tr>
                                    <td>$number</td>
                                    <td>" . $getItem['ap_name'] . "</td>
                                    <td>---</td>
                                    <td>---</td>
                                    <td>" . $getItem['s_sold_qty'] . "</td>
                                    <td>" . $getItem['ap_price'] . "</td>
                                    <td>" . $getItem['total'] . "</td>
                                </tr>
                                ";
                                    $t[] = $getItem['total'];
                                    $sum = array_sum($t);
                                    $tsum = $sum + 200;
                                }
                            } else {
                                $sum = '';
                                $tsum = '';
                            }
                        } else {
                            $sum = '';
                            $tsum = '';
                        }
                        ?>
                    </tbody>
                </table>

                <div class="total-wrapper">

                    <div>
                        <label for="">Subtotal:</label>
                        <span>
                            Rs.
                            <?php echo $sum ?>
                        </span>
                    </div>
                    <div>
                        <label for="">Shipping:</label>
                        <span>Rs. 200</span>
                    </div>
                    <div>
                        <label for="">Total:</label>
                        <span>Rs.
                            <?php echo $tsum ?>
                        </span>
                    </div>

                </div>

            </section>


            <div class="d-flex justify-content-center my-5" id="btn-wrapper">
                <button class="btn btn-outline-1 mx-1" id="clear">Clear Feilds</button>
                <button class="btn btn-outline-2 mx-1" id="print">Print</button>
            </div>

        </div>

    </div>
</div>


<script src="Scripts/reciept.js"></script>
</body>

</html>