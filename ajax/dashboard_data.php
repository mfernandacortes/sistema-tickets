<?php
require_once '../config/database.php';

// 1. Por departamento
$dep = $conexion->query("
    SELECT u.departamento, COUNT(*) total
    FROM tickets t
    JOIN usuarios u ON t.dni = u.dni
    GROUP BY u.departamento
")->fetchAll(PDO::FETCH_ASSOC);

// 2. Por estado
$estado = $conexion->query("
    SELECT estado, COUNT(*) total
    FROM tickets
    GROUP BY estado
")->fetchAll(PDO::FETCH_ASSOC);

// 3. Problemas
$problemas = $conexion->query("
    SELECT problema, COUNT(*) total
    FROM tickets
    GROUP BY problema
    ORDER BY total DESC
    LIMIT 5
")->fetchAll(PDO::FETCH_ASSOC);

echo json_encode([
    "departamentos" => $dep,
    "estados" => $estado,
    "problemas" => $problemas
]);