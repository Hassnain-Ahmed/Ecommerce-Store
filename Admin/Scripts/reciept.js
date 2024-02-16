$(document).ready(function () {

    $("#print").click(function () {
        $("#btn-wrapper").css("opacity", "0");
        $("#nav").hide();
        $(".select-user-wrapper").hide()
        if (!window.print()) {
            history.go(0);
        }
    });
    $("#clear").click(function () {
        $.post("reciept-ajax.php", { clear: 1 }, function () {
            setTimeout(() => {
                history.go(0);
            }, 500)
        });
    });


    $(".select-user").on("change", function () {
        const u_id = $(this).val();
        window.location.href = 'reciept.php?u_id=' + u_id;
    });

});