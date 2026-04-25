<?php
require_once '../config/database.php';

$id = $_POST['id'];
$responsable = $_POST['responsable'];

$stmt = $conexion->prepare("UPDATE tickets SET resuelto_por=? WHERE idTicket=?");
$stmt->execute([$responsable, $id]);

header("Location: ../views/admin_panel.php");
?>