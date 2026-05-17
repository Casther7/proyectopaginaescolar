<?php
// ajax_instalaciones.php
require_once "../model/InstalacionesModel.php";

// --- PARTE PARA LISTAR (GET) ---
if (isset($_GET["action"]) && $_GET["action"] == "listar") {
    $categoria = $_GET["seccion"];
    $respuesta = ModeloInstalaciones::mdlMostrarGaleria($categoria);
    echo json_encode(count($respuesta) > 0 ? ["status" => "success", "banners" => $respuesta] : ["status" => "empty", "banners" => []]);
}

// --- PARTE PARA GUARDAR (POST) ---
if (isset($_POST["action"]) && $_POST["action"] == "agregar") {
    
    // Subir la imagen primero
    if(isset($_FILES["archivo"])){
        $nombreArchivo = "inst_" . time() . "_" . $_FILES["archivo"]["name"];
        $rutaDestino = "../view/img_banners/" . $nombreArchivo;
        
        if(move_uploaded_file($_FILES["archivo"]["tmp_name"], $rutaDestino)){
            // Si la foto se movió bien, guardamos en la BD
            $datos = array(
                "seccion" => $_POST["seccion"],
                "titulo" => $_POST["titulo"],
                "subtitulo" => $_POST["subtitulo"],
                "ruta" => "view/img_banners/" . $nombreArchivo, // Ruta para la web
                "tipo" => "imagen"
            );

            // Llamamos a una función para insertar (debes crearla en tu Modelo)
            $respuesta = ModeloInstalaciones::mdlGuardarInstalacion($datos);
            
            if($respuesta == "ok"){
                echo json_encode(["status" => "success"]);
            } else {
                echo json_encode(["status" => "error", "message" => "Error al insertar en BD"]);
            }
        } else {
            echo json_encode(["status" => "error", "message" => "No se pudo subir la imagen"]);
        }
    }
}