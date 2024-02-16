$(document).ready(function () {
    const image_input = document.getElementById("image_input");
    const image_gallary = document.getElementById("image_gallary");

    image_input.addEventListener("change", (event) => {
        const img = event.target.files;

        if (img.length > 0) {
            for (const img_inp of img) {
                const reader = new FileReader();
                reader.readAsDataURL(img_inp);

                reader.addEventListener("load", () => {
                    image_gallary.innerHTML +=
                        `
                            <div class="col-2" id="img-box">
                                <img src="${reader.result}" class="img-fluid">
                                <p>${img_inp.name}, <b>${img_inp.size / 1000000}</b> (MBs)</p>
                            </div>
                        `;
                })
            }
        }
    })
});