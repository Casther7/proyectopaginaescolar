<?php
require_once "../config/conexion.php";

header('Content-Type: application/json');

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $stock = $_POST['stock'];
    $precio = $_POST['precio'];
    $tallas = $_POST['tallas'];

    try {
        $db = Conexion::conectar();

        if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] == 0) {
            $nombre_archivo = time() . "_" . $_FILES['imagen']['name'];
            $ruta_fisica = "../view/img_tienda/" . $nombre_archivo;
            $ruta_db = "view/img_tienda/" . $nombre_archivo;

            move_uploaded_file($_FILES['imagen']['tmp_name'], $ruta_fisica);

            $sql = "UPDATE productos 
                    SET nombre = :nom, stock = :stk, precio = :pre, tallas = :tal, imagen = :img 
                    WHERE id = :id";

            $stmt = $db->prepare($sql);
            $stmt->bindParam(":img", $ruta_db);

        } else {
            $sql = "UPDATE productos 
                    SET nombre = :nom, stock = :stk, precio = :pre, tallas = :tal 
                    WHERE id = :id";

            $stmt = $db->prepare($sql);
        }

        $stmt->bindParam(":nom", $nombre);
        $stmt->bindParam(":stk", $stock);
        $stmt->bindParam(":pre", $precio);
        $stmt->bindParam(":tal", $tallas);
        $stmt->bindParam(":id", $id);

        $stmt->execute();

        echo json_encode([
            "status" => "success",
            "message" => "Producto actualizado correctamente"
        ]);

    } catch (Exception $e) {
        echo json_encode([
            "status" => "error",
            "message" => $e->getMessage()
        ]);
    }
}

