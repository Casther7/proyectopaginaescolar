<?php
// 1. Importar el modelo de contacto
require_once "model/ContactoModel.php";

// 2. Obtener los datos actuales para llenar los inputs del formulario
$infoContacto = ContactoModel::mdlObtenerContacto();

// Si la tabla está vacía, creamos valores por defecto para que no falle el formulario
if(!$infoContacto){
    $infoContacto = [
        'telefono' => '',
        'correo' => '',
        'ubicacion' => '',
        'horario' => ''
    ];
}
?>

<?php $__mostrarTodo = !isset($permisosVista); ?>

<div id="vista-diseno" class="dashboard-content" style="display: none;">
    <h1 class="page-title">🎨 Editar Página Principal</h1>
    <p style="color: var(--texto-gris); margin-bottom: 30px;">
        Actualiza los textos e imágenes que ven los visitantes en la página pública.
    </p>
    
    <form action="#" method="POST" enctype="multipart/form-data">

        <!-- ==================== BANNER ==================== -->
        <?php if ($__mostrarTodo || !empty($permisosVista['p_banner'])): ?>
<div class="card form-card">
    <h3 class="form-section-title">🖼️ Banner Principal (Hero)</h3>
    <p style="font-size: 0.85rem; color: #64748b; margin-bottom: 15px;">Cambia el impacto visual de tu página de inicio.</p>

    <div class="form-group">
        <label>Título de Bienvenida</label>
        <input type="text" id="hero_titulo" class="input-admin" placeholder="Ej: Formando líderes">
    </div>

    <div class="form-group">
        <label>Subtítulo o Descripción</label>
        <textarea id="hero_subtitulo" class="input-admin" rows="2"></textarea>
    </div>

    <div class="form-group">
        <label>Tipo de fondo</label>
        <select id="hero_tipo" class="input-admin" onchange="toggleInputBanner()">
            <option value="imagen">Imagen Estática</option>
            <option value="video">Video (MP4)</option>
        </select>
    </div>

    <div class="form-group" id="cont-input-img">
        <label>Seleccionar Imagen</label>
        <input type="file" id="hero_archivo_img" class="input-admin" accept="image/*">
    </div>

    <div class="form-group" id="cont-input-vid" style="display:none;">
        <label>Seleccionar Video (Recomendado: MP4 ligero)</label>
        <input type="file" id="hero_archivo_vid" class="input-admin" accept="video/mp4">
    </div>

    <button type="button" id="btnGuardarHero" class="btn-guardar" style="background:#2c3e50;">Actualizar Banner</button>
</div>

