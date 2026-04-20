<?php
require_once __DIR__ . '/../config/conexion.php';

class BannerModel {

    /**
     * Crea la tabla si no existe.
     * Solo se llama una vez por request; en producción usa migraciones.
     */
    private static function crearTabla() {
        $sql = "CREATE TABLE IF NOT EXISTS banners (
            id          INT AUTO_INCREMENT PRIMARY KEY,
            seccion     VARCHAR(50)  NOT NULL DEFAULT 'general',
            tipo        ENUM('imagen','video') NOT NULL DEFAULT 'imagen',
            ruta        VARCHAR(255) NOT NULL,
            titulo      VARCHAR(255) DEFAULT NULL,
            subtitulo   VARCHAR(255) DEFAULT NULL,
            activo      TINYINT(1)  NOT NULL DEFAULT 1,
            orden       INT         NOT NULL DEFAULT 0,
            fecha_subida TIMESTAMP  NOT NULL DEFAULT CURRENT_TIMESTAMP
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";
        
        try {
            Conexion::conectar()->exec($sql);
        } catch (PDOException $e) {
            error_log("BannerModel::crearTabla ERROR: " . $e->getMessage());
        }
    }

    /**
     * Devuelve todos los banners de una sección, ordenados
     * CORREGIDO: Nombre del método para que coincida con ajax_banners.php
     */
    public static function mdlMostrarBanners(string $seccion = 'general'): array {
        try {
            self::crearTabla();
            $stmt = Conexion::conectar()->prepare(
                "SELECT * FROM banners WHERE seccion = ? ORDER BY orden ASC, id DESC"
            );
            $stmt->execute([$seccion]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("BannerModel::mdlMostrarBanners ERROR: " . $e->getMessage());
            return [];
        }
    }
    
    /**
     * Mantengo el método original para compatibilidad
     */
    public static function mdlListarBanners(string $seccion = 'general'): array {
        return self::mdlMostrarBanners($seccion);
    }

    /**
     * Inserta un nuevo banner
     * CORREGIDO: Añadido campo 'activo' con valor por defecto 1
     */
    public static function mdlAgregarBanner(array $datos): string {
        try {
            self::crearTabla();
            
            // Valores por defecto seguros
            $seccion   = $datos['seccion']   ?? 'general';
            $tipo      = $datos['tipo']      ?? 'imagen';
            $ruta      = $datos['ruta']      ?? '';
            $titulo    = $datos['titulo']    ?? null;
            $subtitulo = $datos['subtitulo'] ?? null;
            $activo    = $datos['activo']    ?? 1; // Por defecto activo
            $orden     = (int)($datos['orden'] ?? 0);
            
            // Validar que la ruta no esté vacía
            if (empty($ruta)) {
                error_log("BannerModel::mdlAgregarBanner ERROR: Ruta vacía");
                return 'error_ruta_vacia';
            }
            
            $stmt = Conexion::conectar()->prepare(
                "INSERT INTO banners (seccion, tipo, ruta, titulo, subtitulo, activo, orden)
                 VALUES (?, ?, ?, ?, ?, ?, ?)"
            );
            
            $ok = $stmt->execute([
                $seccion,
                $tipo,
                $ruta,
                $titulo,
                $subtitulo,
                $activo,
                $orden
            ]);
            
            return $ok ? 'ok' : 'error';
            
        } catch (PDOException $e) {
            error_log("BannerModel::mdlAgregarBanner ERROR: " . $e->getMessage());
            return 'error_' . $e->getCode();
        }
    }

    /**
     * Actualiza titulo, subtitulo, activo y orden de un banner existente
     */
    public static function mdlActualizarBanner(int $id, array $datos): string {
        try {
            $db   = Conexion::conectar();
            $sets = "titulo = ?, subtitulo = ?, activo = ?, orden = ?";
            $vals = [
                $datos['titulo']    ?? null,
                $datos['subtitulo'] ?? null,
                isset($datos['activo']) ? (int)$datos['activo'] : 1,
                (int)($datos['orden'] ?? 0),
            ];

            // Si se sube nueva imagen, también actualiza ruta y tipo
            if (!empty($datos['ruta'])) {
                $sets .= ", ruta = ?, tipo = ?";
                $vals[] = $datos['ruta'];
                $vals[] = $datos['tipo'] ?? 'imagen';
            }

            $vals[] = $id;
            $stmt = $db->prepare("UPDATE banners SET {$sets} WHERE id = ?");
            return $stmt->execute($vals) ? 'ok' : 'error';
            
        } catch (PDOException $e) {
            error_log("BannerModel::mdlActualizarBanner ERROR: " . $e->getMessage());
            return 'error';
        }
    }

    /**
     * Elimina el registro y el archivo físico
     * CORREGIDO: Manejo correcto de rutas
     */
    public static function mdlEliminarBanner(int $id, string $baseDir): string {
        try {
            $db = Conexion::conectar();

            // Obtener la ruta del banner
            $stmt = $db->prepare("SELECT ruta FROM banners WHERE id = ?");
            $stmt->execute([$id]);
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!$row) {
                return 'not_found';
            }

            // Construir ruta física correctamente
            // La ruta en BD es algo como: view/img_banners/banner_xxx.jpg
            // $baseDir ya incluye la raíz del proyecto (__DIR__ . '/../')
            $rutaFisica = rtrim($baseDir, '/') . '/' . $row['ruta'];
            
            // Eliminar archivo físico si existe
            if (file_exists($rutaFisica)) {
                if (!unlink($rutaFisica)) {
                    error_log("BannerModel::mdlEliminarBanner WARNING: No se pudo eliminar archivo: " . $rutaFisica);
                }
            } else {
                error_log("BannerModel::mdlEliminarBanner INFO: Archivo no encontrado: " . $rutaFisica);
            }

            // Eliminar registro de la base de datos
            $stmt2 = $db->prepare("DELETE FROM banners WHERE id = ?");
            $result = $stmt2->execute([$id]);
            
            return $result ? 'ok' : 'error';
            
        } catch (PDOException $e) {
            error_log("BannerModel::mdlEliminarBanner ERROR: " . $e->getMessage());
            return 'error';
        }
    }

    /**
     * Activa / desactiva un banner
     */
    public static function mdlToggleActivo(int $id): string {
        try {
            $stmt = Conexion::conectar()->prepare(
                "UPDATE banners SET activo = IF(activo = 1, 0, 1) WHERE id = ?"
            );
            return $stmt->execute([$id]) ? 'ok' : 'error';
        } catch (PDOException $e) {
            error_log("BannerModel::mdlToggleActivo ERROR: " . $e->getMessage());
            return 'error';
        }
    }
    
    /**
     * Obtiene un banner por su ID
     */
    public static function mdlObtenerBanner(int $id): ?array {
        try {
            $stmt = Conexion::conectar()->prepare(
                "SELECT * FROM banners WHERE id = ?"
            );
            $stmt->execute([$id]);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result ?: null;
        } catch (PDOException $e) {
            error_log("BannerModel::mdlObtenerBanner ERROR: " . $e->getMessage());
            return null;
        }
    }
    
    /**
     * Cambia el orden de los banners
     */
    public static function mdlActualizarOrden(int $id, int $nuevoOrden): string {
        try {
            $stmt = Conexion::conectar()->prepare(
                "UPDATE banners SET orden = ? WHERE id = ?"
            );
            return $stmt->execute([$nuevoOrden, $id]) ? 'ok' : 'error';
        } catch (PDOException $e) {
            error_log("BannerModel::mdlActualizarOrden ERROR: " . $e->getMessage());
            return 'error';
        }
    }
}
?>