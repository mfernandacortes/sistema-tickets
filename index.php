<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Tickets</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light min-vh-100 d-flex flex-column justify-content-center">

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-12 col-sm-8 col-md-6 col-lg-4">

            <div class="text-center mb-4">
                <span style="font-size: 48px;">🎫</span>
                <h2 class="mt-2 fw-bold">Sistema de Tickets</h2>
                <p class="text-muted">Seleccioná una opción para continuar</p>
            </div>

            <div class="list-group shadow-sm">
                <a href="public/cargar_ticket.php" class="list-group-item list-group-item-action py-3">
                    📝 Cargar nuevo ticket
                </a>
                <a href="views/admin_login.php" class="list-group-item list-group-item-action py-3">
                    🔐 Panel Administrador
                </a>
                
            </div>

        </div>
    </div>
</div>
<footer>
<?php
include "public/footer.php"; 
?>
</footer>
</body>
</html>
