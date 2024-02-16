$(document).ready(function () {
    // Menu Slide Open-Close
    $("#a-m-close-btn").click(function () {
        $("#admin_menu").animate({
            right: '-20%'
        });
    });


    $("#a-m-open-btn").click(function () {
        $("#admin_menu").animate({
            right: '0%'
        });
    });
});