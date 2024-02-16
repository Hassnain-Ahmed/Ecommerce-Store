$(document).ready(function () {
    $(".select-status").on("change", function () {
        const ID = $(this).attr('aria-valuetext');
        const updateValue = $(this).val();
        $.post("orders-updateStatus-ajax.php", { statusID: ID, statusVal: updateValue });
        $(this).css("border", "1px solid #669999")
    });
    $(".select-status").dblclick(function () {
        window.open("orders_inshipment.php", "_blank");
    });
    $(".deleted-msg").click(function () {
        $("#msg").stop().animate({ right: "5px" })
        setTimeout(() => {
            $("#msg").stop().animate({ right: "-100%" });
        }, 3000);
    });
});