<?php
if (session_status() == PHP_SESSION_NONE) { session_start(); }

if (!isset($_SESSION['usuarioLogueado']) || $_SESSION['usuarioLogueado'] !== true) {
    echo '<script>window.location = "index.php?ruta=acceso";</script>';
    exit();
}

require_once __DIR__ . '/../../model/MensajeModel.php';
require_once __DIR__ . '/../../model/PermisosModel.php';

$uNombre  = $_SESSION['usuarioNombre'];
$uRol     = $_SESSION['usuarioRol'];
$uFoto    = $_SESSION['usuarioFoto'];
$uEmail   = $_SESSION['usuarioEmail'];
$permisosSesion = isset($_SESSION['usuarioPermisos']) && is_array($_SESSION['usuarioPermisos'])
    ? $_SESSION['usuarioPermisos']
    : [];

// Refrescar permisos en cada carga evita que el usuario tenga que cerrar sesion
// cuando el admin cambia accesos.
$permisos = PermisosModel::mdlObtenerPermisos((int)($_SESSION['usuarioId'] ?? 0));
if (!is_array($permisos)) {
    $permisos = $permisosSesion;
}
$_SESSION['usuarioPermisos'] = $permisos;

// Helper
function puede($permisos, $clave) {
    return !empty($permisos[$clave]);
}

// Construir menú según permisos
$menu = [];

// Diseño: si tiene algún permiso de diseño
if (puede($permisos,'p_banner') || puede($permisos,'p_nosotros') || puede($permisos,'p_oferta') ||
    puede($permisos,'p_docentes') || puede($permisos,'p_instalaciones') || puede($permisos,'p_contacto')) {
    $menu[] = ['id' => 'diseno', 'icon' => '🎨', 'label' => 'Diseño'];
}
if (puede($permisos,'p_mensajes'))         $menu[] = ['id' => 'mensajes',  'icon' => '✉️',  'label' => 'Mensajes'];
if (puede($permisos,'p_tienda'))           $menu[] = ['id' => 'tienda',    'icon' => '🛒',  'label' => 'Tienda'];
if (puede($permisos,'p_usuarios_accesos')) $menu[] = ['id' => 'usuarios',  'icon' => '👥',  'label' => 'Usuarios'];
if (puede($permisos,'p_usuarios_accesos')) $menu[] = ['id' => 'accesos',   'icon' => '🔐',  'label' => 'Accesos'];

$totalNoLeidos = MensajeModel::mdlContarNoLeidos();

$primeraVista = !empty($menu) ? $menu[0]['id'] : 'sin-accesos';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel | <?php echo htmlspecialchars($uNombre); ?></title>
    <link rel="stylesheet" href="view/css/admin.css">
</head>
<body>

<aside class="sidebar">
    <div class="sidebar-logo">
        <div class="logo-icon">🏫</div>
        <div class="logo-text">MiEscuela</div>
    </div>

    <nav class="sidebar-menu">
        <!-- Inicio: visible para todos los usuarios -->
        <a href="javascript:void(0)" class="menu-item active" id="btn-inicio" onclick="cambiarVista('inicio')">
            <span class="icon">🏠</span>
            <span class="text">Inicio</span>
        </a>

        <?php foreach ($menu as $item): ?>
        <a href="javascript:void(0)" class="menu-item"
           id="btn-<?php echo $item['id']; ?>"
           onclick="cambiarVista('<?php echo $item['id']; ?>')">
            <?php if ($item['id'] === 'mensajes' && $totalNoLeidos > 0): ?>
                <span class="icon icon-with-dot"><?php echo $item['icon']; ?><span class="badge-dot" title="<?php echo $totalNoLeidos; ?> mensajes no leidos"></span></span>
            <?php else: ?>
                <span class="icon"><?php echo $item['icon']; ?></span>
            <?php endif; ?>
            <span class="text"><?php echo $item['label']; ?></span>
        </a>
        <?php endforeach; ?>
        <?php if (empty($menu)): ?>
        <div style="padding:20px 10px;text-align:center;color:#94a3b8;font-size:0.8rem;">
            Sin secciones asignadas
        </div>
        <?php endif; ?>
    </nav>

    <div class="sidebar-footer">
        <a href="index.php?ruta=salir-usuario" class="menu-item btn-salir">
            <span class="icon">🚪</span><span class="text">Salir</span>
        </a>
    </div>
</aside>

