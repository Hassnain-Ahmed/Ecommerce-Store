$(document).ready(function () {
    let timer;
    const debounce = ((callback) => {
        clearTimeout(timer);
        timer = setTimeout(() => {
            callback();
        }, 1000)
    })

    $("#search_cty").keyup(function () {
        debounce(() => {
            let searchVal = $(this).val();
            if (searchVal != "") {
                $(".category-wrapper").hide();
                $.post("category-ajax.php", { search: searchVal }, function (e) {
                    $(".searched-values").html(e);
                })
            }
            else {
                $(".category-wrapper").show();
                $(".searched-values").html("");
            }
        });
    });
});