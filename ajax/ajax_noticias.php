<?php
require_once __DIR__ . '/../model/NoticiaModel.php';
header('Content-Type: application/json');

$action = $_POST['action'] ?? $_GET['action'] ?? '';

if ($action == 'agregar') {
    $directorio = "../view/img_noticias/";
    if (!file_exists($directorio)) { mkdir($directorio, 0777, true); }

    $nombreArchivo = time() . "_" . $_FILES['archivo']['name'];
    $rutaFinal = "view/img_noticias/" . $nombreArchivo;

    if (move_uploaded_file($_FILES['archivo']['tmp_name'], "../" . $rutaFinal)) {
        $datos = [
            'titulo' => $_POST['titulo'],
            'descripcion' => $_POST['descripcion'],
            'categoria' => $_POST['categoria'],
            'fecha' => $_POST['fecha'],
            'imagen' => $rutaFinal
        ];
        $res = NoticiaModel::mdlGuardarNoticia($datos);
        echo json_encode(['status' => ($res == 'ok' ? 'success' : 'error')]);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Error al subir imagen']);
    }
}

if ($action == 'listar') {
    echo json_encode(['status' => 'success', 'noticias' => NoticiaModel::mdlListarNoticias()]);
}

if ($action == 'eliminar') {
    $res = NoticiaModel::mdlEliminarNoticia($_POST['id']);
    echo json_encode(['status' => ($res == 'ok' ? 'success' : 'error')]);
}