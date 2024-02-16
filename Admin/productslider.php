<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: productslider.php");
}

include('adminnavbar.php');
?>

<title>Admin - Product Slider</title>
<!-- External CSS Document File -->
<link rel="stylesheet" href="Css/productslider.css">




<div class="container-fluid g-0">
    <div id="home-slider">

        <div id="carouselExampleDark" class="carousel carousel-dark slide" data-bs-ride="carousel">
            <?php
            include("../DB-Con/db.con.php");
            $query2 = mysqli_query($con, "SELECT s_id , slider.ap_id , add_products.ap_id , add_products.ap_img_gal , s_status ,s_img , s_title , s_about from add_products right join slider on add_products.ap_id = slider.ap_id order by slider.ap_id desc");
            $numRows = mysqli_num_rows($query2);

            echo "<div class='carousel-inner'>";
            while ($get_query2 = mysqli_fetch_assoc($query2)) {

                if (strlen($get_query2['s_img']) > 0) {
                    $s_imgg = "../admin/uploads/slider/" . $get_query2['s_img'];
                }

                if (strlen($get_query2['ap_img_gal']) > 0) {
                    $s_imgg = "../admin/uploads/" . explode(",", $get_query2['ap_img_gal'])[0];
                }

                if ($get_query2['s_status'] == "Primary") {
                    echo
                        "
                        <div class='carousel-item active' data-bs-interval='5000'>
                            <img src='" . $s_imgg . "' class='d-block w-100' alt='...'>
                            <div class='carousel-caption d-none d-md-block'>
                                <h2>" . $get_query2["s_title"] . "</h2>
                                <p>" . $get_query2["s_about"] . "</p>
                            </div>
                        </div>
                ";
                }
                if ($get_query2['s_status'] != "Primary") {
                    echo
                        "
                    <div class='carousel-item' data-bs-interval='5000'>
                        <img src='" . $s_imgg . "' class='d-block w-100' alt='...'>
                        <div class='carousel-caption d-none d-md-block'>
                            <h2>" . $get_query2["s_title"] . "</h2>
                            <p>" . $get_query2["s_about"] . "</p>
                        </div>
                    </div>
                        ";
                }
            }
            echo "</div>";

            if ($numRows > 0) {
                echo
                    "
                <button class='carousel-control-prev' type='button' data-bs-target='#carouselExampleDark' data-bs-slide='prev'>
                    <span class='carousel-control-prev-icon' aria-hidden='true'></span>
                    <span class='visually-hidden'>Previous</span>
                </button>
                <button class='carousel-control-next' type='button' data-bs-target='#carouselExampleDark' data-bs-slide='next'>
                    <span class='carousel-control-next-icon' aria-hidden='true'></span>
                    <span class='visually-hidden'>Next</span>
                </button>
                ";
            }

            ?>

        </div>

    </div>
</div>






<div class="row justify-content-center my-4" id="ps-home">
    <div class="col-sm-10">
        <h5 class="m-0">Images Currently on Display</h5>
        <p>Below are the images that are Currently displayed on the Main Homepage</p>
        <div id="input_wrapper">
            <p>Add images to Slider <span class="add_img_btn">Click Here</span></p>
        </div>
        <div id="table_wrapper">
            <table class="table">
                <tr>
                    <th>ID</th>
                    <th>Image</th>
                    <th>Title</th>
                    <th>About</th>
                    <th>Status</th>
                    <th>Product ID</th>
                    <th>Edit</th>
                    <th>Remove</th>
                </tr>
                <?php
                $query = mysqli_query($con, "SELECT s_id , slider.ap_id , add_products.ap_id , add_products.ap_img_gal , s_img , s_title , s_about, s_status from slider left join add_products on add_products.ap_id = slider.ap_id  order by s_status asc");
                while ($get = mysqli_fetch_assoc($query)) {
                    if (strlen($get['s_img']) > 0) {
                        $s_img = "uploads/slider/" . $get['s_img'];
                    }

                    if (strlen($get['ap_img_gal']) > 0) {
                        $s_img = "uploads/" . explode(",", $get['ap_img_gal'])[0];
                    }
                    echo
                        "
                    <tr>
                        <td>SID-" . $get["s_id"] . "</td>
                        <td><img src='" . $s_img . "' alt='$s_img' class='img-thumbnail w-100'></td>
                        <td>" . $get['s_title'] . "</td>
                        <td>" . $get['s_about'] . "</td>
                        <td>" . $get['s_status'] . "</td>
                        <td>AP-" . $get['ap_id'] . "</td>
                        <td><a href='' onclick='return false;' class='edit_btn' aria-valuetext='" . $get['s_id'] . "'>Edit</a></td>
                        <td><a href='productslider_remove.php?s_id=" . $get["s_id"] . " '>Remove</a></td>
                    </tr>
                    ";
                }
                ?>
            </table>
        </div>
    </div>
</div>



<!-- <?php

