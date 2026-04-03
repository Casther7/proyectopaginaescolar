<?php
/* Archivo: tienda.php */
require_once "config/conexion.php"; 

// Conectamos y traemos los productos
$db = Conexion::conectar();
$stmt = $db->prepare("SELECT * FROM productos");
$stmt->execute();
$productos = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<link rel="stylesheet" href="view/css/tienda.css">

<section class="tienda-contenedor">
    <div class="tienda-grid">
        
        <?php foreach ($productos as $indice => $prod): ?>
            <?php 
                // Determinamos si es el producto principal (el primero del array)
                // o si va al mosaico lateral
                $claseTarjeta = ($indice === 0) ? "producto-principal" : "tarjeta-tienda";
                
                // Preparamos los datos para el modal de JS
                // Escapamos comillas para evitar errores en el onClick
                $nombreJS = htmlspecialchars($prod['nombre'], ENT_QUOTES);
                $precioJS = "$" . number_format($prod['precio'], 2);
                $tallasJS = htmlspecialchars($prod['tallas'], ENT_QUOTES);
                $tieneTalla = !empty($prod['tallas']) ? 'true' : 'false';
            ?>

            <?php if ($indice === 0): ?>
                <div class="producto-principal" onclick="abrirModal('<?= $nombreJS ?>', '<?= $precioJS ?>', 'Producto escolar de alta calidad.', '<?= $prod['imagen'] ?>', <?= $tieneTalla ?>)">
                    <div class="tarjeta-tienda">
                        <img src="<?= $prod['imagen'] ?>" alt="<?= $nombreJS ?>">
                        <div class="info-overlay">
                            <span class="tag">Nuevo</span>
                            <h3><?= $prod['nombre'] ?></h3>
                            <p class="precio">$<?= number_format($prod['precio'], 2) ?></p>
                            <span class="btn-ver">Ver detalles</span>
                        </div>
                    </div>
                </div>
                <div class="producto-mosaico"> <?php else: ?>
                <div class="<?= $claseTarjeta ?>" onclick="abrirModal('<?= $nombreJS ?>', '<?= $precioJS ?>', 'Accesorio oficial.', '<?= $prod['imagen'] ?>', <?= $tieneTalla ?>)">
                    <img src="<?= $prod['imagen'] ?>" alt="<?= $nombreJS ?>">
                    <div class="info-overlay">
                        <h3><?= $prod['nombre'] ?></h3>
                        <p class="precio">$<?= number_format($prod['precio'], 2) ?></p>
                    </div>
                </div>
            <?php endif; ?>

        <?php endforeach; ?>
        
        </div> </div>
</section>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="view/js/tienda.js"></script>
<div id="modalProducto" class="modal-fondo">
    <div class="modal-contenido">
        <span class="cerrar-modal" onclick="cerrarModal()">&times;</span>
        <div class="modal-flex">
            <div class="modal-imagen">
                <img id="imgModal" src="" alt="">
            </div>
            <div class="modal-info">
                <h2 id="tituloModal"></h2>
                <p id="precioModal" class="modal-precio"></p>
                <hr>
                <p id="descModal" class="modal-descripcion"></p>
                
                <div class="opciones-compra">
                    <div class="fila-cantidad">
                        <label>Cantidad:</label>
                        <input type="number" value="1" min="1">
                    </div>
                    <button class="btn-comprar" onclick="agregarAlCarrito()">Agregar al carrito</button>
                </div>
                <div class="tallas-container">
                    <button class="talla-btn" data-talla="XS">XCH (XS)</button>
                    <button class="talla-btn" data-talla="CH">CH (S)</button>
                    <button class="talla-btn" data-talla="M">M (M)</button>
                    <button class="talla-btn" data-talla="G">G (L)</button>
                    <button class="talla-btn" data-talla="XG">XG (XL)</button>
                </div>

                <input type="hidden" id="tallaSeleccionada">
            </div>
        </div>
    </div>
</div>

<div id="carrito-lateral" class="carrito-sidebar">
    <div class="carrito-header">
        <h3>Tu Carrito</h3>
        <span class="cerrar-carrito" onclick="toggleCarrito()">&times;</span>
    </div>
    <div id="lista-carrito" class="carrito-cuerpo">
        <p class="carrito-vacio">Tu carrito está vacío.</p>
    </div>
    <div class="carrito-footer">
        <p><strong>Total:</strong> $<span id="total-carrito">0.00</span></p>
        <button class="btn-pagar" onclick="abrirModalPago()">Finalizar Compra</button>
    </div>
</div>

<div id="modalPago" class="modal-fondo">
    <div class="modal-contenido">
        <span class="cerrar-modal" onclick="cerrarModalPago()">&times;</span>
        
        <h2>Método de Pago</h2>

        <div class="opciones-pago">
            <button onclick="seleccionarPago('Tarjeta')">💳 Tarjeta</button>
            <button onclick="seleccionarPago('Efectivo')">💵 Efectivo</button>
            <button onclick="seleccionarPago('Transferencia')">🏦 Transferencia</button>
        </div>

        <p id="metodoSeleccionado"></p>

        <button class="btn-comprar" onclick="confirmarCompra()">Confirmar Compra</button>
    </div>
</div>