$(document).ready(function () {

    let timeout;
    const debounce = ((callback) => {
        clearTimeout(timeout);
        timeout = setTimeout(() => {
            callback();
        }, 1000)
    })
    const searchbar = document.getElementById("searchbar")



    var loader = "<div class='loader-wrapper'><div class='loader'></div></div>"
    $(".db_table_wrapper").html(loader)
    searchbar.addEventListener("keyup", () => {
        $(".db_table_wrapper").css({ "display": "block", "padding": "1rem 0" });

        debounce(() => {
            if (searchbar.value == "") {
                $(".db_table_wrapper").css("display", "none").html(loader);
            }
            else {
                $.post("remove_product_searchbar.php", {
                    search: searchbar.value
                }, function (data) {
                    $(".db_table_wrapper").html(data)
                });
            }
        })

    });


    $("#add_products-rm-btn").click(function () {
        $.post("deletedproducts.php", {
            p_id: '<?php echo $ap_id ?>'
        }, function (e) {
            window.location.href = "removeproducts.php";
        });
    });

});
