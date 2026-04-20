<?php
// 1. Cargamos el modelo y obtenemos los datos
require_once "model/OfertaModel.php";
$ofertas = OfertaModel::mdlListarOfertas();
?>

<section class="seccion-carreras" id="academico">
    <h2>Nuestra Oferta Académica</h2>

    <div class="carreras-slider-container">
        <button class="btn-flecha flecha-izq">❮</button>

        <div class="carreras-track-wrapper">
            <div class="carreras-track" id="riel-carreras">
                
                <?php if (!empty($ofertas)): ?>
                    <?php foreach ($ofertas as $o): ?>
                    <div class="carrera-card">
                        <div class="carrera-icono-img">
                            <img src="<?php echo $o['imagen_principal']; ?>" alt="Icono <?php echo $o['titulo']; ?>">
                        </div>
                        
                        <div class="carrera-nivel"><?php echo $o['nivel']; ?></div>
                        <h3 class="carrera-nombre"><?php echo $o['titulo']; ?></h3>
                        <p class="carrera-desc"><?php echo $o['descripcion_corta']; ?></p>

                        <button class="btn-detalles" 
                            data-imgs="<?php echo $o['imagenes_galeria']; ?>" 
                            data-nivel="<?php echo $o['nivel']; ?>" 
                            data-titulo="<?php echo $o['titulo']; ?>" 
                            data-mision="<?php echo $o['mision']; ?>"
                            data-vision="<?php echo $o['vision']; ?>"
                            data-objetivo="<?php echo $o['objetivo']; ?>"
                            data-perfil="<?php echo $o['perfil_egreso']; ?>"
                            data-campo="<?php echo $o['campo_laboral']; ?>">
                            Ver Detalles
                        </button>
                    </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p style="color: white; padding: 20px;">Cargando programas académicos...</p>
                <?php endif; ?>

            </div>
        </div>

        <button class="btn-flecha flecha-der">❯</button>
    </div>

    <div id="modal-carrera-detalle" class="modal-flotante-oculto">
    <div class="modal-flotante-contenido modal-grande">
        <span id="btn-cerrar-modal-carrera" class="btn-cerrar">&times;</span>
        
        <div class="modal-cabecera-top">
            <span id="m-nivel" class="m-nivel-txt">INGENIERÍA</span>
            <h2 id="m-titulo" class="m-titulo-txt">Nombre de la Carrera</h2>
        </div>

    </div>
            <div class="m-carrusel-contenedor" id="m-carrusel">
                </div>

            <div class="modal-cuerpo-bottom">
                <div class="m-tabs-nav">
                    <button class="m-tab-btn activo" data-tab="mision">Misión</button>
                    <button class="m-tab-btn" data-tab="vision">Visión</button>
                    <button class="m-tab-btn" data-tab="objetivo">Objetivo</button>
                    <button class="m-tab-btn" data-tab="perfil">Perfil de Egreso</button>
                    <button class="m-tab-btn" data-tab="campo">Campo Laboral</button>
                </div>

                <div id="m-tab-contenido" class="m-tab-content">
                    Cargando información...
                </div>
                
                <div style="text-align: center; margin-top: 15px;">
                    <a href="#contacto" class="btn-main" id="btn-interes-carrera">Me interesa esta carrera</a>
                </div>
            </div>
        </div>
    </div>
</section>