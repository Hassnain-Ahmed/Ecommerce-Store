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
if (!isset($_GET['low']) && !isset($_GET['out'])) {
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

if (isset($_GET['low'])) {
    $query = mysqli_query($con, "SELECT * from add_products left join category on category.cty_id = add_products.cty_id join supplier on supplier.su_id = add_products.su_id where ap_avail_stock < 20");
    $title = "Low On Stock";
    $class = "text-info";
}

if (isset($_GET['out'])) {
    $query = mysqli_query($con, "SELECT * from add_products left join category on category.cty_id = add_products.cty_id join supplier on supplier.su_id = add_products.su_id where ap_avail_stock = 0");
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



            <style>
                .table tr td:nth-child(2) {
                    width: 120px;
                    align-self: 1/1;
                    object-fit: cover;
                }
            </style>


            <div id="table-sales">
                <div id="table-wrapper1">
                    <table class="table">
                        <tr>
                            <th>Product no.</th>
                            <th>Image</th>
                            <th>Product Name</th>
                            <th>Category</th>
                            <th>Supplier Name</th>
                            <th>Price</th>
                            <th>Remaining Stock</th>
                            <th>Date</th>
                        </tr>
                        <tr>
                            <?php
                            while ($get = mysqli_fetch_assoc($query)) {
                                $img = explode(",", $get['ap_img_gal'])[0];

                                if ($get['ap_avail_stock'] < 20) {
                                    $row = "<td class='text-info'>" . $get['ap_avail_stock'] . "x</td>";

                                }
                                if ($get['ap_avail_stock'] == 0) {
                                    $row = "<td class='text-danger'>" . $get['ap_avail_stock'] . "x</td>";
                                }

                                echo
                                    "
                                    <tr>
                                        <td>P-" . $get['ap_id'] . "</td>
                                        <td><img src='uploads/" . trim($img) . "' class='w-50'></td>
                                        <td>" . $get['ap_name'] . "</td>
                                        <td>" . $get['cty_name'] . "</td>
                                        <td>" . $get['su_name'] . "</td>
                                        <td>Rs." . $get['ap_price'] . "</td>
                                        $row
                                        <td>" . $get['ap_date'] . "</td>
                                    </tr>
                                    ";
                            }
                            ?>
                        </tr>

                    </table>

                </div>

            </div>
        </div>
    </div>

</div>

</body>

</html>