<?php
require_once "model/ContactoModel.php";

$infoContacto = ContactoModel::mdlObtenerContacto();

if(!$infoContacto){
    $infoContacto = [
        'telefono' => '',
        'correo' => '',
        'ubicacion' => '',
        'horario' => ''
    ];
}

$__mostrarTodo = !isset($permisosVista);
?>

<link rel="stylesheet" href="view/css/admin_diseno.css">

<div id="vista-diseno" class="dashboard-content" style="display: none;">
    <h1 class="page-title">🎨 Editar Página Principal</h1>

    <!-- ==================== BANNER ==================== -->
    <?php if ($__mostrarTodo || !empty($permisosVista['p_banner'])): ?>
    <div class="card form-card">
        <h3>🖼️ Banner Principal</h3>

        <input type="text" id="hero_titulo" placeholder="Título">
        <textarea id="hero_subtitulo"></textarea>

        <select id="hero_tipo" onchange="toggleInputBanner()">
            <option value="imagen">Imagen</option>
            <option value="video">Video</option>
        </select>

        <div id="cont-input-img">
            <input type="file" id="hero_archivo_img">
        </div>

        <div id="cont-input-vid" style="display:none;">
            <input type="file" id="hero_archivo_vid">
        </div>

        <button type="button" id="btnGuardarHero">Guardar Banner</button>
    </div>
    <?php endif; ?>


    <!-- ==================== NOSOTROS ==================== -->
    <?php if ($__mostrarTodo || !empty($permisosVista['p_nosotros'])): ?>
    <div class="card form-card">

        <h3>📖 Nosotros</h3>

        <textarea id="texto_mision"></textarea>
        <button type="button" class="btn-guardar-info" data-slug="mision">Guardar Misión</button>

        <textarea id="texto_vision"></textarea>
        <button type="button" class="btn-guardar-info" data-slug="vision">Guardar Visión</button>

        <textarea id="texto_historia"></textarea>
        <button type="button" class="btn-guardar-info" data-slug="historia">Guardar Historia</button>

    </div>

    <div class="card form-card">

        <h3>📖 Sobre Nosotros</h3>

        <textarea id="texto_nosotros_desc_top"></textarea>
        <button type="button" class="btn-guardar-info" data-slug="nosotros_desc_top">Guardar</button>

        <input type="text" id="texto_nosotros_item1">
        <input type="text" id="texto_nosotros_item2">
        <input type="text" id="texto_nosotros_item3">

        <textarea id="texto_nosotros_desc_bottom"></textarea>

    </div>
    <?php endif; ?>


    <!-- ==================== INSTALACIONES ==================== -->
    <?php if ($__mostrarTodo || !empty($permisosVista['p_instalaciones'])): ?>
    <div class="card form-card">

        <h3>🏢 Instalaciones</h3>

        <select id="inst_seccion">
            <option value="laboratorios">Laboratorios</option>
            <option value="deportes">Deportes</option>
        </select>

        <input type="text" id="inst_titulo">
        <textarea id="inst_subtitulo"></textarea>
        <input type="file" id="inst_foto">

        <button type="button" onclick="guardarInstalacion()">Guardar</button>

    </div>
    <?php endif; ?>


    <!-- ==================== OFERTA ==================== -->
    <?php if ($__mostrarTodo || !empty($permisosVista['p_oferta'])): ?>
    <div class="card form-card">

        <h3>🎓 Oferta Académica</h3>

        <form id="formNuevaOferta" enctype="multipart/form-data">

            <input type="text" id="of_nivel">
            <input type="text" id="of_titulo">
            <textarea id="of_desc_corta"></textarea>

            <input type="file" id="of_archivo_principal">
            <input type="file" id="of_galeria" multiple>

            <textarea id="of_mision"></textarea>
            <textarea id="of_vision"></textarea>

            <textarea id="of_objetivo"></textarea>

            <textarea id="of_perfil"></textarea>
            <textarea id="of_campo"></textarea>

            <button type="button" id="btnGuardarOferta">Guardar</button>

        </form>

        <div id="listaOfertaAdmin"></div>

    </div>
    <?php endif; ?>


    <!-- ==================== NOTICIAS ==================== -->
    <div class="card form-card">

        <h3>📰 Noticias</h3>

        <form id="formNuevaNoticia" enctype="multipart/form-data">

            <input type="text" id="not_titulo">
            <input type="date" id="not_fecha">

            <input type="file" id="not_archivo">
            <textarea id="not_descripcion"></textarea>

            <button type="button" id="btnGuardarNoticia">Guardar</button>

        </form>

        <div id="listaNoticiasAdmin"></div>

    </div>


    <!-- ==================== CONTACTO ==================== -->
    <div class="card form-card">

        <h3>📞 Contacto</h3>

        <form id="formUpdateContacto">

            <input type="text" id="con_tel" value="<?php echo $infoContacto['telefono']; ?>">
            <input type="email" id="con_correo" value="<?php echo $infoContacto['correo']; ?>">

            <input type="text" id="con_horario" value="<?php echo $infoContacto['horario']; ?>">

            <textarea id="con_ubicacion"><?php echo $infoContacto['ubicacion']; ?></textarea>

            <button type="button" id="btnActualizarContacto">Guardar</button>

        </form>

    </div>

</div>
