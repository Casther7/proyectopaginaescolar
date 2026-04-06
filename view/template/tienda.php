<?php
require_once "config/conexion.php"; 

// Conectamos y traemos los productos
$db = Conexion::conectar();
$stmt = $db->prepare("SELECT * FROM productos");
$stmt->execute();
$productos = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<link rel="stylesheet" href="view/css/tienda.css">

<!-- ========================================= -->
<!-- HERO BANNER / CARRUSEL PROMOCIONAL        -->
<!-- ========================================= -->
<section class="hero-banner">
    <div class="hero-slider">
        <!-- Slide 1 - Promoción de productos -->
        <div class="hero-slide active" style="background-image: linear-gradient(135deg, #0a192f 0%, #1a2a4a 100%);">
            <div class="hero-overlay"></div>
            <div class="hero-content">
                <div class="hero-text">
                    <span class="hero-badge">🔥 OFERTA ESPECIAL</span>
                    <h1>Hasta <span class="highlight">30%</span> de descuento</h1>
                    <p>En uniformes, útiles y accesorios escolares</p>
                    <div class="hero-features">
                        <span>✓ Hasta 18 MSI</span>
                        <span>✓ Envío gratis</span>
                        <span>✓ Garantía Suburbia</span>
                    </div>
                    <button class="hero-btn" onclick="document.querySelector('.productos-grid').scrollIntoView({behavior: 'smooth'})">
                        Comprar ahora →
                    </button>
                </div>
                <div class="hero-image">
                    <img src="view/img_tienda/sudadera_carrusel.png" alt="Productos escolares" onerror="this.src='https://placehold.co/400x400/0a192f/white?text=Productos'">
                </div>
            </div>
        </div>


        <!-- Slide 2 - Estudiantes felices -->
        <div class="hero-slide" style="background-image: linear-gradient(135deg, #1a472a 0%, #0d2818 100%);">
            <div class="hero-overlay"></div>
            <div class="hero-content">
                <div class="hero-text">
                    <span class="hero-badge">🎓 COMUNIDAD</span>
                    <h1>Estudiantes <span class="highlight">excelencia</span></h1>
                    <p>Más de 500 estudiantes confían en nuestra tienda escolar</p>
                    <div class="hero-features">
                        <span>✓ Calidad garantizada</span>
                        <span>✓ Precios justos</span>
                        <span>✓ Atención personalizada</span>
                    </div>
                    <button class="hero-btn" onclick="document.querySelector('.productos-grid').scrollIntoView({behavior: 'smooth'})">
                        Ver productos →
                    </button>
                </div>
                <div class="hero-image">
                    <img src="view/img_tienda/Estudiantes.png" alt="Estudiantes felices" onerror="this.src='https://placehold.co/400x400/1a472a/white?text=Estudiantes'">
                </div>
            </div>
        </div>

        <!-- Slide 3 - Nuevos productos -->
        <div class="hero-slide" style="background-image: linear-gradient(135deg, #4312557e 0%, #69256fcc 100%);">
            <div class="hero-overlay"></div>
            <div class="hero-content">
                <div class="hero-text">
                    <span class="hero-badge">🆕 NUEVA COLECCIÓN</span>
                    <h1>Lleva tu <span class="highlight">estilo</span> al máximo</h1>
                    <p>Productos exclusivos para la comunidad escolar</p>
                    <div class="hero-features">
                        <span>✓ Envío rápido</span>
                        <span>✓ Devoluciones sin condiciones</span>
                        <span>✓ Soporte 24/7</span>
                    </div>
                    <button class="hero-btn" onclick="document.querySelector('.productos-grid').scrollIntoView({behavior: 'smooth'})">
                        Explorar colección →
                    </button>
                </div>
                <div class="hero-image">
                    <img src="view/img_tienda/1775436093_Libro.jpg" alt="Nuevos productos" onerror="this.src='https://placehold.co/400x400/8B4513/white?text=Nuevos'">
                </div>
            </div>
        </div>
    </div>

    <!-- Controles del carrusel -->
    <button class="slider-btn prev" onclick="cambiarSlide(-1)">&#10094;</button>
    <button class="slider-btn next" onclick="cambiarSlide(1)">&#10095;</button>
    
    <!-- Indicadores -->
    <div class="slider-dots">
        <span class="dot active" onclick="irASlide(0)"></span>
        <span class="dot" onclick="irASlide(1)"></span>
        <span class="dot" onclick="irASlide(2)"></span>
    </div>
</section>

