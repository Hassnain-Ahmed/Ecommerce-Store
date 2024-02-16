$(document).ready(function () {
    var ok = 1;
    $("#sign-up-password").keyup(function () {
        let signup_pasword = $(this).val()
        if (signup_pasword.length > 0) {
            $(".password-msg").show().animate({ left: "75%" }, 300);

            if (signup_pasword.length < 8) {
                $(".character").addClass('red');
                ok = 1;
            }
            else if (signup_pasword.length >= 8) {
                $(".character").removeClass('red');
                $(".character").addClass('green');
                ok = 0;
            }

            if (signup_pasword.match(/[a-z]/)) {
                $(".small_letter").removeClass('red');
                $(".small_letter").addClass("green");
                ok = 1;
            }
            else {
                $(".small_letter").removeClass('green');
                $(".small_letter").addClass('red');
                ok = 0;
            }
            if (signup_pasword.match(/[A-Z]/)) {
                $(".capital_letter").removeClass("red");
                $(".capital_letter").addClass("green");
                ok = 1;
            }
            else {
                $(".capital_letter").removeClass("green");
                ok = 0;
            }
            if (signup_pasword.match(/\d/)) {
                $(".number").removeClass("red");
                $(".number").addClass("green");
                ok = 1;
            }
            else {
                $(".number").removeClass("green");
                $(".number").addClass("red");
                ok = 0;
            }
        }
        else {
            $(".password-msg").animate({ left: "50%" });
        }
    });


    $("#sign-up-confirm-password").keyup(function () {
        let confirmPass = $(this).val();

        if (confirmPass == $("#sign-up-password").val()) {
            $("#sign-up-confirm-password-wrapper").css({ "outline": "1px solid green" })
            $("#sign-up-password-wrapper").css({ "outline": "1px solid green" })
        }
        else {
            $("#sign-up-confirm-password-wrapper").css({ "outline": "transparent" })
            $("#sign-up-password-wrapper").css({ "outline": "transparent" })
        }
    });


    $("#signin-btn").click(function () {
        $(".signup-form").fadeOut();
        $(".login-form").fadeIn();
        $(".password-msg").hide();
        $("#title").html('Login - Ecommerce');
    });

    $("#signup-btn").click(function () {
        $(".login-form").fadeOut();
        $(".signup-form").fadeIn();
        $(".password-msg").fadeIn(2000);
        $("#title").html('Signup - Ecommerce');
    });


    $("#sign-up-username").keyup(function () {
        let userVal = $('#sign-up-username').val()
        $.post("ajax_index.php", { u_username: userVal }, function (e) {
            $("#u_user_label").html(e)
        })
    })


    $("#email").keyup(function () {
        let emailVal = $("#email").val()
        $.post("ajax_index.php", { u_email: emailVal }, function (e) {
            $("#email_label").html(e)
        })
    })



    $("#Username").keypress(function () {
        $(".loader-wrapper-username").html("<div class='loader'></div>")
    })


    $("#Password").keyup(function () {
        let username = $("#Username ").val();
        let password = $("#Password").val()

        $.post("ajax_index.php", { signin_username: username, signin_password: password }, function (e) {
            let b = e.split(",")[1];
            let c = e.split(",")[2];

            $(".loader-wrapper-password").html(c + b)
            if (c.length > 1) {
                $(".loader-wrapper-username").html(c)
            }
        })
    });
})