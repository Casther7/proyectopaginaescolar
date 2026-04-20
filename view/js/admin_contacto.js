$(document).on('click', '#btnGuardarContacto', function() {
    const datos = {
        action: 'actualizar',
        telefono: $('#edit_con_tel').val(),
        correo: $('#edit_con_correo').val(),
        horario: $('#edit_con_horario').val(),
        ubicacion: $('#edit_con_ubi').val()
    };

    $.post('ajax/ajax_contacto.php', datos, function(res) {
        if(res === "ok") {
            alert("✅ Información actualizada correctamente");
            location.reload();
        } else {
            alert("❌ Error al actualizar");
        }
    });
});