<main class="main-content">
    <header class="top-header">
        <div class="breadcrumb">Panel &rsaquo; <span class="destacado"><?php echo htmlspecialchars(ucfirst($uRol)); ?></span></div>
        <div class="user-profile">
            <?php if (!empty($uFoto)): ?>
                <img src="<?php echo htmlspecialchars($uFoto); ?>" style="width:38px;height:38px;border-radius:50%;object-fit:cover;">
            <?php else: ?>
                <div class="avatar"><?php echo strtoupper(substr($uNombre, 0, 1)); ?></div>
            <?php endif; ?>
            <span>Hola, <?php echo htmlspecialchars($uNombre); ?></span>
            <a href="index.php?ruta=salir-usuario" class="btn-salir-header">Cerrar Sesión</a>
        </div>
    </header>

    <!-- VISTA: Inicio (visión general, siempre visible) -->
    <div id="vista-inicio" class="dashboard-content">
        <h1 class="page-title">Visión General del Sistema Escolar</h1>
        <div class="cards-grid">
            <?php if (puede($permisos,'p_banner') || puede($permisos,'p_nosotros') || puede($permisos,'p_oferta') ||
                      puede($permisos,'p_docentes') || puede($permisos,'p_instalaciones') || puede($permisos,'p_contacto')): ?>
            <div class="card card-accent-blue">
                <div class="card-circle-icon">🖼️</div>
                <div class="card-text-content">
                    <h3>Página de Inicio</h3>
                    <p>Edita banners, misión y comunicados escolares.</p>
                    <button onclick="cambiarVista('diseno')" class="card-action-btn">Configurar</button>
                </div>
            </div>
            <?php endif; ?>
            <?php if (puede($permisos,'p_tienda')): ?>
            <div class="card card-accent-blue">
                <div class="card-circle-icon icon-red">🛍️</div>
                <div class="card-text-content">
                    <h3>Tienda Escolar</h3>
                    <p>Gestiona uniformes, libros y controla las ventas.</p>
                    <button class="card-action-btn btn-red" onclick="cambiarVista('tienda')">Gestionar</button>
                </div>
            </div>
            <?php endif; ?>
            <?php if (puede($permisos,'p_mensajes')): ?>
            <div class="card card-accent-blue">
                <div class="card-circle-icon icon-yellow">✉️</div>
                <div class="card-text-content">
                    <h3>Mensajes Nuevos</h3>
                    <p>Tienes 3 consultas sin leer en el formulario.</p>
                    <a href="#" onclick="cambiarVista('mensajes')" class="card-btn-text">Ver Mensajes</a>
                </div>
            </div>
            <?php endif; ?>
            <?php if (puede($permisos,'p_usuarios_accesos')): ?>
            <div class="card card-accent-blue">
                <div class="card-circle-icon icon-green">👨‍🏫</div>
                <div class="card-text-content">
                    <h3>Docentes</h3>
                    <p>Agrega o elimina profesores del directorio.</p>
                    <a href="#" onclick="cambiarVista('usuarios')" class="card-btn-text">Gestionar</a>
                </div>
            </div>
            <?php endif; ?>
            <?php if (empty($menu)): ?>
            <div class="card card-accent-blue" style="grid-column:1/-1;text-align:center;padding:40px;">
                <div class="card-circle-icon">🔒</div>
                <div class="card-text-content">
                    <h3>Sin módulos asignados</h3>
                    <p>Contacta al administrador para que te asigne permisos.</p>
                </div>
            </div>
            <?php endif; ?>
        </div>
    </div>

    <!-- VISTA: Sin accesos -->
    <div id="vista-sin-accesos" class="dashboard-content" style="display:none;">
        <div style="text-align:center;padding:80px 40px;">
            <div style="font-size:4rem;margin-bottom:20px;">🔒</div>
            <h2 style="color:#0e1b38;margin-bottom:10px;">Sin secciones asignadas</h2>
            <p style="color:#64748b;">Tu cuenta no tiene acceso a ningún módulo todavía.<br>Contacta al administrador para que te asigne permisos.</p>
        </div>
    </div>

    <!-- VISTA: Mensajes -->
    <?php if (puede($permisos,'p_mensajes')): ?>
    <?php include __DIR__ . '/admin_modulos/admin_mensajes.php'; ?>
    <?php endif; ?>

    <!-- VISTA: Tienda -->
    <?php if (puede($permisos,'p_tienda')): ?>
    <?php include __DIR__ . '/admin_modulos/admin_tienda.php'; ?>
    <?php endif; ?>

    <!-- VISTA: Usuarios -->
    <?php if (puede($permisos,'p_usuarios_accesos')): ?>
    <?php include __DIR__ . '/admin_modulos/admin_usuarios.php'; ?>
    <?php endif; ?>

    <!-- VISTA: Accesos -->
    <?php if (puede($permisos,'p_usuarios_accesos')): ?>
    <?php include __DIR__ . '/admin_modulos/admin_accesos.php'; ?>
    <?php endif; ?>

    <!-- VISTA: Diseño (admin_diseno.php ya contiene su propio div#vista-diseno) -->
    <?php if (puede($permisos,'p_banner') || puede($permisos,'p_nosotros') || puede($permisos,'p_oferta') ||
              puede($permisos,'p_docentes') || puede($permisos,'p_instalaciones') || puede($permisos,'p_contacto')): ?>
    <?php $permisosVista = $permisos; include __DIR__ . '/admin_modulos/admin_diseno.php'; unset($permisosVista); ?>
    <?php endif; ?>

</main>

<script src="view/js/admin.js"></script>
</body>
</html>
