<?php
require_once "../config/conexion.php";

header('Content-Type: application/json');

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $carrito = json_decode($_POST['carrito'], true);

    try {
        $db = Conexion::conectar();

        foreach ($carrito as $item) {

            $id = $item['id'];
            $cantidad = $item['cantidad'];

            // 🔍 Verificar stock
            $stmt = $db->prepare("SELECT stock FROM productos WHERE id = :id");
            $stmt->bindParam(":id", $id);
            $stmt->execute();

            $producto = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!$producto || $producto['stock'] < $cantidad) {
                echo json_encode([
                    "status" => "error",
                    "message" => "Stock insuficiente en uno de los productos"
                ]);
                exit;
            }

            // 🔥 Descontar stock
            $update = $db->prepare("
                UPDATE productos 
                SET stock = stock - :cantidad 
                WHERE id = :id
            ");

            $update->bindParam(":cantidad", $cantidad);
            $update->bindParam(":id", $id);
            $update->execute();
        }

        echo json_encode([
            "status" => "success",
            "message" => "Compra realizada correctamente"
        ]);

    } catch (Exception $e) {
        echo json_encode([
            "status" => "error",
            "message" => $e->getMessage()
        ]);
    }
}