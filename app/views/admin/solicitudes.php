<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Solicitudes pendientes</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="public/js/jquery-4.0.0.min.js"></script>
</head>

<body class="container mt-5">

    <nav class="d-flex justify-content-between align-items-center mb-4 p-3 border rounded bg-light">
        <div class="d-flex gap-3">
            <a href="index.php?page=talleres" class="btn btn-outline-primary">
                Talleres
            </a>

            <a href="index.php?page=admin" class="btn btn-outline-dark">
                Gestionar Solicitudes
            </a>
        </div>

        <div class="d-flex align-items-center gap-3">
            <span class="fw-bold">
                Admin:
                <?= htmlspecialchars($_SESSION['nombre'] ?? $_SESSION['user'] ?? 'Administrador') ?>
            </span>

            <a href="index.php?page=logout" class="btn btn-danger">
                Cerrar sesión
            </a>
        </div>
    </nav>

    <main>
        <h2 class="mb-4">Solicitudes pendientes de aprobación</h2>

        <div id="mensaje"></div>

        <div class="table-responsive">
            <table class="table table-bordered table-striped align-middle" id="tabla-solicitudes">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Taller</th>
                        <th>Solicitante</th>
                        <th>Estado</th>
                        <th width="220">Acciones</th>
                    </tr>
                </thead>

                <tbody id="solicitudes-body">
                    <tr>
                        <td colspan="5" class="text-center">
                            Cargando solicitudes...
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </main>

    <script src="public/js/solicitudes.js"></script>
</body>
</html>