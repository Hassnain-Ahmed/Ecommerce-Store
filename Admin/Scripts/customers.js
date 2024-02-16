$(document).ready(function () {

    $(".ban-show").click(function () {
        $(".ban-wrapper").css("display", "flex");
        $(".ban-yes").show();
        $(".un_ban").hide();
        $(".unban-text").text("");

        let id = $(".ban-show").attr('aria-valuetext');
        $.post("customers-ajax.php", { user: id, ban: 1 }, function (e) { $(".ban-name").html(e + "'s") });

        $(".ban-yes").click(function () {
            $.post("customers-ajax.php", { user: id, ban_yes: 1 }, function (el) { console.log(el) });
            history.go(0);
        });
    });


    $(".un-ban-show").click(function () {
        $(".ban-wrapper").css("display", "flex");
        $(".ban-yes").hide();
        $(".un_ban").show();
        $(".unban-text").text("UN-");

        let id = $(".un-ban-show").attr('aria-valuetext');
        $.post("customers-ajax.php", { user: id, ban: 1 }, function (e) { $(".ban-name").html(e + "'s") });

        $(".un_ban").click(function () {
            $.post("customers-ajax.php", { user: id, un_ban: 1 }, function (el) { console.log(el) });
            history.go(0);
        });
    });

    $(".ban-no").click(function () { $(".ban-wrapper").hide(); });






    $(".view-history").click(function () {
        const address = "orders.php?u_id=" + $(this).attr("aria-valuetext");
        $(".viewallorders").attr("href", address)
        $(".history-wrapper").css("display", "flex");
        $(".history").show().stop().animate({ height: "650px", padding: "1rem" }, 350).css("border", "1px solid #555");

        setTimeout(() => {
            $.post("customers-ajax.php", { user: $(this).attr("aria-valuetext"), history: 1 }, function (e) {
                $(".history-table-wrapper").html(e);
            });
        }, 1000);
    })
    $(".history-close").click(function () {
        $(".history").stop().animate({ height: "0px", padding: "0px", border: "0px" }, 350).delay(400, function () { $(this).hide(); $(".history-wrapper").hide(); });
    })




    $(".change").click(function () {
        $(".wrapper-wrapper").show();
        $(".create-wrapper").show().stop().animate({ height: "250px", padding: "1rem" }, 350).css("border", "1px solid #669999");

        setTimeout(() => {
            $.post("customers-ajax.php", { change: 1, user: $(".change").attr("aria-valuetext") }, function (e) {
                let values = e.split(",");
                $("#cus-name").val(values[0]);
                $("#cus-pass").val(values[1]);
            });
        }, 1000);
        $(".change-update").click(function () {
            $.post("customers-ajax.php", { user: $(".change").attr("aria-valuetext"), cus_pass: $("#cus-pass").val() }, function (e) {
                if (e == "success_update") {
                    setTimeout(() => {
                        $(".create-wrapper").stop().animate({ height: "0px", padding: "0px", border: "0px" }, 350).delay(400, function () { $(this).hide(); $(".wrapper-wrapper").hide(); });
                    }, 500)
                }
            });
        });
    });
    $(".close-icon").click(function () {
        $(".create-wrapper").stop().animate({ height: "0px", padding: "0px", border: "0px" }, 350).delay(400, function () { $(this).hide(); $(".wrapper-wrapper").hide(); });
    });

});
