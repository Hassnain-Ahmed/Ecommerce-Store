<?php
if (isset($_POST['monthVal'])) {
    $monthVal = $_POST['monthVal'];
    if ($monthVal != 'all') {
        getMonth($monthVal);
    } else {
        echo 1;
    }
}

function getMonth($input)
{
    include("../DB-Con/db.con.php");
    $query = mysqli_query($con, "SELECT orders.o_id, sale.s_id, add_products.ap_id, add_products.ap_name as ap_name, user.u_name as u_name, s_sold_qty, u_shippingaddr, s_payment_method, date(o_date) as o_date, ap_deleted, o_status, user.u_id as u_id from sale right join orders on sale.o_id = orders.o_id join add_products on orders.ap_id = add_products.ap_id join user on orders.u_id = user.u_id where monthname(orders.o_date) = '$input' order by orders.o_date desc");
    if (mysqli_num_rows($query) >= 1) {
        echo "View Records Of $input";
        DisplayRecords($query);
    } else {
        echo "No Records Found";
    }

}

function displayRecords($query)
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
                    <th>Print</th>
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
                    <td><label for='pr' class='bg-dark d-flex justify-content-center my-1'><input type='checkbox' aria-valuenow='" . $get['u_id'] . "'  aria-valuetext='" . $get['o_id'] . "|" . $get['u_id'] . "|" . $get['s_id'] . "|" . $get['o_id'] . "' class='print id='pr'></label></td>
                </tr>
            ";
        }
        echo "</table>";
    } else {
        echo "<h4 class='text-secondary'>No Records to Show</h4>";
    }
}
?>
<script src="Scripts/orders-viewby-ajax.js"></script>
<script src="Scripts/category-ajax-print.js"></script>

</body>

</html>