<!-- Banner de garantía -->
<div class="garantia-banner">
    <div class="garantia-item">
        <span class="garantia-icono">🛡️</span>
        <div>
            <strong>Con Garantía Escolar</strong>
            <small>Tienes devoluciones sin condiciones</small>
        </div>
    </div>
    <div class="garantia-item">
        <span class="garantia-icono">🚚</span>
        <div>
            <strong>Envío gratis</strong>
            <small>En compras mayores a $500</small>
        </div>
    </div>
    <div class="garantia-item">
        <span class="garantia-icono">💳</span>
        <div>
            <strong>Hasta 18 MSI</strong>
            <small>Con tarjetas participantes</small>
        </div>
    </div>
</div>

<!-- Botón flotante de inicio -->
<a href="/proyectopaginaescolar/index.php" class="btn-inicio-flotante" title="Volver al inicio">
    <svg class="icono-casa" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2h-5v-8H7v8H2a2 2 0 0 1-2-2z"/>
        <polyline points="9 22 9 12 15 12 15 22"/>
    </svg>
    <span>Inicio</span>
</a>

<!-- ========================================= -->
<!-- SECCIÓN DE PRODUCTOS                     -->
<!-- ========================================= -->
<section class="tienda-contenedor">
    <div class="tienda-header">
        <h1>🛍️ Nuestros productos</h1>
        <p>Encuentra los mejores productos para tu día a día</p>
    </div>

    <div class="productos-grid">
        <?php foreach ($productos as $indice => $prod): 
            $nombreJS = htmlspecialchars($prod['nombre'], ENT_QUOTES);
            $precioJS = "$" . number_format($prod['precio'], 2);
            $tieneTalla = !empty($prod['tallas']);
        ?>
            <div class="producto-card" onclick="abrirModal('<?= $nombreJS ?>', '<?= $precioJS ?>', '<?= htmlspecialchars($prod['descripcion'] ?? 'Producto de alta calidad para la comunidad escolar.') ?>', '<?= $prod['imagen'] ?>', <?= $tieneTalla ? 'true' : 'false' ?>, <?= $prod['id'] ?>)">
                <?php if ($indice === 0): ?>
                    <div class="producto-badge">✨ Destacado</div>
                <?php endif; ?>
                <?php if ($prod['stock'] < 5): ?>
                    <div class="producto-badge stock-bajo">⚠️ Últimas unidades</div>
                <?php endif; ?>
                <div class="producto-imagen">
                    <img src="<?= $prod['imagen'] ?>" alt="<?= $nombreJS ?>">
                    <div class="producto-overlay">
                        <button class="btn-rapido">Ver detalles →</button>
                    </div>
                </div>
                <div class="producto-info">
                    <h3><?= $prod['nombre'] ?></h3>
                    <div class="producto-precio">$<?= number_format($prod['precio'], 2) ?></div>
                    <span class="producto-stock">📦 <?= $prod['stock'] ?> disponibles</span>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</section>


<!-- Modal de producto  -->
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
                
                <div id="contenedorTalla" style="display: none;">
                    <label style="font-weight: 600; margin-bottom: 10px; display: block;">📏 Selecciona talla:</label>
                    <div class="tallas-container">
                        <button type="button" class="talla-btn" data-talla="XS">XCH (XS)</button>
                        <button type="button" class="talla-btn" data-talla="CH">CH (S)</button>
                        <button type="button" class="talla-btn" data-talla="M">M (M)</button>
                        <button type="button" class="talla-btn" data-talla="G">G (L)</button>
                        <button type="button" class="talla-btn" data-talla="XG">XG (XL)</button>
                    </div>
                    <input type="hidden" id="tallaSeleccionada">
                </div>

                <div class="opciones-compra">
                    <div class="fila-cantidad">
                        <label>Cantidad:</label>
                        <input type="number" id="cantidadProducto" value="1" min="1">
                    </div>
                    <button class="btn-comprar" onclick="agregarAlCarrito()">🛒 Agregar al carrito</button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Carrito lateral y modal de pago  -->
<div id="carrito-lateral" class="carrito-sidebar">
    <div class="carrito-header">
        <h3>🛒 Mi Carrito</h3>
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
    <div class="modal-contenido" style="max-width: 500px;">
        <span class="cerrar-modal" onclick="cerrarModalPago()">&times;</span>
        <div style="padding: 30px;">
            <h2 style="color: var(--primary); margin-bottom: 20px;">Método de Pago</h2>
            <div class="opciones-pago">
                <button onclick="seleccionarPago('Tarjeta')">💳 Tarjeta de crédito/débito</button>
                <button onclick="seleccionarPago('Efectivo')">💵 Efectivo (en tienda)</button>
                <button onclick="seleccionarPago('Transferencia')">🏦 Transferencia bancaria</button>
            </div>
            <p id="metodoSeleccionado" style="color: var(--gray); margin: 15px 0; text-align: center;"></p>
            <button class="btn-comprar" onclick="confirmarCompra()">✅ Confirmar Compra</button>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="view/js/tienda.js"></script>