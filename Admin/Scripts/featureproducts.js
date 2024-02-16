$("document").ready(function () {

    let timeOutId;
    const debounce = ((callback) => {

        clearTimeout(timeOutId)
        timeOutId = setInterval(() => {
            callback();
        }, 1000);

    });

    $("#search_items").keyup(function () {

        debounce(() => {

            const keyVal = $("#search_items").val();
            if (keyVal.length > 0) {
                $(".db_table_wrapper").fadeIn(100);

                $.post("featureproducts-ajax.php", {
                    search: $("#search_items").val(),
                    select: $("#select").val()
                }, function (e) {
                    $(".db_table_wrapper").html(e);
                });

            } else {
                $(".db_table_wrapper").fadeOut(200);
            }



        });

    });

    $("#search_items").attr("disabled", "disabled");
    $("#select").on("change", function () {
        $("#search_items").removeAttr("disabled").focus();
    });
});