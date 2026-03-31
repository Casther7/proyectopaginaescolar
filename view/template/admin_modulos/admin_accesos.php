<div id="vista-accesos" class="dashboard-content" style="display: none;">
            
    <div class="header-accesos">
        <div>
            <h1 class="page-title">🔐 Configuración de Accesos</h1>
            <p>Selecciona un usuario y activa o desactiva sus permisos.</p>
        </div>
        <button type="button" class="btn-guardar" onclick="alert('¡Permisos guardados para el usuario seleccionado!')">💾 Guardar Accesos</button>
    </div>

    <div class="accesos-selector-container">
        <span class="label-selector">Configurar a:</span>
        <select class="select-usuario-grande" name="usuario_a_editar">
            <option value="1">Ana Jiménez (Editor de Contenido)</option>
            <option value="2">Dr. Roberto Gómez (Administrador Global)</option>
        </select>
    </div>

    <div class="paneles-permisos-grid">
        
        <div class="panel-permiso">
            <div class="panel-permiso-header">🎨 Edición de Diseño (Página Pública)</div>
            <div class="panel-permiso-body">
                
                <div class="permiso-row">
                    <span class="permiso-label">Banner Inicial y Hero</span>
                    <label class="switch"><input type="checkbox" name="p_banner" checked><span class="slider"></span></label>
                </div>
                <div class="permiso-row">
                    <span class="permiso-label">Sección "Quiénes Somos"</span>
                    <label class="switch"><input type="checkbox" name="p_nosotros" checked><span class="slider"></span></label>
                </div>
                <div class="permiso-row">
                    <span class="permiso-label">Oferta Académica (Carreras)</span>
                    <label class="switch"><input type="checkbox" name="p_oferta"><span class="slider"></span></label>
                </div>
                <div class="permiso-row">
                    <span class="permiso-label">Nuestro Equipo Docente</span>
                    <label class="switch"><input type="checkbox" name="p_docentes"><span class="slider"></span></label>
                </div>
                <div class="permiso-row">
                    <span class="permiso-label">Galería de Instalaciones</span>
                    <label class="switch"><input type="checkbox" name="p_instalaciones"><span class="slider"></span></label>
                </div>
                <div class="permiso-row">
                    <span class="permiso-label">Información de Contacto</span>
                    <label class="switch"><input type="checkbox" name="p_contacto"><span class="slider"></span></label>
                </div>

            </div>
        </div>

        <div class="panel-permiso">
            <div class="panel-permiso-header">⚙️ Acceso a Módulos Administrativos</div>
            <div class="panel-permiso-body">
                
                <div class="permiso-row">
                    <span class="permiso-label">✉️ Leer y gestionar Mensajes</span>
                    <label class="switch">
                        <input type="checkbox" name="p_mensajes">
                        <span class="slider"></span>
                    </label>
                </div>
                
                <div class="permiso-row">
                    <span class="permiso-label">🛒 Acceso a Tienda Escolar</span>
                    <label class="switch">
                        <input type="checkbox" name="p_tienda" checked>
                        <span class="slider"></span>
                    </label>
                </div>
                
                <div class="permiso-row">
                    <span class="permiso-label">👥 Administrar Usuarios y sus Accesos</span>
                    <label class="switch">
                        <input type="checkbox" name="p_usuarios_accesos">
                        <span class="slider"></span>
                    </label>
                </div>

            </div>
        </div>

    </div>
</div>