<?php
/**
 * ajax/ajax_banners.php
 * Manejo de banners (listar, agregar, eliminar)
 */

session_start();

require_once __DIR__ . '/../model/BannerModel.php';

header('Content-Type: application/json');

/* ── 1. CONSTANTES Y CONFIGURACIÓN ────────────────────────────────────── */

// Configuración de archivos
define('MAX_FILE_SIZE', 10 * 1024 * 1024); // 10MB
define('ALLOWED_EXTENSIONS', ['jpg', 'jpeg', 'png', 'webp', 'gif', 'mp4', 'webm']);
define('VIDEO_EXTENSIONS', ['mp4', 'webm']);
define('IMAGE_EXTENSIONS', ['jpg', 'jpeg', 'png', 'webp', 'gif']);

// Carpeta física absoluta para el servidor
$dirFisico = __DIR__ . '/../view/img_banners/';

// Crear directorio si no existe
if (!file_exists($dirFisico)) {
    if (!mkdir($dirFisico, 0755, true)) {
        respuesta(false, 'No se pudo crear el directorio de uploads.');
    }
}

// Verificar permisos de escritura
if (!is_writable($dirFisico)) {
    respuesta(false, 'El directorio de uploads no tiene permisos de escritura.');
}

/* ── 2. FUNCIONES AUXILIARES ──────────────────────────────────────────── */

/**
 * Envía respuesta JSON y termina la ejecución
 */
function respuesta(bool $ok, string $msg, array $extra = []): void {
    echo json_encode(array_merge(
        [
            'status' => $ok ? 'success' : 'error', 
            'message' => $msg
        ],
        $extra
    ), JSON_UNESCAPED_UNICODE);
    exit;
}

/**
 * Sanitiza y valida una sección
 */
function sanitizarSeccion(string $seccion): string {
    $seccionesPermitidas = ['general', 'home', 'productos', 'servicios', 'contacto'];
    $seccion = trim(strip_tags($seccion));
    
    if (!in_array($seccion, $seccionesPermitidas)) {
        return 'general'; // Valor por defecto seguro
    }
    
    return $seccion;
}

/**
 * Sanitiza texto para evitar XSS
 */
function sanitizarTexto(string $texto): string {
    return htmlspecialchars(trim($texto), ENT_QUOTES, 'UTF-8');
}

/**
 * Valida y procesa el archivo subido
 * 
 * @param array $file Archivo $_FILES
 * @param string $dirFisico Directorio físico donde guardar
 * @return array ['ruta' => string, 'tipo' => string, 'nombre' => string]
 * @throws Exception
 */
function procesarArchivo(array $file, string $dirFisico): array {
    // Verificar que el archivo existe
    if (!isset($file) || $file['error'] === UPLOAD_ERR_NO_FILE) {
        throw new Exception("No se recibió ningún archivo.");
    }
    
    // Verificar error de subida
    if ($file['error'] !== UPLOAD_ERR_OK) {
        $errores = [
            UPLOAD_ERR_INI_SIZE => "El archivo excede el tamaño máximo permitido por el servidor.",
            UPLOAD_ERR_FORM_SIZE => "El archivo excede el tamaño máximo permitido por el formulario.",
            UPLOAD_ERR_PARTIAL => "El archivo solo se subió parcialmente.",
            UPLOAD_ERR_NO_TMP_DIR => "Falta la carpeta temporal.",
            UPLOAD_ERR_CANT_WRITE => "Error al escribir el archivo en el disco.",
            UPLOAD_ERR_EXTENSION => "Extensión de archivo bloqueada."
        ];
        $mensaje = $errores[$file['error']] ?? "Error desconocido al subir el archivo.";
        throw new Exception($mensaje);
    }
    
    // Verificar tamaño
    if ($file['size'] > MAX_FILE_SIZE) {
        throw new Exception("El archivo excede el límite de " . (MAX_FILE_SIZE / 1024 / 1024) . "MB.");
    }
    
    // Validar extensión
    $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
    if (!in_array($ext, ALLOWED_EXTENSIONS)) {
        $extPermitidas = implode(', ', ALLOWED_EXTENSIONS);
        throw new Exception("Formato no permitido. Extensiones permitidas: " . $extPermitidas);
    }
    
    // Validar tipo MIME (capa extra de seguridad)
    $finfo = finfo_open(FILEINFO_MIME_TYPE);
    $mimeType = finfo_file($finfo, $file['tmp_name']);
    finfo_close($finfo);
    
    $mimePermitidos = [
        'image/jpeg', 'image/png', 'image/webp', 'image/gif',
        'video/mp4', 'video/webm'
    ];
    
    if (!in_array($mimeType, $mimePermitidos)) {
        throw new Exception("Tipo de archivo no válido o archivo corrupto.");
    }
    
    // Generar nombre único y seguro
    $nombreArchivo = 'banner_' . uniqid() . '_' . bin2hex(random_bytes(8)) . '.' . $ext;
    $rutaDestinoFisica = $dirFisico . $nombreArchivo;
    
    // Mover archivo
    if (!move_uploaded_file($file['tmp_name'], $rutaDestinoFisica)) {
        throw new Exception("No se pudo guardar el archivo en el servidor.");
    }
    
    // Determinar tipo (basado en extensión, más confiable que MIME)
    $tipo = in_array($ext, VIDEO_EXTENSIONS) ? 'video' : 'imagen';
    
    // Retornar información del archivo
    return [
        'ruta' => "view/img_banners/" . $nombreArchivo,
        'tipo' => $tipo,
        'nombre' => $nombreArchivo
    ];
}

