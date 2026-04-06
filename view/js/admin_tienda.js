// Variables globales
let modalEditando = false;

// ==================== EDITAR PRODUCTO ====================
$(document).on("click", ".btn-editar", function() {
    // Captura de datos
    const id = $(this).attr("data-id");
    const nombre = $(this).attr("data-nombre");
    const stock = $(this).attr("data-stock");
    const precio = $(this).attr("data-precio");
    const tallas = $(this).attr("data-tallas");
    const imagen = $(this).attr("data-imagen");

    // Asignar al formulario
    $("#edit-id").val(id);
    $("#edit-nombre").val(nombre);
    $("#edit-stock").val(stock);
    $("#edit-precio").val(precio);
    $("#edit-tallas").val(tallas);
    $("#edit-preview").attr("src", imagen);

    // Abrir modal
    $("#modalPersonalizado").fadeIn(200);
});

function cerrarModal() {
    $("#modalPersonalizado").fadeOut(200);
}

// Previsualización imagen editar
$(document).on("change", "#modalPersonalizado input[name='imagen']", function() {
    const file = this.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            $('#edit-preview').attr('src', e.target.result);
        }
        reader.readAsDataURL(file);
    }
});

// Envío formulario editar
$(document).on("submit", "#formEditar", function(e) {
    e.preventDefault();

    let formData = new FormData(this);

    $.ajax({
        url: "/proyectopaginaescolar/ajax/ajax.php",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        success: function(respuesta) {
            if (respuesta.status === "success") {
                alert("✅ " + respuesta.message);
                cerrarModal();
                location.reload();
            } else {
                alert("❌ " + respuesta.message);
            }
        },
        error: function() {
            alert("❌ Error en AJAX");
        }
    });
});

// ==================== ELIMINAR PRODUCTO ====================
$(document).on("click", ".btn-eliminar", function() {
    const id = $(this).attr("data-id");
    const nombre = $(this).attr("data-nombre");
    
    // Confirmación con SweetAlert o confirm nativo
    const confirmar = confirm(`¿Estás seguro de que deseas eliminar el producto "${nombre}"?\n\nEsta acción no se puede deshacer.`);
    
    if (confirmar) {
        $.ajax({
            url: "/proyectopaginaescolar/ajax/eliminar_producto.php",
            type: "POST",
            data: { id: id },
            dataType: "json",
            success: function(respuesta) {
                if (respuesta.status === "success") {
                    alert("✅ " + respuesta.message);
                    location.reload();
                } else {
                    alert("❌ " + respuesta.message);
                }
            },
            error: function(xhr, status, error) {
                console.error("Error:", error);
                alert("❌ Error al eliminar el producto");
            }
        });
    }
});

// ==================== AGREGAR PRODUCTO ====================
function abrirModalAgregar() {
    $("#modalAgregar").fadeIn(200);
    // Resetear formulario
    $("#formAgregar")[0].reset();
    $("#agregar-preview").attr("src", "data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='80' height='80' viewBox='0 0 24 24' fill='none' stroke='%23999' stroke-width='1' stroke-linecap='round' stroke-linejoin='round'%3E%3Crect x='3' y='3' width='18' height='18' rx='2' ry='2'%3E%3C/rect%3E%3Ccircle cx='8.5' cy='8.5' r='1.5'%3E%3C/circle%3E%3Cpolyline points='21 15 16 10 5 21'%3E%3C/polyline%3E%3C/svg%3E");
}

function cerrarModalAgregar() {
    $("#modalAgregar").fadeOut(200);
}

// Previsualización imagen agregar
$(document).on("change", "#imagen-agregar", function() {
    const file = this.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            $('#agregar-preview').attr('src', e.target.result);
        }
        reader.readAsDataURL(file);
    }
});

// Envío formulario agregar
$(document).on("submit", "#formAgregar", function(e) {
    e.preventDefault();

    let formData = new FormData(this);

    $.ajax({
        url: "/proyectopaginaescolar/ajax/agregar_producto.php",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        success: function(respuesta) {
            if (respuesta.status === "success") {
                alert("✅ Producto agregado correctamente");
                cerrarModalAgregar();
                location.reload();
            } else {
                alert("❌ Error: " + respuesta.message);
            }
        },
        error: function(xhr, status, error) {
            console.error("Error:", error);
            alert("❌ Error al agregar producto. Revisa la consola.");
        }
    });
});

// Cerrar modales al hacer click fuera
$(document).on("click", "#modalAgregar", function(e) {
    if (e.target === this) {
        cerrarModalAgregar();
    }
});

$(document).on("click", "#modalPersonalizado", function(e) {
    if (e.target === this) {
        cerrarModal();
    }
});