<script>
// Función simple para mostrar el input correcto
function toggleInputBanner() {
    const tipo = document.getElementById('hero_tipo').value;
    document.getElementById('cont-input-img').style.display = (tipo === 'imagen') ? 'block' : 'none';
    document.getElementById('cont-input-vid').style.display = (tipo === 'video') ? 'block' : 'none';
}
</script>
<?php endif; ?>

        <!--=====================(Nosotros)===================== -->

        <?php if ($__mostrarTodo || !empty($permisosVista['p_nosotros'])): ?>
        <div class="card form-card" style="margin-top: 25px;">
            <h3 class="form-section-title">📖 Nuestros valores</h3>
            <p style="font-size: 0.85rem; color: #64748b; margin-bottom: 15px;">Modifica los textos institucionales que se muestran en la sección Nosotros.</p>

            <div class="form-group" style="margin-bottom: 25px; border-bottom: 1px solid #f1f1f1; padding-bottom: 20px;">
                <label><strong>Misión Institucional</strong></label>
                <textarea id="texto_mision" class="input-admin" rows="4" placeholder="Escribe aquí la misión..."></textarea>
                <button type="button" class="btn-guardar-info" data-slug="mision" style="margin-top: 10px; background-color: #2c3e50; color: white; border: none; padding: 10px 20px; border-radius: 6px; cursor: pointer; font-weight: 600;">Actualizar Misión</button>
            </div>

            <div class="form-group" style="margin-bottom: 25px; border-bottom: 1px solid #f1f1f1; padding-bottom: 20px;">
                <label><strong>Visión Institucional</strong></label>
                <textarea id="texto_vision" class="input-admin" rows="4" placeholder="Escribe aquí la visión..."></textarea>
                <button type="button" class="btn-guardar-info" data-slug="vision" style="margin-top: 10px; background-color: #2c3e50; color: white; border: none; padding: 10px 20px; border-radius: 6px; cursor: pointer; font-weight: 600;">Actualizar Visión</button>
            </div>

            <div class="form-group">
                <label><strong>Nuestra Historia</strong></label>
                <textarea id="texto_historia" class="input-admin" rows="4" placeholder="Escribe aquí la reseña histórica..."></textarea>
                <button type="button" class="btn-guardar-info" data-slug="historia" style="margin-top: 10px; background-color: #2c3e50; color: white; border: none; padding: 10px 20px; border-radius: 6px; cursor: pointer; font-weight: 600;">Actualizar Historia</button>
            </div>
        </div>
        <?php endif; ?>

        <!--     ============= Estadisticas al lado de nosotros ====================-->

        <?php if ($__mostrarTodo || !empty($permisosVista['p_nosotros'])): ?>
        <div class="card form-card" style="margin-top: 25px;">
            <h3 class="form-section-title">📖 Sobre nosotros</h3>
    
            <h4 style="margin-bottom: 15px; color: #1e3a6e;">▶ Sobre Nosotros</h4>
    
            <div class="form-group">
                <label>Texto Superior</label>
                <textarea id="texto_nosotros_desc_top" class="input-admin" rows="3"></textarea>
                <button type="button" class="btn-guardar-info" data-slug="nosotros_desc_top" style="margin-top:5px; background:#2c3e50; color:white; padding:5px 10px; border:none; border-radius:4px; cursor:pointer;">Guardar Texto</button>
            </div>

            <div class="form-group" style="display:flex; gap:10px;">
                <div style="flex:1;">
                <label>Punto Lista 1 (🎓)</label>
                <input type="text" id="texto_nosotros_item1" class="input-admin">
                <button type="button" class="btn-guardar-info" data-slug="nosotros_item1" style="margin-top:5px; background:#2c3e50; color:white; padding:5px 10px; border:none; border-radius:4px; cursor:pointer;">Guardar Pt. 1</button>
            </div>
            <div style="flex:1;">
                <label>Punto Lista 2 (💻)</label>
                <input type="text" id="texto_nosotros_item2" class="input-admin">
                <button type="button" class="btn-guardar-info" data-slug="nosotros_item2" style="margin-top:5px; background:#2c3e50; color:white; padding:5px 10px; border:none; border-radius:4px; cursor:pointer;">Guardar Pt. 2</button>
            </div>
            <div style="flex:1;">
                <label>Punto Lista 3 (🏛️)</label>
                <input type="text" id="texto_nosotros_item3" class="input-admin">
                <button type="button" class="btn-guardar-info" data-slug="nosotros_item3" style="margin-top:5px; background:#2c3e50; color:white; padding:5px 10px; border:none; border-radius:4px; cursor:pointer;">Guardar Pt. 3</button>
            </div>
        </div>

        <div class="form-group" style="margin-bottom: 30px; border-bottom: 2px solid #eee; padding-bottom: 20px;">
            <label>Texto Inferior</label>
            <textarea id="texto_nosotros_desc_bottom" class="input-admin" rows="2"></textarea>
            <button type="button" class="btn-guardar-info" data-slug="nosotros_desc_bottom" style="margin-top:5px; background:#2c3e50; color:white; padding:5px 10px; border:none; border-radius:4px; cursor:pointer;">Guardar Texto</button>
        </div>
        <?php endif; ?>   
    

        <!-- ==================== INSTALACIONES ==================== -->
        <?php if ($__mostrarTodo || !empty($permisosVista['p_instalaciones'])): ?>
            <div class="card form-card" style="margin-top: 25px;">
    <h3 class="form-section-title">🏢 Instalaciones</h3>
    
    <div style="display: flex; gap: 20px; flex-wrap: wrap;">
        
        <div class="form-group" style="flex: 1; min-width: 250px;">
            <label>Categoría (Sección)</label>
            <select id="inst_seccion" class="input-admin">
                <option value="laboratorios">Laboratorios</option>
                <option value="deportes">Deportes</option>
                <option value="biblioteca">Biblioteca</option>
            </select>
        </div>

        <div class="form-group" style="flex: 1; min-width: 250px;">
            <label>Nombre del espacio</label>
            <input type="text" id="inst_titulo" class="input-admin" placeholder="Ej: Laboratorio de Redes">
        </div>

        <div class="form-group" style="width: 100%;">
            <label>Descripción</label>
            <textarea id="inst_subtitulo" class="input-admin" rows="2"></textarea>
        </div>

        <div class="form-group" style="width: 100%;">
            <label>Imagen</label>
            <input type="file" id="inst_foto" accept="image/*" class="input-admin">
        </div>

        <button type="button" onclick="guardarInstalacion()" class="btn-guardar" style="background: #2563eb;">
            🚀 Guardar en Instalaciones
        </button>
    </div>