/* ── 3. MANEJO DE ACCIONES ─────────────────────────────────────────────── */

$action = $_POST['action'] ?? $_GET['action'] ?? '';

try {
    switch ($action) {
        
        case 'listar':
            // Obtener lista de banners por sección
            $seccion = $_GET['seccion'] ?? '';
            $seccion = sanitizarSeccion($seccion);
            
            $banners = BannerModel::mdlMostrarBanners($seccion);
            
            if (!is_array($banners)) {
                throw new Exception("Error al obtener los banners.");
            }
            
            respuesta(true, 'Lista obtenida correctamente.', ['banners' => $banners]);
            break;
        
        case 'agregar':
            // Validar sesión (opcional, descomentar si se necesita autenticación)
            // if (!isset($_SESSION['usuario_id'])) {
            //     respuesta(false, 'No autorizado.');
            // }
            
            // Obtener y sanitizar datos
            $seccion   = sanitizarSeccion($_POST['seccion'] ?? 'general');
            $titulo    = sanitizarTexto($_POST['titulo'] ?? '');
            $subtitulo = sanitizarTexto($_POST['subtitulo'] ?? '');
            $archivo   = $_FILES['archivo'] ?? null;
            
            // Validar campos obligatorios
            if (!$archivo) {
                respuesta(false, 'No se recibió ningún archivo.');
            }
            
            // Procesar archivo
            $archivoInfo = procesarArchivo($archivo, $dirFisico);
            
            // Preparar datos para el modelo
            $datos = [
                'seccion'   => $seccion,
                'titulo'    => $titulo,
                'subtitulo' => $subtitulo,
                'ruta'      => $archivoInfo['ruta'],
                'tipo'      => $archivoInfo['tipo']
            ];
            
            // Guardar en base de datos
            $res = BannerModel::mdlAgregarBanner($datos);
            
            if ($res === 'ok') {
                respuesta(true, '¡Banner guardado con éxito!', [
                    'banner' => $datos
                ]);
            } else {
                // Si falla la BD, eliminar el archivo subido
                if (file_exists($dirFisico . $archivoInfo['nombre'])) {
                    unlink($dirFisico . $archivoInfo['nombre']);
                }
                throw new Exception('Error al guardar en la base de datos: ' . $res);
            }
            break;
        
        case 'eliminar':
            // Validar ID
            $id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
            
            if (!$id || $id <= 0) {
                respuesta(false, 'ID no válido.');
            }
            
            // Eliminar banner (el modelo debería encargarse de borrar el archivo)
            $resultado = BannerModel::mdlEliminarBanner($id, __DIR__ . '/../');
            
            if ($resultado === 'ok') {
                respuesta(true, 'Banner eliminado correctamente.');
            } else {
                throw new Exception('No se pudo eliminar el banner: ' . $resultado);
            }
            break;
        
        default:
            respuesta(false, 'Acción no reconocida: ' . htmlspecialchars($action));
            break;
    }
    
} catch (Exception $e) {
    // Manejo centralizado de errores
    error_log("Error en ajax_banners.php: " . $e->getMessage());
    respuesta(false, $e->getMessage());
}
?>