<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Login Administrador</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light d-flex align-items-center" style="height:100vh;">

<div class="container">

    <div class="row justify-content-center">

        <div class="col-md-4">

            <div class="card shadow">

                    <div class="card-body">
                    <div class="text-center mb-2">
                    <span style="font-size:40px;">🖥️</span>
                    </div>
                    <h4 class="text-center mb-4">🔐 Panel Administrador</h4>

                    <form method="POST" action="../controllers/AdminController.php">

                        <div class="mb-3">
                            <label class="form-label">Contraseña</label>
                            <input type="password" name="password" class="form-control" placeholder="Ingrese clave" required>
                        </div>

                        <button class="btn btn-primary w-100">Ingresar</button>

                    </form>

                    <a href="../public/menu.php" class="btn btn-link w-100 mt-2">← Volver al menú</a>

                </div>

            </div>

        </div>

    </div>

</div>

</body>
</html>