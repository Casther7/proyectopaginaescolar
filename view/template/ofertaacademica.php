<section class="seccion-carreras" id="academico">
    <h2>Nuestra Oferta Académica</h2>

    <div class="carreras-slider-container">
        <button class="btn-flecha flecha-izq">❮</button>

        <div class="carreras-track-wrapper">
            <div class="carreras-track" id="riel-carreras">
                
                <div class="carrera-card">
                    <div class="carrera-icono-img">
                        <img src="view/carreras/TICS.jpg" alt="Icono Robótica">
                    </div>
                    
                    <div class="carrera-nivel">Ingeniería</div>
                    <h3 class="carrera-nombre">Tecnologías de la Información y Comunicaciones</h3>
                    <p class="carrera-desc">Diseña, construye y programa sistemas automatizados y robóticos para la industria 4.0.</p>

                    <button class="btn-detalles" 
                        data-imgs="view/carreras/TICS.jpg, view/carreras/TICS2.jpeg, view/carreras/TICS3.jpeg, view/carreras/TICS4.jpeg" 
                        data-nivel="Ingeniería" 
                        data-titulo="Tecnologías de la Información y comunicaciones" 
                        data-mision="Formar profesionales capaces de integrar tecnologías..."
                        data-vision="Ser el programa líder en innovación tecnológica..."
                        data-objetivo="Capacitar al estudiante en el desarrollo de software..."
                        data-perfil="El egresado será capaz de diseñar redes y sistemas..."
                        data-campo="Empresas de software, telecomunicaciones, gobierno...">
                        Ver Detalles
                    </button>
                </div>

                <div class="carrera-card">
                    <div class="carrera-icono-img">
                        <img src="view/carreras/ADMIN.jpg" alt="Icono Negocios">
                    </div>
                    
                    <div class="carrera-nivel">Ingeniería</div>
                    <h3 class="carrera-nombre">Administración</h3>
                    <p class="carrera-desc">Domina el e-commerce, marketing digital y gestión de proyectos tecnológicos.</p>

                    <button class="btn-detalles" 
                        data-imgs="view/carreras/ADMIN.jpg, view/carreras/ADMIN2.jpeg, view/carreras/ADMIN3.jpeg, view/carreras/ADMIN4.jpeg"  
                        data-nivel="Ingeniería" 
                        data-titulo="Administración" 
                        data-mision="Formar profesionales capaces de integrar tecnologías..."
                        data-vision="Ser el programa líder en innovación tecnológica..."
                        data-objetivo="Capacitar al estudiante en el desarrollo de software..."
                        data-perfil="El egresado será capaz de diseñar redes y sistemas..."
                        data-campo="Empresas de software, telecomunicaciones, gobierno...">
                        Ver Detalles
                    </button>
                </div>

                <div class="carrera-card">
                    <div class="carrera-icono-img">
                        <img src="view/carreras/IAS.jpg" alt="Icono Negocios">
                    </div>
                    
                    <div class="carrera-nivel">Ingeniería</div>
                    <h3 class="carrera-nombre">Innovación Agrícola Sustentable</h3>
                    <p class="carrera-desc">Domina el e-commerce, marketing digital y gestión de proyectos tecnológicos.</p>
                    
                    <button class="btn-detalles" 
                        data-imgs="view/carreras/IAS.jpg, view/carreras/IAS2.jpg, view/carreras/IAS3.jpg, view/carreras/IAS4.jpg" 
                        data-nivel="Ingeniería" 
                        data-titulo="Innovación Agrícola Sustentable" 
                        data-desc="Aquí va la descripción completa de la carrera...">
                        Ver Detalles
                    </button>
                </div>

                <div class="carrera-card">
                    <div class="carrera-icono-img">
                        <img src="view/carreras/FORESTAL.jpg" alt="Icono Negocios">
                    </div>
                    
                    <div class="carrera-nivel">Ingeniería</div>
                    <h3 class="carrera-nombre">Forestal</h3>
                    <p class="carrera-desc">Domina el e-commerce, marketing digital y gestión de proyectos tecnológicos.</p>
                    
                    <button class="btn-detalles" 
                        data-imgs="view/carreras/FORESTAL.jpg, view/carreras/FORESTAL2.jpeg, view/carreras/FORESTAL3.jpeg, view/carreras/FORESTAL4.jpeg" 
                        data-nivel="Ingeniería" 
                        data-titulo="Forestal" 
                        data-desc="Aquí va la descripción completa de la carrera...">
                        Ver Detalles
                    </button>
                </div>

                <div class="carrera-card">
                    <div class="carrera-icono-img">
                        <img src="view/carreras/IDC.jpeg" alt="Icono Negocios">
                    </div>
                    
                    <div class="carrera-nivel">Ingeniería</div>
                    <h3 class="carrera-nombre">Desarrollo Comunitario</h3>
                    <p class="carrera-desc">Domina el e-commerce, marketing digital y gestión de proyectos tecnológicos.</p>
                    
                    <button class="btn-detalles" 
                        data-imgs="view/carreras/IDC.jpeg, view/carreras/IDC2.jpeg, view/carreras/IDC3.jpeg, view/carreras/IDC4.jpeg" 
                        data-nivel="Ingeniería" 
                        data-titulo="Desarrollo Comunitario" 
                        data-desc="Aquí va la descripción completa de la carrera...">
                        Ver Detalles
                    </button>
                </div>

            </div>
        </div>

        <button class="btn-flecha flecha-der">❯</button>
    </div>
    
    <div class="carreras-nav" id="puntos-navegacion"></div>
    
    <div id="modal-carrera-detalle" class="modal-flotante-oculto">
        <div class="modal-flotante-contenido modal-grande">
            <span id="btn-cerrar-modal-carrera" class="btn-cerrar">&times;</span>
            
            <div class="modal-cabecera-top">
                <span id="m-nivel" class="m-nivel-txt">INGENIERÍA</span>
                <h2 id="m-titulo" class="m-titulo-txt">Nombre de la Carrera</h2>
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
                <button id="btn-pedir-info" class="btn-enviar-rojo" style="width: 100%; max-width: 400px; border-radius: 8px;">Pedir Información y Costos</button>
            </div>
        </div>
            
        </div>
    </div>
</section>