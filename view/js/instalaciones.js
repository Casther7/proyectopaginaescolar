document.addEventListener('DOMContentLoaded', () => {
    const modalInst = document.getElementById('modal-inst-detalle');
    const btnCerrar = document.getElementById('btn-cerrar-inst');
    const mTitulo = document.getElementById('m-inst-titulo');
    const mDesc = document.getElementById('m-inst-desc');
    const mGaleria = document.getElementById('m-inst-galeria');

    // Títulos estáticos para las cabeceras según la tarjeta clickeada
    const cabeceras = {
        'laboratorios': 'Nuestros Laboratorios',
        'deportes': 'Complejo Deportivo',
        'biblioteca': 'Biblioteca Central'
    };

    // Escuchar clics en las tarjetas
    document.querySelectorAll('.instalacion-card').forEach(card => {
        card.addEventListener('click', () => {
            const categoria = card.getAttribute('data-categoria');
            
            // 1. Configurar cabecera
            mTitulo.textContent = cabeceras[categoria] || 'Instalaciones';
            mDesc.textContent = 'Explora nuestros espacios actualizados.';
            
            // 2. Limpiar galería y abrir modal
            mGaleria.innerHTML = '<p style="color:white; text-align:center;">Cargando...</p>';
            modalInst.classList.add('activo');

            // 3. Traer datos reales de la BD
            fetch(`ajax/ajax_banners.php?action=listar&seccion=${categoria}`)
                .then(res => res.json())
                .then(data => {
                    mGaleria.innerHTML = ''; // Limpiar el "Cargando"
                    
                    if (data.status === 'success' && data.banners.length > 0) {
                        data.banners.forEach(item => {
                            const div = document.createElement('div');
                            div.classList.add('sub-inst-card');
                            
                            // Usamos la ruta tal cual viene de la BD (view/img_banners/...)
                            div.innerHTML = `
                                <img src="${item.ruta_archivo}" class="sub-inst-img" onerror="this.src='view/img/placeholder.jpg'">
                                <div class="sub-inst-info">
                                    <h4>${item.titulo}</h4>
                                    <p>${item.subtitulo}</p>
                                </div>
                            `;
                            mGaleria.appendChild(div);
                        });
                    } else {
                        mGaleria.innerHTML = '<p style="color:white;">No hay espacios registrados en esta categoría.</p>';
                    }
                })
                .catch(err => {
                    console.error("Error cargando instalaciones:", err);
                    mGaleria.innerHTML = '<p style="color:white;">Error de conexión con el servidor.</p>';
                });
        });
    });

    // Cerrar modal
    if (btnCerrar) {
        btnCerrar.onclick = () => modalInst.classList.remove('activo');
    }
});