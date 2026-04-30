<?php
session_start();
if(!isset($_SESSION['admin'])){
    header("Location: admin_login.php");
    exit;
}

require_once __DIR__ . '/../config/database.php';

function e($dato){
    return htmlspecialchars((string)($dato ?? ''), ENT_QUOTES, 'UTF-8');
}

$estadoFiltro = $_GET['estado'] ?? '';
$where = "";
if($estadoFiltro != ''){
    $where = "WHERE t.estado = " . $conexion->quote($estadoFiltro);
}

$stmt = $conexion->query("
    SELECT t.*, u.nombre, u.departamento 
    FROM tickets t
    JOIN usuarios u ON t.dni = u.dni
    $where
    ORDER BY t.fecha DESC
");

$tickets = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container-fluid py-4">

    <!-- Navbar top -->
    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4 gap-2">
        <h3 class="mb-0">🛠️ Panel de Administración</h3>
        <div class="d-flex gap-2">
            <a href="../views/dashboard.php" class="btn btn-secondary btn-sm">
                    📊 Dashboard
            </a>
            <a href="../public/menu.php" class="btn btn-secondary btn-sm">← Menú</a>
            <a href="../controllers/logout.php" class="btn btn-danger btn-sm">Cerrar sesión</a>
        </div>
    </div>

    <!-- Filtros -->
    <div class="d-flex flex-wrap gap-2 mb-4">
        <a href="admin_panel.php" class="btn btn-dark btn-sm <?= $estadoFiltro==''?'active':'' ?>">Todos</a>
        <a href="admin_panel.php?estado=abierto" class="btn btn-warning btn-sm <?= $estadoFiltro=='abierto'?'active':'' ?>">Abiertos</a>
        <a href="admin_panel.php?estado=en_proceso" class="btn btn-primary btn-sm <?= $estadoFiltro=='en_proceso'?'active':'' ?>">En proceso</a>
        <a href="admin_panel.php?estado=cerrado" class="btn btn-success btn-sm <?= $estadoFiltro=='cerrado'?'active':'' ?>">Cerrados</a>
    </div>

    <!-- Tabla responsive -->
    <div class="table-responsive shadow-sm rounded">
        <table class="table table-bordered table-striped table-hover mb-0 align-middle">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Fecha</th>
                    <th>Nombre</th>
                    <th>Sector</th>
                    <th>Problema</th>
                    <th>Estado</th>
                    <th>Responsable</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach($tickets as $t): ?>
            <tr>
                <td><?= e($t['idTicket']) ?></td>
                <td class="text-nowrap"><?= e($t['fecha']) ?></td>
                <td><?= e($t['nombre']) ?></td>
                <td><?= e($t['departamento']) ?></td>
                <td><?= e($t['problema']) ?></td>
                <td>
                    <form method="POST" action="../controllers/actualizar_estado.php">
                        <input type="hidden" name="id" value="<?= e($t['idTicket']) ?>">
                        <select name="estado" onchange="this.form.submit()" class="form-select form-select-sm">
                            <option <?= $t['estado']=='abierto'?'selected':'' ?>>abierto</option>
                            <option <?= $t['estado']=='en_proceso'?'selected':'' ?>>en_proceso</option>
                            <option <?= $t['estado']=='cerrado'?'selected':'' ?>>cerrado</option>
                        </select>
                    </form>
                </td>
                <td>
                    <form method="POST" action="../controllers/asignar.php">
                        <input type="hidden" name="id" value="<?= e($t['idTicket']) ?>">
                        <input 
                            type="text" 
                            name="responsable" 
                            value="<?= e($t['resuelto_por']) ?>" 
                            class="form-control form-control-sm" 
                            placeholder="Responsable"
                            onchange="this.form.submit()"
                        >
                    </form>
                </td>
                <td>
                    <a href="../controllers/eliminar.php?id=<?= e($t['idTicket']) ?>" 
                       class="btn btn-danger btn-sm"
                       onclick="return confirm('¿Eliminar ticket?')">Eliminar</a>
                </td>
            </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>

</div>

</body>
</html>