</div>
<?php endif; ?>

        <!-- ==================== OFERTA ==================== -->
        <?php if ($__mostrarTodo || !empty($permisosVista['p_oferta'])): ?>
        <div class="card form-card" style="margin-top: 25px;">
            <h3 class="form-section-title">🎓 Gestión de Oferta Académica</h3>
            <p style="font-size: 0.85rem; color: #64748b; margin-bottom: 20px;">Registra los detalles de las carreras para que aparezcan en el slider y el modal.</p>
            
            <form id="formNuevaOferta" enctype="multipart/form-data">
                <div style="display:grid; grid-template-columns: 1fr 1fr; gap:15px; margin-bottom: 15px;">
                    <div class="form-group">
                        <label>Nivel (Ej: Ingeniería, Licenciatura)</label>
                        <input type="text" id="of_nivel" class="input-admin" placeholder="Ingeniería">
                    </div>
                    <div class="form-group">
                        <label>Nombre de la Carrera</label>
                        <input type="text" id="of_titulo" class="input-admin" placeholder="Ing. en Sistemas">
                    </div>
                </div>

                <div class="form-group">
                    <label>Descripción corta (Para la tarjeta del slider)</label>
                    <textarea id="of_desc_corta" class="input-admin" rows="2"></textarea>
                </div>

                <div style="display:grid; grid-template-columns: 1fr 1fr; gap:15px; margin-bottom: 15px;">
                    <div class="form-group">
                        <label>Imagen Principal (Icono)</label>
                        <input type="file" id="of_archivo_principal" class="input-admin" accept="image/*">
                    </div>
                    <div class="form-group">
                        <label>Galería (Selecciona varias fotos)</label>
                        <input type="file" id="of_galeria" class="input-admin" accept="image/*" multiple>
                    </div>
                </div>

                <div style="display:grid; grid-template-columns: 1fr 1fr; gap:15px; margin-bottom: 15px;">
                    <div class="form-group">
                        <label>Misión de la Carrera</label>
                        <textarea id="of_mision" class="input-admin" rows="3"></textarea>
                    </div>
                    <div class="form-group">
                        <label>Visión de la Carrera</label>
                        <textarea id="of_vision" class="input-admin" rows="3"></textarea>
                    </div>
                </div>

                <div class="form-group">
                    <label>Objetivo General</label>
                    <textarea id="of_objetivo" class="input-admin" rows="2"></textarea>
                </div>

                <div style="display:grid; grid-template-columns: 1fr 1fr; gap:15px;">
                    <div class="form-group">
                        <label>Perfil de Egreso</label>
                        <textarea id="of_perfil" class="input-admin" rows="3"></textarea>
                    </div>
                    <div class="form-group">
                        <label>Campo Laboral</label>
                        <textarea id="of_campo" class="input-admin" rows="3"></textarea>
                    </div>
                </div>

                <button type="button" id="btnGuardarOferta" class="btn-guardar" style="background:#2980b9; margin-top: 20px;">Publicar Carrera</button>
            </form>

            <hr style="margin: 30px 0; border: 0; border-top: 1px solid #eee;">
            <div id="listaOfertaAdmin"></div>
        </div>
        <?php endif; ?>

        <!-- ==================== NOTICIAS ==================== -->
        <div class="card form-card" style="margin-top: 25px;">
    <h3 class="form-section-title">📰 Publicar Nueva Noticia</h3>
    <form id="formNuevaNoticia" enctype="multipart/form-data">
        <div class="form-group">
            <label>Título de la Noticia</label>
            <input type="text" name="not_titulo" id="not_titulo" class="input-admin" required>
        </div>
        <div style="display:flex; gap:15px;">
            <div class="form-group" style="flex:1;">
                <label>Categoría</label>
                <select name="not_categoria" id="not_categoria" class="input-admin">
                    <option value="Académico">Académico</option>
                    <option value="Deportes">Deportes</option>
                    <option value="Cultura">Cultura</option>
                    <option value="Avisos">Avisos</option>
                </select>
            </div>
            <div class="form-group" style="flex:1;">
                <label>Fecha del Evento</label>
                <input type="date" name="not_fecha" id="not_fecha" class="input-admin" required>
            </div>
        </div>
        <div class="form-group">
            <label>Imagen Portada</label>
            <input type="file" name="not_archivo" id="not_archivo" class="input-admin" accept="image/*" required>
        </div>
        <div class="form-group">
            <label>Contenido Completo</label>
            <textarea name="not_descripcion" id="not_descripcion" class="input-admin" rows="5" required></textarea>
        </div>
        <button type="button" id="btnGuardarNoticia" class="btn-guardar" style="background:#2ecc71;">Publicar Noticia</button>
    </form>

    <hr style="margin: 30px 0; border: 0; border-top: 1px solid #eee;">
    <h3 class="form-section-title">Lista de Noticias Publicadas</h3>
    <div id="listaNoticiasAdmin" style="margin-top:15px;">
        </div>
