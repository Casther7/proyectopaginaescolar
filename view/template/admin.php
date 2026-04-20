<?php
if (session_status() == PHP_SESSION_NONE) { session_start(); }

if(!isset($_SESSION["accesoAdmin"]) || $_SESSION["accesoAdmin"] != "ok"){
    echo '<script>window.location = "index.php";</script>';
    exit();
}
$nombre_admin = isset($_SESSION["nombreAdmin"]) ? $_SESSION["nombreAdmin"] : "Admin";
?>
<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/../../model/UsuarioModel.php';
require_once __DIR__ . '/../../model/MensajeModel.php';
require_once __DIR__ . '/../../model/BannerModel.php';
$totalNoLeidos = MensajeModel::mdlContarNoLeidos();

// Manejar eliminación de usuario
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['eliminar_usuario'])) {
    $idUsuario = (int)$_POST['eliminar_usuario'];
    error_log("ADMIN: Eliminando usuario ID: $idUsuario");

    $resultado = UsuarioModel::mdlEliminarUsuario($idUsuario);

    if ($resultado === 'ok') {
        $_SESSION['usuarioMensaje'] = 'eliminado_ok';
    } else {
        $_SESSION['usuarioMensaje'] = 'eliminado_error';
    }

    echo '<script>window.location = "index.php?ruta=admin&vista=usuarios";</script>';
    exit();
}

// Manejar edición de usuario
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['editar_usuario_id'])) {
    $idUsuario = (int)$_POST['editar_usuario_id'];
    $nombre = trim($_POST['editar_nombre']);
    $email = trim($_POST['editar_email']);
    $rol = trim($_POST['editar_rol']);
    $fotoPerfil = null;

    error_log("ADMIN: Editando usuario ID: $idUsuario, Nombre: $nombre, Email: $email");

    // Validaciones
    if (empty($nombre) || empty($email) || empty($rol)) {
        $_SESSION['usuarioMensaje'] = 'error';
        echo '<script>window.location = "index.php?ruta=admin&vista=usuarios";</script>';
        exit();
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['usuarioMensaje'] = 'error';
        echo '<script>window.location = "index.php?ruta=admin&vista=usuarios";</script>';
        exit();
    }

    // Manejar foto si se subió una nueva
    if (!empty($_FILES['editar_foto_perfil']['name']) && $_FILES['editar_foto_perfil']['error'] === UPLOAD_ERR_OK) {
        $rutaCarpeta = __DIR__ . '/../imagen/usuarios/';
        if (!is_dir($rutaCarpeta)) {
            mkdir($rutaCarpeta, 0755, true);
        }

        $extension = pathinfo($_FILES['editar_foto_perfil']['name'], PATHINFO_EXTENSION);
        $nombreArchivo = uniqid('usuario_') . '.' . $extension;
        $rutaDestino = $rutaCarpeta . $nombreArchivo;

        if (move_uploaded_file($_FILES['editar_foto_perfil']['tmp_name'], $rutaDestino)) {
            $fotoPerfil = 'view/imagen/usuarios/' . $nombreArchivo;
        }
    } else {
        // Mantener la foto existente si no se cambió
        $usuarioActual = UsuarioModel::mdlObtenerUsuario($idUsuario);
        $fotoPerfil = $usuarioActual ? $usuarioActual['foto_perfil'] : null;
    }

    $datosUsuario = [
        'nombre' => $nombre,
        'email' => $email,
        'rol' => $rol,
        'foto_perfil' => $fotoPerfil
    ];

    $resultado = UsuarioModel::mdlEditarUsuario($idUsuario, $datosUsuario);

    if ($resultado === 'ok') {
        $_SESSION['usuarioMensaje'] = 'editado_ok';
    } elseif ($resultado === 'duplicate_email') {
        $_SESSION['usuarioMensaje'] = 'duplicate_email';
    } else {
        $_SESSION['usuarioMensaje'] = 'error';
    }

    echo '<script>window.location = "index.php?ruta=admin&vista=usuarios";</script>';
    exit();
}

