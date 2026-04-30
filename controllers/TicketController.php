<?php
require_once __DIR__ . '/../config/database.php';

$dni=$_POST['dni'];
$nombre=$_POST['nombre'];
$departamento=$_POST['departamento'];
$cargo=$_POST['cargo'];
$problema=$_POST['problema'];
$detalle=$_POST['detalle'];

// Verificar usuario
$stmt=$conexion->prepare("SELECT dni FROM usuarios WHERE dni=?");
$stmt->execute([$dni]);

if($stmt->rowCount()==0){
    $conexion->prepare("INSERT INTO usuarios VALUES (?,?,?,?)")
    ->execute([$dni,$nombre,$departamento,$cargo]);
}

// Insertar ticket
$conexion->prepare("INSERT INTO tickets (dni,fecha,estado,problema,detalle) 
VALUES (?,NOW(),'abierto',?,?)")
->execute([$dni,$problema,$detalle]);

$id = $conexion->lastInsertId();

/*Confirmación simple
echo "<h3>Ticket generado correctamente</h3>";
echo "<p>Número de ticket: <strong>$id</strong></p>";
echo "<a href='../public/menu.php'>Volver al menú</a>";*/



echo '
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Ticket generado</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light d-flex align-items-center" style="height:100vh;">

<div class="container">

    <div class="row justify-content-center">
        <div class="col-md-5">

            <div class="card shadow text-center">

                <div class="card-body">

                    <div style="font-size:50px;">✅</div>

                    <h4 class="mt-3">Ticket generado correctamente</h4>

                    <p class="mt-2">
                        Número de ticket: 
                        <strong class="text-primary">'.$id.'</strong>
                    </p>

                    <a href="../public/menu.php" class="btn btn-primary mt-3">
                        Volver al menú
                    </a>

                </div>

            </div>

        </div>
    </div>

</div>

</body>
</html>
';
header("Location: ../public/index.php?msg=ok&id=$id");
exit;
?>