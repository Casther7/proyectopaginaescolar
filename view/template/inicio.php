<section id="inicio" class="hero">
    <div class="hero-content">
        <h1>Formando a los líderes del mañana</h1>
        <p>Inscripciones abiertas para el nuevo ciclo escolar.</p>
        <a href="#contacto" class="btn-main">Pedir Información</a>
    </div>
</section>

<section id="nosotros" class="seccion-clara">
    <h2 class="titulo-seccion">Quiénes Somos</h2>
    <div class="contenedor-grid">
        <div class="tarjeta-info">
            <h3>Nuestra Misión</h3>
            <p>Brindar una educación integral de excelencia, fomentando valores y habilidades tecnológicas.</p>
        </div>
        <div class="tarjeta-info">
            <h3>Nuestra Visión</h3>
            <p>Ser la institución educativa líder en innovación y desarrollo humano a nivel nacional.</p>
        </div>
    </div>
</section>

<section id="academico" class="seccion-oscura">
    <h2 class="titulo-seccion text-white">Oferta Académica</h2>
    <div class="contenedor-grid">
        <div class="tarjeta-curso">
            <div class="icono-curso">🎒</div>
            <h3>Secundaria</h3>
            <p>Educación básica con enfoque en ciencias y humanidades.</p>
        </div>
        <div class="tarjeta-curso">
            <div class="icono-curso">💻</div>
            <h3>Bachillerato Tecnológico</h3>
            <p>Especialización en programación, desarrollo web y robótica.</p>
        </div>
    </div>
</section>

<section id="docentes" class="seccion-clara">
    <h2 class="titulo-seccion">Nuestro Equipo Docente</h2>
    <div class="contenedor-grid">
        <div class="tarjeta-perfil">
            <img src="https://via.placeholder.com/150" alt="Profesor" class="img-perfil">
            <h4>Prof. Katto Chavez</h4>
            <p class="puesto">Titular de Proyectos Tecnológicos</p>
        </div>
        <div class="tarjeta-perfil">
            <img src="https://via.placeholder.com/150" alt="Profesora" class="img-perfil">
            <h4>Mtra. Elena Ruiz</h4>
            <p class="puesto">Coordinadora de Ciencias Exactas</p>
        </div>
        <div class="tarjeta-perfil">
            <img src="https://via.placeholder.com/150" alt="Director" class="img-perfil">
            <h4>Dr. Roberto Gómez</h4>
            <p class="puesto">Director General</p>
        </div>
    </div>
</section>

<section id="instalaciones" class="seccion-oscura">
    <h2 class="titulo-seccion text-white">Instalaciones de Primer Nivel</h2>
    <div class="galeria">
        <img src="https://via.placeholder.com/400x300?text=Laboratorio+Cómputo" alt="Lab Cómputo">
        <img src="https://via.placeholder.com/400x300?text=Canchas+Deportivas" alt="Canchas">
        <img src="https://via.placeholder.com/400x300?text=Biblioteca" alt="Biblioteca">
    </div>
</section>

<section id="contacto" class="seccion-clara">
    <h2 class="titulo-seccion">Contáctanos</h2>
    <div class="formulario-container">
        <form action="" method="POST" class="form-contacto">
            <input type="text" placeholder="Nombre completo" required>
            <input type="email" placeholder="Correo electrónico" required>
            <select>
                <option>Interés en Secundaria</option>
                <option>Interés en Bachillerato</option>
            </select>
            <textarea rows="4" placeholder="Tus dudas o comentarios..."></textarea>
            <button type="submit" class="btn-main">Enviar Mensaje</button>
        </form>
    </div>
</section>

<div id="modalAdmin" class="modal-oculto">
    <div class="modal-contenido">
        <span class="cerrar-modal" onclick="cerrarModalAdmin()">&times;</span>
        
        <h3 style="color: #1a365d; margin-bottom: 15px;">Acceso Administrador</h3>
        <p style="font-size: 0.9rem; margin-bottom: 20px;">Ingresa para entrar al panel</p>
        
        <form action="index.php?ruta=procesar-login" method="POST">
            <input type="text" name="usuario" placeholder="Usuario" required class="input-modal">
            <input type="password" name="password" placeholder="Contraseña" required class="input-modal">
            <button type="submit" class="btn-main" style="width: 100%; margin-top: 10px; cursor:pointer;">Entrar a Configurar</button>
        </form>
    </div>
</div>