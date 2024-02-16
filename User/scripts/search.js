$(document).ready(function () {

    $("#search-bar-wrapper input").focusin(function () {
        $("#search-bar-wrapper").css({
            "border": "1px solid #407F7F",
            "outline": "2px solid #669999"
        }, function () {

        });
    });
    $("#search-bar-wrapper input").focusout(function () {
        $("#search-bar-wrapper").css({
            "border": "1px solid #555",
            "outline": "2px solid transparent"
        });
    });


    let timeoutId;
    const debounce = (callback) => {
        clearTimeout(timeoutId);
        timeoutId = setTimeout(() => callback(), 1000);
    };

    $("#search_input").keyup(function () {
        debounce(() => {
            if ($(this).val() != "") {
                $(".db_searched_data").stop().animate({ marginTop: "20px" }, 200).animate({ height: "400px" }, 500);

                $.post("search-ajax.php", { search: $(this).val() }, function (e) {
                    $(".data").stop().show();
                    $(".data").html(e);
                });
            }
            else {
                $(".db_searched_data").stop().animate({ marginTop: "5px" }, 200).animate({ height: "0px" }, 500);
                $(".data").stop().fadeOut();
            }
        });
    });



});