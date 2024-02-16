<?php
$val = $_POST['search'];
search($val);

function search($value)
{
    include("../DB-Con/db.con.php");
    $query = mysqli_query($con, "SELECT * from category where cty_name like '%$value%'");
    if ($query) {
        while ($get = mysqli_fetch_assoc($query)) {
            echo
                "
                <div class='col-2'>
                    <a href='category_products.php?cty_id=" . $get['cty_id'] . "'>
                        <img src='uploads/" . $get['cty_img'] . " ' alt='' class='w-100'>
                        <div id='text-box'>
                            <h5> " . $get['cty_name'] . " </h5>
                            <p class='fs-6'>Click to view Category Products</p>
                        </div>
                    </a>
                </div>
                ";
        }
    }
}
?>