$(document).on('click', '#btnGuardarHero', function(e) {
    e.preventDefault();

    let tipo = $("#hero_tipo").val();
    let formData = new FormData();
    
    formData.append('action', 'agregar');
    formData.append('seccion', 'hero'); 
    formData.append('tipo', tipo);
    formData.append('titulo', $("#hero_titulo").val());
    formData.append('subtitulo', $("#hero_subtitulo").val());

    let archivo;
    if(tipo === 'imagen'){
        archivo = $("#hero_archivo_img")[0].files[0];
    } else {
        archivo = $("#hero_archivo_vid")[0].files[0];
    }
    
    if(archivo) {
        formData.append('archivo', archivo);
    }

    $.ajax({
        url: 'ajax/ajax_hero.php',
        type: 'POST',
        data: formData,
        contentType: false,
        processData: false,
        dataType: 'json', // Forzamos a interpretar la respuesta como JSON
        success: function(res) {
            if(res.status === "success") {
                alert("✅ ¡Banner actualizado!");
                location.reload();
            } else {
                alert("❌ Error: " + res.message);
            }
        },
        error: function(jqXHR) {
            console.error(jqXHR.responseText);
            alert("❌ Error en el servidor. Revisa la consola.");
        }
    });
});