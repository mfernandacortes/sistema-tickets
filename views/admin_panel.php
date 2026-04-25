<?php
session_start();
if(!isset($_SESSION['admin'])){
    header("Location: admin_login.php");
    exit;
}

require_once '../config/database.php';

// función para sanitizar (forma prolija)
function e($dato){
    return htmlspecialchars($dato, ENT_QUOTES, 'UTF-8');
}


$estadoFiltro = $_GET['estado'] ?? '';

$where = "";
if($estadoFiltro != ''){
    $where = "WHERE t.estado = " . $conexion->quote($estadoFiltro);
}
// Traer tickets + datos usuario
/*$stmt = $conexion->query("
    SELECT t.*, u.nombre, u.departamento 
    FROM tickets t
    JOIN usuarios u ON t.dni = u.dni
    ORDER BY t.fecha DESC
");*/

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
<html>
<head>
    <title>Panel Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-4">

<!--a href="../public/menu.php" class="btn btn-secondary mb-3">← Menú</a-->
<div class="d-flex justify-content-between mb-3">
    <a href="../public/menu.php" class="btn btn-secondary">← Menú</a>
    <a href="../controllers/logout.php" class="btn btn-danger">Cerrar sesión</a>
</div>

<h3>Panel de Administración</h3>
<div class="mb-3">

    <a href="admin_panel.php" class="btn btn-dark">Todos</a>
    <a href="admin_panel.php?estado=abierto" class="btn btn-warning">Abiertos</a>
    <a href="admin_panel.php?estado=en_proceso" class="btn btn-primary">En proceso</a>
    <a href="admin_panel.php?estado=cerrado" class="btn btn-success">Cerrados</a>

</div>
<table class="table table-bordered table-striped mt-3">
    <thead>
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
    <td><?= e($t['fecha']) ?></td>
    <td><?= e($t['nombre']) ?></td>
    <td><?= e($t['departamento']) ?></td>
    <td><?= e($t['problema']) ?></td>

    <td>
        <form method="POST" action="../controllers/actualizar_estado.php">
            <input type="hidden" name="id" value="<?= e($t['idTicket']) ?>">
            <select name="estado" onchange="this.form.submit()" class="form-select">
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
                class="form-control" 
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

</body>
</html>