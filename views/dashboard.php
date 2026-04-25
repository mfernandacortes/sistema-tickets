<?php
session_start();
if(!isset($_SESSION['admin'])){
    header("Location: admin_login.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="container mt-4">

<a href="../public/menu.php" class="btn btn-secondary mb-3">← Menú</a>

<h3>📊 Dashboard de Tickets</h3>

<div class="row">

    <div class="col-md-6">
        <canvas id="porDepartamento"></canvas>
    </div>

    <div class="col-md-6">
        <canvas id="porEstado"></canvas>
    </div>

</div>

<div class="row mt-4">
    <div class="col-md-6">
        <canvas id="problemas"></canvas>
    </div>
</div>

<div class="row mt-4">
    <div class="col-md-12">
        <canvas id="evolucion"></canvas>
    </div>
</div>

<script src="../public/js/dashboard.js"></script>

</body>
</html>