<?php
session_start();

// clave (podés cambiarla)
$claveCorrecta = "admin123";

if(password_verify($_POST['password'], password_hash($claveCorrecta, PASSWORD_DEFAULT))){
    
    session_regenerate_id(true); // 🔐 evita secuestro de sesión
    $_SESSION['admin'] = true;

    header("Location: ../views/admin_panel.php");
    exit;

} else {
    echo "Clave incorrecta";
}
?>