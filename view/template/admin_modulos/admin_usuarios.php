<div id="vista-usuarios" class="dashboard-content" style="display: none;">
            
    <div class="header-mensajes">
        <div>
            <h1 class="page-title">👥 Gestión de Usuarios</h1>
            <p>Crea cuentas para tu equipo y administra el directorio del personal.</p>
        </div>
    </div>

    <div class="card form-card">
        <form action="#" method="POST" enctype="multipart/form-data">
            <h3 class="form-section-title">👤 Datos del Nuevo Usuario</h3>
            
            <div class="form-usuario-container">
                
                <div class="area-foto-upload">
                    <div class="avatar-preview-container">
                        <span>👤</span>
                    </div>
                    
                    <label for="foto_perfil" class="label-archivo-custom">Elegir Foto</label>
                    <input type="file" name="foto_perfil" id="foto_perfil" class="input-archivo-oculto" accept="image/*">
                </div>

                <div class="area-datos-form">
                    <div class="form-grid-2">
                        <div class="form-group">
                            <label>Nombre y Apellidos Completos</label>
                            <input type="text" name="nuevo_nombre" class="input-admin" placeholder="Ej. Ana Jiménez">
                        </div>
                        <div class="form-group">
                            <label>Rol del Sistema (Cargo)</label>
                            <select name="nuevo_rol" class="select-admin">
                                <option value="admin">Administrador Global</option>
                                <option value="editor">Editor de Contenido</option>
                                <option value="docente">Docente / Soporte</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Correo Electrónico (Usuario)</label>
                            <input type="email" name="nuevo_email" class="input-admin" placeholder="ana@miescuela.edu.mx">
                        </div>
                        <div class="form-group">
                            <label>Contraseña Temporal</label>
                            <input type="password" name="nuevo_pass" class="input-admin" placeholder="••••••••">
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="form-actions-right">
                <button type="button" class="btn-guardar" onclick="alert('¡Backend recibirá los datos y la foto para guardarlos en la BD!')">➕ Agregar Usuario</button>
            </div>
        </form>
    </div>

    <h3 class="titulo-seccion-secundario">Usuarios Registrados</h3>
    <div class="card card-tabla">
        <table class="tabla-mensajes">
            <thead>
                <tr>
                    <th>Nombre Completo</th>
                    <th>Correo Electrónico</th>
                    <th>Rol / Cargo</th>
                    <th class="text-center">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <tr class="fila-leida">
                    <td class="txt-nombre">Ana Jiménez</td>
                    <td class="txt-correo">ana@miescuela.edu.mx</td>
                    <td><span class="badge-editor">Editor de Contenido</span></td>
                    <td class="text-center">
                        <button class="btn-leer-sec">Editar</button>
                        <button class="btn-eliminar" title="Dar de baja">🗑️</button>
                    </td>
                </tr>
                <tr class="fila-leida">
                    <td class="txt-nombre">Dr. Roberto Gómez</td>
                    <td class="txt-correo">direccion@miescuela.edu.mx</td>
                    <td><span class="badge-admin">Administrador Global</span></td>
                    <td class="text-center">
                        <button class="btn-leer-sec">Editar</button>
                        <button class="btn-eliminar" title="Dar de baja">🗑️</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>


        