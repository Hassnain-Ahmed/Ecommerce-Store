$(document).ready(function () {

    $(".select-item").click(function () {
        $("#img_preview_mini").removeAttr("src");
        $(".search-product-items").hide();

        let ap_id = $(this).attr("aria-valuetext");
        $.post("productslider-ajax-get.php", { id: ap_id }, function (e) {
            const item = e.split("|");

            $("#input_title").val(item[0])
            $("#input_about").val(item[1])
            $("#img_preview_mini").attr("src", item[2]);
            $("#slider_img").attr("disabled", "disabled");

            $("#insert-trigger").val(item[3]);
        });
    });
});