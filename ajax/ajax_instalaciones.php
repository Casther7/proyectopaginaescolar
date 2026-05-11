<?php
require_once "../model/InstalacionesModel.php";

if (isset($_GET["action"]) && $_GET["action"] == "listar") {
    $categoria = $_GET["seccion"]; // laboratorios, deportes, etc.
    $respuesta = ModeloInstalaciones::mdlMostrarGaleria($categoria);

    if (count($respuesta) > 0) {
        echo json_encode(["status" => "success", "banners" => $respuesta]);
    } else {
        echo json_encode(["status" => "empty", "banners" => []]);
    }
}