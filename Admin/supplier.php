<?php
include("adminnavbar.php");
?>


<title>Supplier - Admin</title>
<link rel="stylesheet" href="Css/supplier.css">

<div class="container-fluid">

    <div class="m-4 after-bar-1">
        <h4 class="my-0">About Supplier</h4>
        <p>All the information about the Suppliers</p>
    </div>


    <div class="container">
        <div class="wrapper">
            <h6>Click to <a href="#" class="create-btn fw-bold">Create</a> a new Supplier Record</h6>

            <div class="table-wrapper">
                <?php
                include("../DB-Con/db.con.php");
                $query = mysqli_query($con, "SELECT * from supplier order by su_id desc");
                echo "<table class='table'>
                <tr>
                    <th>Sup-Id</th>
                    <th>Name</th>
                    <th>Company Name</th>
                    <th>Contact</th>
                    <th>Email</th>
                    <th>View Products</th>
                    <th>Edit</th>
                    <th>Remove</th>
                </tr>
                ";
                while ($db = mysqli_fetch_assoc($query)) {
                    echo
                        "
                        <tr>
                            <td>SUP-" . $db['su_id'] . "</td>
                            <td>" . $db['su_name'] . "</td>
                            <td>" . $db['su_companyname'] . "</td>
                            <td>" . $db['su_contact'] . "</td>
                            <td>" . $db['su_email'] . "</td>
                            <td><a href='category-items.php?su_id=" . $db['su_id'] . "'>View Products</a></td>
                            <td><a href='#' aria-valuetext=" . $db['su_id'] . " class='edit' >Edit</a></td>
                            <td><a href='supplier-query-remove.php?su_id=" . $db['su_id'] . "'>Remove</a></td>
                        </tr>
                        "
                    ;
                }
                echo "</table>";
                ?>
            </div>
        </div>
    </div>
</div>


<div class="wrapper-wrapper">
    <div class="create-wrapper">
        <div class="close-icon"><span class="material-symbols-rounded">close</span></div>
        <h6 class="my-0"></h6>
        <p>Fill below feilds to continue</p>

        <div class="create">
            <input type="hidden" id="su_id">
            <div class="input-container">
                <input placeholder="Supplier Name" class="input-field" type="text" id="su_name" required>

                <label for="input-field" class="input-label">Supplier Name</label>
                <span class="input-highlight"></span>
            </div>

            <div class="input-container">
                <input placeholder="Company name" class="input-field" type="text" id="su_companyname" required>

                <label for="input-field" class="input-label">Company name</label>
                <span class="input-highlight"></span>
            </div>

            <div class="input-container">
                <input placeholder="Contact info" class="input-field" type="number" id="su_contact" inputmode="numeric"
                    required onkeypress="if(this.value.length >= 11){return false}">

                <label for="input-field" class="input-label">Contact info</label>
                <span class="input-highlight"></span>
            </div>

            <div class="input-container">
                <input placeholder="Email Address" class="input-field" type="email" id="su_email" required>

                <label for="input-field" class="input-label">Email Address</label>
                <span class="input-highlight"></span>
            </div>

            <div class="msg-wrapper">
                <p class="m-0">All Feilds Are required</p>
            </div>

            <div class="d-flex justify-content-center">
                <button class="button-outline btn-outline-1" id="submit">Submit</button>
                <button class="button-outline btn-outline-2" id="update">Update</button>
            </div>
        </div>


    </div>
</div>


<script src="scripts/supplier.js"></script>




</body>

</html>