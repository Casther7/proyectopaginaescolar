<?php
if (session_status() == PHP_SESSION_NONE) { session_start(); }
$estadoContacto = $_SESSION['contacto_estado'] ?? null;
unset($_SESSION['contacto_estado']);

require_once "model/ContactoModel.php";
$info = ContactoModel::mdlObtenerContacto();

if(!$info) {
    $info = [
        'telefono' => '951 517 0444',
        'correo' => 'informes@tuinstitucion.edu.mx',
        'ubicacion' => 'Av. Universidad S/N, Ex-Hacienda de Cinco Señores, C.P. 68120, Oaxaca de Juárez, Oax.',
        'horario' => 'Lunes a Viernes: 08:00 AM - 4:00 PM'
    ];
}
?>
<link rel="stylesheet" href="view/css/contacto.css?v=<?php echo time(); ?>">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<section id="contacto" class="seccion-contacto-moderna">
    <div class="contacto-wrapper">
        
        <div class="contacto-header">
            <h2 class="contacto-titulo-principal">Nuestra Escuela te Espera</h2>
            <p class="contacto-subtitulo">Conéctate y descubre más sobre nosotros</p>
        </div>

        <div class="contacto-grid-2-col">
            
            <div class="contacto-form-section">
                <p class="contacto-seguridad-txt">Tu información está segura con nosotros. Respondemos en 24h.</p>
                <h3 class="contacto-form-titulo">Estamos para escucharte.</h3>
                
                <?php if ($estadoContacto === 'ok'): ?>
                    <div style="margin-bottom:14px;padding:10px 12px;border-radius:8px;background:#ecfdf3;color:#166534;border:1px solid #bbf7d0;">Mensaje enviado correctamente.</div>
                <?php elseif ($estadoContacto === 'error'): ?>
                    <div style="margin-bottom:14px;padding:10px 12px;border-radius:8px;background:#fef2f2;color:#991b1b;border:1px solid #fecaca;">Error al enviar el mensaje.</div>
                <?php endif; ?>

                <form action="index.php?ruta=procesar-contacto" method="POST" class="contacto-form">
                    <div class="contacto-campos-grid">
                        <div class="contacto-input-group">
                            <label>Nombre Completo</label>
                            <input type="text" name="nombre" class="contacto-input" placeholder="Ej. Juan Pérez" required>
                        </div>
                        <div class="contacto-input-group">
                            <label>Correo Electrónico</label>
                            <input type="email" name="email" class="contacto-input" placeholder="juan@ejemplo.com" required>
                        </div>
                        <div class="contacto-input-group">
                            <label>Telefono</label>
                            <input type="tel" name="telefono" class="contacto-input" placeholder="Ej. 951 123 4567">
                        </div>
                        <div class="contacto-input-group ancho-completo">
                            <label>Asunto</label>
                            <input type="text" name="asunto" class="contacto-input" placeholder="¿En qué podemos ayudarte?" required>
                        </div>
                        <div class="contacto-input-group ancho-completo">
                            <label>Mensaje</label>
                            <textarea name="mensaje" class="contacto-textarea" placeholder="Escribe tu mensaje aquí..." required></textarea>
                        </div>
                    </div>
                    <div class="contacto-btn-wrapper">
                        <button type="submit" class="btn-enviar-rojo">
                            <span>Enviar Mensaje</span>
                            <i class="fa-solid fa-paper-plane" style="margin-left:10px;"></i>
                        </button>
                    </div>
                </form>
            </div>

            <div class="contacto-info-section">
                <h3 class="contacto-info-titulo" style="color: #ffffff;">Información de Contacto</h3>
                
                <ul class="contacto-lista-detalles">
                    <li class="contacto-lista-item">
                        <div class="contacto-icono-circulo"><i class="fa-solid fa-phone"></i></div>
                        <div>
                            <strong>Teléfono</strong><br>
                            <?php echo $info['telefono']; ?>
                        </div>
                    </li>
                    <li class="contacto-lista-item">
                        <div class="contacto-icono-circulo"><i class="fa-solid fa-envelope"></i></div>
                        <div>
                            <strong>Correo</strong><br>
                            <?php echo $info['correo']; ?>
                        </div>
                    </li>
                    <li class="contacto-lista-item">
                        <div class="contacto-icono-circulo"><i class="fa-solid fa-location-dot"></i></div>
                        <div>
                            <strong>Ubicación</strong><br>
                            <?php echo $info['ubicacion']; ?>
                        </div>
                    </li>
                    <li class="contacto-lista-item">
                        <div class="contacto-icono-circulo"><i class="fa-solid fa-clock"></i></div>
                        <div>
                            <strong>Horario</strong><br>
                            <?php echo $info['horario']; ?>
                        </div>
                    </li>
                </ul>

                <div class="contacto-mapa-caja">
                    <img src="https://images.unsplash.com/photo-1526778548025-fa2f459cd5c1?q=80&w=600" alt="Mapa">
                </div>
                <a href="#" class="contacto-link-mapa">Ver en Google Maps</a>
            </div>

        </div>
    </div>
</section>