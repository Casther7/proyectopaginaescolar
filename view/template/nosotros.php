<?php
require_once "model/InformacionModel.php";

// Recuperar Textos Identidad
$mision   = InformacionModel::mdlObtenerInformacion('mision');
$vision   = InformacionModel::mdlObtenerInformacion('vision');
$historia = InformacionModel::mdlObtenerInformacion('historia');

// Recuperar Textos Sobre Nosotros
$descTop    = InformacionModel::mdlObtenerInformacion('nosotros_desc_top');
$item1      = InformacionModel::mdlObtenerInformacion('nosotros_item1');
$item2      = InformacionModel::mdlObtenerInformacion('nosotros_item2');
$item3      = InformacionModel::mdlObtenerInformacion('nosotros_item3');
$descBottom = InformacionModel::mdlObtenerInformacion('nosotros_desc_bottom');
?>

<link rel="stylesheet" href="view/css/nosotros.css">

<section id="nosotros" class="seccion-nosotros">
    <div class="nosotros-container">
        
        <div class="nosotros-col-izq">
            <h2 class="nosotros-titulo">Sobre Nosotros</h2>
            
            <p class="nosotros-texto">
                <?php echo $descTop['contenido'] ?? 'Cargando información...'; ?>
            </p>

            <ul class="nosotros-lista">
                <li><i class="fa-solid fa-graduation-cap"></i> <?php echo $item1['contenido'] ?? 'Dato 1'; ?></li>
                <li><i class="fa-solid fa-laptop"></i> <?php echo $item2['contenido'] ?? 'Dato 2'; ?></li>
                <li><i class="fa-solid fa-building-columns"></i> <?php echo $item3['contenido'] ?? 'Dato 3'; ?></li>
            </ul>

            <p class="nosotros-texto">
                <?php echo $descBottom['contenido'] ?? ''; ?>
            </p>
        </div>

        <div class="nosotros-col-der">
            <h2 class="nosotros-titulo">Nuestros Valores</h2>
            
            <div class="valores-acordeon">
                <details class="valor-item" open>
                    <summary><?php echo $mision['titulo'] ?? 'Misión'; ?></summary>
                    <p><?php echo $mision['contenido'] ?? 'Cargando contenido...'; ?></p>
                </details>
                
                <details class="valor-item">
                    <summary><?php echo $vision['titulo'] ?? 'Visión'; ?></summary>
                    <p><?php echo $vision['contenido'] ?? 'Cargando contenido...'; ?></p>
                </details>
                
                <details class="valor-item">
                    <summary><?php echo $historia['titulo'] ?? 'Historia'; ?></summary>
                    <p><?php echo $historia['contenido'] ?? 'Cargando contenido...'; ?></p>
                </details>
            </div>
        </div>

    </div>
</section>