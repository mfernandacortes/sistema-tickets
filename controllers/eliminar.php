<?php
require_once '../config/database.php';

$id = $_GET['id'];

$stmt = $conexion->prepare("DELETE FROM tickets WHERE idTicket=?");
$stmt->execute([$id]);

header("Location: ../views/admin_panel.php");
?>