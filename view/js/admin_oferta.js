$(document).ready(function() {
    listarOfertasAdmin();

    // Usamos delegación de eventos para asegurar que detecte el clic
    $(document).on('click', '#btnGuardarOferta', function(e) {
        e.preventDefault();
        
        // Verificamos en consola que el clic funciona
        console.log("Iniciando guardado de oferta...");

        let formData = new FormData();
        formData.append('action', 'agregar');
        formData.append('nivel', $("#of_nivel").val());
        formData.append('titulo', $("#of_titulo").val());
        formData.append('desc_corta', $("#of_desc_corta").val());
        formData.append('mision', $("#of_mision").val());
        formData.append('vision', $("#of_vision").val());
        formData.append('objetivo', $("#of_objetivo").val());
        formData.append('perfil', $("#of_perfil").val());
        formData.append('campo', $("#of_campo").val());

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
                if (res.status === 'success') {
                    alert("✅ Carrera publicada correctamente.");
                    location.reload();
                } else {
                    alert("❌ Error: " + res.message);
                }
            },
            error: function() {
                alert("❌ Error de comunicación con el servidor.");
            }
        });
    });
});

// Función para listar (se mantiene igual)
function listarOfertasAdmin() {
    $.get('ajax/ajax_oferta.php', { action: 'listar' }, function(res) {
        if(res.status === 'success' && res.ofertas.length > 0) {
            let html = '<table style="width:100%; border-collapse: collapse;">';
            res.ofertas.forEach(o => {
                html += `<tr style="border-bottom: 1px solid #eee;">
                    <td style="padding:10px;"><img src="${o.imagen_principal}" width="40" style="border-radius:4px;"></td>
                    <td><strong>${o.titulo}</strong></td>
                    <td style="text-align:right;"><button onclick="eliminarOferta(${o.id})" style="color:red; background:none; border:none; cursor:pointer;">Eliminar</button></td>
                </tr>`;
            });
            html += '</table>';
            $("#listaOfertaAdmin").html(html);
        }
    }, 'json');
}