$(function () {

    cargarTalleres();

    function cargarTalleres() {
        $.ajax({
            url: 'index.php?page=api_talleres',
            method: 'GET',
            dataType: 'json',

            success: function (talleres) {

                let html = '';

                talleres.forEach(function (taller) {
                    html += `
                        <tr id="fila-${taller.id}">
                            <td>${taller.id}</td>
                            <td>${taller.nombre}</td>
                            <td>${taller.descripcion}</td>
                            <td id="cupo-${taller.id}">
                                ${taller.cupo_disponible}/${taller.cupo_maximo}
                            </td>
                            <td>
                                <button class="btn btn-primary btn-solicitar"
                                        data-id="${taller.id}">
                                    Solicitar inscripción
                                </button>
                            </td>
                        </tr>
                    `;
                });

                $("#talleres-body").html(html);
            },

            error: function (xhr) {
                console.log(xhr.responseText);

                $("#talleres-body").html(`
                    <tr>
                        <td colspan="5" class="text-center text-danger">
                            Error al cargar los talleres
                        </td>
                    </tr>
                `);
            }
        });
    }

    $(document).on("click", ".btn-solicitar", function () {

        const boton = $(this);
        const tallerId = boton.data("id");

        boton.prop("disabled", true).text("Enviando...");

        $.ajax({
            url: "index.php?page=solicitar_taller",
            method: "POST",
            dataType: "json",
            data: {
                taller_id: tallerId
            },

            success: function (respuesta) {
                console.log(respuesta);

                if (respuesta.success) {

                    $("#mensaje").html(`
                        <div class="alert alert-success">
                            ${respuesta.message}
                        </div>
                    `);

                    boton
                        .removeClass("btn-primary")
                        .addClass("btn-success")
                        .text("Solicitud enviada");

                    cargarTalleres();

                } else {

                    $("#mensaje").html(`
                        <div class="alert alert-danger">
                            ${respuesta.error}
                        </div>
                    `);

                    boton.prop("disabled", false).text("Solicitar inscripción");
                }
            },

            error: function (xhr) {
                console.log(xhr.responseText);

                $("#mensaje").html(`
                    <div class="alert alert-danger">
                        Error al enviar la solicitud
                    </div>
                `);

                boton.prop("disabled", false).text("Solicitar inscripción");
            }
        });
    });

});
