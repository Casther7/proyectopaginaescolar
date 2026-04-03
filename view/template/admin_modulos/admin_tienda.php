<?php
require_once "config/conexion.php";
$db = Conexion::conectar();
$stmt = $db->prepare("SELECT * FROM productos");
$stmt->execute();
$productos = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<link rel="stylesheet" href="view/css/admin_tienda.css">
<div id="vista-tienda">
    <div class="header-tienda">
        <h1>🛒 Gestión de Inventario</h1>
        <p style="color: #64748b;">Administra los productos de la tienda escolar</p>
    </div>


    <div class="tabla-container">
        <table class="tabla-productos">
            <thead>
                <tr>
                    <th>Vista previa</th>
                    <th>Información</th>
                    <th>Inventario</th>
                    <th>Precio</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($productos as $p): ?>
                <tr>
                    <td>
                        <img src="<?= $p['imagen'] ?>" class="img-tabla">
                    </td>
                    <td>
                        <div style="font-weight: bold; color: #0e1b38;"><?= $p['nombre'] ?></div>
                        <div style="font-size: 0.85rem; color: #64748b;">Tallas: <?= $p['tallas'] ?: 'N/A' ?></div>
                    </td>
                    <td>
                        <span style="padding: 5px 10px; background: #e2e8f0; border-radius: 5px; font-size: 0.9rem;">
                            <?= $p['stock'] ?> unidades
                        </span>
                    </td>
                    <td style="font-weight: bold; font-size: 1.1rem; color: #2ecc71;">
                        $<?= number_format($p['precio'], 2) ?>
                    </td>
                    <td>
                        <button class="btn-editar" 
                                data-id="<?= $p['id'] ?>"
                                data-nombre="<?= $p['nombre'] ?>"
                                data-stock="<?= $p['stock'] ?>"
                                data-precio="<?= $p['precio'] ?>"
                                data-tallas="<?= $p['tallas'] ?>"
                                data-imagen="<?= $p['imagen'] ?>">
                            🔧 Editar
                        </button>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<div id="modalPersonalizado" class="modal-overlay" style="display: none;">
    <div class="modal-content-custom">
        <form action="/proyectopaginaescolar/ajax/agregar_producto.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="id" id="edit-id">
            
            <div class="modal-body-custom">
                <div style="text-align:center;">
                    <img id="edit-preview" src="" style="width:80px; height:80px; object-fit:cover; border-radius:10px;">
                    <input type="file" name="imagen" style="display:block; margin: 10px auto;">
                </div>

                <div class="input-group">
                    <label>Nombre</label>
                    <input type="text" name="nombre" id="edit-nombre" required>
                </div>

                <div class="input-group">
                    <label>Tallas (Separadas por comas)</label>
                    <input type="text" name="tallas" id="edit-tallas">
                </div>

                <div style="display:flex; gap:10px;">
                    <div class="input-group">
                        <label>Stock</label>
                        <input type="number" name="stock" id="edit-stock">
                    </div>
                    <div class="input-group">
                        <label>Precio</label>
                        <input type="text" name="precio" id="edit-precio">
                    </div>
                </div>
            </div>

            <div class="modal-footer-custom">
                <button type="button" onclick="cerrarModal()">Cancelar</button>
                <button type="submit" class="btn-guardar">Actualizar Producto</button>
            </div>
        </form>
    </div>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="view/js/admin_tienda.js"></script>
</div>
