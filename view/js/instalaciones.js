document.addEventListener('DOMContentLoaded', () => {
    
    // 1. DICCIONARIO DE DATOS (AQUÍ PONES TU INFORMACIÓN)
    const datosInstalaciones = {
        'laboratorios': {
            titulo: 'Nuestros Laboratorios',
            descripcion: 'Conoce los espacios especializados donde nuestros alumnos ponen en práctica la teoría.',
            espacios: [
                { nombre: 'Laboratorio de Redes Cisco', desc: 'Equipado con switches y routers de última generación para prácticas de telecomunicaciones.', img: 'view/img/instalaciones/redes.jpg' },
                { nombre: 'Laboratorio de Desarrollo de Software', desc: 'Computadoras de alto rendimiento con entornos de programación para inteligencia artificial y web.', img: 'view/img/instalaciones/software.jpg' },
                { nombre: 'Taller de Ensamblaje', desc: 'Área dedicada a la arquitectura de computadoras y mantenimiento de hardware.', img: 'view/img/instalaciones/hardware.jpg' }
            ]
        },
        'deportes': {
            titulo: 'Complejo Deportivo',
            descripcion: 'Instalaciones diseñadas para el esparcimiento y la competencia de alto nivel.',
            espacios: [
                { nombre: 'Cancha de Fútbol Profesional', desc: 'Pasto sintético certificado, bancas techadas y gradas.', img: 'view/img/instalaciones/futbol.jpg' },
                { nombre: 'Canchas de Básquetbol', desc: 'Dos canchas techadas con duela e iluminación LED.', img: 'view/img/instalaciones/basquet.jpg' },
                { nombre: 'Gimnasio de Pesas', desc: 'Área de acondicionamiento físico general con instructores capacitados.', img: 'view/img/instalaciones/gimnasio.jpg' }
            ]
        },
        'biblioteca': {
            titulo: 'Biblioteca y Salas de Estudio',
            descripcion: 'Un ambiente propicio para la investigación, concentración y el trabajo colaborativo.',
            espacios: [
                { nombre: 'Acervo General', desc: 'Más de 10,000 libros físicos de todas las ingenierías y licenciaturas.', img: 'view/img/instalaciones/acervo.jpg' },
                { nombre: 'Salas de Trabajo Colaborativo', desc: 'Cubículos privados con pantallas para trabajar en equipo sin interrupciones.', img: 'view/img/instalaciones/salas.jpg' },
                { nombre: 'Hemeroteca Digital', desc: 'Computadoras con acceso a bases de datos científicas internacionales.', img: 'view/img/instalaciones/digital.jpg' }
            ]
        }
    };

    // 2. LÓGICA DEL MODAL
    const modalInst = document.getElementById('modal-inst-detalle');
    const btnCerrar = document.getElementById('btn-cerrar-inst');
    const tarjetas = document.querySelectorAll('.instalacion-card');
    
    const mTitulo = document.getElementById('m-inst-titulo');
    const mDesc = document.getElementById('m-inst-desc');
    const mGaleria = document.getElementById('m-inst-galeria');

    if(modalInst) {
        tarjetas.forEach(tarjeta => {
            tarjeta.addEventListener('click', () => {
                // Saber qué categoría se clickeó
                const categoriaKey = tarjeta.getAttribute('data-categoria');
                const data = datosInstalaciones[categoriaKey];

                if(data) {
                    // Llenar títulos
                    mTitulo.textContent = data.titulo;
                    mDesc.textContent = data.descripcion;
                    
                    // Limpiar galería anterior
                    mGaleria.innerHTML = '';

                    // Inyectar nuevas tarjetas
                    data.espacios.forEach(espacio => {
                        const htmlCard = `
                            <div class="sub-inst-card">
                                <img src="${espacio.img}" alt="${espacio.nombre}" class="sub-inst-img">
                                <div class="sub-inst-info">
                                    <h4>${espacio.nombre}</h4>
                                    <p>${espacio.desc}</p>
                                </div>
                            </div>
                        `;
                        mGaleria.innerHTML += htmlCard;
                    });

                    // Mostrar modal
                    modalInst.classList.add('activo');
                }
            });
        });

        // Cerrar modal
        function cerrarModal() {
            modalInst.classList.remove('activo');
        }

        if(btnCerrar) btnCerrar.addEventListener('click', cerrarModal);
        
        window.addEventListener('click', (e) => {
            if (e.target === modalInst) cerrarModal();
        });
    }
});