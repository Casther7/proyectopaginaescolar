<?php
require_once "config/conexion.php";
$db = Conexion::conectar();
$stmt = $db->prepare("SELECT * FROM productos ORDER BY id DESC");
$stmt->execute();
$productos = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<link rel="stylesheet" href="view/css/admin_tienda.css">

<!-- SweetAlert2 CDN -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<div id="vista-tienda">
    <div class="header-tienda">
        <h1>🛒 Gestión de Inventario</h1>
        <p style="color: #64748b;">Administra los productos de la tienda escolar</p>
    </div>

    <div style="display:flex; justify-content:flex-end; margin-bottom:15px;">
        <button class="btn-agregar" onclick="abrirModalAgregar()">➕ Agregar Producto</button>
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
                        <div style="font-weight: bold; color: #0e1b38;"><?= htmlspecialchars($p['nombre']) ?></div>
                        <div style="font-size: 0.85rem; color: #64748b;">Tallas: <?= htmlspecialchars($p['tallas']) ?: 'N/A' ?></div>
                    </td>
                    <td>
                        <span style="padding: 5px 10px; background: <?= $p['stock'] < 5 ? '#ffebee' : '#e2e8f0' ?>; border-radius: 5px; font-size: 0.9rem; color: <?= $p['stock'] < 5 ? '#c62828' : '#333' ?>;">
                            <?= $p['stock'] ?> unidades
                        </span>
                    </td>
                    <td style="font-weight: bold; font-size: 1.1rem; color: #2ecc71;">
                        $<?= number_format($p['precio'], 2) ?>
                    </td>
                    <td style="display: flex; gap: 8px; flex-wrap: wrap;">
                        <button class="btn-editar" 
                                data-id="<?= $p['id'] ?>"
                                data-nombre="<?= htmlspecialchars($p['nombre']) ?>"
                                data-stock="<?= $p['stock'] ?>"
                                data-precio="<?= $p['precio'] ?>"
                                data-tallas="<?= htmlspecialchars($p['tallas']) ?>"
                                data-imagen="<?= $p['imagen'] ?>">
                            ✏️ Editar
                        </button>
                        <button class="btn-eliminar" 
                                data-id="<?= $p['id'] ?>"
                                data-nombre="<?= htmlspecialchars($p['nombre']) ?>">
                            🗑️ Eliminar
                        </button>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- MODAL PARA EDITAR PRODUCTO -->
<div id="modalPersonalizado" class="modal-overlay" style="display: none;">
    <div class="modal-content-custom">
        <form id="formEditar" enctype="multipart/form-data">
            <input type="hidden" name="id" id="edit-id">
            
            <div class="modal-header-custom">
                <h2>✏️ Editar Producto</h2>
            </div>

            <div class="modal-body-custom">
                <div style="text-align:center;">
                    <img id="edit-preview" src="" style="width:100px; height:100px; object-fit:cover; border-radius:10px;">
                    <input type="file" name="imagen" style="display:block; margin: 10px auto;">
                    <small style="color:#666;">Deja vacío para mantener la imagen actual</small>
                </div>

                <div class="input-group">
                    <label>Nombre</label>
                    <input type="text" name="nombre" id="edit-nombre" required>
                </div>

                <div class="input-group">
                    <label>Tallas (Separadas por comas)</label>
                    <input type="text" name="tallas" id="edit-tallas" placeholder="Ej: S,M,L,XL">
                </div>

                <div style="display:flex; gap:10px;">
                    <div class="input-group">
                        <label>Stock</label>
                        <input type="number" name="stock" id="edit-stock" required>
                    </div>
                    <div class="input-group">
                        <label>Precio</label>
                        <input type="number" step="0.01" name="precio" id="edit-precio" required>
                    </div>
                </div>
            </div>

            <div class="modal-footer-custom">
                <button type="button" onclick="cerrarModal()">Cancelar</button>
                <button type="submit" class="btn-guardar">Actualizar Producto</button>
            </div>
        </form>
    </div>
</div>

<!-- MODAL PARA AGREGAR PRODUCTO -->
<div id="modalAgregar" class="modal-overlay" style="display: none;">
    <div class="modal-content-custom">
        <form id="formAgregar" enctype="multipart/form-data">
            <div class="modal-header-custom">
                <h2>➕ Agregar Nuevo Producto</h2>
            </div>

            <div class="modal-body-custom">
                <div style="text-align:center; margin-bottom:15px;">
                    <img id="agregar-preview" src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='80' height='80' viewBox='0 0 24 24' fill='none' stroke='%23999' stroke-width='1' stroke-linecap='round' stroke-linejoin='round'%3E%3Crect x='3' y='3' width='18' height='18' rx='2' ry='2'%3E%3C/rect%3E%3Ccircle cx='8.5' cy='8.5' r='1.5'%3E%3C/circle%3E%3Cpolyline points='21 15 16 10 5 21'%3E%3C/polyline%3E%3C/svg%3E" style="width:80px; height:80px; object-fit:cover; border-radius:10px; background:#f0f0f0;">
                    <input type="file" name="imagen" id="imagen-agregar" required style="display:block; margin: 10px auto;">
                </div>

                <div class="input-group">
                    <label>Nombre del Producto</label>
                    <input type="text" name="nombre" placeholder="Ej: Uniforme Escolar" required>
                </div>

                <div class="input-group">
                    <label>Tallas (Separadas por comas)</label>
                    <input type="text" name="tallas" placeholder="Ej: S,M,L,XL">
                </div>

                <div style="display:flex; gap:10px;">
                    <div class="input-group">
                        <label>Stock</label>
                        <input type="number" name="stock" placeholder="Cantidad" required>
                    </div>
                    <div class="input-group">
                        <label>Precio</label>
                        <input type="number" step="0.01" name="precio" placeholder="Precio" required>
                    </div>
                </div>
            </div>

            <div class="modal-footer-custom">
                <button type="button" onclick="cerrarModalAgregar()">Cancelar</button>
                <button type="submit" class="btn-guardar">Agregar Producto</button>
            </div>
        </form>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="view/js/admin_tienda.js"></script>
