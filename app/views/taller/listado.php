<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de Talleres</title>

    <link rel="stylesheet" href="public/css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <script src="public/js/jquery-4.0.0.min.js"></script>
</head>

<body class="container mt-5">

    <nav class="d-flex justify-content-between align-items-center mb-4 p-3">
        <div class="d-flex gap-3">
            <a href="index.php?page=talleres" class="btn btn-outline-primary">
                Talleres
            </a>

            <?php if (isset($_SESSION['rol']) && $_SESSION['rol'] === 'admin'): ?>
                <a href="index.php?page=admin" class="btn btn-outline-dark">
                    Gestionar Solicitudes
                </a>
            <?php endif; ?>
        </div>

        <div class="d-flex align-items-center gap-3">
            <span class="fw-bold">
                <?= htmlspecialchars($_SESSION['user'] ?? 'Usuario') ?>
            </span>

            <a href="index.php?page=logout" class="btn btn-danger">
                Cerrar sesión
            </a>
        </div>
    </nav>

    <main>

        <h2 class="mb-4">Talleres disponibles</h2>

        <div id="mensaje" class="mb-3"></div>

        <div class="table-responsive">
            <table class="table table-striped align-middle">

                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Taller</th>
                        <th>Descripción</th>
                        <th>Cupos disponibles</th>
                        <th>Acción</th>
                    </tr>
                </thead>

                <tbody id="talleres-body">
                    <tr>
                        <td colspan="5" class="text-center">
                            Cargando talleres...
                        </td>
                    </tr>
                </tbody>

            </table>
        </div>

    </main>

    <script src="public/js/taller.js"></script>
</body>
</html>