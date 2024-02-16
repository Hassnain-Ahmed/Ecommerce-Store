$(document).ready(function () {
    var ch_array = new Array();
    var ch_data = new Array();
    var addr;
    $(".print").click(function () {
        $(".print-wrapper").animate({ bottom: "0%" });

        const v1 = $(this).attr('aria-valuetext');
        const val = parseInt(v1);
        const index = ch_array.indexOf(val);

        if ($(this).is(":checked")) {
            ch_array.push(val);
            ch_data.push(v1);
            $(".elements").html("OR- [" + ch_array + "]")
        }
        else {
            if (index > -1) {
                ch_array.splice(index, 1);
                ch_data.splice(index, 1);
                $(".elements").html(ch_array)
            }
        }
        if (ch_array.length < 1) {
            $(".print-wrapper").animate({ bottom: "-50%" });
        }
    });

    $(".print-btn").click(function () {
        $.post("reciept-ajax.php", { data: ch_data }, function (e) {
            if (e) {
                setTimeout(() => {
                    var addr = $(".print").attr("aria-valuenow")
                    var syntax = "reciept.php?u_id=" + addr
                    window.open(syntax);
                }, 1000);
            }
        });
    })
    $(".history-close").click(function () {
        setTimeout(() => {
            $(".history-table-wrapper").html('<div class="wrap"><div class="loader"></div></div>');
        }, 500);
    });

});