if (isset($_GET['addslider'])) {
    $addsliderQuery = mysqli_query($con, "SELECT  ap_name , ap_img_gal , ap_desc from add_products where ap_id = '" . $_GET['addslider'] . "'");
    if ($addsliderQuery) {
        $addslider = mysqli_fetch_assoc($addsliderQuery);
        $ap_id = $_GET['addslider'];
        $ap_name = $addslider['ap_name'];
        $ap_desc = $addslider['ap_desc'];
        $ap_img = explode(",", $addslider['ap_img_gal'])[0];
        $ori_img = explode(",", $addslider['ap_img_gal'])[0];
        $ap_imgg = "uploads/" . trim($ap_img);
    }
} else {
    $ap_id = "";
    $ap_name = "";
    $ap_desc = "";
    $ap_imgg = "assets/img/undraw_photo_session_re_c0cp.svg";
    $ori_img = "";
}
?> -->

<div class="wrapper-wrapper">

    <form action="" method="post" enctype="multipart/form-data">
        <div class="add_img row">
            <div id="close-add_img_wrapper">
                <i class="f fa fa-close"></i>
            </div>
            <h5 class="m-0 wrapper-title"></h5>
            <p class="wrapper-about"></p>

            <div class="col-8">

                <button id='add_as_prdct' class="button" type="button" data-bs-toggle="collapse"
                    data-bs-target="#collapseExample" aria-expanded="flase" aria-controls="collapseExample">
                    Add Product as Slider
                </button>

                <div class="collapse" id="collapseExample">
                    <div class="search-product-wrapper">
                        <label for="p_id">Product Name</label>
                        <input type="text" name="" id="search_product" placeholder="Eg: Sony , 1" value="">
                        <div class="search-product-items"></div>
                    </div>
                </div>
                <br>

                <label for="input_title">Slider Title</label>
                <input type="text" id="input_title" name="input_title" placeholder="Eg: Sony Headphones" value=""
                    required><br>

                <label for="input_about">About Image</label>
                <input type="text" id="input_about" name="input_about" placeholder="Eg: Good Stuff" value=""
                    required><br>

                <input type="hidden" name="insert-trigger" id="insert-trigger">
                <input type="hidden" name="ori_img_val" id="ap_img_ori" value="">
                <input type="hidden" name="" id="s_id" value="">


                <input type="file" name="slider_img" id="slider_img"><br>

                <input type="checkbox" name="make_primary" id="make_primary" class="">
                <label for="make_primary">Make Primary</label>
                <p class="m-0 checkbox-text">&nbsp;</p>

            </div>

            <div class="col-4">
                <img src="" alt="Selected Image" id="img_preview_mini" loading="lazy">
            </div>

            <div class="btn-wrapper my-2">
                <button type="button" class="button btn-style-1 mx-1" id="preview_slider">Preview Slider</button>
                <button type="submit" class="button btn-style-2 mx-1" id="create_slider" name="create_silder">Create
                    Slider Page</button>
                <button type="button" class="btn btn-outline-secondary mx-1" id="update_slider_btn" name="">Update
                    Slider</button>
            </div>
        </div>
    </form>

</div>

<div class="slider_preview_wrapper">
    <div class="slider">
        <div class="f-btn"><i class="f fa fa-close"></i></div>
        <img src="assets/img/undraw_photo_session_re_c0cp.svg" class="w-100" alt="..." id="img_preview" loading="lazy">
        <div class="carousel-caption d-none d-md-block">
            <h2 id="slider_title"></h2>
            <p id="slider_about"></p>
        </div>
    </div>
</div>


<script src="Scripts/productslider.js"></script>

</body>

</html>

<?php

if (isset($_POST["create_silder"])) {

    $s_title = $_POST['input_title'];
    $s_about = $_POST['input_about'];
    $s_makeprimary = "Secondary";
    if (isset($_POST["make_primary"])) {
        mysqli_query($con, "UPDATE slider set s_status = 'Secondary'");
        $s_makeprimary = "Primary";
    }
    $goforupload = 1;

    if (isset($_FILES['slider_img'])) {
        $accept_arr = array("jpg", "jpeg", "png");
        $slider_img = $_FILES["slider_img"];
        $slider_img_dir = "uploads/Slider/" . $slider_img["name"];
        $slider_img_ext = pathinfo($slider_img["name"], PATHINFO_EXTENSION);

        if (!in_array($slider_img_ext, $accept_arr)) {
            $goforupload = 0;
        }
        if ($slider_img["size"] > 2000000) {
            $goforupload = 0;
        }

        if ($goforupload == 1) {
            if (move_uploaded_file($slider_img["tmp_name"], $slider_img_dir)) {

                slider_insert_query($slider_img["name"], $s_title, $s_about, $s_makeprimary, 'NULL', '');

                echo "<script>window.location.href='productslider.php'</script>";
            }
        }
    }

    if (isset($_POST['insert-trigger'])) {

        if ($_POST['insert-trigger'] >= 1) {

            slider_insert_query('', $s_title, $s_about, $s_makeprimary, $_POST['insert-trigger'], $_POST['ori_img_val']);
            echo "<script>window.location.href='productslider.php'</script>";

        }

    } else {
        $addsliderId = NULL;
    }



}
function slider_insert_query($s_img, $s_title, $s_about, $s_status, $ap_id, $s_ori_img)
{
    include("../DB-Con/db.con.php");
    $date = date("Y/m/d h:i:s");
    mysqli_query($con, "INSERT into slider(s_id, s_img, s_title, s_about, s_status, s_date, ap_id, s_ori_img) values('','$s_img','$s_title','$s_about','$s_status','$date','$ap_id','$s_ori_img')");
}
?>