<div id="vista-diseno" class="dashboard-content" style="display: none;">
    <h1 class="page-title">🎨 Editar Página Principal</h1>
    <p style="color: var(--texto-gris); margin-bottom: 30px;">Actualiza los textos e imágenes que ven los visitantes en la página pública.</p>
    
    <form action="#" method="POST" enctype="multipart/form-data">
        
        <div class="card form-card">
            <h3 class="form-section-title">🖼️ Banner Principal (Inicio)</h3>
            
            <div class="form-group">
                <label>Título Principal</label>
                <input type="text" name="hero_titulo" value="Formando a los líderes del mañana" class="input-admin">
            </div>
            <div class="form-group">
                <label>Subtítulo / Descripción</label>
                <textarea name="hero_subtitulo" rows="3" class="input-admin">Inscripciones abiertas para el nuevo ciclo escolar.</textarea>
            </div>

            <div class="form-media-banner-grid">
                <div class="form-media-banner-group">
                    <div class="banner-preview-circle"><span>🖼️</span></div>
                    <div class="media-upload-texts">
                        <h4>Imagen de Fondo (Fija)</h4>
                        <p>Sube una imagen de alta calidad.</p>
                        <label for="banner_imagen" class="label-archivo-custom">Elegir Imagen</label>
                        <input type="file" name="banner_imagen" id="banner_imagen" class="input-archivo-oculto" accept="image/*">
                    </div>
                </div>

                <div class="form-media-banner-group">
                    <div class="banner-preview-circle"><span>📹</span></div>
                    <div class="media-upload-texts">
                        <h4>Video de Fondo (Opcional)</h4>
                        <p>Sube un video corto y ligero.</p>
                        <label for="banner_video" class="label-archivo-custom">Elegir Video</label>
                        <input type="file" name="banner_video" id="banner_video" class="input-archivo-oculto" accept="video/*">
                    </div>
                </div>
            </div>
        </div>

        <div class="card form-card" style="margin-top: 25px;">
            <h3 class="form-section-title">🏫 Nosotros y Valores</h3>
            <div class="form-grid-2">
                <div class="form-group">
                    <label>Texto de Misión</label>
                    <textarea name="texto_mision" rows="3" class="input-admin">Brindar una educación integral de excelencia...</textarea>
                </div>
                <div class="form-group">
                    <label>Texto de Visión</label>
                    <textarea name="texto_vision" rows="3" class="input-admin">Ser la institución educativa líder en innovación...</textarea>
                </div>
                <div class="form-group">
                    <label>Política de la Calidad</label>
                    <textarea name="texto_calidad" rows="3" class="input-admin">Compromiso con la mejora continua de nuestros procesos...</textarea>
                </div>
                <div class="form-group">
                    <label>Historia</label>
                    <textarea name="texto_historia" rows="3" class="input-admin">Fundada hace más de 50 años, nuestra institución...</textarea>
                </div>
            </div>
        </div>

        <div class="card form-card" style="margin-top: 25px;">
            <h3 class="form-section-title">🎒 Oferta Académica</h3>
            <p style="font-size: 0.85rem; color: var(--texto-gris); margin-bottom: 15px;">Selecciona una carrera existente para modificarla o agrega una nueva.</p>
            
            <div class="form-group">
                <label>Nivel o Carrera a editar</label>
                <select id="selector-carrera" name="carrera_seleccionada" class="select-admin">
                    <option value="1">Ingeniería en Robótica</option>
                    <option value="2">Licenciatura en Negocios Digitales</option>
                    <option value="nueva" class="opcion-destacada">➕ Agregar nueva carrera...</option>
                </select>
            </div>

            <div class="sub-form-container" id="contenedor-edicion-carrera">
                <h4 class="sub-form-title">📝 Diseño de la Tarjeta Principal</h4>
                <div class="form-grid-2">
                    <div class="form-group">
                        <label>Imagen Principal (Tarjeta)</label>
                        <input type="file" name="edit_img_principal" class="input-admin" accept="image/*">
                    </div>
                    <div class="form-group">
                        <label>Nivel Educativo</label>
                        <input type="text" id="edit_nivel" name="edit_nivel" value="Ingeniería" class="input-admin">
                    </div>
                    <div class="form-group" style="grid-column: span 2;">
                        <label>Nombre de la Carrera</label>
                        <input type="text" id="edit_nombre" name="edit_nombre" value="Robótica" class="input-admin">
                    </div>
                    <div class="form-group" style="grid-column: span 2;">
                        <label>Descripción Corta (Para la tarjeta exterior)</label>
                        <textarea id="edit_desc_corta" name="edit_desc_corta" rows="2" class="input-admin">Diseña, construye y programa sistemas automatizados...</textarea>
                    </div>
                </div>

                <h4 class="sub-form-title" style="margin-top: 30px;">🔍 Información de la Ventana Flotante (Pestañas)</h4>
                <div class="form-grid-2">
                    <div class="form-group" style="grid-column: span 2;">
                        <label>Imágenes para el Carrusel (Sube múltiples fotos)</label>
                        <input type="file" name="edit_carrusel[]" class="input-admin" multiple accept="image/*">
                        <p style="font-size: 0.8rem; color: #94a3b8; margin-top: 5px;">*Puedes seleccionar varias imágenes a la vez.</p>
                    </div>
                    <div class="form-group">
                        <label>Misión de la Carrera</label>
                        <textarea id="edit_mision" name="edit_mision" rows="3" class="input-admin">Formar profesionales capaces de...</textarea>
                    </div>
                    <div class="form-group">
                        <label>Visión de la Carrera</label>
                        <textarea id="edit_vision" name="edit_vision" rows="3" class="input-admin">Ser el programa líder en innovación...</textarea>
                    </div>
                    <div class="form-group">
                        <label>Objetivo General</label>
                        <textarea id="edit_objetivo" name="edit_objetivo" rows="3" class="input-admin">Capacitar al estudiante en...</textarea>
                    </div>
                    <div class="form-group">
                        <label>Perfil de Egreso</label>
                        <textarea id="edit_perfil" name="edit_perfil" rows="3" class="input-admin">El egresado será capaz de diseñar...</textarea>
                    </div>
                    <div class="form-group" style="grid-column: span 2;">
                        <label>Campo Laboral</label>
                        <textarea id="edit_campo" name="edit_campo" rows="2" class="input-admin">Empresas de software, telecomunicaciones...</textarea>
                    </div>
                </div>

                <div style="margin-top: 25px; text-align: right;">
                    <button type="button" class="btn-guardar" style="background-color: var(--azul-acento);">💾 Guardar Carrera</button>
                </div>
            </div>
        </div>

        <div class="card form-card" style="margin-top: 25px;">
            <h3 class="form-section-title">📰 Gestión de Noticias</h3>
            <p style="font-size: 0.85rem; color: var(--texto-gris); margin-bottom: 15px;">Agrega o edita las noticias que aparecen en la página principal.</p>
            
            <div class="form-group">
                <label>Noticia a editar</label>
                <select id="selector-noticia" name="noticia_seleccionada" class="select-admin">
                    <option value="1">Gran éxito en la Feria de Ciencias</option>
                    <option value="2">Inauguración de laboratorios</option>
                    <option value="nueva" class="opcion-destacada">➕ Redactar nueva noticia...</option>
                </select>
            </div>

            <div class="sub-form-container">
                <div class="form-grid-2">
                    <div class="form-group" style="grid-column: span 2;">
                        <label>Título de la Noticia</label>
                        <input type="text" name="noticia_titulo" value="Gran éxito en la Feria de Ciencias y Tecnología 2026" class="input-admin">
                    </div>
                    <div class="form-group">
                        <label>Categoría (Ej. Académico, Avisos)</label>
                        <input type="text" name="noticia_cat" value="Académico" class="input-admin">
                    </div>
                    <div class="form-group">
                        <label>Fecha a mostrar</label>
                        <input type="text" name="noticia_fecha" value="15 Mar" class="input-admin">
                    </div>
                    <div class="form-group" style="grid-column: span 2;">
                        <label>Imagen de Portada</label>
                        <input type="file" name="noticia_img" class="input-admin" accept="image/*">
                    </div>
                    <div class="form-group" style="grid-column: span 2;">
                        <label>Contenido Completo (Descripción)</label>
                        <textarea name="noticia_desc" rows="5" class="input-admin">Nuestros alumnos presentaron más de 50 proyectos de innovación agrícola, robótica y desarrollo sustentable ante la comunidad...</textarea>
                    </div>
                </div>
                <div style="margin-top: 15px; text-align: right;">
                    <button type="button" class="btn-guardar" style="background-color: #10b981;">💾 Publicar Noticia</button>
                </div>
            </div>
        </div>

        <div class="card form-card" style="margin-top: 25px;">
            <h3 class="form-section-title">🏢 Instalaciones Principales</h3>
            <p style="font-size: 0.85rem; color: var(--texto-gris); margin-bottom: 15px;">Sube las fotos de fondo para tus 3 categorías principales.</p>
            <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 20px;">
                <div class="form-group">
                    <label>Foto: Laboratorios</label>
                    <input type="file" name="inst_lab_img" class="input-admin" accept="image/*">
                    <input type="text" name="inst_lab_titulo" value="Laboratorios de Cómputo" class="input-admin" style="margin-top:10px;">
                </div>
                <div class="form-group">
                    <label>Foto: Complejo Deportivo</label>
                    <input type="file" name="inst_dep_img" class="input-admin" accept="image/*">
                    <input type="text" name="inst_dep_titulo" value="Complejo Deportivo" class="input-admin" style="margin-top:10px;">
                </div>
                <div class="form-group">
                    <label>Foto: Biblioteca</label>
                    <input type="file" name="inst_bib_img" class="input-admin" accept="image/*">
                    <input type="text" name="inst_bib_titulo" value="Biblioteca Central" class="input-admin" style="margin-top:10px;">
                </div>
            </div>
            <p style="font-size: 0.8rem; color: #94a3b8; margin-top: 10px;">*Los sub-espacios de cada instalación se administrarán desde la base de datos.</p>
        </div>

        <div class="card form-card" style="margin-top: 25px; margin-bottom: 25px;">
            <h3 class="form-section-title">📞 Información de Contacto</h3>
            <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 20px;">
                <div class="form-group">
                    <label>Teléfono Oficial</label>
                    <input type="text" name="contacto_tel" value="(55) 1234-5678" class="input-admin">
                </div>
                <div class="form-group">
                    <label>Correo Electrónico</label>
                    <input type="email" name="contacto_email" value="contacto@miescuela.edu.mx" class="input-admin">
                </div>
                <div class="form-group">
                    <label>Dirección Física</label>
                    <input type="text" name="contacto_direccion" value="Av. Universidad #123, Centro" class="input-admin">
                </div>
            </div>
        </div>

        <div style="margin-top: 30px; text-align: right;">
            <button type="button" class="btn-guardar">💾 Guardar Cambios Generales</button>
        </div>

    </form>
</div>