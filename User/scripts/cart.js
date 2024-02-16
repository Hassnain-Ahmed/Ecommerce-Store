$(document).ready(function () {
    $(".c_qty").on('change', function () {
        let id = $(this).attr("aria-valuetext")
        let Id = parseInt(id);
        $.post("cart-query-update.php",
            {
                c_id: Id,
                cty_qty: $(this).val()
            });
    });


    $(".buyall").click(function () {
        $.post("cart-query.php", { buyall: 1 });
        window.location.href = 'buynow.php?all=1';
    })


    $('#dec-btn').on('click', function (e) {
        var input = $("#Quantity-inputs input");
        input[0]['stepDown']();
    });
    $('#inc-btn').on('click', function (e) {
        var input = $("#Quantity-inputs input");
        input[0]['stepUp']();
    });

});
