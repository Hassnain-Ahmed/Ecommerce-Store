<?php
include('usernavbar.php');
?>



<title>Contact Us - Ecommerce</title>
<!-- External CSS Document File -->
<link rel="stylesheet" href="Css/contact.css">

<div class="container-fluid" id='c-d'>

    <div class="row justify-content-center" id="contact">

        <div class="col-sm-8" id="input-wrapper">
            <h4>Contact Us</h4>
            <p id="c-d-p">If you have Any Quries or Suggestions.</p>
            <br>

            <form action="" method="post">

                <label for="">Your Name</label>
                <input type="text" placeholder="John Doe" value="<?php echo $getprofile['u_name'] ?>"> <br>

                <label for="">Email Address</label>
                <input type="email" placeholder="example.xyz@mail.com" value="<?php echo $getprofile['u_email'] ?>"
                    required> <br>

                <label for=""></label>
                <textarea name="" id="" cols="30" rows="10" placeholder="Message Or Query" required></textarea> <br>

                <p class="text-center"><button type="submit">Send Now</button></p>

            </form>
        </div>

    </div>

</div>







<?php
include('userfooter.php');
?>