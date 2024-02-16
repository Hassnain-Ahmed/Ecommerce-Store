<?php
include("adminnavbar.php");
?>

<title>Admin - Socials</title>
<!-- External CSS Document File -->
<link rel="stylesheet" href="Css/socials.css">





<div class="container-fluid">


    <div class="" id="socials_home">

        <h4>Socials</h4>
        <p>Social Media Accounts Statistics</p>

        <div class="row">

            <div class="col-3" id="facebook-card">
                <a href="">
                    <div>
                        <h5>Facebook</h5>
                        <p><b>8754</b> Page Likes </p>
                        <i class="bi bi-facebook"></i>
                    </div>
                </a>
            </div>

            <div class="col-3" id="instagram-card">
                <a href="">
                    <div>
                        <h5>Instagram</h5>
                        <p><b>8754</b> Page Followers </p>
                        <i class="bi bi-instagram"></i>
                    </div>
                </a>
            </div>

            <div class="col-3" id="twitter-card">
                <a href="">
                    <div>
                        <h5>Twitter</h5>
                        <p><b>8754</b> Page Followers </p>
                        <i class="bi bi-twitter"></i>
                    </div>
                </a>
            </div>

            <div class="col-3" id="linkedin-card">
                <a href="">
                    <div>
                        <h5>Linkedin</h5>
                        <p><b>8754</b> Page Followers </p>
                        <i class="bi bi-linkedin"></i>
                    </div>
                </a>
            </div>

            <div class="col-3" id="tiktok-card">
                <a href="">
                    <div>
                        <h5>Tiktok</h5>
                        <p><b>8754</b> Page Followers </p>
                        <i class="bi bi-tiktok"></i>
                    </div>
                </a>
            </div>

        </div>

    </div>


    <div id="socials_home">

        <h5>Update Social Media Links</h5>
        <p>Insert the URL of your Social Media Accounts</p>

        <form action="">

            <label for="">Facebook &nbsp;</label><input type="url" placeholder="facebook.com" value="https://www.facebook.com/"> <br>
            <label for="">Instagram &nbsp;</label><input type="url" placeholder="facebook.com" value="https://www.instagram.com/"> <br>
            <label for="">Twitter &nbsp;</label><input type="url" placeholder="facebook.com" value="https://www.twitter.com"> <br>
            <label for="">Linkedin &nbsp;</label><input type="url" placeholder="facebook.com" value="https://www.linkedin.com"> <br>
            <label for="">Tiktok &nbsp;</label><input type="url" placeholder="facebook.com" value="https://www.tiktok.com"> <br> <br>

            <label for=""></label><button type="submit">Update</button>

        </form>

    </div>

</div>














<script>
    // Menu Slide Open-Close
    $("#a-m-close-btn").click(function() {
        $("#admin_menu").animate({
            right: '-20%'
        });
    });



    $("#a-m-open-btn").click(function() {
        $("#admin_menu").animate({
            right: '0%'
        });

    });
</script>





</body>

</html>