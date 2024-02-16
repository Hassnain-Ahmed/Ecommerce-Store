<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: orders_inshipment.php");
}

include("adminnavbar.php");
?>

<title>Admin - In Shipment</title>
<!-- External CSS Document File -->
<link rel="stylesheet" href="Css/orders_inshipment.css">




<div class="container-fluid">
    <div class="container" id="inshipment">

        <div>
            <h5>Orders - In Shipment</h5>
            <p>Orders that are currently in Shipment Process</p>
        </div>

        <div id="table-wrapper">
            <label for="">View by Order Status</label>
            <select name="" id="" class="">
                <option value="">All Records</option>
                <option value="">Warehouse</option>
                <option value="">In Route</option>
                <option value="">Shipped</option>
                <option value="">Delivered</option>
            </select>

            <table class="table">
                <tr>
                    <th>Order ID</th>
                    <th>Customer ID</th>
                    <th>Product ID</th>
                    <th>Product Name</th>
                    <th>Current Process Step</th>
                </tr>
                <tr>
                    <td><a href="">Order ID</a></td>
                    <td><a href="">Customer ID</a></td>
                    <td><a href="">Product ID</a></td>
                    <td>Product Name</td>
                    <td>
                        <i class="f fa fa-building"></i>
                        <span>In Warehouse</span>
                    </td>
                </tr>
            </table>
        </div>

    </div>
</div>



</body>

</html>