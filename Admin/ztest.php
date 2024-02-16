<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

    <div id="chartContainer"></div>


    <?php
    include("../DB-Con/db.con.php");
    $q = mysqli_query($con, "SELECT 'y', ap_price from add_products right join sale on add_products.ap_id = sale.ap_id");

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
                        while ($data = mysqli_fetch_assoc($q)) {
                            $y = $data['y'];
                            $price = $data['ap_price'];
                            ?>
                                                    { <?php echo $y ?>: <?php echo $price ?> },
                            <?php
                        }
                        ?>

                    ]
                }]
            });
            chart.render();

        }
    </script>

</body>

</html>