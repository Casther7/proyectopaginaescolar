<link rel="stylesheet" href="view/css/instalaciones.css">

<section id="instalaciones" class="seccion-instalaciones">
    <div class="instalaciones-container">
        
        <div class="instalaciones-header">
            <h2>Instalaciones de Primer Nivel</h2>
            <p>Espacios modernos y equipados con tecnología de vanguardia para potenciar tu desarrollo académico y deportivo.</p>
        </div>

        <div class="instalaciones-grid">
            
            <div class="instalacion-card" data-categoria="laboratorios">
                <img src="view/carreras/Labora.jpeg"  alt="Laboratorios de Cómputo" class="instalacion-img">
                
                <div class="instalacion-overlay">
                    <div class="instalacion-icono">
                        <i class="fas fa-desktop"></i>
                    </div>
                    <h3 class="instalacion-titulo">Laboratorios de Cómputo</h3>
                    <p class="instalacion-desc">Equipos de última generación con software especializado para ingeniería, diseño y programación.</p>
                </div>
            </div>

            <div class="instalacion-card" data-categoria="deportes">
                <img src="view/carreras/canchas.jpeg" alt="Canchas Deportivas" class="instalacion-img">
                
                <div class="instalacion-overlay">
                    <div class="instalacion-icono">
                        <i class="fas fa-basketball-ball"></i>
                    </div>
                    <h3 class="instalacion-titulo">Complejo Deportivo</h3>
                    <p class="instalacion-desc">Canchas de usos múltiples, pista de atletismo y áreas verdes para fomentar tu bienestar físico.</p>
                </div>
            </div>

            <div class="instalacion-card" data-categoria="biblioteca">
                <img src="view/carreras/Bibliotecajpg.jpg"  alt="Biblioteca Central" class="instalacion-img">
                
                <div class="instalacion-overlay">
                    <div class="instalacion-icono">
                        <i class="fas fa-book-reader"></i>
                    </div>
                    <h3 class="instalacion-titulo">Biblioteca Central</h3>
                    <p class="instalacion-desc">Un espacio silencioso e inspirador con miles de volúmenes físicos y acceso a bases de datos digitales internacionales.</p>
                </div>
            </div>

        </div>
    </div>

    <div id="modal-inst-detalle" class="modal-inst-oculto">
        <div class="modal-inst-contenido">
            <span id="btn-cerrar-inst" class="btn-cerrar-inst">&times;</span>
            
            <div class="modal-inst-cabecera">
                <h2 id="m-inst-titulo" class="m-inst-titulo">Categoría</h2>
                <p id="m-inst-desc" class="m-inst-desc">Descripción general</p>
            </div>

            <div id="m-inst-galeria" class="m-inst-galeria-grid">
                </div>
        </div>
    </div>
</section>