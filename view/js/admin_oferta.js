$(document).ready(function() {
    // 1. Cargar la lista al iniciar
    listarOfertasAdmin();

    // 2. Delegación de eventos para el botón de guardado
    $(document).on('click', '#btnGuardarOferta', function(e) {
        e.preventDefault();
        
        console.log("Iniciando guardado de oferta...");

        let formData = new FormData();
        formData.append('action', 'agregar');
        formData.append('nivel', $("#of_nivel").val());
        formData.append('titulo', $("#of_titulo").val());
        formData.append('desc_corta', $("#of_desc_corta").val());
        formData.append('mision', $("#of_mision").val());
        formData.append('vision', $("#of_vision").val());
        
        // Estos campos no estaban en el HTML pero los mantengo por si los usas en el modelo
        formData.append('objetivo', $("#of_objetivo").val() || '');
        formData.append('perfil', $("#of_perfil").val() || '');
        formData.append('campo', $("#of_campo").val() || '');

        // Imagen Principal
        let imgPrincipal = $("#of_archivo_principal")[0].files[0];
        if(imgPrincipal) {
            formData.append('archivo_principal', imgPrincipal);
        }

        // Galería de Imágenes (Múltiples)
        let galeria = $("#of_galeria")[0].files;
        for (let i = 0; i < galeria.length; i++) {
            formData.append('galeria[]', galeria[i]);
        }

        // Validación básica
        if(!$("#of_titulo").val() || !imgPrincipal) {
            alert("⚠️ El nombre de la carrera y la imagen principal son obligatorios.");
            return;
        }

        $.ajax({
            url: 'ajax/ajax_oferta.php',
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function(res) {
                // Asegurar que res sea objeto si no viene parseado
                let response = (typeof res === 'string') ? JSON.parse(res) : res;
                
                if (response.status === 'success') {
                    alert("✅ Carrera publicada correctamente.");
                    location.reload();
                } else {
                    alert("❌ Error: " + response.message);
                }
            },
            error: function() {
                alert("❌ Error de comunicación con el servidor.");
            }
        });
    });
});

/**
 * Función para listar las carreras en el panel administrativo
 */
function listarOfertasAdmin() {
    $.get('ajax/ajax_oferta.php', { action: 'listar' }, function(res) {
        let response = (typeof res === 'string') ? JSON.parse(res) : res;

        if(response.status === 'success' && response.ofertas.length > 0) {
            let html = '<table style="width:100%; border-collapse: collapse;">';
            response.ofertas.forEach(o => {
                html += `
                <tr style="border-bottom: 1px solid #eee;">
                    <td style="padding:10px;">
                        <img src="${o.imagen_principal}" width="40" style="border-radius:4px; object-fit: cover;">
                    </td>
                    <td><strong>${o.titulo}</strong></td>
                    <td style="text-align:right; padding-right: 10px;">
                        <button type="button" onclick="eliminarOferta(${o.id})" style="color:red; background:none; border:none; cursor:pointer; font-weight:bold;">
                            Eliminar
                        </button>
                    </td>
                </tr>`;
            });
            html += '</table>';
            $("#listaOfertaAdmin").html(html);
        } else {
            $("#listaOfertaAdmin").html('<p style="text-align:center; color:gray; padding:20px;">No hay carreras registradas.</p>');
        }
    }, 'json');
}

/**
 * Función Global para eliminar (Fuera del ready para que sea accesible por el onclick)
 */
function eliminarOferta(id) {
    if (confirm("¿Estás seguro de que deseas eliminar esta carrera? Esta acción no se puede deshacer.")) {
        $.ajax({
            url: 'ajax/ajax_oferta.php',
            type: 'POST',
            data: { 
                action: 'eliminar', 
                id: id 
            },
            dataType: 'json',
            success: function(res) {
                if (res.status === 'success') {
                    alert("✅ Carrera eliminada exitosamente.");
                    listarOfertasAdmin(); // Refresca la lista sin recargar página
                } else {
                    alert("❌ Error al eliminar: " + res.message);
                }
            },
            error: function() {
                alert("❌ Error de comunicación con el servidor al intentar eliminar.");
            }
        });
    }
}