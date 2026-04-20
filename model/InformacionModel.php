<?php
require_once __DIR__ . '/../config/conexion.php';

class InformacionModel {

    /**
     * Obtiene el contenido de una sección específica mediante su slug.
     */
    public static function mdlObtenerInformacion(string $slug): ?array {
        try {
            $stmt = Conexion::conectar()->prepare(
                "SELECT * FROM informacion_escolar WHERE slug = :slug LIMIT 1"
            );
            $stmt->bindParam(":slug", $slug, PDO::PARAM_STR);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result ?: null;
        } catch (PDOException $e) {
            error_log("InformacionModel::mdlObtenerInformacion ERROR: " . $e->getMessage());
            return null;
        }
    }

    /**
     * Actualiza el contenido y el título de una sección.
     */
    public static function mdlActualizarInformacion(string $slug, array $datos): string {
        try {
            $stmt = Conexion::conectar()->prepare(
                "UPDATE informacion_escolar 
                 SET titulo = :titulo, contenido = :contenido 
                 WHERE slug = :slug"
            );
            
            $stmt->bindParam(":titulo",    $datos['titulo'],    PDO::PARAM_STR);
            $stmt->bindParam(":contenido", $datos['contenido'], PDO::PARAM_STR);
            $stmt->bindParam(":slug",      $slug,              PDO::PARAM_STR);

            return $stmt->execute() ? "ok" : "error";
        } catch (PDOException $e) {
            error_log("InformacionModel::mdlActualizarInformacion ERROR: " . $e->getMessage());
            return "error";
        }
    }

    /**
     * Lista toda la información de una sección (ej: 'nosotros') para el panel admin.
     */
    public static function mdlListarPorSeccion(string $seccion): array {
        try {
            $stmt = Conexion::conectar()->prepare(
                "SELECT * FROM informacion_escolar WHERE seccion = :seccion"
            );
            $stmt->bindParam(":seccion", $seccion, PDO::PARAM_STR);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("InformacionModel::mdlListarPorSeccion ERROR: " . $e->getMessage());
            return [];
        }
    }
}