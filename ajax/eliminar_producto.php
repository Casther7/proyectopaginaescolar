<?php
// ajax/eliminar_producto.php
require_once "../config/conexion.php";

header('Content-Type: application/json');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $id = $_POST['id'];
    
    if (empty($id)) {
        echo json_encode([
            "status" => "error",
            "message" => "ID de producto no proporcionado"
        ]);
        exit;
    }
    
    try {
        $db = Conexion::conectar();
        
        // Primero obtener la imagen para eliminarla del servidor
        $stmt = $db->prepare("SELECT imagen FROM productos WHERE id = :id");
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        $producto = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if (!$producto) {
            echo json_encode([
                "status" => "error",
                "message" => "Producto no encontrado"
            ]);
            exit;
        }
        
        // Eliminar la imagen física si existe
        if ($producto['imagen']) {
            $ruta_imagen = "../" . $producto['imagen'];
            if (file_exists($ruta_imagen)) {
                unlink($ruta_imagen); // Eliminar archivo de imagen
            }
        }
        
        // Eliminar el producto de la base de datos
        $stmt = $db->prepare("DELETE FROM productos WHERE id = :id");
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        
        echo json_encode([
            "status" => "success",
            "message" => "Producto eliminado correctamente"
        ]);
        
    } catch (Exception $e) {
        echo json_encode([
            "status" => "error",
            "message" => $e->getMessage()
        ]);
    }
} else {
    echo json_encode([
        "status" => "error",
        "message" => "Método no permitido"
    ]);
}
?>