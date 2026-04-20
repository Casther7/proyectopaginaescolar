$(document).ready(function() {

    // 1. Cargar textos actuales al abrir el panel
    function cargarTextosActuales() {
        const slugs = ['mision', 'vision', 'historia', 'stat_experiencia', 'stat_docentes', 'stat_egresados'];
        
        slugs.forEach(slug => {
            $.get('ajax/ajax_informacion.php', { action: 'obtener', slug: slug }, function(res) {
                // Si encuentra datos, los pone dentro del recuadro de texto
                if(res.status === 'success' && res.datos) {
    $(`#texto_${slug}`).val(res.datos.contenido);
    // Si existe un campo para el título/número, también lo llenamos
    if($(`#titulo_${slug}`).length) {
        $(`#titulo_${slug}`).val(res.datos.titulo);
    }
}
            });
        });
    }

    cargarTextosActuales();

    // 2. Guardar al hacer clic en cualquier botón de "Actualizar"
    $(document).on('click', '.btn-guardar-info', function(e) {
        e.preventDefault();
        
        const slug = $(this).data('slug'); // Sabe si presionaste mision, vision, etc.
        const contenido = $(`#texto_${slug}`).val();
        const titulo = $(`#titulo_${slug}`).length ? $(`#titulo_${slug}`).val() : slug.charAt(0).toUpperCase() + slug.slice(1);

        if(contenido.trim() === "") {
            alert("El campo no puede estar vacío");
            return;
        }

        // Enviamos los datos al PHP usando AJAX
        $.ajax({
            url: 'ajax/ajax_informacion.php',
            method: 'POST',
            data: {
                action: 'actualizar',
                slug: slug,
                titulo: titulo,
                contenido: contenido
            },
            success: function(res) {
                if(res.status === 'success') {
                    alert("✅ " + res.message);
                } else {
                    alert("❌ Error: " + res.message);
                }
            },
            error: function() {
                alert("❌ Error de conexión con el servidor");
            }
        });
    });
});