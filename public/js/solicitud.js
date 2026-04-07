
$(function () {

    cargarSolicitudes();

    function cargarSolicitudes() {
        $.ajax({
            url: 'index.php?page=api_solicitudes',
            method: 'GET',
            dataType: 'json',
            success: function (solicitudes) {

                let html = '';

                if (!solicitudes || solicitudes.length === 0) {
                    html = `
                        <tr>
                            <td colspan="5" class="text-center">
                                No hay solicitudes pendientes
                            </td>
                        </tr>
                    `;
                } else {

                    solicitudes.forEach(function (s) {
                        html += `
                            <tr id="fila-${s.id}">
                                <td>${s.id}</td>
                                <td>${s.taller}</td>
                                <td>${s.usuario}</td>
                                <td>${s.estado}</td>
                                <td>
                                    <button class="btn btn-success btn-aprobar"
                                            data-id="${s.id}">
                                        Aprobar
                                    </button>

                                    <button class="btn btn-danger btn-rechazar"
                                            data-id="${s.id}">
                                        Rechazar
                                    </button>
                                </td>
                            </tr>
                        `;
                    });
                }

                $('#solicitudes-body').html(html);
            },
            error: function () {
                $('#solicitudes-body').html(`
                    <tr>
                        <td colspan="5" class="text-center text-danger">
                            Error al cargar las solicitudes
                        </td>
                    </tr>
                `);
            }
        });
    }

    $(document).on('click', '.btn-aprobar', function () {

        const id = $(this).data('id');

        $.ajax({
            url: 'index.php?page=aprobar_solicitud',
            method: 'POST',
            data: {
                id_solicitud: id
            },
            dataType: 'json',
            success: function (respuesta) {

                if (respuesta.success) {

                    $('#mensaje').html(`
                        <div class="alert alert-success">
                            ${respuesta.message}
                        </div>
                    `);

                    $('#fila-' + id).remove();

                } else {
                    $('#mensaje').html(`
                        <div class="alert alert-danger">
                            ${respuesta.error}
                        </div>
                    `);
                }
            },
            error: function () {
                $('#mensaje').html(`
                    <div class="alert alert-danger">
                        Error al aprobar la solicitud
                    </div>
                `);
            }
        });
    });

    $(document).on('click', '.btn-rechazar', function () {

        const id = $(this).data('id');

        $.ajax({
            url: 'index.php?page=rechazar_solicitud',
            method: 'POST',
            data: {
                id_solicitud: id
            },
            dataType: 'json',
            success: function (respuesta) {

                if (respuesta.success) {

                    $('#mensaje').html(`
                        <div class="alert alert-warning">
                            ${respuesta.message}
                        </div>
                    `);

                    $('#fila-' + id).remove();

                } else {
                    $('#mensaje').html(`
                        <div class="alert alert-danger">
                            ${respuesta.error}
                        </div>
                    `);
                }
            },
            error: function () {
                $('#mensaje').html(`
                    <div class="alert alert-danger">
                        Error al rechazar la solicitud
                    </div>
                `);
            }
        });
    });

});
