<?php
//PermisosModel.php
require_once __DIR__ . '/../config/conexion.php';

class PermisosModel {

    private static $campos = [
        'p_banner', 'p_nosotros', 'p_oferta', 'p_docentes',
        'p_instalaciones', 'p_contacto', 'p_mensajes',
        'p_tienda', 'p_usuarios_accesos'
    ];

    private static function crearTabla() {
        $db = Conexion::conectar();
        $db->exec("CREATE TABLE IF NOT EXISTS permisos (
            id INT AUTO_INCREMENT PRIMARY KEY,
            usuario_id INT NOT NULL UNIQUE,
            p_banner TINYINT(1) DEFAULT 0,
            p_nosotros TINYINT(1) DEFAULT 0,
            p_oferta TINYINT(1) DEFAULT 0,
            p_docentes TINYINT(1) DEFAULT 0,
            p_instalaciones TINYINT(1) DEFAULT 0,
            p_contacto TINYINT(1) DEFAULT 0,
            p_mensajes TINYINT(1) DEFAULT 0,
            p_tienda TINYINT(1) DEFAULT 0,
            p_usuarios_accesos TINYINT(1) DEFAULT 0
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8");
    }

    static public function mdlObtenerPermisos($usuario_id) {
        try {
            self::crearTabla();
            $stmt = Conexion::conectar()->prepare(
                "SELECT * FROM permisos WHERE usuario_id = ?"
            );
            $stmt->execute([$usuario_id]);
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!$row) {
                $defaults = ['usuario_id' => $usuario_id];
                foreach (self::$campos as $c) $defaults[$c] = 0;
                return $defaults;
            }
            return $row;
        } catch (PDOException $e) {
            error_log("PermisosModel::mdlObtenerPermisos ERROR: " . $e->getMessage());
            return null;
        }
    }

    static public function mdlGuardarPermisos($usuario_id, $datos) {
        try {
            self::crearTabla();
            $db = Conexion::conectar();
            $campos = self::$campos;

            $vals = array_map(function($c) use ($datos) {
                return isset($datos[$c]) ? 1 : 0;
            }, $campos);

            $check = $db->prepare("SELECT id FROM permisos WHERE usuario_id = ?");
            $check->execute([$usuario_id]);

            if ($check->fetch()) {
                $sets = implode(', ', array_map(function($c) { return "$c = ?"; }, $campos));
                $stmt = $db->prepare("UPDATE permisos SET $sets WHERE usuario_id = ?");
                $stmt->execute(array_merge($vals, [$usuario_id]));
            } else {
                $cols = 'usuario_id, ' . implode(', ', $campos);
                $placeholders = implode(', ', array_fill(0, count($campos) + 1, '?'));
                $stmt = $db->prepare("INSERT INTO permisos ($cols) VALUES ($placeholders)");
                $stmt->execute(array_merge([$usuario_id], $vals));
            }

            return 'ok';
        } catch (PDOException $e) {
            error_log("PermisosModel::mdlGuardarPermisos ERROR: " . $e->getMessage());
            return 'error';
        }
    }
}
?>
