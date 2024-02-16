$(document).ready(function () {

    $("#product_gallary img").click(function () {
        let gallary_img_address = $(this).attr("src");
        $("#p-img").attr("src", gallary_img_address)
    });

    const img_file_id = document.getElementById('img_file');
    const reader_result_div = document.getElementById('reader-result');
    img_file_id.addEventListener('change', (e) => {
        const imgFiles = e.target.files;

        for (const img of imgFiles) {
            const reader = new FileReader();
            reader.readAsDataURL(img)

            reader.addEventListener('load', () => {
                reader_result_div.innerHTML +=
                    `
                    <div class="img-info">
                        <img src="${reader.result}" alt="">
                        <p class='my-1'>${img.name}</p>
                        <p class='fw-bold'>${img.size / 1000000} (MBs)</p>
                    </div> 
                `;
            });
        }
    });


    $("#btn-cancel").click(function () {
        $(".msg-box-wrapper").css("display", "none")
    })
    $("#btn_rm").click(function () {
        $(".msg-box-wrapper").css("display", "block")
    })

    $(".p_wrapper").click(function () {
        $(".product_name").focus()
    });

    $(".c_wrapper").click(function () {
        $("#p_text").focus()
    });

    $(".s_wrapper").click(function () {
        $("#s_text").focus()
    });

    $(".n_wrapper").click(function () {
        $("#price_text").focus()
    });

    const str = document.getElementById("p_text").value;
    const st2 = str.replace(/\s\s+/g, " ");


});