<link rel="stylesheet" href="view/css/noticias.css">

<section id="noticias" class="seccion-noticias">
    <div class="noticias-container">
        
        <div class="noticias-header">
            <h2>Últimas Noticias</h2>
            <p>Entérate de los eventos, convocatorias y logros más recientes de nuestra comunidad estudiantil.</p>
        </div>

        <div class="noticias-grid">
            
            <article class="noticia-card">
                <div class="noticia-img-container">
                    <img src="view/carreras/IAS2.jpeg" alt="Feria de Ciencias">
                    <span class="noticia-fecha">15 Mar</span>
                </div>
                <div class="noticia-contenido">
                    <span class="noticia-categoria">Académico</span>
                    <h3 class="noticia-titulo">Gran éxito en la Feria de Ciencias y Tecnología 2026</h3>
                    <p class="noticia-desc">Nuestros alumnos presentaron más de 50 proyectos de innovación agrícola, robótica y desarrollo sustentable ante la comunidad.</p>
                    
                    <a href="#" class="noticia-enlace btn-leer-noticia"
                        data-img="view/carreras/IAS2.jpeg"
                        data-fecha="15 Mar"
                        data-cat="Académico"
                        data-titulo="Gran éxito en la Feria de Ciencias y Tecnología 2026"
                        data-desc="Aquí va todo el texto largo y completo de tu noticia. Puedes agregar varios párrafos para que el usuario lea los detalles completos del evento. Nuestros alumnos presentaron más de 50 proyectos de innovación agrícola, robótica y desarrollo sustentable ante la comunidad. Fue un evento sin precedentes...">
                        <span class="texto-btn">Leer noticia</span>
                        <span class="icono-flecha"><i class="fas fa-arrow-right"></i></span>
                    </a>
                </div>
            </article>

            <article class="noticia-card">
                <div class="noticia-img-container">
                    <img src="view/carreras/TICS2.jpeg" alt="Nuevos Laboratorios">
                    <span class="noticia-fecha">10 Mar</span>
                </div>
                <div class="noticia-contenido">
                    <span class="noticia-categoria">Instalaciones</span>
                    <h3 class="noticia-titulo">Inauguración de los nuevos laboratorios de cómputo</h3>
                    <p class="noticia-desc">Con equipos de última generación, los estudiantes de Ingeniería en TIC's ahora cuentan con espacios optimizados para programación y diseño.</p>
                    
                    <a href="#" class="noticia-enlace btn-leer-noticia"
                        data-img="view/carreras/TICS2.jpeg"
                        data-fecha="10 Mar"
                        data-cat="Instalaciones"
                        data-titulo="Inauguración de los nuevos laboratorios de cómputo"
                        data-desc="Aquí va todo el texto largo y completo de tu noticia. Puedes agregar varios párrafos para que el usuario lea los detalles completos del evento. Nuestros alumnos presentaron más de 50 proyectos de innovación agrícola, robótica y desarrollo sustentable ante la comunidad. Fue un evento sin precedentes...">
                        <span class="texto-btn">Leer noticia</span>
                        <span class="icono-flecha"><i class="fas fa-arrow-right"></i></span>
                    </a>
                </div>
            </article>

            <article class="noticia-card">
                <div class="noticia-img-container">
                    <img src="view/carreras/ADMIN3.jpeg" alt="Inscripciones Abiertas">
                    <span class="noticia-fecha">05 Mar</span>
                </div>
                <div class="noticia-contenido">
                    <span class="noticia-categoria">Avisos</span>
                    <h3 class="noticia-titulo">¡Inscripciones abiertas para el nuevo ciclo escolar!</h3>
                    <p class="noticia-desc">Conoce los requisitos, fechas de exámenes de admisión y la oferta educativa completa que tenemos preparada para ti.</p>
                    
                    <a href="#" class="noticia-enlace btn-leer-noticia"
                        data-img="view/carreras/ADMIN3.jpeg"
                        data-fecha="05 Mar"
                        data-cat="Avisos"
                        data-titulo="¡Inscripciones abiertas para el nuevo ciclo escolar!"
                        data-desc="Aquí va todo el texto largo y completo de tu noticia. Puedes agregar varios párrafos para que el usuario lea los detalles completos del evento. Nuestros alumnos presentaron más de 50 proyectos de innovación agrícola, robótica y desarrollo sustentable ante la comunidad. Fue un evento sin precedentes...">
                        <span class="texto-btn">Leer noticia</span>
                        <span class="icono-flecha"><i class="fas fa-arrow-right"></i></span>
                    </a>
                </div>
            </article>

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
                <p id="m-noticia-desc" class="m-noticia-desc-txt">Descripción completa...</p>
            </div>
            
        </div>
    </div>
</section>