// Manejar guardado de permisos de acceso
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['guardar_accesos'])) {
    require_once __DIR__ . '/../../model/PermisosModel.php';

    $usuarioId = (int)$_POST['accesos_usuario_id'];

    if ($usuarioId > 0) {
        $resultado = PermisosModel::mdlGuardarPermisos($usuarioId, $_POST);
        $_SESSION['accesosMensaje'] = ($resultado === 'ok') ? 'ok' : 'error';
    } else {
        $_SESSION['accesosMensaje'] = 'error';
    }

    echo '<script>window.location = "index.php?ruta=admin&vista=accesos";</script>';
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['nuevo_nombre'])) {
    $nombre = trim($_POST['nuevo_nombre']);
    $email = trim($_POST['nuevo_email']);
    $password = trim($_POST['nuevo_pass']);
    $rol = trim($_POST['nuevo_rol']);
    $fotoPerfil = null;

    error_log("ADMIN: Intentando crear usuario - Nombre: $nombre, Email: $email, Rol: $rol");

    // Validaciones básicas
    if (empty($nombre) || empty($email) || empty($password) || empty($rol)) {
        error_log("ADMIN: ERROR - Campos requeridos vacíos");
        $_SESSION['usuarioMensaje'] = 'error';
        echo '<script>window.location = "index.php?ruta=admin&vista=usuarios";</script>';
        exit();
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        error_log("ADMIN: ERROR - Email inválido: $email");
        $_SESSION['usuarioMensaje'] = 'error';
        echo '<script>window.location = "index.php?ruta=admin&vista=usuarios";</script>';
        exit();
    }

    if (!empty($_FILES['foto_perfil']['name']) && $_FILES['foto_perfil']['error'] === UPLOAD_ERR_OK) {
        $rutaCarpeta = __DIR__ . '/../imagen/usuarios/';
        if (!is_dir($rutaCarpeta)) {
            mkdir($rutaCarpeta, 0755, true);
        }

        $extension = pathinfo($_FILES['foto_perfil']['name'], PATHINFO_EXTENSION);
        $nombreArchivo = uniqid('usuario_') . '.' . $extension;
        $rutaDestino = $rutaCarpeta . $nombreArchivo;

        if (move_uploaded_file($_FILES['foto_perfil']['tmp_name'], $rutaDestino)) {
            $fotoPerfil = 'view/imagen/usuarios/' . $nombreArchivo;
            error_log("ADMIN: Foto subida correctamente: $fotoPerfil");
        } else {
            error_log("ADMIN: Error al subir foto");
        }
    }

    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    error_log("ADMIN: Password hashed: " . substr($hashedPassword, 0, 20) . "...");

    $datosUsuario = [
        'nombre' => $nombre,
        'email' => $email,
        'password' => $hashedPassword,
        'rol' => $rol,
        'foto_perfil' => $fotoPerfil
    ];

    error_log("ADMIN: Datos preparados: " . print_r($datosUsuario, true));

    $resultado = UsuarioModel::mdlCrearUsuario($datosUsuario);

    error_log("ADMIN: Resultado de mdlCrearUsuario: $resultado");

    if ($resultado === 'ok') {
        error_log("ADMIN: Usuario creado exitosamente");
        $_SESSION['usuarioMensaje'] = 'ok';
        error_log("ADMIN: Sesión usuarioMensaje establecido a 'ok'");
    } elseif ($resultado === 'duplicate_email') {
        error_log("ADMIN: Email duplicado");
        $_SESSION['usuarioMensaje'] = 'duplicate_email';
        error_log("ADMIN: Sesión usuarioMensaje establecido a 'duplicate_email'");
    } else {
        error_log("ADMIN: Error desconocido en mdlCrearUsuario");
        $_SESSION['usuarioMensaje'] = 'error';
        error_log("ADMIN: Sesión usuarioMensaje establecido a 'error'");
    }

    error_log("ADMIN: Redirigiendo a admin...");
    echo '<script>window.location = "index.php?ruta=admin&vista=usuarios";</script>';
    exit();
}
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
            <a href="javascript:void(0)" class="menu-item active" id="btn-inicio" onclick="cambiarVista('inicio')">
                <span class="icon">📊</span><span class="text">Inicio</span>
            </a>
            <a href="javascript:void(0)" class="menu-item" id="btn-diseno" onclick="cambiarVista('diseno')">
                <span class="icon">🎨</span><span class="text">Diseño</span>
            </a>
            <a href="javascript:void(0)" class="menu-item" id="btn-mensajes" onclick="cambiarVista('mensajes')">
                <span class="icon icon-with-dot">✉️<?php if ($totalNoLeidos > 0): ?><span class="badge-dot" title="<?php echo $totalNoLeidos; ?> mensajes no leidos"></span><?php endif; ?></span><span class="text">Mensajes</span>
            </a>
            <a href="javascript:void(0)" class="menu-item" id="btn-tienda" onclick="cambiarVista('tienda')">
                <span class="icon">🛒</span><span class="text">Tienda</span>
            </a>
            <a href="javascript:void(0)" class="menu-item" id="btn-usuarios" onclick="cambiarVista('usuarios')">
                <span class="icon">👥</span><span class="text">Usuarios</span>
            </a>
            <a href="javascript:void(0)" class="menu-item" id="btn-accesos" onclick="cambiarVista('accesos')">
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
            include __DIR__ . '/admin_modulos/admin_inicio.php';
            include __DIR__ . '/admin_modulos/admin_diseno.php';
            include __DIR__ . '/admin_modulos/admin_mensajes.php';
            include __DIR__ . '/admin_modulos/admin_tienda.php';
            include __DIR__ . '/admin_modulos/admin_usuarios.php';
            include __DIR__ . '/admin_modulos/admin_accesos.php';
        ?>

    </main>

    <script src="view/js/admin.js"></script>
    <script src="view/js/admin_informacion.js"></script>
    <script src="view/js/admin_noticias.js"></script>
    <script src="view/js/admin_banners.js"></script>
    <script src="view/js/admin_oferta.js"></script>
    <script src="view/js/admin_contacto.js"></script>
</body>
</html>