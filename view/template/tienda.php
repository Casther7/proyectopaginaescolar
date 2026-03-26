<?php
/* Archivo: tienda.php - Incluye Modal de Detalles */
?>
<link rel="stylesheet" href="view/css/tienda.css">

<section class="tienda-contenedor">
    <div class="tienda-grid">
        
        <div class="producto-principal" onclick="abrirModal('Playera Institucional', '$350.00', 'Playera tipo polo con escudo bordado. Disponible en tallas S, M, L y XL. Material 100% algodón.', 'https://i.pinimg.com/736x/6c/b1/99/6cb199c80970b73721408a2b11b65662.jpg', true)">
            <div class="tarjeta-tienda">
                <img src="https://i.pinimg.com/736x/6c/b1/99/6cb199c80970b73721408a2b11b65662.jpg" alt="Playera">
                <div class="info-overlay">
                    <span class="tag">Nuevo</span>
                    <h3>Playera Institucional</h3>
                    <p class="precio">$350.00</p>
                    <span class="btn-ver">Ver detalles</span>
                </div>
            </div>
        </div>

        <div class="producto-mosaico">
            <div class="tarjeta-tienda horizontal" onclick="abrirModal('Sudadera Deportiva', '$550.00', 'Sudadera con capucha y cierre. Ideal para invierno y actividades deportivas.', 'https://i.pinimg.com/1200x/10/8c/ac/108cac2bb1f4e33c37c4e553f4b45547.jpg', true)">
                <img src="https://i.pinimg.com/1200x/10/8c/ac/108cac2bb1f4e33c37c4e553f4b45547.jpg" alt="Sudadera">
                <div class="info-overlay">
                    <h3>Sudadera Deportiva</h3>
                    <p class="precio">$550.00</p>
                    <span class="btn-link">Ver más</span>
                </div>
            </div>

            <div class="fila-inferior">
                <div class="tarjeta-tienda" onclick="abrirModal('Gorra Oficial', '$180.00', 'Gorra ajustable con logo bordado en alta definición.', 'https://i.pinimg.com/1200x/8d/22/bb/8d22bb4217a0ec72d0055e9ab659a02a.jpg', false)">
                    <img src="https://i.pinimg.com/1200x/8d/22/bb/8d22bb4217a0ec72d0055e9ab659a02a.jpg" alt="Gorra">
                    <div class="info-overlay">
                        <h3>Gorra Oficial</h3>
                        <p class="precio">$180.00</p>
                    </div>
                </div>
                <div class="tarjeta-tienda" onclick="abrirModal('Termo Escolar', '$220.00', 'Termo de acero inoxidable. Mantiene bebidas frías o calientes por 12 horas.', 'https://i.pinimg.com/736x/96/63/ed/9663ede9d6a225bfbdabef793f611424.jpg', false)">
                    <img src="https://i.pinimg.com/736x/96/63/ed/9663ede9d6a225bfbdabef793f611424.jpg" alt="Termo">
                    <div class="info-overlay">
                        <h3>Termo Escolar</h3>
                        <p class="precio">$220.00</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

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