<?php
// ¡AQUÍ ES LA CONEXIÓN! Mandamos a llamar tu archivo de configuración
require_once "config/conexion.php";

class AdminModel {
    static public function mdlIngresoAdmin($usuario, $password) {
        // Usamos Conexion::conectar() para abrir la puerta a MySQL
        $stmt = Conexion::conectar()->prepare("SELECT * FROM administradores WHERE usuario = :usuario AND password = :password");
        
        // Protegemos el sistema contra hackers (Inyección SQL)
        $stmt->bindParam(":usuario", $usuario, PDO::PARAM_STR);
        $stmt->bindParam(":password", $password, PDO::PARAM_STR);
        
        $stmt->execute();

        // fetch() devuelve los datos si el usuario existe, o false si no existe
        return $stmt->fetch(); 
    }
}
?>