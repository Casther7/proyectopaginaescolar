<link rel="stylesheet" href="view/css/ofertaacademica.css">
<link rel="stylesheet" href="view/css/contacto.css">

<section id="inicio" class="hero">
    <div class="hero-content">
        <h1>Formando a los líderes del mañana</h1>
        <p>Inscripciones abiertas para el nuevo ciclo escolar.</p>
        <a href="#contacto" class="btn-main">Pedir Información</a>
    </div>
</section>

<?php include 'view/template/nosotros.php'; ?>

<?php include 'view/template/ofertaacademica.php'; ?>


<?php include 'view/template/noticias.php'; ?>

<?php include 'view/template/instalaciones.php'; ?>

<?php include 'view/template/contacto.php'; ?>

<div id="modalAdmin" class="modal-oculto">
    <div class="modal-contenido">
        <span class="cerrar-modal" onclick="cerrarModalAdmin()">&times;</span>
        
        <h3 style="color: #1a365d; margin-bottom: 15px;">Acceso Administrador</h3>
        <p style="font-size: 0.9rem; margin-bottom: 20px;">Ingresa para entrar al panel</p>
        
        <form action="index.php?ruta=procesar-login" method="POST">
            <input type="text" name="usuario" placeholder="Usuario" required class="input-modal">
            <input type="password" name="password" placeholder="Contraseña" required class="input-modal">
            <button type="submit" class="btn-main" style="width: 100%; margin-top: 10px; cursor:pointer;">Entrar a Configurar</button>
        </form>
    </div>
</div>

<div id="redes-flotante" class="contenedor-redes-flotante">
    
    <div class="icono-centro-redes">
        <svg viewBox="0 0 24 24" fill="none" height="24" width="24" xmlns="http://www.w3.org/2000/svg">
            <path d="M5 7h14M5 12h14M5 17h14" stroke-width="2" stroke-linecap="round" stroke="currentColor"></path>
        </svg>
    </div>

    <a href="#" class="item-red-social bg-instagram">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
            <path fill="currentColor" fill-rule="evenodd" d="M3 8a5 5 0 0 1 5-5h8a5 5 0 0 1 5 5v8a5 5 0 0 1-5 5H8a5 5 0 0 1-5-5V8Zm5-3a3 3 0 0 0-3 3v8a3 3 0 0 0 3 3h8a3 3 0 0 0 3-3V8a3 3 0 0 0-3-3H8Zm7.597 2.214a1 1 0 0 1 1-1h.01a1 1 0 1 1 0 2h-.01a1 1 0 0 1-1-1ZM12 9a3 3 0 1 0 0 6 3 3 0 0 0 0-6Zm-5 3a5 5 0 1 1 10 0 5 5 0 0 1-10 0Z" clip-rule="evenodd"></path>
        </svg>
    </a>

    <a href="#" class="item-red-social bg-whatsapp">
        <svg viewBox="0 0 24 24" fill="currentColor" height="24" width="24" xmlns="http://www.w3.org/2000/svg">
            <path d="M7.978 4a2.553 2.553 0 0 0-1.926.877C4.233 6.7 3.699 8.751 4.153 10.814c.44 1.995 1.778 3.893 3.456 5.572 1.68 1.679 3.577 3.018 5.57 3.459 2.062.456 4.115-.073 5.94-1.885a2.556 2.556 0 0 0 .001-3.861l-1.21-1.21a2.689 2.689 0 0 0-3.802 0l-.617.618a.806.806 0 0 1-1.14 0l-1.854-1.855a.807.807 0 0 1 0-1.14l.618-.62a2.692 2.692 0 0 0 0-3.803l-1.21-1.211A2.555 2.555 0 0 0 7.978 4Z"></path>
        </svg>
    </a>

    <a href="#" class="item-red-social bg-facebook">
        <svg viewBox="0 0 24 24" fill="currentColor" height="24" width="24" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd" clip-rule="evenodd" d="M13.135 6H15V3h-1.865a4.147 4.147 0 0 0-4.142 4.142V9H7v3h2v9.938h3V12h2.021l.592-3H12V6.591A.6.6 0 0 1 12.592 6h.543Z"></path>
        </svg>
    </a>

    <a href="#" class="item-red-social bg-youtube rounded-br">
        <svg viewBox="0 0 24 24" fill="currentColor" height="24" width="24" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd" clip-rule="evenodd" d="M21.7 8.037a4.26 4.26 0 0 0-.789-1.964 2.84 2.84 0 0 0-1.984-.839c-2.767-.2-6.926-.2-6.926-.2s-4.157 0-6.928.2a2.836 2.836 0 0 0-1.983.839 4.225 4.225 0 0 0-.79 1.965 30.146 30.146 0 0 0-.2 3.206v1.5a30.12 30.12 0 0 0 .2 3.206c.094.712.364 1.39.784 1.972.604.536 1.38.837 2.187.848 1.583.151 6.731.2 6.731.2s4.161 0 6.928-.2a2.844 2.844 0 0 0 1.985-.84 4.27 4.27 0 0 0 .787-1.965 30.12 30.12 0 0 0 .2-3.206v-1.516a30.672 30.672 0 0 0-.202-3.206Zm-11.692 6.554v-5.62l5.4 2.819-5.4 2.801Z"></path>
        </svg>
    </a>
</div>



<script src="view/js/ofertaacademica.js"></script>
<script src="view/js/noticias.js"></script>
;<script src="view/js/instalaciones.js"></script>