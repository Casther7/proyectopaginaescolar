<?php
require_once "../config/conexion.php";

class ModeloInstalaciones {
    static public function mdlMostrarGaleria($categoria) {
        // La categoría se guarda en la columna "seccion" de la tabla banners
        $stmt = Conexion::conectar()->prepare(
            "SELECT ruta AS ruta_archivo, titulo, subtitulo 
             FROM banners 
             WHERE seccion = :categoria 
             AND activo = 1 
             ORDER BY orden ASC"
        );
        $stmt->bindParam(":categoria", $categoria, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>