<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title id="title">Login - Ecommerce</title>

  <link rel="stylesheet" href="../Admin/assets/bootstrap5/bootstrap-5.0.2-dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="../Admin/assets/bootstrap5/bootstrap-5.0.2-dist/js/bootstrap.min.js">

  <script src="../Admin/assets/Jquery/jquery.min.js"></script>

  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />

  <link rel="stylesheet" href="index.css">


</head>

<body>






  <div class="container-fluid bg">

    <div class="container">

      <div class="row justify-content-center">

        <div class="login-form">



          <div class="heading">
            <h5>Login</h5>
            <p>Enter Credentials to Login your Account </p>
          </div>

          <form action="login_index.php" autocomplete="on" method="post">

            <div class="inputs">
              <div class="input-wrapper">
                <span class="material-symbols-rounded">account_circle</span>
                <input type="text" id="Username" name="u_user" placeholder="Username" required>
                <div class="loader-wrapper-username"></div>
              </div>
              <br>

              <div class="input-wrapper">
                <span class="material-symbols-rounded">passkey</span>
                <input type="password" name="u_pass" id="Password" placeholder="Password" required> <br>
                <div class="loader-wrapper-password"></div>
              </div>

              <br>
              <button type="submit" name="login">Sign In</button> <br>
              <p>Or</p>
              <br>
              <button type='button' name="">Continue With Google</button>
            </div>
          </form>


          <div class="footer">
            <p>Don't have an account <span id="signup-btn">SignUp</span></p>
          </div>



        </div>


        <div class="signup-form">
          <form action="login_index.php" method="post" autocomplete="on">

            <div class="heading">
              <h5>Sign Up</h5>
              <p>Enter Credentials to Create your Account </p>
            </div>

            <div class="inputs">

              <div>
                <span class="material-symbols-rounded">account_circle</span>
                <input type="text" name="u_name" id="" placeholder="Name: John Doe" required>
              </div>

              <br>


              <div>
                <span class="material-symbols-rounded">mail</span>
                <input type="email" name="u_email" id="email" placeholder="Email: johndoe@email.com" required>
                <label for="" id="email_label"></label>
              </div>

              <br>

              <div>
                <span class="material-symbols-rounded">contact_phone</span>
                <input type="tel" name="u_phone" id="phone" placeholder="Phone: 031234567890" required>
              </div>
              <br>


              <div>
                <span class="material-symbols-rounded">person</span>
                <input type="text" name="u_username" id="sign-up-username" placeholder="Username: doejohn71" required>
                <label for="" id="u_user_label"></label>
              </div>
              <br>

              <div id="sign-up-password-wrapper">
                <span class="material-symbols-rounded">passkey</span>
                <input type="password" name="u_pass" id="sign-up-password" placeholder="Password: *******" required>
              </div>
              <br>

              <div id="sign-up-confirm-password-wrapper">
                <span class="material-symbols-rounded">passkey</span>
                <input type="password" id="sign-up-confirm-password" placeholder="Confirm Password: *******" required>
              </div>
            </div>

            <div class="footer">
              <button type="submit" name="create_account">&nbsp;</button>
              <p>Or</p>
              <button name="btn" type="button">Continue With Google</button> <br>
              <label>Already have an account <span id="signin-btn">Sign In</span></label>
            </div>

          </form>

        </div>

        <div class="password-msg">
          <p class="m-1">Password Must Include</p>
          <ul>
            <li class="character red">At least Eight Characters Long</li>
            <li class="small_letter red">Small Letter</li>
            <li class="capital_letter red">Capital Letter</li>
            <li class="number red">Number</li>
          </ul>
        </div>

        <div class="msg"></div>


      </div>
    </div>
  </div>



  <?php
  if (isset($_GET['signin'])) {
    echo "<script>$('.msg').html('Login to Continue').animate({top:'0'},600).delay(5000).animate({top:'-100'},600)</script>";
  }

  if (isset($_GET['signup'])) {
    echo
      "<script>
        $('.signup-form').show();
        $('.login-form').hide();
        $('.msg').html('Signup to Continue').animate({top:'0'},600).delay(5000).animate({top:'-100'},600)
      </script>";
  }
  ?>


  <script src="index.js"></script>

</body>

</html>