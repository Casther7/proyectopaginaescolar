<div id="vista-inicio" class="dashboard-content">
    <h1 class="page-title">Visión General del Sistema Escolar</h1>
    <div class="cards-grid">
        <div class="card card-accent-blue">
            <div class="card-circle-icon">🖼️</div>
            <div class="card-text-content">
                <h3>Página de Inicio</h3>
                <p>Edita banners, misión y comunicados escolares.</p>
                <button onclick="cambiarVista('diseno')" class="card-action-btn">Configurar</button>
            </div>
        </div>
        <div class="card card-accent-blue">
            <div class="card-circle-icon icon-red">🛍️</div>
            <div class="card-text-content">
                <h3>Tienda Escolar</h3>
                <p>Gestiona uniformes, libros y controla las ventas.</p>
                <button class="card-action-btn btn-red" onclick="cambiarVista('tienda')">Gestionar</button>
            </div>
        </div>
        <div class="card card-accent-blue">
            <div class="card-circle-icon icon-yellow">✉️</div>
            <div class="card-text-content">
                <h3>Mensajes Nuevos</h3>
                <p>Tienes 3 consultas sin leer en el formulario.</p>
                <a href="#" onclick="cambiarVista('mensajes')" class="card-btn-text">Ver Mensajes</a>
            </div>
        </div>
        <div class="card card-accent-blue">
            <div class="card-circle-icon icon-green">👨‍🏫</div>
            <div class="card-text-content">
                <h3>Docentes</h3>
                <p>Agrega o elimina profesores del directorio.</p>
                <a href="#" onclick="cambiarVista('usuarios')" class="card-btn-text">Gestionar</a>
            </div>
        </div>
    </div>
</div>