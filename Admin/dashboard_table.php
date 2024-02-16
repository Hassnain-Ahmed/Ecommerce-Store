<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: dashboard_table.php");
}

include("adminnavbar.php");
include("../DB-Con/db.con.php");
?>

<title>Admin - Dashboard - TS</title>
<!-- External CSS Document File -->
<link rel="stylesheet" href="Css/dashboard_table.css">

<?php
if (!isset($_GET['sale']) && !isset($_GET['low']) && !isset($_GET['out'])) {
    echo "<script>window.location.href='dashboard.php'</script>";
}

if (!isset($_GET['sale'])) {
    $disable = "disabled";
    $hide = "class-hide";

} else {
    $disable = "";
    $hide = "";
}



$getTotalDashboad = mysqli_fetch_assoc(mysqli_query($con, "SELECT sum(ap_price) as total , monthname(now()) as nameofmonth from add_products right join sale on add_products.ap_id = sale.ap_id"));

if (isset($_GET['sale'])) {
    $query = mysqli_query(
        $con,
        "SELECT sale.s_id as SaleID , orders.o_id as OR_ID , supplier.su_name as SU_NAME , orders.o_reciver_name as CUS_NAME , sale.s_sold_qty as QTY , sale.s_payment_method as PAY ,
        add_products.ap_price as PRICE , add_products.ap_name as PRD_NAME , (sale.s_sold_qty * add_products.ap_price) as TOTAL , sale.s_date as S_DATE , add_products.ap_avail_stock as T_STOCK
        from sale 
        left join add_products on sale.ap_id = add_products.ap_id 
        join orders on sale.o_id = orders.o_id
        join supplier on add_products.su_id = supplier.su_id
        order by sale.s_date desc
        "
    );
    $title = "All Records";
    $class = '';
}
if (isset($_GET['low'])) {
    $query = mysqli_query(
        $con,
        "SELECT sale.s_id as SaleID , orders.o_id as OR_ID , supplier.su_name as SU_NAME , orders.o_reciver_name as CUS_NAME , sale.s_sold_qty as QTY , sale.s_payment_method as PAY ,
        add_products.ap_price as PRICE , add_products.ap_name as PRD_NAME , (sale.s_sold_qty * add_products.ap_price) as TOTAL , sale.s_date as S_DATE , add_products.ap_avail_stock as T_STOCK
        from sale 
        left join add_products on sale.ap_id = add_products.ap_id 
        join orders on sale.o_id = orders.o_id
        join supplier on add_products.su_id = supplier.su_id
        where add_products.ap_avail_stock < 20
        "
    );
    $title = "Low On Stock";
    $class = "text-info";
}

if (isset($_GET['out'])) {
    $query = mysqli_query(
        $con,
        "SELECT sale.s_id as SaleID , orders.o_id as OR_ID , supplier.su_name as SU_NAME , orders.o_reciver_name as CUS_NAME , sale.s_sold_qty as QTY , sale.s_payment_method as PAY ,
        add_products.ap_price as PRICE , add_products.ap_name as PRD_NAME , (sale.s_sold_qty * add_products.ap_price) as TOTAL , sale.s_date as S_DATE , add_products.ap_avail_stock as T_STOCK
        from add_products
        right join sale on sale.ap_id = add_products.ap_id 
        join orders on sale.o_id = orders.o_id
        join supplier on add_products.su_id = supplier.su_id
        where add_products.ap_avail_stock = 0 order by sale.s_date desc
        "
    );
    $title = "Out of Stock";
    $class = "text-danger";
}
?>



