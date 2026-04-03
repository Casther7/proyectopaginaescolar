<?php
require_once "../config/conexion.php";

header('Content-Type: application/json');

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nombre = $_POST['nombre'];
    $tallas = $_POST['tallas'];
    $stock = $_POST['stock'];
    $precio = $_POST['precio'];

    try {
        $db = Conexion::conectar();

        // Imagen
        $nombre_archivo = time() . "_" . $_FILES['imagen']['name'];
        $ruta_fisica = "../view/img_tienda/" . $nombre_archivo;
        $ruta_db = "view/img_tienda/" . $nombre_archivo;

        move_uploaded_file($_FILES['imagen']['tmp_name'], $ruta_fisica);

        // Insert
        $sql = "INSERT INTO productos (nombre, tallas, stock, precio, imagen)
                VALUES (:nom, :tal, :stk, :pre, :img)";

        $stmt = $db->prepare($sql);

        $stmt->bindParam(":nom", $nombre);
        $stmt->bindParam(":tal", $tallas);
        $stmt->bindParam(":stk", $stock);
        $stmt->bindParam(":pre", $precio);
        $stmt->bindParam(":img", $ruta_db);

        $stmt->execute();

        echo json_encode([
            "status" => "success"
        ]);

    } catch (Exception $e) {
        echo json_encode([
            "status" => "error",
            "message" => $e->getMessage()
        ]);
    }
}