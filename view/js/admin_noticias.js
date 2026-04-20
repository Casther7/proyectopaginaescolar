$(document).ready(function() {
    // 1. Cargar la lista de noticias al abrir el panel
    listarNoticiasAdmin();

    // 2. Guardar nueva noticia
    $("#btnGuardarNoticia").click(function(e) {
        e.preventDefault();

        // Validar que los campos no estén vacíos
        if(!$("#not_titulo").val() || !$("#not_archivo")[0].files[0] || !$("#not_descripcion").val()) {
            alert("⚠️ Faltan campos por llenar o la imagen de portada.");
            return;
        }

        let formData = new FormData();
        formData.append('action', 'agregar');
        formData.append('titulo', $("#not_titulo").val());
        formData.append('categoria', $("#not_categoria").val());
        formData.append('fecha', $("#not_fecha").val());
        formData.append('descripcion', $("#not_descripcion").val());
        formData.append('archivo', $("#not_archivo")[0].files[0]);

        $.ajax({
            url: 'ajax/ajax_noticias.php',
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function(res) {
                if (res.status === 'success') {
                    alert("✅ Noticia publicada exitosamente");
                    location.reload();
                } else {
                    alert("❌ Error al publicar: " + res.message);
                }
            },
            error: function() {
                alert("❌ Error de conexión con el servidor.");
            }
        });
    });

    // 3. Función para listar las noticias en una tabla
    function listarNoticiasAdmin() {
        $.get('ajax/ajax_noticias.php', { action: 'listar' }, function(res) {
            if(res.status === 'success' && res.noticias.length > 0) {
                let html = '<table style="width:100%; text-align:left; border-collapse: collapse; margin-top:10px;">';
                res.noticias.forEach(n => {
                    html += `
                    <tr style="border-bottom: 1px solid #eee;">
                        <td style="padding:10px; width:60px;"><img src="${n.imagen}" style="width:50px; height:50px; border-radius:5px; object-fit:cover;"></td>
                        <td style="padding:10px;">
                            <strong>${n.titulo}</strong><br>
                            <span style="font-size:0.8rem; color:#64748b;">${n.fecha} | ${n.categoria}</span>
                        </td>
                        <td style="padding:10px; text-align:right;">
                            <button onclick="eliminarNoticia(${n.id})" style="color:white; background:#e74c3c; border:none; padding:5px 10px; border-radius:4px; cursor:pointer;">Eliminar</button>
                        </td>
                    </tr>`;
                });
                html += '</table>';
                $("#listaNoticiasAdmin").html(html);
            } else {
                $("#listaNoticiasAdmin").html('<p style="color:#64748b;">No hay noticias publicadas aún.</p>');
            }
        }, 'json');
    }
});

// 4. Función global para eliminar una noticia (debe ir fuera del document.ready)
function eliminarNoticia(id) {
    if (confirm("¿Estás seguro de eliminar esta noticia? Esta acción no se puede deshacer.")) {
        $.post('ajax/ajax_noticias.php', { action: 'eliminar', id: id }, function(res) {
            if(res.status === 'success') {
                alert("🗑️ Noticia eliminada");
                location.reload();
            } else {
                alert("Error al eliminar");
            }
        }, 'json');
    }
}