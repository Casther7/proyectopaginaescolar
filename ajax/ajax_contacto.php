<?php
// ajax_contacto.php
require_once "../model/ContactoModel.php";
require_once "../config/conexion.php";

if(isset($_POST["action"]) && ($_POST["action"] == "actualizar" || $_POST["action"] == "actualizarContacto")){

    $datos = array(
        "telefono"  => $_POST["telefono"],
        "correo"    => $_POST["correo"],
        "horario"   => $_POST["horario"],
        "ubicacion" => $_POST["ubicacion"],
        "mapa"      => isset($_POST["mapa"]) ? $_POST["mapa"] : "" 
    );

    // Ejecutamos la actualización
    $respuesta = ContactoModel::mdlActualizarContacto($datos);

    // Devolvemos el texto plano para que el JS (res.trim() === "ok") lo entienda
    echo $respuesta; 
}