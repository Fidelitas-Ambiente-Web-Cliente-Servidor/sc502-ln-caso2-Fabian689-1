$(function () {

    $("#formRegister").on("submit", function (e) {
        e.preventDefault();

        $.ajax({
            url: "index.php",
            type: "POST",
            data: {
                option: "register",
                username: $("#username").val(),
                password: $("#password").val()
            },
            dataType: "json",

            success: function (response) {
                if (response.response === "00") {
                    alert("Usuario registrado correctamente");
                    window.location.href = "index.php?page=login";
                } else {
                    alert(response.message);
                }
            },

            error: function () {
                alert("Error en el servidor");
            }
        });
    });

});
