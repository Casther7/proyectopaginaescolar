<?php
require_once __DIR__ . '/../config/conexion.php';

class MensajeModel {
    private static function columnaExiste($db, $tabla, $columna) {
        $tabla = preg_replace('/[^a-zA-Z0-9_]/', '', $tabla);
        $columna = preg_replace('/[^a-zA-Z0-9_]/', '', $columna);
        $stmt = $db->query("SHOW COLUMNS FROM {$tabla} LIKE '{$columna}'");
        return $stmt && $stmt->fetch(PDO::FETCH_ASSOC) ? true : false;
    }

    private static function asegurarEstructuraMensajes($db) {
        if (!self::columnaExiste($db, 'mensajes', 'fecha_envio')) {
            $db->exec("ALTER TABLE mensajes ADD COLUMN fecha_envio TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP");
        }
        if (!self::columnaExiste($db, 'mensajes', 'estado')) {
            $db->exec("ALTER TABLE mensajes ADD COLUMN estado ENUM('no_leido','leido','respondido') DEFAULT 'no_leido'");
        }
    }

    private static function crearTablaMensajes() {
        $sql = "CREATE TABLE IF NOT EXISTS mensajes (
            id INT AUTO_INCREMENT PRIMARY KEY,
            nombre VARCHAR(255) NOT NULL,
            email VARCHAR(255) NOT NULL,
            telefono VARCHAR(20) DEFAULT NULL,
            asunto VARCHAR(255) NOT NULL,
            mensaje TEXT NOT NULL,
            fecha_envio TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
            estado ENUM('no_leido','leido','respondido') DEFAULT 'no_leido'
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";

        $db = Conexion::conectar();
        $db->exec($sql);
        self::asegurarEstructuraMensajes($db);
    }

    public static function mdlGuardarMensaje($datos) {
        try {
            self::crearTablaMensajes();
            $db = Conexion::conectar();
            // Insert principal (estructura actual).
            try {
                $stmt = $db->prepare(
                    "INSERT INTO mensajes (nombre, email, telefono, asunto, mensaje) VALUES (?, ?, ?, ?, ?)"
                );

                $ok = $stmt->execute([
                    $datos['nombre'],
                    $datos['email'],
                    $datos['telefono'],
                    $datos['asunto'],
                    $datos['mensaje']
                ]);

                return $ok ? 'ok' : 'error';
            } catch (PDOException $e) {
                // Fallback para esquemas antiguos sin columna telefono.
                $stmt = $db->prepare(
                    "INSERT INTO mensajes (nombre, email, asunto, mensaje) VALUES (?, ?, ?, ?)"
                );

                $ok = $stmt->execute([
                    $datos['nombre'],
                    $datos['email'],
                    $datos['asunto'],
                    $datos['mensaje']
                ]);

                return $ok ? 'ok' : 'error';
            }
        } catch (PDOException $e) {
            error_log('MensajeModel::mdlGuardarMensaje ERROR: ' . $e->getMessage());
            return 'error';
        }
    }

    public static function mdlListarMensajes($limite = 200) {
        try {
            self::crearTablaMensajes();
            $limite = max(1, (int)$limite);
            $stmt = Conexion::conectar()->prepare(
                "SELECT *
                 FROM mensajes
                 ORDER BY fecha_envio DESC
                 LIMIT {$limite}"
            );
            $stmt->execute();
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

            // Normalizar salida para que la vista siempre tenga las llaves esperadas.
            return array_map(function($r) {
                return [
                    'id' => $r['id'] ?? 0,
                    'nombre' => $r['nombre'] ?? '',
                    'email' => $r['email'] ?? '',
                    'telefono' => $r['telefono'] ?? '',
                    'asunto' => $r['asunto'] ?? '',
                    'mensaje' => $r['mensaje'] ?? '',
                    'fecha_envio' => $r['fecha_envio'] ?? date('Y-m-d H:i:s'),
                    'estado' => $r['estado'] ?? 'no_leido',
                ];
            }, $rows);
        } catch (PDOException $e) {
            error_log('MensajeModel::mdlListarMensajes ERROR: ' . $e->getMessage());
            // Compatibilidad con esquemas antiguos: si faltan columnas nuevas,
            // seguimos listando para no dejar la bandeja vacia.
            try {
                $limite = max(1, (int)$limite);
                $stmt = Conexion::conectar()->prepare(
                    "SELECT id, nombre, email, telefono, asunto, mensaje,
                            NOW() AS fecha_envio,
                            'no_leido' AS estado
                     FROM mensajes
                     ORDER BY id DESC
                     LIMIT {$limite}"
                );
                $stmt->execute();
                return $stmt->fetchAll(PDO::FETCH_ASSOC);
            } catch (PDOException $e2) {
                error_log('MensajeModel::mdlListarMensajes FALLBACK ERROR: ' . $e2->getMessage());
                return [];
            }
        }
    }

    public static function mdlContarNoLeidos() {
        try {
            self::crearTablaMensajes();
            $stmt = Conexion::conectar()->prepare(
                "SELECT COUNT(*) AS total FROM mensajes WHERE estado = 'no_leido'"
            );
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            return isset($row['total']) ? (int)$row['total'] : 0;
        } catch (PDOException $e) {
            error_log('MensajeModel::mdlContarNoLeidos ERROR: ' . $e->getMessage());
            try {
                $stmt = Conexion::conectar()->prepare("SELECT COUNT(*) AS total FROM mensajes");
                $stmt->execute();
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                return isset($row['total']) ? (int)$row['total'] : 0;
            } catch (PDOException $e2) {
                error_log('MensajeModel::mdlContarNoLeidos FALLBACK ERROR: ' . $e2->getMessage());
                return 0;
            }
        }
    }

    public static function mdlMarcarLeido($id) {
        try {
            $stmt = Conexion::conectar()->prepare(
                "UPDATE mensajes SET estado = 'leido' WHERE id = ?"
            );
            return $stmt->execute([(int)$id]) ? 'ok' : 'error';
        } catch (PDOException $e) {
            error_log('MensajeModel::mdlMarcarLeido ERROR: ' . $e->getMessage());
            return 'error';
        }
    }

    public static function mdlEliminarMensaje($id) {
        try {
            $stmt = Conexion::conectar()->prepare("DELETE FROM mensajes WHERE id = ?");
            return $stmt->execute([(int)$id]) ? 'ok' : 'error';
        } catch (PDOException $e) {
            error_log('MensajeModel::mdlEliminarMensaje ERROR: ' . $e->getMessage());
            return 'error';
        }
    }
}
?>