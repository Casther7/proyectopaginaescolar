<?php
/**
 * ajax/ajax_informacion.php
 */

session_start();
require_once __DIR__ . '/../model/InformacionModel.php';

header('Content-Type: application/json');

function respuesta(bool $ok, string $msg, array $extra = []): void {
    echo json_encode(array_merge(
        ['status' => $ok ? 'success' : 'error', 'message' => $msg],
        $extra
    ));
    exit;
}

// Verificar si hay una acción definida
$action = $_POST['action'] ?? $_GET['action'] ?? '';

try {
    switch ($action) {

        case 'obtener':
            $slug = $_GET['slug'] ?? '';
            $info = InformacionModel::mdlObtenerInformacion($slug);
            if ($info) {
                respuesta(true, 'Datos obtenidos.', ['datos' => $info]);
            } else {
                respuesta(false, 'No se encontró la información.');
            }
            break;

        case 'actualizar':
            // Validar que el usuario tenga sesión (opcional pero recomendado)
            if (!isset($_SESSION["accesoAdmin"]) && !isset($_SESSION["usuarioLogueado"])) {
                respuesta(false, 'Sesión no válida.');
            }

            $slug = $_POST['slug'] ?? '';
            $datos = [
                'titulo'    => $_POST['titulo'] ?? '',
                'contenido' => $_POST['contenido'] ?? ''
            ];

            if (empty($slug) || empty($datos['contenido'])) {
                respuesta(false, 'El contenido no puede estar vacío.');
            }

            $res = InformacionModel::mdlActualizarInformacion($slug, $datos);
            
            if ($res === "ok") {
                respuesta(true, '¡Información actualizada con éxito!');
            } else {
                respuesta(false, 'Error al actualizar en la base de datos.');
            }
            break;

        case 'listar_seccion':
            $seccion = $_GET['seccion'] ?? 'nosotros';
            $lista = InformacionModel::mdlListarPorSeccion($seccion);
            respuesta(true, 'Lista obtenida.', ['lista' => $lista]);
            break;

        default:
            respuesta(false, 'Acción no reconocida.');
            break;
    }

} catch (Exception $e) {
    respuesta(false, 'Error en el servidor: ' . $e->getMessage());
}