$(document).ready(function () {
    $("#login_form").submit(function (e) {
        e.preventDefault();

        $.ajax({
            type: "POST",
            url: "./php/auth.php",
            data: $("#login_form").serialize(),
            success: function (data) {
                if (data == "true") window.location.href = "./index.php";
            },
            error: function (data) {
                Swal.fire({
                    title: "Authentication Request Denied",
                    text: data.responseText,
                    icon: "error",
                    heightAuto: false,
                });
            },
        });
    });
});