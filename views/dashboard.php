<?php
session_start();
if(!isset($_SESSION['admin'])){
    header("Location: admin_login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        canvas { max-height: 300px; }
    </style>
</head>

<body class="bg-light">

<div class="container-fluid py-4">

    <div class="d-flex align-items-center gap-3 mb-4">
        <a href="../public/menu.php" class="btn btn-secondary btn-sm">← Menú</a>
        <h3 class="mb-0">📊 Dashboard de Tickets</h3>
    </div>

    <div class="row g-4">

        <div class="col-12 col-md-6">
            <div class="card shadow-sm h-100">
                <div class="card-body">
                    <h6 class="card-title text-muted">Por Departamento</h6>
                    <canvas id="porDepartamento"></canvas>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-6">
            <div class="card shadow-sm h-100">
                <div class="card-body">
                    <h6 class="card-title text-muted">Por Estado</h6>
                    <canvas id="porEstado"></canvas>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-6">
            <div class="card shadow-sm h-100">
                <div class="card-body">
                    <h6 class="card-title text-muted">Tipos de Problema</h6>
                    <canvas id="problemas"></canvas>
                </div>
            </div>
        </div>

        <div class="col-12">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h6 class="card-title text-muted">Evolución temporal</h6>
                    <canvas id="evolucion"></canvas>
                </div>
            </div>
        </div>

    </div>

</div>

<script src="../public/js/dashboard.js"></script>

</body>
</html>
