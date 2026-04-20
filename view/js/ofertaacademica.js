$(document).ready(function() {
    // 1. Delegación de eventos para el botón Ver Detalles
    $(document).on('click', '.btn-detalles', function(e) {
        e.preventDefault();
        
        const btn = $(this);
        // USAMOS EL ID QUE TU CSS YA OCULTA POR DEFECTO
        const modal = $('#modal-carrera-detalle'); 

        // Extraer datos
        window.datosCarreraActual = {
            mision: btn.data('mision'),
            vision: btn.data('vision'),
            objetivo: btn.data('objetivo'),
            perfil: btn.data('perfil'),
            campo: btn.data('campo')
        };

        // Inyectar textos
        $('#m-titulo').text(btn.data('titulo'));
        $('#m-nivel').text(btn.data('nivel'));
        $('#m-tab-contenido').text(window.datosCarreraActual.mision);

        // Carrusel del Modal
        const imagenes = btn.data('imgs') ? btn.data('imgs').split(',') : [];
        const carrusel = $('#m-carrusel');
        carrusel.empty();

        imagenes.forEach((src, index) => {
            const img = $('<img>').attr('src', src.trim()).addClass('m-img');
            if (index === 0) img.addClass('activa');
            carrusel.append(img);
        });

        // Mostrar con la clase que activa el CSS
        modal.addClass('activo');
        $('body').css('overflow', 'hidden');
    });

    // 2. Lógica de las Pestañas (Tabs)
    $(document).on('click', '.m-tab-btn', function() {
        const tabId = $(this).data('tab');
        $('.m-tab-btn').removeClass('activo');
        $(this).addClass('activo');
        $('#m-tab-contenido').text(window.datosCarreraActual[tabId]);
    });

    // 3. Cerrar Modal
    function cerrarModal() {
        $('#modal-carrera-detalle').removeClass('activo');
        $('body').css('overflow', 'auto');
    }

    $(document).on('click', '#btn-cerrar-modal-carrera', cerrarModal);
    
    $(window).on('click', function(e) {
        if ($(e.target).is('#modal-carrera-detalle')) cerrarModal();
    });
});
