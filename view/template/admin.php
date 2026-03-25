<?php
if (session_status() == PHP_SESSION_NONE) { session_start(); }

// Protección: Si no hay sesión, lo regresa al inicio
if(!isset($_SESSION["accesoAdmin"]) || $_SESSION["accesoAdmin"] != "ok"){
    echo '<script>window.location = "index.php";</script>';
    exit();
}
// Nombre del admin sacado de la sesión o valor por defecto
$nombre_admin = isset($_SESSION["nombreAdmin"]) ? $_SESSION["nombreAdmin"] : "Admin";
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Administración Estilo Institucional | MiEscuela</title>
    
    <link rel="stylesheet" href="view/css/admin.css">
</head>
<body>

    <aside class="sidebar">
        <div class="sidebar-logo">
            <div class="logo-icon">🏫</div>
            <div class="logo-text">MiEscuela</div>
        </div>
        
        <nav class="sidebar-menu">
            <a href="#" class="menu-item active">
                <span class="icon">📊</span>
                <span class="text">Inicio</span>
            </a>
            <a href="#" class="menu-item">
                <span class="icon">🎨</span>
                <span class="text">Diseño</span>
            </a>
            <a href="#" class="menu-item">
                <span class="icon">🎒</span>
                <span class="text">Oferta</span>
            </a>
            <a href="#" class="menu-item">
                <span class="icon">🛒</span>
                <span class="text">Tienda</span>
            </a>
            <a href="#" class="menu-item">
                <span class="icon">👥</span>
                <span class="text">Usuarios</span>
            </a>
        </nav>

        <div class="sidebar-footer">
            <a href="index.php?ruta=salir" class="menu-item btn-salir">
                <span class="icon">🚪</span>
                <span class="text">Salir</span>
            </a>
        </div>
    </aside>

    <main class="main-content">
        
        <header class="top-header">
            <div class="breadcrumb">
                Administración > <span class="destacado">Escritorio</span>
            </div>
            
            <div class="user-profile">
                <span>Hola, <?php echo $nombre_admin; ?></span>
                <div class="avatar"><?php echo strtoupper(substr($nombre_admin, 0, 1)); ?></div>
                <a href="index.php?ruta=salir" class="btn-salir-header">Cerrar Sesión</a>
            </div>
        </header>

        <div class="dashboard-content">
            <h1 class="page-title">Visión General del Sistema Escolar</h1>
            
            <div class="cards-grid">
                
                <div class="card card-accent-blue">
                    <div class="card-circle-icon">🖼️</div>
                    <div class="card-text-content">
                        <h3>Página de Inicio</h3>
                        <p>Edita banners, misión y comunicados escolares.</p>
                        <a href="#" class="card-action-btn">Configurar</a>
                    </div>
                </div>

                <div class="card card-accent-red">
                    <div class="card-circle-icon icon-red">🛍️</div>
                    <div class="card-text-content">
                        <h3>Tienda Escolar</h3>
                        <p>Gestiona uniformes, libros y controla las ventas.</p>
                        <a href="#" class="card-action-btn btn-red">Gestionar</a>
                    </div>
                </div>

                <div class="card card-accent-yellow">
                    <div class="card-circle-icon icon-yellow">✉️</div>
                    <div class="card-text-content">
                        <h3>Mensajes</h3>
                        <p>Tienes 3 consultas sin leer en el formulario.</p>
                        <a href="#" class="card-btn-text">Ver Mensajes</a>
                    </div>
                </div>

                 <div class="card card-accent-green">
                    <div class="card-circle-icon icon-green">👨‍🏫</div>
                    <div class="card-text-content">
                        <h3>Docentes</h3>
                        <p>Agrega o elimina profesores del directorio.</p>
                        <a href="#" class="card-btn-text">Gestionar</a>
                    </div>
                </div>

            </div>
        </div>

    </main>

</body>
</html>