<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: dashboard.php");
}

include('adminnavbar.php');
include("../DB-Con/db.con.php");
?>

<title>Admin - Dashboard</title>
<script src="assets/CanvasJs/canvasjs.min.js"></script>
<!-- External CSS Document File -->
<link rel="stylesheet" href="Css/dashboard.css">




<div class="container-fluid">

    <div class="justify-content-center" id="dash-box">

        <h5 class="text-center m-0 p-1">DASHBOARD</h5>

        <div class="" id="dash-stats">

            <!-- Sales Stats -->
            <div class="row">
                <h4>Sales</h4>
                <p class="after-bar">All sales Related to the Products</p>


                <div class="col-sm-3">
                    <?php
                    $getTotalDashboad = mysqli_fetch_assoc(mysqli_query($con, "SELECT sum(ap_price) as total from add_products right join sale on add_products.ap_id = sale.ap_id"));
                    $getTotalDashboadValue = implode(",", $getTotalDashboad);
                    ?>
                    <a href="dashboard_table.php?sale=1" title="View More">
                        <div class="card">
                            <h6>Total Sales This Month</h6>
                            <p>Rs:
                                <b class="fs-4">
                                    <?php echo $getTotalDashboadValue ?>
                                </b>
                            </p>
                        </div>
                    </a>
                </div>


                <div class="col-sm-3">
                    <a href="" title="View More">
                        <div class="card">
                            <h6>Most Sold Product</h6>
                            <p>
                                <b class="fs-4">XYZ</b>
                            </p>
                        </div>
                    </a>
                </div>

                <div class="col-sm-3">
                    <a href="" title="View More">
                        <div class="card">
                            <h6>Total Profit Made</h6>
                            <p>Rs:
                                <b class="fs-4">823</b>
                            </p>
                        </div>
                    </a>
                </div>

                <div class="col-sm-3">
                    <a href="" title="View More">
                        <div class="card">
                            <h6>Total Expenses</h6>
                            <p>Rs:
                                <b class="fs-4">823</b>
                            </p>
                        </div>
                    </a>
                </div>


            </div>



            <!-- Product Stats -->

            <?php
            $s_total = mysqli_fetch_assoc(mysqli_query($con, "SELECT SUM(s_sold_qty) as t_sold from sale"));
            $s_low_stk = mysqli_fetch_assoc(mysqli_query($con, "SELECT COUNT(ap_id) as low from add_products where ap_avail_stock < 20"));
            $s_out_stk = mysqli_fetch_assoc(mysqli_query($con, "SELECT COUNT(ap_id) as outt from add_products where ap_avail_stock = 0"));
            ?>

            <div class="row">
                <h4>Products</h4>
                <p class="after-bar">All Data Related to the Products</p>

                <div class="col-sm-3">
                    <a href="" title="View More">
                        <div class="card">
                            <h6>Products Sold so far</h6>
                            <p>Quantity:
                                <b class="fs-4">
                                    <?php echo $s_total['t_sold'] ?>
                                </b>
                            </p>
                        </div>
                    </a>
                </div>

                <div class="col-sm-3">
                    <a href="dashboard_table_low_out.php?low=1" title="View More">
                        <div class="card">
                            <h6>Low on Quantity</h6>
                            <p>Quantity:
                                <b class="fs-4">
                                    <?php echo $s_low_stk['low'] ?>
                                </b>
                            </p>
                        </div>
                    </a>
                </div>

                <div class="col-sm-3">
                    <a href="dashboard_table_low_out.php?out=1" title="View More">
                        <div class="card">
                            <h6>Out of Stock</h6>
                            <p>Quantity:
                                <b class="fs-4">
                                    <?php echo $s_out_stk['outt'] ?>
                                </b>
                            </p>
                        </div>
                    </a>
                </div>
            </div>


            <!-- This Month -->
            <div class="row">
                <div class="col-sm-12">

                    <div id="chartContainer" style="height: 270px; width: 100%;"></div>

                </div>
            </div>
        </div>



    </div>




</div>


</body>

</html>