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

    static public function mdlGuardarInstalacion($datos){
        $stmt = Conexion::conectar()->prepare("INSERT INTO banners(seccion, tipo, ruta, titulo, subtitulo, activo) VALUES (:seccion, :tipo, :ruta, :titulo, :subtitulo, 1)");

        $stmt->bindParam(":seccion", $datos["seccion"], PDO::PARAM_STR);
        $stmt->bindParam(":tipo", $datos["tipo"], PDO::PARAM_STR);
        $stmt->bindParam(":ruta", $datos["ruta"], PDO::PARAM_STR);
        $stmt->bindParam(":titulo", $datos["titulo"], PDO::PARAM_STR);
        $stmt->bindParam(":subtitulo", $datos["subtitulo"], PDO::PARAM_STR);

        if($stmt->execute()){ return "ok"; } else { return "error"; }
    }
}
?>