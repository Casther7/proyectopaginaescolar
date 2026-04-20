<?php
require_once "model/NoticiaModel.php";
// Pedimos a la base de datos todas las noticias publicadas
$noticias = NoticiaModel::mdlListarNoticias();
?>

<link rel="stylesheet" href="view/css/noticias.css">

<section id="noticias" class="seccion-noticias">
    <div class="noticias-container">
        
        <div class="noticias-header">
            <h2>Últimas Noticias</h2>
            <p>Entérate de los eventos, convocatorias y logros más recientes de nuestra comunidad estudiantil.</p>
        </div>

        <div class="noticias-grid">
            
            <?php if (!empty($noticias)): ?>
                <?php foreach ($noticias as $n): ?>
                <article class="noticia-card">
                    <div class="noticia-img-container">
                        <img src="<?php echo $n['imagen']; ?>" alt="Imagen Noticia">
                        <span class="noticia-fecha"><?php echo date("d M", strtotime($n['fecha'])); ?></span>
                    </div>
                    <div class="noticia-contenido">
                        <span class="noticia-categoria"><?php echo $n['categoria']; ?></span>
                        <h3 class="noticia-titulo"><?php echo $n['titulo']; ?></h3>
                        <p class="noticia-desc"><?php echo substr($n['descripcion'], 0, 100) . '...'; ?></p>
                        
                        <a href="#" class="noticia-enlace btn-leer-noticia"
                            data-img="<?php echo $n['imagen']; ?>"
                            data-fecha="<?php echo date("d M Y", strtotime($n['fecha'])); ?>"
                            data-cat="<?php echo $n['categoria']; ?>"
                            data-titulo="<?php echo $n['titulo']; ?>"
                            data-desc="<?php echo htmlspecialchars($n['descripcion']); ?>">
                            <span class="texto-btn">Leer noticia</span>
                            <span class="icono-flecha"><i class="fas fa-arrow-right"></i></span>
                        </a>
                    </div>
                </article>
                <?php endforeach; ?>
            <?php else: ?>
                <p style="text-align: center; width: 100%; color: #64748b;">Aún no hay noticias publicadas.</p>
            <?php endif; ?>

        </div>

    </div>

    <div id="modal-noticia" class="modal-noticia-oculto">
        <div class="modal-noticia-contenido">
            
            <span id="btn-cerrar-noticia" class="btn-cerrar-img">&times;</span>
            
            <div class="m-noticia-img-contenedor">
                <img id="m-noticia-img" src="" alt="Imagen de la noticia">
                <span id="m-noticia-fecha" class="m-noticia-fecha-tag">Fecha</span>
            </div>
            
            <div class="m-noticia-cuerpo">
                <span id="m-noticia-cat" class="m-noticia-cat-txt">CATEGORÍA</span>
                <h2 id="m-noticia-titulo" class="m-noticia-titulo-txt">Título de la Noticia</h2>
                <p id="m-noticia-desc" class="m-noticia-desc-txt">Contenido</p>
            </div>
            
        </div>
    </div>
</section>