$(function () {

    $("#formLogin").on("submit", function (event) {
        event.preventDefault();

        const username = $("#username").val().trim();
        const password = $("#password").val().trim();

        $("#mensaje").html("");

        if (username === "" || password === "") {
            $("#mensaje").html(`
                <div class="alert alert-danger">
                    Debes completar todos los campos
                </div>
            `);
            return;
        }

        $.ajax({
            url: "index.php",
            type: "POST",
            data: {
                option: "login",
                username: username,
                password: password
            },
            dataType: "json",

            success: function (response) {

                console.log(response);

                if (response.response === "00") {

                    $("#mensaje").html(`
                        <div class="alert alert-success">
                            ${response.message}
                        </div>
                    `);

                    setTimeout(function () {

                        if (response.rol === "admin") {
                            window.location.href = "index.php?page=admin";
                        } else {
                            window.location.href = "index.php?page=talleres";
                        }

                    }, 800);

                } else {

                    $("#mensaje").html(`
                        <div class="alert alert-danger">
                            ${response.message}
                        </div>
                    `);
                }
            },

            error: function (xhr, status, error) {

                console.log("STATUS:", status);
                console.log("ERROR:", error);
                console.log("RESPUESTA DEL SERVIDOR:");
                console.log(xhr.responseText);

                $("#mensaje").html(`
                    <div class="alert alert-danger">
                        Ocurrió un error al iniciar sesión
                    </div>
                `);
            }
        });

    });

});