<?php
require_once "../model/ContactoModel.php";

if (isset($_POST["accion"]) && $_POST["accion"] == "actualizar_contacto") {
    
    $datos = array(
        "telefono"  => $_POST["telefono"],
        "correo"    => $_POST["correo"],
        "horario"   => $_POST["horario"],
        "ubicacion" => $_POST["ubicacion"]
    );

    // Llamamos al método del modelo (Asegúrate que el nombre coincida con tu ContactoModel.php)
    $respuesta = ContactoModel::mdlActualizarContacto($datos);

    echo $respuesta; // Debería devolver "ok" o un error
}