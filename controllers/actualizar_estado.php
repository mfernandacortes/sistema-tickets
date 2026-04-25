<?php
require_once '../config/database.php';

$id = $_POST['id'];
$estado = $_POST['estado'];

$stmt = $conexion->prepare("UPDATE tickets SET estado=? WHERE idTicket=?");
$stmt->execute([$estado, $id]);

header("Location: ../views/admin_panel.php");
?>