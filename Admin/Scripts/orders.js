$(document).ready(function () {

    setTimeout(() => {
        $.post("orders-tables.php", { all: 1 }, function (e) { $(".original").html(e) });
    }, 1000);


    $("#mp-allorders li").css("background-color", "#669999")
    $("#mp-allorders").css("color", "#000");

    $("#mp-allorders").click(function () {

        $("#mp-allorders li").css("background-color", "#669999");
        $("#mp-shipped li").css("background-color", "rgb(214, 214, 214)");
        $("#mp-canceled li").css("background-color", "rgb(214, 214, 214)")
        $("#mp-user li").css("background-color", "rgb(214, 214, 214)");

        $("#mp-user").css("color", "#555");
        $("#mp-allorders").css("color", "#000");
        $("#mp-shipped").css("color", "#555");
        $("#mp-canceled").css("color", "#555");


        $(".allorders-wrapper").show();
        $(".shipped-wrapper").hide();
        $(".canceled-wrapper").hide();
        $('.user-wrapper').hide();
    });

    $("#mp-shipped").click(function () {
        setTimeout(() => {
            $.post("orders-tables.php", { shipped: 1 }, function (e) { $(".fetch-shipped").html(e); });
        }, 1000);


        $("#mp-shipped li").css("background-color", "#669999")
        $("#mp-allorders li").css("background-color", "rgb(214, 214, 214)")
        $("#mp-canceled li").css("background-color", "rgb(214, 214, 214)")


        $("#mp-shipped").css("color", "#000");
        $("#mp-allorders").css("color", "#555");
        $("#mp-canceled").css("color", "#555");
        $("#mp-user li").css("background-color", "rgb(214, 214, 214)");

        $("#mp-user").css("color", "#555");
        $(".shipped-wrapper").show();
        $(".allorders-wrapper").hide();
        $(".canceled-wrapper").hide();
        $('.user-wrapper').hide();
    });

    $("#mp-canceled").click(function () {
        setTimeout(() => {
            $.post("orders-tables.php", { cancelled: 1 }, function (e) { $(".fetch-cancelled").html(e); });

        }, 1000);

        $("#mp-canceled li").css("background-color", "#669999")
        $("#mp-shipped li").css("background-color", "rgb(214, 214, 214)");
        $("#mp-allorders li").css("background-color", "rgb(214, 214, 214)")
        $("#mp-user li").css("background-color", "rgb(214, 214, 214)");

        $("#mp-user").css("color", "#555");
        $("#mp-canceled").css("color", "#000");
        $("#mp-allorders").css("color", "#555");
        $("#mp-shipped").css("color", "#555");

        $(".canceled-wrapper").show();
        $(".allorders-wrapper").hide();
        $(".shipped-wrapper").hide();
        $('.user-wrapper').hide();
    });


    // $(".deleted-msg").click(function () {
    //     $("#msg").stop().animate({ right: "5px" })
    //     setTimeout(() => {
    //         $("#msg").stop().animate({ right: "-100%" });
    //     }, 3000);
    // });


    let time;
    const debounce = ((callback) => {
        clearTimeout(time)
        time = setTimeout(() => {
            callback();
        }, 1000)
    })


    $("#search").keyup(function () {
        $(".loader").css("opacity", "1")
        $(".viewbytable").fadeOut();

        if ($("#search").val() == "" || $("#search").val() == " ") {

            $(".fetched").html('');
            $(".original").fadeIn();
        }
        else {
            $(".original").fadeOut();
            debounce(() => {
                $.post("orders-search-ajax.php", { search: $("#search").val() }, function (e) {
                    $(".fetched").html(e);
                    $(".loader").css("opacity", "0");
                });
            });
        }
    });

    $("#viewby").on("change", function () {
        const Val = $(this).val();
        if (Val == 'all') {
            $(".original").show();
            $(".fetched").html('');
        }
        else {
            $(".original").hide();
            $.post("orders-viewby-ajax.php", { monthVal: Val }, function (e) {
                $(".viewbytable").html(e);
            });
        }
    });

});
