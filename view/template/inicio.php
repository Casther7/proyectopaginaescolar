<?php
// 1. Solo añadimos este bloque al principio para conectar con la base de datos
require_once "model/BannerModel.php";

// Buscamos el banner de la sección 'hero'
$bannersHero = BannerModel::mdlMostrarBanners('hero');
$hero = !empty($bannersHero) ? $bannersHero[0] : null;

// Variables dinámicas (si no hay nada en la BD, usa tus textos originales)
$tituloHero = $hero['titulo'] ?? "Formando a los líderes del mañana";
$subtituloHero = $hero['subtitulo'] ?? "Inscripciones abiertas para el nuevo ciclo escolar.";
$rutaHero = $hero['ruta'] ?? "view/img/hero-default.jpg";
$tipoHero = $hero['tipo'] ?? "imagen";
?>

<link rel="stylesheet" href="view/css/ofertaacademica.css">
<link rel="stylesheet" href="view/css/contacto.css">

<section id="inicio" class="hero" style="position: relative; overflow: hidden;">
    
    <?php if($tipoHero == "video"): ?>
        <video autoplay muted loop playsinline style="position: absolute; top:0; left:0; width:100%; height:100%; object-fit:cover; z-index:0;">
            <source src="<?php echo $rutaHero; ?>" type="video/mp4">
        </video>
        <div style="position: absolute; top:0; left:0; width:100%; height:100%; background: rgba(0,0,0,0.4); z-index: 1;"></div>
    <?php else: ?>
        <style>
            .hero { 
                background-image: linear-gradient(rgba(0,0,0,0.4), rgba(0,0,0,0.4)), url('<?php echo $rutaHero; ?>') !important;
                background-size: cover;
                background-position: center;
            }
        </style>
    <?php endif; ?>

    <div class="hero-content" style="position: relative; z-index: 2;">
        <h1><?php echo $tituloHero; ?></h1>
        <p><?php echo $subtituloHero; ?></p>
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
            <button type="submit" class="btn-login-modal">Entrar al Panel</button>
        </form>
    </div>
</div>

<div id="redes-flotante" class="redes-flotante">
    <a href="https://wa.me/tu-numero" class="item-red-social bg-whatsapp" target="_blank">
        <svg viewBox="0 0 24 24" fill="currentColor" height="24" width="24" xmlns="http://www.w3.org/2000/svg">
            <path d="M12.012 2c-5.508 0-9.987 4.479-9.987 9.987 0 1.763.461 3.474 1.333 4.988L2 22l5.174-1.358c1.464.798 3.102 1.218 4.769 1.218 5.508 0 9.987-4.479 9.987-9.987 0-5.508-4.479-9.987-9.987-9.987Zm4.97 14.151c-.204.577-1.011 1.056-1.393 1.121-.366.062-.716.149-2.316-.484-2.046-.811-3.364-2.889-3.466-3.025-.102-.136-.83-.1.83-1.1s.119-.247.187-.383c.068-.136.034-.26-.017-.383-.051-.123-.459-1.105-.629-1.513-.166-.398-.335-.344-.459-.351-.123-.007-.26-.008-.396-.008s-.356.051-.543.255c-.187.204-.714.697-.714 1.7s.731 1.973.832 2.11c.102.136 1.44 2.198 3.486 3.083.487.21 1.144.336 1.542.459.4.123.764.105 1.052.062.323-.048 1.011-.413 1.155-.811.144-.398.144-.739.101-.811-.043-.072-.158-.114-.332-.204Z"></path>
        </svg>
    </a>
    <a href="#" class="item-red-social bg-facebook">
        <svg viewBox="0 0 24 24" fill="currentColor" height="24" width="24" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd" clip-rule="evenodd" d="M13.135 6H15V3h-1.865a4.147 4.147 0 0 0-4.142 4.142V9H7v3h2v9.938h3V12h2.021l.592-3H12V6.591A.6.6 0 0 1 12.592 6h.543Z"></path>
        </svg>
    </a>
</div>