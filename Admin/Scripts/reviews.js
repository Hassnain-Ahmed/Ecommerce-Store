$(document).ready(function () {

    var on_of = 0;
    $(".view-btn").click(function () {
        setTimeout(() => {
            $(".loader-wrapper").fadeOut()
        }, 1000);

        $(".show-reviews-wrapper").css("display", "flex");
        $(".show-reviews").stop().delay().animate({ height: "500px", padding: "1rem" });

        const p_id = $(this).attr('aria-valuetext');
        $.post("reviews-query.php", {
            ap_id: p_id,
        }, function (e) {
            const fetchData = JSON.parse(e);
            if (on_of != 1) {
                appendItems(fetchData)
            }
        })
    })

    function appendItems(fetchData) {
        $.each(fetchData, function (index, item) {
            var imgAddr;
            var rate = '';
            var hide_text;
            var title;
            var className;

            if (item.u_profilepicture == "") {
                imgAddr = 'assets/img/undraw_pic_profile_re_7g2h.svg';
            }

            for (let index = 1; index <= 5; index++) {
                if (item.r_ratting >= index) {
                    rate += "<span class='material-symbols-rounded stars active'>star</span>"
                } else {
                    rate += "<span class='material-symbols-rounded stars'>star</span>"
                }
            }

            if (item.r_show == 0) {
                hide_text = "Un Hide"
                title = "This review is set to be Hidden";
                className = "bg-color-user";

            } else {
                hide_text = "Hide";
                title = "";
                className = "";
            }
            var txt = hide_text.replace(' ', "");


            var newRow = $("<tr title='" + title + "' class='" + className + "'>");
            setTimeout(() => {
                newRow.append("<td>AP-" + item.ap_id + "</td>")
                newRow.append("<td><img src=" + imgAddr + " class='w-75' /></td>")
                newRow.append("<td>" + item.u_name + "</td>")
                newRow.append("<td>" + item.u_email + "</td>")
                newRow.append("<td><div class='d-flex'>" + rate + "</div></td>")
                newRow.append("<td>" + item.r_comment + "</td>");
                newRow.append(`<td><button class='btn btn-outline-secondary ${"r-" + txt}' aria-valuetext='${item.r_id}'>${hide_text}</button></td>`)
                newRow.append(`<td><button class='btn btn-outline-danger r-delete' aria-valuetext='${item.r_id}'>Delete</button></td>`)

                $(".fetched-rows").append(newRow);

                $(".r-UnHide").click(function () {
                    const id = $(this).attr("aria-valuetext")
                    r_unhide(id);
                });
                $(".r-Hide").click(function () {
                    console.log("112")
                    const id = $(this).attr("aria-valuetext")
                    r_hide(id);
                });
                $(".r-delete").click(function () {
                    const id = $(this).attr("aria-valuetext")
                    r_delete(id);
                });

            }, 1000);

        });
    }

    $(".close").click(function () {
        $(".show-reviews").stop().animate({ height: "0px", padding: "0rem" }).delay(500, function () { $(".show-reviews-wrapper").css("display", "none") });
        on_of = 1;
        if (on_of != 1) {
            $(".loader-wrapper").fadeIn();
        }
    });

    function r_hide(id) {
        $.post("reviews-query.php", { hide: 1, r_id_h: id }, function () { history.go(0) });
    }
    function r_unhide(id) {
        $.post("reviews-query.php", { unhide: 1, r_id_u: id }, function () { history.go(0) });
    }
    function r_delete(id) {
        $.post("reviews-query.php", { delete: 1, r_id_d: id }, function () { history.go(0) });
    }

});