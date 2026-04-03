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
    $("#modalPersonalizado").css("display", "flex").hide().fadeIn(200);
});

function cerrarModal() {
    $("#modalPersonalizado").fadeOut(200);
}


$(document).on("change", "input[name='imagen']", function() {
    const file = this.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            $('#edit-preview').attr('src', e.target.result);
        }
        reader.readAsDataURL(file);
    }
});

$(document).on("submit", "#modalPersonalizado form", function(e) {
    e.preventDefault();

    let formData = new FormData(this);

    $.ajax({
        url: $(this).attr("action"),
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

function abrirModalAgregar() {
    $("#modalAgregar").fadeIn(200);
}

function cerrarModalAgregar() {
    $("#modalAgregar").fadeOut(200);
}

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

                alert("✅ Producto agregado");

                cerrarModalAgregar();
                location.reload();

            } else {
                alert("❌ " + respuesta.message);
            }
        },

        error: function() {
            alert("❌ Error al agregar producto");
        }
    });
});