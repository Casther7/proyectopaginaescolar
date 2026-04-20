$(document).on('click', '#btnGuardarHero', function(e) {
    e.preventDefault();
    console.log("Botón de Banner presionado"); // Esto aparecerá en la consola (F12)

    let tipo = $("#hero_tipo").val();
    let formData = new FormData();
    
    formData.append('action', 'agregar');
    formData.append('seccion', 'hero'); 
    formData.append('tipo', tipo);
    formData.append('titulo', $("#hero_titulo").val());
    formData.append('subtitulo', $("#hero_subtitulo").val());

    // Seleccionamos el archivo según el tipo (imagen o video)
    let archivo;
    if(tipo === 'imagen'){
        archivo = $("#hero_archivo_img")[0].files[0];
    } else {
        archivo = $("#hero_archivo_vid")[0].files[0];
    }
    
    // Si no hay archivo nuevo, el sistema no enviará nada
    if(!archivo && $("#hero_titulo").val() === "") {
        alert("⚠️ Por favor completa los campos o selecciona un archivo.");
        return;
    }

    formData.append('archivo', archivo);

    $.ajax({
        url: 'ajax/ajax_hero.php',
        type: 'POST',
        data: formData,
        contentType: false,
        processData: false,
        success: function(res) {
            console.log("Respuesta del servidor:", res);
            if(res.status === "success") {
                alert("✅ ¡Banner actualizado con éxito!");
                location.reload();
            } else {
                alert("❌ Error: " + res.message);
            }
        },
        error: function(jqXHR, textStatus, errorThrown) {
            console.error("Error en AJAX:", textStatus, errorThrown);
            alert("❌ Hubo un fallo en la conexión con el servidor.");
        }
    });
});