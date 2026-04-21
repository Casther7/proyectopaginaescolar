$(document).on('click', '#btnActualizarContacto', function(e) {
    e.preventDefault(); // Evita cualquier recarga accidental

    // Obtenemos los valores usando los IDs reales del PHP
    const datos = {
        action: 'actualizar',
        telefono: $('#con_tel').val(),
        correo: $('#con_correo').val(),
        horario: $('#con_horario').val(),
        ubicacion: $('#con_ubicacion').val()
    };

    console.log("Enviando datos de contacto:", datos); // Para que revises en la consola (F12)

    $.post('ajax/ajax_contacto.php', datos, function(res) {
        // Usamos trim() por si el PHP devuelve espacios en blanco accidentales
        if(res.trim() === "ok") {
            alert("✅ Información actualizada correctamente");
            location.reload();
        } else {
            console.error("Respuesta del servidor:", res);
            alert("❌ Error al actualizar. Revisa la consola.");
        }
    });
});