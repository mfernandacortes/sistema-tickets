<?php
require_once __DIR__ . '/../config/database.php';

// 1. Tickets por departamento
$dep = $conexion->query("
    SELECT IFNULL(u.departamento,'Sin datos') as departamento, COUNT(*) total
    FROM tickets t
    LEFT JOIN usuarios u ON t.dni = u.dni
    GROUP BY u.departamento
")->fetchAll(PDO::FETCH_ASSOC);

// 2. Tickets por estado
$estado = $conexion->query("
    SELECT estado, COUNT(*) total
    FROM tickets
    GROUP BY estado
")->fetchAll(PDO::FETCH_ASSOC);

// 3. Problemas más comunes
$problemas = $conexion->query("
    SELECT problema, COUNT(*) total
    FROM tickets
    GROUP BY problema
    ORDER BY total DESC
    LIMIT 5
")->fetchAll(PDO::FETCH_ASSOC);

// 4. Evolución por mes (CORREGIDO)
$evolucion = $conexion->query("
    SELECT 
        YEAR(fecha) as anio,
        MONTH(fecha) as mes,
        COUNT(*) as total
    FROM tickets
    WHERE fecha IS NOT NULL
    GROUP BY anio, mes
    ORDER BY anio, mes
")->fetchAll(PDO::FETCH_ASSOC);

// JSON FINAL (UNO SOLO)
echo json_encode([
    "departamentos" => $dep,
    "estados" => $estado,
    "problemas" => $problemas,
    "evolucion" => $evolucion
]);
?>