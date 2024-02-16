$(document).ready(function () {

    document.getElementById("make_primary").addEventListener('click', () => {

        const chckbox = document.getElementById("make_primary");
        if (chckbox.checked) {
            $(".checkbox-text").html("Selecting this option will remove previous PRIMAY slider and add THIS as new primary Slider");
        }
        else {
            $(".checkbox-text").html("");
        }
    });


    let timeOutId;
    const debounce = (callback) => {
        clearTimeout(timeOutId);
        timeOutId = setTimeout(() => callback(), 1000)
    }
    $("#search_product").keyup(function () {
        debounce(() => {
            $(".search-product-items").show();
            let searchVal = $(this).val();
            if (searchVal != "") {
                $.post("productslider-ajax.php", { val: searchVal }, function (e) {
                    $(".search-product-items").html(e);
                });
            }
            else {
                $(".search-product-items").html("");
                $(".search-product-items").hide();
            }

        });
    });


    $("#update_slider_btn").click(function () {
        const chckbox = document.getElementById("make_primary");
        var status;
        if (chckbox.checked) {
            status = "Primary";
        }
        else {
            status = "Secondary"
        }
        $.post("productslider-update.php",
            {
                trigger: 1,

                s_id: $("#s_id").val(),
                title: $("#input_title").val(),
                about: $("#input_about").val(),
                img: $("#ap_img_ori").val(),
                stat: status

            }, function () { history.go(0); }
        );
    });


    $(".add_img_btn").click(function () {
        $("#img_preview_mini").attr("src", "assets/img/undraw_photo_session_re_c0cp.svg");
        showCreateSlider();
    });

    function showCreateSlider() {
        $(".wrapper-title").html("Upload Image and Details");
        $(".wrapper-about").html("upload new image to view on Homepage Slider");

        $("#create_slider").show();
        $("#add_as_prdct").show();
        $("#update_slider_btn").hide();


        $(".wrapper-wrapper").show()
        $(".add_img").show().stop().animate({ height: "480px", padding: "1rem" }, 350);
    }


    $(".edit_btn").click(function () {
        $(".wrapper-title").html("Update Your Slider");
        $(".wrapper-about").html("Change your slider images and text");

        $("#add_as_prdct").hide();
        $("#create_slider").hide();
        $("#update_slider_btn").show();
        $("#slider_img").attr("disabled", "disabled");

        $(".wrapper-wrapper").show()
        $(".add_img").show().stop().animate({ height: "480px", padding: "1rem" }, 350);


        setTimeout(() => {
            $.post("productslider-update.php",
                {
                    id: $(this).attr('aria-valuetext')
                },
                function (e) {

                    let str = e.split("|");

                    $("#input_title").val(str[0]);
                    $("#input_about").val(str[1]);
                    $("#s_id").val(str[5]);
                    $("#img_preview_mini").attr("src", str[2]);
                    $("#ap_img_ori").val(str[2])

                    if (str[3] == "Primary") {
                        $("#make_primary").attr({ "checked": true });
                    }
                    else {
                        $("#make_primary").attr("checked", false);
                    }
                }
            );
        }, 1000);

    });
    $("#close-add_img_wrapper").click(function () {
        $(".add_img").stop().animate({ height: "0px", padding: "0px", border: "0px" }, 350).delay(400, function () { $(this).hide(); $(".wrapper-wrapper").hide(); });

        setTimeout(() => {
            $("#make_primary").removeAttr('checked');
            $("#input_title").val('');
            $("#input_about").val('');
            $("#img_preview_mini").attr("src", "assets/img/undraw_photo_session_re_c0cp.svg");
            $("#slider_img").removeAttr("disabled");
        }, 500);
    });



    $("#preview_slider").click(function () {
        $(".slider_preview_wrapper").css("display", "flex");
        $(".slider").animate({
            top: "0%"
        });
    });
    $(".f-btn").click(function () {
        $(".slider_preview_wrapper").css("display", "none");
        $(".slider").css("top", "100%");
    });


    document.getElementById("slider_img").addEventListener("change", (e) => {
        const [img_obj] = e.target.files;

        const reader = new FileReader();
        reader.readAsDataURL(img_obj);

        reader.addEventListener("load", () => {
            document.getElementById("img_preview_mini").setAttribute("src", reader.result);
        })
    });


    document.getElementById("preview_slider").addEventListener("click", function () {
        document.getElementById("img_preview").setAttribute("src", document.getElementById("img_preview_mini").getAttribute("src"));

        document.getElementById("slider_title").textContent = document.getElementById("input_title").value;
        document.getElementById("slider_about").textContent = document.getElementById("input_about").value;

        if (document.getElementById("input_title").value < 1) {
            document.getElementById("slider_title").textContent = "Example Text Title";
        }
        if (document.getElementById("input_about").value < 1) {
            document.getElementById("slider_about").textContent = "Example Text About: Lorem ipsum dolor sit amet.";
        }
    });


});
