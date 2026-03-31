document.addEventListener('DOMContentLoaded', () => {
    // --- LÓGICA DE LA VENTANA FLOTANTE DE NOTICIAS ---
    const modalNoticia = document.getElementById('modal-noticia');
    const btnCerrarNoticia = document.getElementById('btn-cerrar-noticia');
    const botonesLeerNoticia = document.querySelectorAll('.btn-leer-noticia');

    // Elementos donde inyectaremos la información
    const mNoticiaImg = document.getElementById('m-noticia-img');
    const mNoticiaFecha = document.getElementById('m-noticia-fecha');
    const mNoticiaCat = document.getElementById('m-noticia-cat');
    const mNoticiaTitulo = document.getElementById('m-noticia-titulo');
    const mNoticiaDesc = document.getElementById('m-noticia-desc');

    if(modalNoticia) {
        botonesLeerNoticia.forEach(boton => {
            boton.addEventListener('click', (e) => {
                e.preventDefault(); // Evita que la página salte hacia arriba por el href="#"
                
                // 1. Extraer los datos del botón clickeado
                const img = boton.getAttribute('data-img');
                const fecha = boton.getAttribute('data-fecha');
                const cat = boton.getAttribute('data-cat');
                const titulo = boton.getAttribute('data-titulo');
                const desc = boton.getAttribute('data-desc');

                // 2. Inyectar datos al Modal
                mNoticiaImg.src = img;
                mNoticiaFecha.textContent = fecha;
                mNoticiaCat.textContent = cat;
                mNoticiaTitulo.textContent = titulo;
                mNoticiaDesc.textContent = desc;

                // 3. Mostrar Modal
                modalNoticia.classList.add('activo');
            });
        });

        // Cerrar con la tachita
        if(btnCerrarNoticia) {
            btnCerrarNoticia.addEventListener('click', () => {
                modalNoticia.classList.remove('activo');
            });
        }

        // Cerrar dando clic afuera de la caja blanca
        window.addEventListener('click', (e) => {
            if (e.target === modalNoticia) {
                modalNoticia.classList.remove('activo');
            }
        });
    }
});