<?php
// view/template/admin_modulos/actualizar_producto.php
require_once "../config/conexion.php"; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $stock = $_POST['stock'];
    $precio = $_POST['precio'];
    $tallas = $_POST['tallas'];
    
    try {
        $db = Conexion::conectar();
        
        // Verificamos si se subió una nueva imagen
        if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] == 0) {
            $nombre_archivo = time() . "_" . $_FILES['imagen']['name'];
            $ruta_fisica = "../../../view/img_tienda/" . $nombre_archivo;
            $ruta_db = "view/img_tienda/" . $nombre_archivo;

            if (move_uploaded_file($_FILES['imagen']['tmp_name'], $ruta_fisica)) {
                $sql = "UPDATE productos SET nombre = :nom, stock = :stk, precio = :pre, tallas = :tal, imagen = :img WHERE id = :id";
                $stmt = $db->prepare($sql);
                $stmt->bindParam(":img", $ruta_db);
            }
        } else {
            // Actualización sin cambiar la imagen
            $sql = "UPDATE productos SET nombre = :nom, stock = :stk, precio = :pre, tallas = :tal WHERE id = :id";
            $stmt = $db->prepare($sql);
        }

        $stmt->bindParam(":nom", $nombre);
        $stmt->bindParam(":stk", $stock);
        $stmt->bindParam(":pre", $precio);
        $stmt->bindParam(":tal", $tallas);
        $stmt->bindParam(":id", $id);

        if ($stmt->execute()) {
            header("Location: ../../../index.php?ruta=admin&res=ok");
        }
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }
}