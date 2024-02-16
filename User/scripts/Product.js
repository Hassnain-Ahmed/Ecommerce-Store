$(document).ready(function () {

    $("#comment").keyup(function () {
        const cmt = $("#comment").val().length
        if (cmt > 0) {
            $("label[for=comment]").css({
                "top": "-20px",
                "color": "#fff"
            });
        } else if (cmt < 1) {
            $("label[for=comment]").css({
                "top": "5px",
                "color": "#999"
            });
        }
    })


    $("#gallary img:first-child").addClass('selected')
    $("#gallary img").click(function () {
        let gallary_img_address = $(this).attr("src");
        $("#p_img").attr("src", gallary_img_address)

    });

});