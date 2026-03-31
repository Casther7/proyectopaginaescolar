console.log("✅ Archivo ofertaacademica.js cargado correctamente");

document.addEventListener('DOMContentLoaded', () => {
    const track = document.getElementById('riel-carreras');
    const btnIzq = document.querySelector('.flecha-izq');
    const btnDer = document.querySelector('.flecha-der');
    const tarjetas = document.querySelectorAll('.carrera-card');
    const navPuntos = document.getElementById('puntos-navegacion'); // El nuevo contenedor

    if (!track || !btnIzq || !btnDer || !navPuntos || tarjetas.length === 0) {
        console.error("❌ Error: Faltan elementos del carrusel en el HTML.");
        return;
    }

    let indiceActual = 0;
    const maxIndice = tarjetas.length - 2; 

    // --- MAGIA NUEVA: Crear los puntos dinámicamente ---
    for (let i = 0; i <= maxIndice; i++) {
        const punto = document.createElement('button');
        punto.classList.add('carrera-punto');
        if (i === 0) punto.classList.add('activo'); // El primer punto arranca azul
        
        // Hacer que los puntos sean clickeables
        punto.addEventListener('click', () => {
            indiceActual = i;
            moverCarrusel();
        });
        
        navPuntos.appendChild(punto);
    }
    // Guardamos todos los puntitos que acabamos de crear
    const puntos = document.querySelectorAll('.carrera-punto'); 
    // --------------------------------------------------

    function moverCarrusel() {
        const anchoTarjeta = tarjetas[0].getBoundingClientRect().width;
        const desplazamiento = (anchoTarjeta + 30) * indiceActual;
        track.style.transform = `translateX(-${desplazamiento}px)`;

        // --- ACTUALIZAR PUNTOS ---
        // Le quitamos el azul a todos y se lo ponemos solo al actual
        puntos.forEach(p => p.classList.remove('activo'));
        puntos[indiceActual].classList.add('activo');
    }

    btnDer.addEventListener('click', (e) => {
        e.preventDefault(); 
        if (indiceActual < maxIndice) {
            indiceActual++;
        } else {
            indiceActual = 0; 
        }
        moverCarrusel();
    });

    btnIzq.addEventListener('click', (e) => {
        e.preventDefault(); 
        if (indiceActual > 0) {
            indiceActual--;
        } else {
            indiceActual = maxIndice; 
        }
        moverCarrusel();
    });

    window.addEventListener('resize', moverCarrusel);

   // --- LÓGICA DE LA VENTANA FLOTANTE, CARRUSEL Y PESTAÑAS ---
    const modalDetalle = document.getElementById('modal-carrera-detalle');
    const btnCerrarModal = document.getElementById('btn-cerrar-modal-carrera');
    const botonesVerDetalles = document.querySelectorAll('.btn-detalles');
    const btnPedirInfo = document.getElementById('btn-pedir-info');

    // Elementos del HTML
    const mNivel = document.getElementById('m-nivel');
    const mTitulo = document.getElementById('m-titulo');
    const mCarrusel = document.getElementById('m-carrusel');

    // Elementos de las Pestañas
    const tabBtns = document.querySelectorAll('.m-tab-btn');
    const tabContent = document.getElementById('m-tab-contenido');

    let intervaloCarrusel; 
    let datosCarreraActual = {}; // Aquí guardaremos los textos de la carrera seleccionada

    if(modalDetalle) {
        // 1. ABRIR EL MODAL Y CARGAR DATOS
        botonesVerDetalles.forEach(boton => {
            boton.addEventListener('click', (e) => {
                e.preventDefault(); 
                
                // Extraer textos y guardarlos en memoria
                datosCarreraActual = {
                    mision: boton.getAttribute('data-mision') || 'Información de misión no disponible.',
                    vision: boton.getAttribute('data-vision') || 'Información de visión no disponible.',
                    objetivo: boton.getAttribute('data-objetivo') || 'Información de objetivo no disponible.',
                    perfil: boton.getAttribute('data-perfil') || 'Información de perfil no disponible.',
                    campo: boton.getAttribute('data-campo') || 'Información de campo laboral no disponible.'
                };
                
                mNivel.textContent = boton.getAttribute('data-nivel');
                mTitulo.textContent = boton.getAttribute('data-titulo');
                
                // Resetear Pestañas (Seleccionar la primera por defecto)
                tabBtns.forEach(b => b.classList.remove('activo'));
                document.querySelector('.m-tab-btn[data-tab="mision"]').classList.add('activo');
                tabContent.textContent = datosCarreraActual.mision;

                // ... (AQUÍ VA EXACTAMENTE EL MISMO CÓDIGO DEL CARRUSEL QUE YA TENÍAS) ...
                const stringImagenes = boton.getAttribute('data-imgs');
                mCarrusel.innerHTML = ''; 
                clearInterval(intervaloCarrusel);

                if(stringImagenes) {
                    const arrayImagenes = stringImagenes.split(',');
                    arrayImagenes.forEach((imgSrc, index) => {
                        const claseActiva = index === 0 ? 'activa' : '';
                        mCarrusel.innerHTML += `<img src="${imgSrc.trim()}" class="m-carrusel-img ${claseActiva}" alt="Foto">`;
                    });

                    const imagenesDOM = mCarrusel.querySelectorAll('.m-carrusel-img');
                    let slideActual = 0;
                    if(imagenesDOM.length > 1) {
                        intervaloCarrusel = setInterval(() => {
                            imagenesDOM[slideActual].classList.remove('activa');
                            slideActual = (slideActual + 1) % imagenesDOM.length;
                            imagenesDOM[slideActual].classList.add('activa');
                        }, 3000); 
                    }
                }

                modalDetalle.classList.add('activo');
            });
        });

        // 2. LÓGICA DE CLIC EN LAS PESTAÑAS
        tabBtns.forEach(btn => {
            btn.addEventListener('click', () => {
                // Quitar clase 'activo' a todos los botones
                tabBtns.forEach(b => b.classList.remove('activo'));
                
                // Poner clase 'activo' al botón clickeado
                btn.classList.add('activo');
                
                // Cambiar el texto usando el atributo data-tab
                const tabId = btn.getAttribute('data-tab'); // ej. "perfil"
                tabContent.textContent = datosCarreraActual[tabId];
            });
        });

        // 3. CERRAR MODAL
        function cerrarModal() {
            modalDetalle.classList.remove('activo');
            clearInterval(intervaloCarrusel); 
        }

        if(btnCerrarModal) btnCerrarModal.addEventListener('click', cerrarModal);
        if(btnPedirInfo) btnPedirInfo.addEventListener('click', cerrarModal);

        window.addEventListener('click', (e) => {
            if (e.target === modalDetalle) {
                cerrarModal();
            }
        });
    }
});

