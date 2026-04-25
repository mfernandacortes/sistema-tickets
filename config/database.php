<?php
$conexion = new PDO("mysql:host=localhost;dbname=tickets_db;charset=utf8mb4","root","");
$conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>