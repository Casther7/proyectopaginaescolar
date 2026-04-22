<?php
// Importamos el modelo de contacto para usar la función de actualización
require_once "model/ContactoModel.php";

if(isset($_POST["action"]) && $_POST["action"] == "actualizar"){

    $datos = array(
        "telefono"  => $_POST["telefono"],
        "correo"    => $_POST["correo"],
        "horario"   => $_POST["horario"],
        "ubicacion" => $_POST["ubicacion"]
    );

    // Ejecutamos la actualización en el modelo
    $respuesta = ContactoModel::mdlActualizarContacto($datos);

    echo $respuesta; // Esto envía "ok" de vuelta al JavaScript si todo sale bien
}