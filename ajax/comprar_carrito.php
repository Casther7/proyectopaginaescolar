<?php
require_once "../config/conexion.php";

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Obtener los datos del carrito
    $input = json_decode(file_get_contents('php://input'), true);
    
    // Si viene como POST normal (form data)
    if (isset($_POST['carrito'])) {
        $carrito = json_decode($_POST['carrito'], true);
    } 
    // Si viene como JSON puro
    else if ($input && isset($input['carrito'])) {
        $carrito = $input['carrito'];
    }
    else {
        echo json_encode([
            "status" => "error",
            "message" => "No se recibió el carrito"
        ]);
        exit;
    }

    // Validar que el carrito no esté vacío
    if (empty($carrito)) {
        echo json_encode([
            "status" => "error",
            "message" => "El carrito está vacío"
        ]);
        exit;
    }

    try {
        $db = Conexion::conectar();
        
        // Iniciar transacción
        $db->beginTransaction();

        foreach ($carrito as $item) {
            // Validar que el item tenga los campos necesarios
            if (!isset($item['id']) && !isset($item['nombre'])) {
                // Si no tiene ID, buscar por nombre
                $stmt = $db->prepare("SELECT id, stock, nombre FROM productos WHERE nombre = :nombre");
                $stmt->bindParam(":nombre", $item['nombre']);
                $stmt->execute();
                $producto = $stmt->fetch(PDO::FETCH_ASSOC);
                
                if (!$producto) {
                    throw new Exception("Producto no encontrado: " . $item['nombre']);
                }
                
                $id = $producto['id'];
                $stockActual = $producto['stock'];
                $nombreProducto = $producto['nombre'];
            } else {
                $id = $item['id'];
                // Obtener stock actual
                $stmt = $db->prepare("SELECT stock, nombre FROM productos WHERE id = :id");
                $stmt->bindParam(":id", $id);
                $stmt->execute();
                $producto = $stmt->fetch(PDO::FETCH_ASSOC);
                
                if (!$producto) {
                    throw new Exception("Producto no encontrado con ID: " . $id);
                }
                
                $stockActual = $producto['stock'];
                $nombreProducto = $producto['nombre'];
            }
            
            $cantidad = $item['cantidad'];
            
            // Verificar stock suficiente
            if ($stockActual < $cantidad) {
                throw new Exception("Stock insuficiente para '{$nombreProducto}'. Disponible: {$stockActual}, Solicitado: {$cantidad}");
            }
            
            // Descontar stock
            $update = $db->prepare("
                UPDATE productos 
                SET stock = stock - :cantidad 
                WHERE id = :id
            ");
            
            $update->bindParam(":cantidad", $cantidad);
            $update->bindParam(":id", $id);
            $update->execute();
        }
        
        // Confirmar transacción
        $db->commit();
        
        echo json_encode([
            "status" => "success",
            "message" => "Compra realizada correctamente"
        ]);
        
    } catch (Exception $e) {
        // Revertir transacción en caso de error
        if ($db->inTransaction()) {
            $db->rollBack();
        }
        
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