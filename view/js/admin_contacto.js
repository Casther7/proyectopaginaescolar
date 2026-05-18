$(document).on('click', '#btnActualizarContacto', function(e) {
    e.preventDefault(); 

    // Obtenemos los valores, incluyendo el nuevo campo del mapa
    const datos = {
        action: 'actualizar',
        telefono: $('#con_tel').val(),
        correo: $('#con_correo').val(),
        horario: $('#con_horario').val(),
        ubicacion: $('#con_ubicacion').val(),
        mapa: $('#con_mapa').val() // <-- NUEVO: Asegúrate que el input tenga id="con_mapa"
    };

    console.log("Enviando datos de contacto:", datos);

    $.post('ajax/ajax_contacto.php', datos, function(res) {
        // Usamos trim() para limpiar la respuesta
        if(res.trim() === "ok") {
            alert("✅ Información actualizada correctamente");
            location.reload();
        } else {
            console.error("Respuesta del servidor:", res);
            alert("❌ Error al actualizar. Revisa la consola.");
        }
    });
});