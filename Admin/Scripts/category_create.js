$(document).ready(function () {

    function preview_img(event) {
        let img_info = event.target.files[0];
        const img_preview = document.getElementById("img_preview");
        const reader = new FileReader();
        reader.readAsDataURL(img_info);

        reader.addEventListener("load", () => {
            img_preview.setAttribute("src", reader.result);
            img_preview.style.filter = "saturate(1)";
            img_preview.style.objectFit = "cover";
        });
    }

    function remove_msg() {
        $(".msg-box-wrapper").show();
        $("#msg-box").stop().animate({
            top: "40%"
        });
        $(".msg-box-wrapper .f").click(function () {
            $(".msg-box-wrapper").stop().fadeOut();
        });

        $("#msg-box button").click(function () {
            $(".msg-box-wrapper").stop().fadeOut();
        });
    }

});