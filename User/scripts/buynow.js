$(document).ready(function () {

    $("#edit-person-info").click(function () {
        $(".p-i-f").focus();
        $(".personal-info-input").css({ "border": "1px solid #333", "outline": "1px solid #999" });
    });

    $("#proceed-to-shipping").click(function () {
        checkFeilds();
        UpdatePaymentValues();

        const address = $("#u_address").val() + ", " + $("#u_city").val() + ", " + $("#u_postal").val() + " - " + $("#u_province").val();
        $("#preview-address").html(address);
        $(".payment-review-p").html(address);
    });


    $("#proceed-to-payment").click(function () {
        ToPayment();

        const user_info = $("#name").val() + ", " + $("#Contact").val()
        $("#user_info").html(user_info);

        $("#get-name").val($("#name").val());
        $("#get-phone").val($("#Contact").val());

    });

    function Toshipping() {
        $("#one").removeClass("current");
        $("#one").addClass("previous-to-one");

        $("#two").addClass("current");


        $(".personal-info").stop().animate({ left: "-150%" });
        $(".shipping-info").stop().animate({ left: "0%" }, function () {
            backToOne();
        });
    }
    function backToOne() {
        $(".previous-to-one").click(function () {

            $("#one").addClass("current");
            $("#two").removeClass("current");
            $("#three").removeClass("current");

            $(".shipping-info").stop().animate({ left: "100%" });
            $(".payment").stop().animate({ left: "200%" });

            $(".personal-info").stop().animate({ left: "0" });
        })
    }

    function checkFeilds() {
        if ($("#u_email").val() == "") { $(".email-border").css({ "border": "1px solid red", "width": "100%" }) }

        if ($("#u_phone").val() == "") { $(".phone-border").css({ "border": "1px solid red", "width": "100%" }) }

        if ($("#u_address").val() == "") { $("#u_address").css({ "outline": "1px solid red" }) }

        if ($("#u_city").val() == "") { $("#u_city").css({ "outline": "1px solid red" }) }

        if ($("#u_postal").val() == "") { $("#u_postal").css({ "outline": "1px solid red" }) }

        if ($("#u_province").val() == "") { $("#u_province").css({ "outline": "1px solid red" }) }

        if (($("#u_email").val() != "" && $("#u_phone").val() != "") && $("#u_address").val() != "" && $("#u_city").val() != "" && $("#u_postal").val() != "" && $("#u_province").val() != "") { Toshipping(); }
    }
    function UpdatePaymentValues() {
        $(".shipping").html("200");
        $(".rs").html("rs");
        let shipping = $(".shipping").html();
        let subtotal = $(".subtotal").html();

        const t = parseFloat(shipping) + parseFloat(subtotal);

        let total = $(".total").html(t);
        $(".shipping").html(shipping + " rs");

    }




    function ToPayment() {
        $("#one").removeClass("current");
        $("#two").removeClass("current");
        $("#three").addClass("current");

        $("#two").addClass("previous-to-two");

        $(".personal-info").stop().animate({ left: "-150%" });
        $(".shipping-info").stop().animate({ left: "-100%" });
        $(".item-two").stop().animate({ width: "100%" }, function () {
            BackToTwo();
            $(".payment-method").fadeIn(1000);
        });
    }
    function BackToTwo() {
        $(".previous-to-two").click(function () {
            $("#one").removeClass("current");
            $("#two").addClass("current");
            $("#three").removeClass("current");

            $(".item-two").stop().animate({ width: "50%" });
            $(".personal-info").stop().animate({ left: "-150%" });
            $(".shipping-info").stop().animate({ left: "0%" });
        });
    }

});
