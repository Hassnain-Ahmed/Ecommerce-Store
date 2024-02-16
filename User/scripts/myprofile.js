$(document).ready(function () {


    var okForUpdateProfile = 0;
    $("#u_name").keypress(function () { okForUpdateProfile = 1 });
    $("#u_username").keypress(function () { okForUpdateProfile = 1 });
    $("#u_phone").keypress(function () { okForUpdateProfile = 1 });
    $("#u_email").keypress(function () { okForUpdateProfile = 1 });
    $(".pasval").keypress(function () { okForUpdateProfile = 1 });
    $("#u_profile").on("change", function () { });

    $(".upd-profile").click(function () {
        if (okForUpdateProfile == 1) {
            updateProflieValues();
        }
    })
    function updateProflieValues() {
        $.post("myprofile-query-shipping.php",
            {
                trigger_profile: 1,
                u_id: $("#up-id").val(),
                u_name: $("#u_name").val(),
                u_username: $("#u_username").val(),
                u_phone: $("#u_phone").val(),
                u_email: $("#u_email").val(),
                password: $(".pasval").val(),
                u_profile: $("#u_profile").val()
            }, function () {
                history.go(0);
            });
    }
    // });



    var okForUpdate = 0;
    $("#phone").keyup(function () { okForUpdate = 1 });
    $("#addr").keyup(function () { okForUpdate = 1 });
    $("#city").keyup(function () { okForUpdate = 1 });
    $("#postal").keyup(function () { okForUpdate = 1 });
    $("#province").keyup(function () { okForUpdate = 1 });

    $("#upd-btn").click(function () {
        if (okForUpdate == 1) {
            updateShippingValues();
        }
    })

    function updateShippingValues() {
        $.post("myprofile-query-shipping.php",
            {
                trigger_shipping: 1,
                u_id: $("#id").val(),
                u_phone: $("#phone").val(),
                u_addr: $("#addr").val(),
                u_city: $("#city").val(),
                u_postal: $("#postal").val(),
                u_province: $("#province").val()
            }, function () {
                history.go(0);
            });
    }

    let timeoutId;
    const debounce = (callback) => {
        clearTimeout(timeoutId);
        timeoutId = setTimeout(() => callback(), 500);
    };


    let callO = 1;
    let callC = 1;
    let callR = 1;

    $("#mp-order").click(function () {
        Fetch(callO, 1, 0, ".orders-fetched", "")
        callO = 0
    });

    $("#mp-canceled").click(function () {
        Fetch(callC, 0, 1, "", ".cancelled-fetched");
        callC = 0
    });

    $("#mp-reviews").click(function () {
        GetReviews(callR);
        callR = 0
    });




    function Fetch(call, GetOrders, GetCancelled, FetchOrder, FetchCancelled) {
        if (call == 1) {
            $(FetchOrder).html("<p>Loading...</p>");
            $(FetchCancelled).html("<p>Loading...</p>");
            debounce(() => {
                $.post("myprofile-query-shipping.php", { getOrder: GetOrders, getCancelled: GetCancelled }, function (e) {
                    const OrdersData = JSON.parse(e)
                    if (OrdersData.length < 1) {
                        $(FetchOrder).html("<h6>No Orders Placed</h6>");
                        $(FetchCancelled).html("<h6>No Orders Placed</h6>");
                    }
                    else {
                        $(FetchOrder).html("");
                        $(FetchCancelled).html("");
                        $.each(OrdersData, function (index, item) {
                            var pay;
                            if (item.s_payment_method == "COD") {
                                pay = "Cash On Delivery";
                            }
                            if (item.s_payment_method == "CRD") {
                                pay = "Paid By Credit Card";
                            }

                            if (GetOrders == 1) {

                                if (item.o_status != "Cancelled") {
                                    var newRow = $("<tr>")
                                    newRow.append(`<td>${item.o_id}</td>`)
                                    newRow.append(`<td><a href='product.php?p_id=${item.ap_id}'> ${item.ap_name} </a></td>`)
                                    newRow.append(`<td>${item.s_sold_qty}x</td>`)
                                    newRow.append(`<td>${item.u_shippingaddr}</td>`)
                                    newRow.append(`<td>${pay}</td>`)
                                    newRow.append(`<td>${item.o_status}</td>`)
                                    newRow.append(`<td>${item.o_date}</td>`)
                                    $(FetchOrder).append(newRow);
                                }
                            }

                            if (GetCancelled == 1) {

                                if (item.o_status == "Cancelled") {
                                    var newRow = $("<tr>")
                                    newRow.append(`<td>${item.o_id}</td>`)
                                    newRow.append(`<td><a href='product.php?p_id=${item.ap_id}'> ${item.ap_name} </a></td>`)
                                    newRow.append(`<td>${item.s_sold_qty}x</td>`)
                                    newRow.append(`<td>${item.u_shippingaddr}</td>`)
                                    newRow.append(`<td>${pay}</td>`)
                                    newRow.append(`<td>${item.o_status}</td>`)
                                    newRow.append(`<td>${item.o_date}</td>`)
                                    $(FetchCancelled).append(newRow);
                                }
                            }
                        });
                    }
                });
            });

        }
    }

    function GetReviews(call) {
        if (call == 1) {
            $(".reviews-fetched").html("Loading...")
            debounce(() => {
                $(".reviews-fetched").html("")
                $.post("myprofile-query-shipping.php", { getReviews: 1 }, function (e) {
                    const OrdersData = JSON.parse(e)
                    if (OrdersData.length < 1) {
                        $(".reviews-fetched").html("<h6>No Reviews Yet</h6>");
                    }
                    else {

                        $.each(OrdersData, function (index, item) {
                            const imgArr = item.ap_img_gal;
                            const img = "../admin/uploads/" + imgArr.split(",")[0];
                            const newRow = $("<tr>");
                            var ratting = "";
                            for (let index = 1; index <= 5; index++) {
                                if (item.r_ratting >= index) {
                                    ratting += "<span class='material-symbols-rounded stars active'>star</span>"
                                } else {
                                    ratting += "<span class='material-symbols-rounded stars'>star</span>"
                                }
                            }
                            newRow.append(`<td>AP-${item.ap_id}</td>`)
                            newRow.append(`<td><a href='product.php?p_id=${item.ap_id}'> <img src='${img}' class='img-fluid rounded' /> </a> </td>`)
                            newRow.append(`<td><a href='product.php?p_id=${item.ap_id}'> ${item.ap_name} </a></td>`)
                            newRow.append(`<td>${item.r_comment}</td>`)
                            newRow.append(`<td>${ratting}</td>`)

                            $(".reviews-fetched").append(newRow);
                        });
                    }
                });
            });

        }
    }

    $("#show_pass").click(function () {
        if ($("#profile-password").attr('type') == 'password') {
            $("#profile-password").attr('type', 'text');
            $(this).html('visibility_off');
        }
        else {
            $("#profile-password").attr('type', 'password')
            $(this).html('visibility');
        }
    });


    $("#mp-profile").css("color", "#000");

    $("#mp-profile").click(function () {
        $("#mp-profile").css("color", "#000");
        $("#mp-order").css("color", "#555");
        $("#mp-canceled").css("color", "#555");
        $("#mp-reviews").css("color", "#555");
        $("#mp-shipping").css("color", "#555");


        $(".profile-wrapper").show();
        $(".order-wrapper").hide();
        $(".canceled-wrapper").hide();
        $(".reviews-wrapper").hide();
        $(".shipping-wrapper").hide();
    });

    $("#mp-order").click(function () {

        $("#mp-order").css("color", "#000");
        $("#mp-profile").css("color", "#555");
        $("#mp-canceled").css("color", "#555");
        $("#mp-reviews").css("color", "#555");
        $("#mp-shipping").css("color", "#555");


        $(".order-wrapper").show();
        $(".profile-wrapper").hide();
        $(".canceled-wrapper").hide();
        $(".reviews-wrapper").hide();
        $(".shipping-wrapper").hide();
    });

    $("#mp-canceled").click(function () {

        $("#mp-canceled").css("color", "#000");
        $("#mp-order").css("color", "#555");
        $("#mp-profile").css("color", "#555");
        $("#mp-reviews").css("color", "#555");
        $("#mp-shipping").css("color", "#555");

        $(".canceled-wrapper").show();
        $(".order-wrapper").hide();
        $(".profile-wrapper").hide();
        $(".reviews-wrapper").hide();
        $(".shipping-wrapper").hide();
    });

    $("#mp-reviews").click(function () {

        $("#mp-reviews").css("color", "#000");
        $("#mp-order").css("color", "#555");
        $("#mp-profile").css("color", "#555");
        $("#mp-canceled").css("color", "#555");
        $("#mp-shipping").css("color", "#555");

        $(".reviews-wrapper").show();
        $(".order-wrapper").hide();
        $(".shipping-wrapper").hide();
        $(".profile-wrapper").hide();
        $(".canceled-wrapper").hide();
    });

    $("#mp-shipping").click(function () {

        $("#mp-shipping").css("color", "#000");
        $("#mp-reviews").css("color", "#555");
        $("#mp-order").css("color", "#555");
        $("#mp-profile").css("color", "#555");
        $("#mp-canceled").css("color", "#555");

        $(".shipping-wrapper").show();

        $(".reviews-wrapper").hide();
        $(".order-wrapper").hide();
        $(".profile-wrapper").hide();
        $(".canceled-wrapper").hide();
    })


});