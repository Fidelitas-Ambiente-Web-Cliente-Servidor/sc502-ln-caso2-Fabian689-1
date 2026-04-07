<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar sesión</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="public/css/style.css">

    <script src="public/js/jquery-4.0.0.min.js"></script>
    <script src="public/js/auth.js"></script>
</head>

<body class="login-body">

    <div class="login-container">
        <div class="card shadow-lg border-0 rounded-4 p-4 login-card">

            <div class="text-center mb-4">
                <h2 class="fw-bold">Bienvenido</h2>
                <p class="text-muted mb-0">
                    Inicia sesión para acceder a los talleres
                </p>
            </div>

            <div id="mensaje"></div>

            <form id="formLogin">
                <div class="mb-3">
                    <label for="username" class="form-label">Usuario</label>
                    <input
                        type="text"
                        class="form-control form-control-lg"
                        name="username"
                        id="username"
                        placeholder="Ingresa tu usuario"
                        required>
                </div>

                <div class="mb-4">
                    <label for="password" class="form-label">Contraseña</label>
                    <input
                        type="password"
                        class="form-control form-control-lg"
                        name="password"
                        id="password"
                        placeholder="Ingresa tu contraseña"
                        required>
                </div>

                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-primary btn-lg">
                        Ingresar
                    </button>

                    <a href="index.php?page=registro" class="btn btn-outline-secondary btn-lg">
                        Crear cuenta
                    </a>
                </div>
            </form>
        </div>
    </div>

</body>
</html>