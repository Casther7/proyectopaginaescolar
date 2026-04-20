<?php
require_once __DIR__ . '/../model/OfertaModel.php';
header('Content-Type: application/json');

$action = $_POST['action'] ?? $_GET['action'] ?? '';

if ($action == 'agregar') {
    $dir = "../view/img_oferta/";
    if (!file_exists($dir)) { mkdir($dir, 0777, true); }

    // 1. Procesar Imagen Principal
    $nombreImg = time() . "_principal_" . $_FILES['archivo_principal']['name'];
    move_uploaded_file($_FILES['archivo_principal']['tmp_name'], $dir . $nombreImg);
    $rutaPrincipal = "view/img_oferta/" . $nombreImg;

    // 2. Procesar Galería (múltiples)
    $rutasGaleria = [];
    if(isset($_FILES['galeria'])) {
        foreach($_FILES['galeria']['tmp_name'] as $key => $tmp_name) {
            $nombreGal = time() . "_gal_" . $_FILES['galeria']['name'][$key];
            move_uploaded_file($tmp_name, $dir . $nombreGal);
            $rutasGaleria[] = "view/img_oferta/" . $nombreGal;
        }
    }
    $stringGaleria = implode(",", $rutasGaleria); // Convertimos el array a "ruta1,ruta2,ruta3"

    // 3. Guardar en BD
    $datos = [
        'nivel'             => $_POST['nivel'],
        'titulo'            => $_POST['titulo'],
        'descripcion_corta' => $_POST['desc_corta'], // Asegúrate que sea desc_corta
        'imagen_principal'  => $rutaPrincipal,
        'imagenes_galeria'  => $stringGaleria,
        'mision'            => $_POST['mision'],
        'vision'            => $_POST['vision'],
        'objetivo'          => $_POST['objetivo'],
        'perfil_egreso'     => $_POST['perfil'],
        'campo_laboral'     => $_POST['campo']
    ];

    $res = OfertaModel::mdlGuardarOferta($datos);
    echo json_encode(['status' => ($res == 'ok' ? 'success' : 'error')]);
}

if ($action == 'listar') {
    echo json_encode(['status' => 'success', 'ofertas' => OfertaModel::mdlListarOfertas()]);
}

if ($action == 'eliminar') {
    $res = OfertaModel::mdlEliminarOferta($_POST['id']);
    echo json_encode(['status' => ($res == 'ok' ? 'success' : 'error')]);
}