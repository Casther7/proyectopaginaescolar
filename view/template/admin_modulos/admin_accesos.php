<?php
//admin_accesos.php
require_once __DIR__ . '/../../../model/UsuarioModel.php';
require_once __DIR__ . '/../../../model/PermisosModel.php';

$usuariosAccesos  = UsuarioModel::mdlMostrarUsuarios();
$mensajeAccesos   = isset($_SESSION['accesosMensaje']) ? $_SESSION['accesosMensaje'] : null;
unset($_SESSION['accesosMensaje']);

$primerUsuario    = !empty($usuariosAccesos) ? $usuariosAccesos[0] : null;
$permisosActuales = $primerUsuario ? PermisosModel::mdlObtenerPermisos($primerUsuario['id']) : [];
if (!$permisosActuales) $permisosActuales = [];

$rutaActual = (isset($_GET['ruta']) && $_GET['ruta'] === 'panel-usuario') ? 'panel-usuario' : 'admin';
$accionAccesos = 'index.php?ruta=' . $rutaActual . '&vista=accesos';

function chk($permisos, $campo) {
    return !empty($permisos[$campo]) ? 'checked' : '';
}
?>

<div id="vista-accesos" class="dashboard-content" style="display: none;">

    <div class="header-accesos">
        <div>
            <h1 class="page-title">🔐 Configuración de Accesos</h1>
            <p>Selecciona un usuario y activa o desactiva sus permisos en tiempo real.</p>
        </div>
    </div>

    <?php if ($mensajeAccesos === 'ok'): ?>
        <div class="alert alert-success">✅ Permisos guardados correctamente.</div>
    <?php elseif ($mensajeAccesos === 'error'): ?>
        <div class="alert alert-danger">❌ No se pudieron guardar los permisos.</div>
    <?php endif; ?>

    <?php if (empty($usuariosAccesos)): ?>
        <div class="alert alert-warning">No hay usuarios registrados. Crea uno primero en la sección Usuarios.</div>
    <?php else: ?>

    <form method="POST" action="<?php echo htmlspecialchars($accionAccesos); ?>" id="form-accesos">
        <input type="hidden" name="guardar_accesos" value="1">
        <input type="hidden" name="accesos_usuario_id" id="accesos_usuario_id" value="<?php echo $primerUsuario['id']; ?>">

        <div class="accesos-selector-container">
            <span class="label-selector">Configurar a:</span>
            <select class="select-usuario-grande" id="select-usuario-accesos" onchange="cambiarUsuarioAccesos(this.value)">
                <?php foreach ($usuariosAccesos as $u): ?>
                    <option value="<?php echo (int)$u['id']; ?>">
                        <?php echo htmlspecialchars($u['nombre']); ?>
                        (<?php echo htmlspecialchars(ucfirst($u['rol'])); ?>)
                    </option>
                <?php endforeach; ?>
            </select>
            <button type="submit" class="btn-guardar">💾 Guardar Accesos</button>
        </div>

        <div class="paneles-permisos-grid">

            <div class="panel-permiso">
                <div class="panel-permiso-header">🎨 Edición de Diseño (Página Pública)</div>
                <div class="panel-permiso-body">
                    <div class="permiso-row">
                        <span class="permiso-label">Banner Inicial y Hero</span>
                        <label class="switch"><input type="checkbox" name="p_banner" <?php echo chk($permisosActuales,'p_banner'); ?>><span class="slider"></span></label>
                    </div>
                    <div class="permiso-row">
                        <span class="permiso-label">Sección "Quiénes Somos"</span>
                        <label class="switch"><input type="checkbox" name="p_nosotros" <?php echo chk($permisosActuales,'p_nosotros'); ?>><span class="slider"></span></label>
                    </div>
                    <div class="permiso-row">
                        <span class="permiso-label">Oferta Académica (Carreras)</span>
                        <label class="switch"><input type="checkbox" name="p_oferta" <?php echo chk($permisosActuales,'p_oferta'); ?>><span class="slider"></span></label>
                    </div>
                    <div class="permiso-row">
                        <span class="permiso-label">Publicar Nueva Noticia</span>
                        <label class="switch"><input type="checkbox" name="p_docentes" <?php echo chk($permisosActuales,'p_docentes'); ?>><span class="slider"></span></label>
                    </div>
                    <div class="permiso-row">
                        <span class="permiso-label">Galería de Instalaciones</span>
                        <label class="switch"><input type="checkbox" name="p_instalaciones" <?php echo chk($permisosActuales,'p_instalaciones'); ?>><span class="slider"></span></label>
                    </div>
                    <div class="permiso-row">
                        <span class="permiso-label">Información de Contacto</span>
                        <label class="switch"><input type="checkbox" name="p_contacto" <?php echo chk($permisosActuales,'p_contacto'); ?>><span class="slider"></span></label>
                    </div>
                </div>
            </div>

            <div class="panel-permiso">
                <div class="panel-permiso-header">⚙️ Acceso a Módulos Administrativos</div>
                <div class="panel-permiso-body">
                    <div class="permiso-row">
                        <span class="permiso-label">✉️ Leer y gestionar Mensajes</span>
                        <label class="switch"><input type="checkbox" name="p_mensajes" <?php echo chk($permisosActuales,'p_mensajes'); ?>><span class="slider"></span></label>
                    </div>
                    <div class="permiso-row">
                        <span class="permiso-label">🛒 Acceso a Tienda Escolar</span>
                        <label class="switch"><input type="checkbox" name="p_tienda" <?php echo chk($permisosActuales,'p_tienda'); ?>><span class="slider"></span></label>
                    </div>
                    <div class="permiso-row">
                        <span class="permiso-label">👥 Administrar Usuarios y sus Accesos</span>
                        <label class="switch"><input type="checkbox" name="p_usuarios_accesos" <?php echo chk($permisosActuales,'p_usuarios_accesos'); ?>><span class="slider"></span></label>
                    </div>
                </div>
            </div>

        </div>
    </form>

    <?php endif; ?>
</div>

<script>
    var camposPermisos = ['p_banner','p_nosotros','p_oferta','p_docentes','p_instalaciones','p_contacto','p_mensajes','p_tienda','p_usuarios_accesos'];

    function cambiarUsuarioAccesos(userId) {
        document.getElementById('accesos_usuario_id').value = userId;

        /***if (permisosCache[userId]) {
            aplicarPermisos(permisosCache[userId]);
            return;
        }***/

        fetch('ajax/ajax_accesos.php?action=get&id=' + userId)
            .then(function(r) { return r.json(); })
            .then(function(data) {
                if (data.success) {
                    //permisosCache[userId] = data.permisos;
                    aplicarPermisos(data.permisos);
                }
            });
    }

    function aplicarPermisos(permisos) {
        camposPermisos.forEach(function(campo) {
            var input = document.querySelector('#form-accesos input[name="' + campo + '"]');
            if (input) input.checked = (permisos[campo] == 1);
        });
    }
</script>