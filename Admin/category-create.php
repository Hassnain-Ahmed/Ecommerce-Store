<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: category-create.php");
}

include("adminnavbar.php");
?>

<title>Admin - Category/Create</title>
<link rel="stylesheet" href="css/category.css">


<div class="container">
    <div class="row select-new" id="new_category">
        <h5 class="my-0">New Category</h5>
        <p>Create a new category to add Products in it</p>
        <div class="col-8 my-1">
            <form action="" method="post" enctype="multipart/form-data">

                <label for="">Category Name: </label>
                <input type="text" name="cty_name" id="" placeholder="Eg: Men's wear" required> <br>

                <label for="">Max Products Allowed: </label>
                <input type="number" name="cty_max_products" id="" placeholder="Eg: 25, 1000" required> <br>

                <input type="file" name="cty_img" id="cty_img" onchange="preview_img(event)" accept=".jpeg, .jpg, .png"
                    required> <br>


                <div class="d-flex justify-content-center">
                    <button type="submit" name="sub">Create Category</button>
                </div>
            </form>
        </div>

        <div class="col-3" id="img-wrapper">
            <img src="assets/img/undraw_image_upload_re_w7pm.svg" id="img_preview" class="img-fluid border-1">
        </div>
    </div>


</div>





<script src="category_create.js"></script>

<?php
if (isset($_POST['sub'])) {
    date_default_timezone_set("Asia/Karachi");
    send_data();
}
function send_data()
{

    $allowed_ext = array("jpeg", "jpg", "png");

    $cty_name = $_POST["cty_name"];
    $cty_max_products = $_POST["cty_max_products"];
    $cty_date = date("Y-m-d h:i:s");

    $cty_img_name = $_FILES["cty_img"]['name'];
    $cty_img = $_FILES["cty_img"];


    $target_dir = "uploads/" . $cty_img['name'];
    $ext = pathinfo(basename($cty_img["name"]), PATHINFO_EXTENSION);

    $upload_ok = 1;

    if (in_array($ext, $allowed_ext)) {
        $upload_ok = 1;
        // echo "in array & ";
    } else {
        $upload_ok = 0;
        // echo "not in array & ";
    }

    if ($cty_img['size'] < 2000000) {
        $upload_ok = 1;
        // echo "not heavy & ";
    } else {
        $upload_ok = 0;
        // echo "too heavy & ";
    }


    if ($upload_ok == 1) {
        if (move_uploaded_file($_FILES['cty_img']['tmp_name'], $target_dir)) {
            sql_query($cty_name, $cty_max_products, $cty_img_name, $cty_date);
        } else {
        }
    }
}
function sql_query($cty_name, $cty_max_products, $cty_img, $cty_date)
{
    include("../DB-Con/db.con.php");
    $query = mysqli_query($con, "INSERT into category values('','$cty_name','$cty_max_products','$cty_img','$cty_date','0')");
}
?>

</body>

</html>