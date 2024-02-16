$(document).ready(function () {

    // Update Values OnClick
    $("#update").click(function () {
        $.post
            (
                "supplier-query-update.php",
                {
                    su_id: $("#su_id").val(),
                    su_name: $("#su_name").val(),
                    su_companyname: $("#su_companyname").val(),
                    su_contact: $("#su_contact").val(),
                    su_email: $("#su_email").val()
                },
                function () { history.go(0) }
            )
    });



    // GET Values for update on click
    $(".edit").click(function () {
        const val = $(this).attr('aria-valuetext')

        $.post("supplier-query-get.php", { id: val, },

            function (e) {
                const obj = JSON.parse(e)

                $("#su_id").val(obj.su_id)
                $("#su_name").val(obj.su_name)
                $("#su_companyname").val(obj.su_companyname)
                $("#su_contact").val(obj.su_contact)
                $("#su_email").val(obj.su_email)
            });

    });


    // Insert Values into The table
    $("#submit").click(function () {


        if ($("#su_name").val() != "" && $("#su_companyname").val() != "" && $("#su_contact").val() != "" && $("#su_email").val() != "") {

            if ($.post("supplier-query-insert.php", {
                su_name: $("#su_name").val(),
                su_companyname: $("#su_companyname").val(),
                su_contact: $("#su_contact").val(),
                su_email: $("#su_email").val()
            })) {
                $(".create-wrapper").stop().animate({ height: "0px", padding: "0px", border: "0px" }, 350).delay(400, function () { $(this).hide(); $(".wrapper-wrapper").hide(); });
                $("#su_name").val("")
                $("#su_companyname").val("")
                $("#su_contact").val("")
                $("#su_email").val("")

                history.go(0)
            }
        }
        else {
            $(".msg-wrapper").animate({ right: "0rem" });
        }
    });




    // Show Create Box with values to update
    $(".edit").click(function () {
        $(".create-wrapper h6").html("Update Supplier")

        $("#update").show();
        $("#submit").hide();


        $(".wrapper-wrapper").show();
        $(".create-wrapper").show().stop().animate({ height: "400px", padding: "1rem" }, 350).css("border", "1px solid #669999");
    });


    // Create Record Open - Closing Animation
    $(".create-btn").click(function () {
        $(".create-wrapper h6").html("Create Supplier");

        $("#update").hide();
        $("#submit").show();

        $("#su_name").val(""); $("#su_companyname").val(""); $("#su_contact").val(""); $("#su_email").val("")

        $(".wrapper-wrapper").show();
        $(".create-wrapper").show().stop().animate({ height: "400px", padding: "1rem" }, 350).css("border", "1px solid #555");
    });
    $(".close-icon").click(function () {
        $(".create-wrapper").stop().animate({ height: "0px", padding: "0px", border: "0px" }, 350).delay(400, function () { $(this).hide(); $(".wrapper-wrapper").hide(); });
    });

});