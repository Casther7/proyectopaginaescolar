$(document).ready(function() {
    console.log("✅ ofertaacademica.js cargado correctamente");
    
    // 1. Delegación de eventos para el botón Ver Detalles
    $(document).on('click', '.btn-detalles', function(e) {
        e.preventDefault();
        e.stopPropagation(); // Evitar propagación
        
        console.log("🔍 Botón detalles clickeado");
        
        const btn = $(this);
        const modal = $('.modal-flotante'); 
        
        console.log("📊 Datos del botón:", {
            titulo: btn.data('titulo'),
            nivel: btn.data('nivel'),
            imgs: btn.data('imgs')
        });

        // Extraer datos
        window.datosCarreraActual = {
            mision: btn.data('mision') || 'No disponible',
            vision: btn.data('vision') || 'No disponible',
            objetivo: btn.data('objetivo') || 'No disponible',
            perfil: btn.data('perfil') || 'No disponible',
            campo: btn.data('campo') || 'No disponible'
        };

        // Inyectar textos
        $('#m-titulo').text(btn.data('titulo') || 'Sin título');
        $('#m-nivel').text(btn.data('nivel') || 'Sin nivel');
        $('#m-tab-contenido').text(window.datosCarreraActual.mision);

        // Carrusel del Modal
        const imagenes = btn.data('imgs') ? btn.data('imgs').split(',') : [];
        const carrusel = $('#m-carrusel');
        carrusel.empty();
        
        console.log("🖼️ Imágenes encontradas:", imagenes.length);

        if (imagenes.length > 0) {
            imagenes.forEach((src, index) => {
                const img = $('<img>').attr('src', src.trim()).addClass('m-carrusel-img');
                if (index === 0) img.addClass('activa');
                carrusel.append(img);
            });
        } else {
            carrusel.html('<p style="color:white; text-align:center;">No hay imágenes disponibles</p>');
        }

        // Activar primera pestaña
        $('.m-tab-btn').removeClass('activo');
        $('.m-tab-btn[data-tab="mision"]').addClass('activo');

        // Mostrar modal
        modal.addClass('activo');
        $('body').css('overflow', 'hidden');
        
        console.log("✅ Modal debería estar visible ahora");
    });

    // 2. Lógica de las Pestañas (Tabs)
    $(document).on('click', '.m-tab-btn', function() {
        const tabId = $(this).data('tab');
        $('.m-tab-btn').removeClass('activo');
        $(this).addClass('activo');
        
        if (window.datosCarreraActual && window.datosCarreraActual[tabId]) {
            $('#m-tab-contenido').text(window.datosCarreraActual[tabId]);
        } else {
            $('#m-tab-contenido').text('Información no disponible');
        }
    });

    // 3. Cerrar Modal
    function cerrarModal() {
        $('#modal-carrera-detalle').removeClass('activo');
        $('body').css('overflow', 'auto');
    }

    $(document).on('click', '#btn-cerrar-modal-carrera', cerrarModal);
    
    $(window).on('click', function(e) {
        if ($(e.target).is('#modal-carrera-detalle')) {
            cerrarModal();
        }
    });
    
    // ESC para cerrar
    $(document).on('keydown', function(e) {
        if (e.key === 'Escape') {
            cerrarModal();
        }
    });

    // =============================
// CARRUSEL DE CARRERAS
// =============================

let index = 0;

const track = document.querySelector('.carreras-track');
const cards = document.querySelectorAll('.carrera-card');
const btnNext = document.querySelector('.flecha-der');
const btnPrev = document.querySelector('.flecha-izq');

function actualizarCarrusel() {
    const visibles = 2;
    const total = cards.length;

    // Evitar que se salga del rango
    if (index < 0) index = 0;
    if (index > total - visibles) index = total - visibles;

    const cardWidth = cards[0].offsetWidth + 30; // 30 = gap
    track.style.transform = `translateX(-${index * cardWidth}px)`;
}

// Botón siguiente
if (btnNext) {
    btnNext.addEventListener('click', () => {
        index++;
        actualizarCarrusel();
    });
}

// Botón anterior
if (btnPrev) {
    btnPrev.addEventListener('click', () => {
        index--;
        actualizarCarrusel();
    });
}

// Ajuste al cargar
window.addEventListener('load', actualizarCarrusel);
});