</div>


        <!-- ==================== CONTACTO ==================== -->
        <div class="card form-card" style="margin-top: 25px;">
    <h3 class="form-section-title">📞 Información de Contacto Directo</h3>
    <form id="formUpdateContacto">
        <div style="display:grid; grid-template-columns: 1fr 1fr; gap:15px; margin-bottom: 15px;">
            <div class="form-group">
                <label>Teléfono de Atención</label>
                <input type="text" id="con_tel" class="input-admin" value="<?php echo $infoContacto['telefono']; ?>">
            </div>
            <div class="form-group">
                <label>Correo Institucional</label>
                <input type="email" id="con_correo" class="input-admin" value="<?php echo $infoContacto['correo']; ?>">
            </div>
        </div>

        <div class="form-group">
            <label>Horario (Ej: Lun-Vie 8am a 4pm)</label>
            <input type="text" id="con_horario" class="input-admin" value="<?php echo $infoContacto['horario']; ?>">
        </div>

        <div class="form-group">
            <label>Dirección Completa</label>
            <textarea id="con_ubicacion" class="input-admin" rows="2"><?php echo $infoContacto['ubicacion']; ?></textarea>
        </div>

        <button type="button" id="btnActualizarContacto" class="btn-guardar" style="background:#16a085;">Actualizar Información</button>
    </form>
</div>
