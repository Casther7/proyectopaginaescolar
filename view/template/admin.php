<?php
if (session_status() == PHP_SESSION_NONE) { session_start(); }

if(!isset($_SESSION["accesoAdmin"]) || $_SESSION["accesoAdmin"] != "ok"){
    echo '<script>window.location = "index.php";</script>';
    exit();
}
$nombre_admin = isset($_SESSION["nombreAdmin"]) ? $_SESSION["nombreAdmin"] : "Admin";
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Administración | MiEscuela</title>
    <link rel="stylesheet" href="view/css/admin.css">
</head>
<body>

    <aside class="sidebar">
        <div class="sidebar-logo">
            <div class="logo-icon">🏫</div>
            <div class="logo-text">MiEscuela</div>
        </div>
        
        <nav class="sidebar-menu">
            <a href="#" class="menu-item active" id="btn-inicio" onclick="cambiarVista('inicio')">
                <span class="icon">📊</span><span class="text">Inicio</span>
            </a>
            <a href="#" class="menu-item" id="btn-diseno" onclick="cambiarVista('diseno')">
                <span class="icon">🎨</span><span class="text">Diseño</span>
            </a>
            <a href="#" class="menu-item" id="btn-mensajes" onclick="cambiarVista('mensajes')">
                <span class="icon">✉️</span><span class="text">Mensajes</span>
            </a>
            <a href="#" class="menu-item" id="btn-tienda" onclick="cambiarVista('tienda')">
                <span class="icon">🛒</span><span class="text">Tienda</span>
            </a>
            <a href="#" class="menu-item" id="btn-usuarios" onclick="cambiarVista('usuarios')">
                <span class="icon">👥</span><span class="text">Usuarios</span>
            </a>
            <a href="#" class="menu-item" id="btn-accesos" onclick="cambiarVista('accesos')">
                <span class="icon">🔐</span><span class="text">Accesos</span>
            </a>
        </nav>

        <div class="sidebar-footer">
            <a href="index.php?ruta=salir" class="menu-item btn-salir">
                <span class="icon">🚪</span><span class="text">Salir</span>
            </a>
        </div>
    </aside>

    <main class="main-content">
        <header class="top-header">
            <div class="breadcrumb">Administración > <span class="destacado">Escritorio</span></div>
            <div class="user-profile">
                <span>Hola, <?php echo $nombre_admin; ?></span>
                <div class="avatar"><?php echo strtoupper(substr($nombre_admin, 0, 1)); ?></div>
                <a href="index.php?ruta=salir" class="btn-salir-header">Cerrar Sesión</a>
            </div>
        </header>

        <?php 
            include 'admin_modulos/admin_inicio.php';
            include 'admin_modulos/admin_diseno.php';
            include 'admin_modulos/admin_mensajes.php';
            include 'admin_modulos/admin_tienda.php';
            include 'admin_modulos/admin_usuarios.php';
            include 'admin_modulos/admin_accesos.php';
        ?>

    </main>

    <script src="view/js/admin.js"></script>
</body>
</html>