<div class="container-fluid py-4">

    <div class="container justify-content-center" id="dash-box">

        <div class="row" id="dash-stats-bar">

            <div class="col-sm-3">
                <h6 class="m-0 p-1 fw-normal">Sales Of
                    <b>
                        <?php echo $getTotalDashboad['nameofmonth'] ?>
                    </b>
                </h6>
            </div>

            <div class="col-sm-6 text-center">
                <h4 class="m-0 ">DASHBOARD</h4>
            </div>

            <div class="col-sm-3 text-end">
                <h6 class="fw-normal m-0 p-1">Total Sales:
                    <b class="font-monospace">
                        <?php echo $getTotalDashboad['total'] ?>
                    </b>
                    <sub>PKR</sub>
                </h6>
            </div>

        </div>

    </div>


    <div class="container justify-content-center">

        <div class="col-12 ">

            <div>
                <label for="" class="fs-6">Dashboard -
                    <?php echo $title ?>
                </label>
                <p class="after-bar"></p>
                <select name="" id="d-select" class="" <?php echo $disable ?>>
                    <option value="Table" selected>View Records</option>
                    <option value="Graph">View Graph</option>
                </select>
                <br><br>
            </div>


            <?php



            ?>


            <div id="table-sales">
                <div id="table-wrapper1">
                    <table class="table">
                        <tr>
                            <th>Sale no.</th>
                            <th>Order no.</th>
                            <th>Product Name</th>
                            <th>Customer Name</th>
                            <th>Supplier Name</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Remaining Stock</th>
                            <th>Total</th>
                            <th>Date</th>
                        </tr>
                        <tr>
                            <?php
                            while ($get = mysqli_fetch_assoc($query)) {
                                if ($get['T_STOCK'] == 0) {

                                    $low = "<td class='text-danger'>" . $get['T_STOCK'] . "</td>";

                                } else if ($get['T_STOCK'] <= 20) {

                                    $low = "<td class='text-info'>" . $get['T_STOCK'] . "</td>";

                                } else {

                                    $low = "<td class=''>" . $get['T_STOCK'] . "</td>";

                                }

                                echo
                                    "
                                    <tr>
                                        <td>SI-" . $get['SaleID'] . "</td>
                                        <td>OR-" . $get['OR_ID'] . "</td>
                                        <td>" . $get['PRD_NAME'] . "</td>
                                        <td>" . $get['CUS_NAME'] . "</td>
                                        <td>" . $get['SU_NAME'] . "</td>
                                        <td>" . $get['PRICE'] . "rs</td>
                                        <td>" . $get['QTY'] . "x</td>
                                        $low
                                        <td>" . $get['TOTAL'] . "rs</td>
                                        <td>" . $get['S_DATE'] . "</td>
                                    </tr>
                                    ";
                            }
                            ?>
                        </tr>

                    </table>

                </div>

                <?php
                $getStats = mysqli_fetch_assoc(mysqli_query($con, "SELECT sum(sale.s_sold_qty) as T_SOLD, sum(add_products.ap_price) as T_PRICE from sale left join add_products on sale.ap_id = add_products.ap_id"));
                ?>

                <div id="table-wrapper2" class="<?php echo $hide ?>">
                    <h5>Total Of Product Stats</h5>
                    <p class="after-bar"></p>
                    <ul class="list-group">
                        <li class="list-group-item"><i class="f fa-regular fa-square"></i>&emsp; Product Sold Worth
                            <b>
                                <?php echo $getStats['T_PRICE'] ?>
                            </b> <sub>PKR</sub>
                        </li>
                        <li class="list-group-item"><i class="f fa-regular fa-square"></i>&emsp; Quantity Sold
                            <b>
                                <?php echo $getStats['T_SOLD'] ?>
                            </b> <sub>Items</sub>
                        </li>
                    </ul>
                </div>

            </div>


            <div class="chart-wrapper">
                <div id="chartContainer" style="height: 450px; width: 100%;"></div>
            </div>





        </div>
    </div>

</div>


<?php
$q = mysqli_query($con, "SELECT month(sale.s_date) as monthh, day(sale.s_date) as dayy ,ap_price as price, sale.s_date as date from add_products right join sale on add_products.ap_id = sale.ap_id where month(sale.s_date) = month(now()) and year(sale.s_date) = year(now()) group by sale.s_date");
$getChartQuery = mysqli_query($con, "SELECT 'y', ap_price from add_products right join sale on add_products.ap_id = sale.ap_id where month(sale.s_date) = month(now()) and year(sale.s_date) = year(now())");

?>


<script src="https://cdn.canvasjs.com/canvasjs.min.js"></script>
<script>
    window.onload = function () {

        var chart = new CanvasJS.Chart("chartContainer", {
            animationEnabled: true,
            theme: "light2",
            title: {
                text: "Sales This Month"
            },
            data: [{
                type: "line",
                indexLabelFontSize: 16,
                dataPoints: [
                    <?php
                    while ($data = mysqli_fetch_assoc($getChartQuery)) {
                        $y = $data['y'];
                        $price = $data['ap_price'];
                        ?>{ <?php echo $y ?>: <?php echo $price ?> },
                        <?php
                    }
                    ?>

                ]
            }]
        });

        $("#d-select").on("change", function () {
            let ss = $("#d-select").val();
            if (ss == "Graph") {
                chart.render();

                $(".chart-wrapper").show().css("visibility", "visible");
                $("#table-sales").hide();
            }
            if (ss == "Table") {
                $(".chart-wrapper").show().css("visibility", "hidden");
                $("#table-sales").show();
            }
        });
    }
</script>



</body>

</html>