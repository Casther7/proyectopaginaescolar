<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Llamamos al Modelo
require_once "model/AdminModel.php";

// Verificamos que el formulario haya enviado datos
if(isset($_POST["usuario"]) && isset($_POST["password"])){
    
    $usuario = trim($_POST["usuario"]);
    $password = trim($_POST["password"]);

    // Le pedimos al modelo que vaya a MySQL a revisar
    $respuesta = AdminModel::mdlIngresoAdmin($usuario, $password);

    // Si la respuesta es verdadera (sí encontró al usuario)
    if($respuesta){
        
        // Creamos la sesión oficial
        $_SESSION["accesoAdmin"] = "ok";
        $_SESSION["nombreAdmin"] = $respuesta["nombre"]; 
        
        // REDIRECCIÓN INFALIBLE AL PANEL
        echo '<script>window.location = "index.php?ruta=admin";</script>';
        
    } else {
        // Credenciales falsas
        echo '<script>
                alert("❌ Usuario o contraseña incorrectos");
                window.location = "index.php";
              </script>';
    }
}
?>