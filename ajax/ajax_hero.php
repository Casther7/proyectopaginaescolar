<?php
session_start();
require_once __DIR__ . '/../config/conexion.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titulo    = $_POST['titulo'] ?? '';
    $subtitulo = $_POST['subtitulo'] ?? '';
    $tipo      = $_POST['tipo'] ?? 'imagen'; // 'imagen' o 'video'

    // Validar si viene un archivo
    if (!isset($_FILES['archivo']) || $_FILES['archivo']['error'] !== UPLOAD_ERR_OK) {
        echo json_encode(['status' => 'error', 'message' => 'No se recibió ningún archivo válido.']);
        exit;
    }

    // Configurar la carpeta de destino
    $directorio = "../view/img_banners/";
    if (!file_exists($directorio)) {
        mkdir($directorio, 0777, true);
    }

    // Limpiar el nombre del archivo y moverlo
    $nombreArchivo = time() . "_" . basename($_FILES['archivo']['name']);
    $rutaFinal = "view/img_banners/" . $nombreArchivo;

    if (move_uploaded_file($_FILES['archivo']['tmp_name'], "../" . $rutaFinal)) {
        try {
            $db = Conexion::conectar();
            
            // 1. Borramos el banner hero anterior para que no se acumulen
            $db->exec("DELETE FROM banners WHERE seccion = 'hero'");

            // 2. Insertamos el nuevo
            $stmt = $db->prepare("INSERT INTO banners (seccion, tipo, ruta, titulo, subtitulo) VALUES ('hero', ?, ?, ?, ?)");
            $stmt->execute([$tipo, $rutaFinal, $titulo, $subtitulo]);

            echo json_encode(['status' => 'success', 'message' => 'Banner actualizado correctamente']);
        } catch (PDOException $e) {
            echo json_encode(['status' => 'error', 'message' => 'Error en base de datos: ' . $e->getMessage()]);
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Error al mover el archivo al servidor.']);
    }
}