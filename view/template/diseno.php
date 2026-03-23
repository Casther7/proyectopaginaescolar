<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// EL DESVÍO CORREGIDO (Rutas exactas a la carpeta)
if(isset($_GET["ruta"])){
    if($_GET["ruta"] == "admin"){
        include "view/template/admin.php"; 
        exit(); 
    }
    if($_GET["ruta"] == "procesar-login"){
        include "view/template/procesar-login.php"; 
        exit();
    }
    if($_GET["ruta"] == "salir"){
        session_destroy();
        echo '<script>window.location = "index.php";</script>';
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MiEscuela</title>
    <link rel="stylesheet" href="view/css/style.css">
</head>
<body>

    <nav class="navbar">
        <div class="logo">
            <h2><span onclick="abrirModalAdmin()" style="cursor: pointer;" title="Acceso Oculto">🏫</span> MiEscuela</h2>
        </div>
        
        <ul class="nav-links">
            <li><a href="#inicio">Inicio</a></li>
            <li><a href="#nosotros">Nosotros</a></li>
            <li><a href="#academico">Oferta Académica</a></li>
            <li><a href="#docentes">Docentes</a></li>
            <li><a href="#instalaciones">Instalaciones</a></li>
            <li><a href="#contacto">Contacto</a></li>
            <li><a href="index.php?ruta=tienda" class="btn-venta">🛒 Tienda</a></li>
        </ul>
    </nav>

    <main>
        <?php
        // Carga la tienda o el inicio
        if(isset($_GET["ruta"]) && $_GET["ruta"] == "tienda"){
            include "view/template/tienda.php"; 
        } else {
            include "view/template/inicio.php";
        }
        ?>
    </main>

    <footer class="footer-escolar">
        <p>&copy; 2026 Instituto Tecnológico. Todos los derechos reservados.</p>
    </footer>

    <script>
        window.addEventListener('scroll', function() {
            const nav = document.querySelector('.navbar');
            if (nav) {
                if (window.scrollY > 50) {
                    nav.style.backgroundColor = '#ffffff';
                    nav.style.boxShadow = '0 2px 10px rgba(0,0,0,0.1)';
                } else {
                    nav.style.backgroundColor = 'transparent';
                    nav.style.boxShadow = 'none';
                }
            }
        });

        function abrirModalAdmin() {
            document.getElementById('modalAdmin').style.display = 'flex';
        }

        function cerrarModalAdmin() {
            document.getElementById('modalAdmin').style.display = 'none';
        }

        window.onclick = function(event) {
            let modal = document.getElementById('modalAdmin');
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    </script>
</body>
</html>