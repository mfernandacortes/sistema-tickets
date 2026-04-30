<?php
require_once __DIR__ . '/../config/database.php';
$dni=$_GET['dni'];
$stmt=$conexion->prepare("SELECT * FROM usuarios WHERE dni=?");
$stmt->execute([$dni]);
echo json_encode($stmt->fetch(PDO::FETCH_ASSOC));
?>