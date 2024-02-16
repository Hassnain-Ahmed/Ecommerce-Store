<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: admin.php");
}
?>

<title>Admin - Home</title>
<!-- External CSS Document File -->
<link rel="stylesheet" href="Css/admin.css">

<?php
include('adminnavbar.php');
?>



<div class="" id="admin_home">

    <h4>Homepage</h4>
    <p class="after-bar-2">Modify the Homepage related Stuff</p>

    <div class="row g-4">

        <div class="col-sm-2">
            <a href="productslider.php">
                <div>
                    <i class="icon fa-regular fa-images"></i>
                    <h5>Product Slider</h5>
                </div>
            </a>
        </div>

        <div class="col-sm-2">
            <a href="featureproducts.php">
                <div>
                    <i class="icon fa fa-cart-shopping"></i>
                    <h5>Featured</h5>
                </div>
            </a>
        </div>

        <!-- <div class="col-sm-2">
                <a href="">
                    <div>
                        <i class="icon fa fa-list"></i>
                        <h5>Categories</h5>
                    </div>
                </a>
            </div> -->



        <div class="col-sm-2">
            <a href="dashboard.php">
                <div>
                    <i class="icon fa fa-chart-line"></i>
                    <h5>Dashboard</h5>
                </div>
            </a>
        </div>


        <div class="col-sm-2">
            <a href="category.php">
                <div>
                    <i class="icon fa fa-list"></i>
                    <h5>Categories</h5>
                </div>
            </a>
        </div>

        <!-- <div class="col-sm-2">
            <a href="Socials.php">
                <div>
                    <i class="icon fa fa-users"></i>
                    <h5>Socials</h5>
                </div>
            </a>
        </div> -->

    </div>




    <h4>Products</h4>
    <p class="after-bar-2">Add or Modify the Products</p>
    <div class="row g-4">

        <div class="col-sm-2">
            <a href="addproducts.php">
                <div>
                    <i class="icon fa fa-shopping-bag"></i>
                    <h5>Add Products</h5>
                </div>
            </a>
        </div>

        <div class="col-sm-2">
            <a href="removeproducts.php">
                <div>
                    <i class="icon fa fa-trash"></i>
                    <h5>Remove Products</h5>
                </div>
            </a>
        </div>


        <div class="col-sm-2">
            <a href="supplier.php">
                <div>
                    <i class="icon fa fa-user"></i>
                    <h5>Products Supplier</h5>
                </div>
            </a>
        </div>

        <div class="col-sm-2">
            <a href="category_products.php">
                <div>
                    <i class="icon fa fa-shopping-basket"></i>
                    <h5>All Products</h5>
                </div>
            </a>
        </div>

        <div class="col-sm-2">
            <a href="reviews.php">
                <div>
                    <i class="icon fa fa-clipboard-list"></i>
                    <h5>Manage Reviews</h5>
                </div>
            </a>
        </div>

    </div>




    <h4>Orders</h4>
    <p class="after-bar-2">Modify the Homepage related Stuff</p>
    <div class="row g-4">

        <div class="col-sm-2">
            <a href="orders.php">
                <div>
                    <i class="icon fa fa-clipboard-list"></i>
                    <h5>Order History</h5>
                </div>
            </a>
        </div>

        <div class="col-sm-2">
            <a href="orders_inshipment.php">
                <div>
                    <i class="icon fa fa-truck-fast"></i>
                    <h5>In Shipment</h5>
                </div>
            </a>
        </div>

        <div class="col-sm-2">
            <a href="customers.php">
                <div>
                    <i class="icon fa fa-person"></i>
                    <h5>Customers</h5>
                </div>
            </a>
        </div>

    </div>

    <h4>Other</h4>
    <p class="after-bar-2">Miscellaneous Stuff Regarding store</p>
    <div class="row g-4">

        <div class="col-sm-2">
            <a href="Deleted-items-table.php">
                <div>
                    <i class="icon fa fa-trash"></i>
                    <h5>Deleted Stuff</h5>
                </div>
            </a>
        </div>

        <div class="col-sm-2">
            <a href="calculator.php">
                <div>
                    <i class="icon fa fa-calculator"></i>
                    <h5>Expense Calculator</h5>
                </div>
            </a>
        </div>
    </div>



</div>

<div class="spacer p-2"></div>



</body>

</html>