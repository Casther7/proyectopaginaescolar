document.addEventListener('DOMContentLoaded', () => {
    // --- LÓGICA DE LA VENTANA FLOTANTE DE NOTICIAS (PÚBLICO) ---
    const modalNoticia = document.getElementById('modal-noticia');
    const btnCerrarNoticia = document.getElementById('btn-cerrar-noticia');
    const botonesLeerNoticia = document.querySelectorAll('.btn-leer-noticia');

    // Elementos donde inyectaremos la información de la noticia
    const mNoticiaImg = document.getElementById('m-noticia-img');
    const mNoticiaFecha = document.getElementById('m-noticia-fecha');
    const mNoticiaCat = document.getElementById('m-noticia-cat');
    const mNoticiaTitulo = document.getElementById('m-noticia-titulo');
    const mNoticiaDesc = document.getElementById('m-noticia-desc');

    // Verificamos que el modal exista en la página antes de ejecutar el código
    if(modalNoticia) {
        
        // 1. Escuchar el clic en todos los botones de "Leer noticia"
        botonesLeerNoticia.forEach(boton => {
            boton.addEventListener('click', (e) => {
                e.preventDefault(); // Evita que la página salte hacia arriba por el href="#"
                
                // Extraer los datos guardados en el botón (data-attributes)
                const img = boton.getAttribute('data-img');
                const fecha = boton.getAttribute('data-fecha');
                const cat = boton.getAttribute('data-cat');
                const titulo = boton.getAttribute('data-titulo');
                const desc = boton.getAttribute('data-desc');

                // Inyectar los datos en el Modal
                if (mNoticiaImg) mNoticiaImg.src = img;
                if (mNoticiaFecha) mNoticiaFecha.textContent = fecha;
                if (mNoticiaCat) mNoticiaCat.textContent = cat;
                if (mNoticiaTitulo) mNoticiaTitulo.textContent = titulo;
                if (mNoticiaDesc) mNoticiaDesc.textContent = desc;

                // Mostrar el Modal agregando la clase 'activo'
                modalNoticia.classList.add('activo');
            });
        });

        // 2. Cerrar el modal al hacer clic en la tachita (X)
        if(btnCerrarNoticia) {
            btnCerrarNoticia.addEventListener('click', () => {
                modalNoticia.classList.remove('activo');
            });
        }

        // 3. Cerrar el modal al hacer clic afuera de la caja blanca (en el fondo oscuro)
        window.addEventListener('click', (e) => {
            if (e.target === modalNoticia) {
                modalNoticia.classList.remove('activo');
            }
        });
    }
});