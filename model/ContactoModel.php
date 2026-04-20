<?php
require_once "config/conexion.php";

class ContactoModel {
    // Obtener los datos actuales
    public static function mdlObtenerContacto() {
        $stmt = Conexion::conectar()->prepare("SELECT * FROM contacto_info WHERE id = 1");
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Actualizar los datos desde el panel
    public static function mdlActualizarContacto($datos) {
        $stmt = Conexion::conectar()->prepare("UPDATE contacto_info SET 
            telefono = :tel, correo = :correo, ubicacion = :ubi, horario = :hor 
            WHERE id = 1");
        
        $stmt->bindParam(":tel", $datos["telefono"], PDO::PARAM_STR);
        $stmt->bindParam(":correo", $datos["correo"], PDO::PARAM_STR);
        $stmt->bindParam(":ubi", $datos["ubicacion"], PDO::PARAM_STR);
        $stmt->bindParam(":hor", $datos["horario"], PDO::PARAM_STR);

        return ($stmt->execute()) ? "ok" : "error";
    }
}