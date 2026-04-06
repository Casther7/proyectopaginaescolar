// Variables globales
let carrito = [];
let productoActualId = null;

// ==================== MODAL DE PRODUCTO ====================
function abrirModal(nombre, precio, desc, imagen, tieneTalla, id) {
    const modal = document.getElementById('modalProducto');
    productoActualId = id;  // Guardar el ID globalmente
    
    document.getElementById('tituloModal').innerText = nombre;
    document.getElementById('precioModal').innerText = precio;
    document.getElementById('descModal').innerText = desc;
    document.getElementById('imgModal').src = imagen;
    
    const contenedorTalla = document.getElementById('contenedorTalla');
    if (contenedorTalla) {
        contenedorTalla.style.display = tieneTalla ? 'block' : 'none';
    }
    
    // Resetear cantidad
    const inputCant = document.getElementById('cantidadProducto');
    if(inputCant) inputCant.value = 1;
    
    // Resetear talla seleccionada
    const inputTalla = document.getElementById('tallaSeleccionada');
    if(inputTalla) inputTalla.value = '';
    
    document.querySelectorAll('.talla-btn').forEach(btn => {
        btn.classList.remove('active');
    });
    
    modal.style.display = 'flex';
}

function cerrarModal() {
    document.getElementById('modalProducto').style.display = 'none';
}

// Selección de talla
$(document).on('click', '.talla-btn', function() {
    $('.talla-btn').removeClass('active');
    $(this).addClass('active');
    $('#tallaSeleccionada').val($(this).data('talla'));
});

// ==================== CARRITO ====================
function toggleCarrito(event) {
    if (event) event.stopPropagation();
    const elementoCarrito = document.getElementById('carrito-lateral');
    if (elementoCarrito) {
        elementoCarrito.classList.toggle('active');
    }
}

function agregarAlCarrito() {
    const nombre = document.getElementById('tituloModal').innerText;
    const precioTexto = document.getElementById('precioModal').innerText;
    const precio = parseFloat(precioTexto.replace(/[^\d.]/g, ''));
    const imagen = document.getElementById('imgModal').src;
    const cantidad = parseInt(document.getElementById('cantidadProducto').value) || 1;
    const talla = document.getElementById('tallaSeleccionada')?.value;
    
    // Obtener el ID del producto actual
    const id = productoActualId;
    
    const contenedorTalla = document.getElementById('contenedorTalla');
    if (contenedorTalla && contenedorTalla.style.display !== 'none' && !talla) {
        alert("❌ Por favor selecciona una talla");
        return;
    }
    
    // Buscar si ya existe (mismo nombre y misma talla)
    const indiceExistente = carrito.findIndex(prod => prod.nombre === nombre && prod.talla === talla);
    
    if (indiceExistente !== -1) {
        carrito[indiceExistente].cantidad += cantidad;
    } else {
        carrito.push({ 
            id: id,  // Guardar el ID
            nombre, 
            precio, 
            imagen, 
            cantidad, 
            talla 
        });
    }
    
    console.log("Carrito actualizado:", carrito); // Para depuración
    
    actualizarInterfazCarrito();
    cerrarModal();
    toggleCarrito();
}

function actualizarInterfazCarrito() {
    const lista = document.getElementById('lista-carrito');
    const totalElem = document.getElementById('total-carrito');
    
    lista.innerHTML = '';
    let totalPrecio = 0;
    let totalUnidades = 0;
    
    if (carrito.length === 0) {
        lista.innerHTML = '<p class="carrito-vacio">🛍️ Tu carrito está vacío</p>';
    } else {
        carrito.forEach((prod, index) => {
            const subtotal = prod.precio * prod.cantidad;
            totalPrecio += subtotal;
            totalUnidades += prod.cantidad;
            
            lista.innerHTML += `
                <div class="item-carrito">
                    <img src="${prod.imagen}" alt="${prod.nombre}">
                    <div class="item-carrito-info">
                        <p>${prod.nombre}</p>
                        <small>${prod.talla ? 'Talla: ' + prod.talla : ''}</small>
                        <p>${prod.cantidad} x $${prod.precio.toFixed(2)} = <strong>$${subtotal.toFixed(2)}</strong></p>
                    </div>
                    <button class="btn-eliminar" onclick="eliminarDelCarrito(${index})">&times;</button>
                </div>
            `;
        });
    }
    
    // Actualizar badge del carrito en navbar si existe
    const contador = document.getElementById('contador-carrito');
    if(contador) contador.innerText = totalUnidades;
    if(totalElem) totalElem.innerText = totalPrecio.toFixed(2);
}

function eliminarDelCarrito(index) {
    carrito.splice(index, 1);
    actualizarInterfazCarrito();
}

// Cerrar modal al hacer clic fuera
window.addEventListener('click', function(event) {
    const modal = document.getElementById('modalProducto');
    const carritoElem = document.getElementById('carrito-lateral');
    
    if (event.target === modal) {
        cerrarModal();
    }
    
    if (carritoElem && carritoElem.classList.contains('active') && !carritoElem.contains(event.target)) {
        if (!event.target.closest('.icono-carrito') && !event.target.closest('#carrito-lateral')) {
            carritoElem.classList.remove('active');
        }
    }
});

// ==================== PAGO ====================
let metodoPago = "";

function abrirModalPago() {
    if (carrito.length === 0) {
        alert("🛒 El carrito está vacío");
        return;
    }
    document.getElementById('modalPago').style.display = 'flex';
}

function cerrarModalPago() {
    document.getElementById('modalPago').style.display = 'none';
}

function seleccionarPago(metodo) {
    metodoPago = metodo;
    document.getElementById('metodoSeleccionado').innerHTML = "✅ Seleccionado: " + metodo;
}

function confirmarCompra() {
    if (carrito.length === 0) {
        alert("🛒 El carrito está vacío");
        return;
    }
    
    if (!metodoPago) {
        alert("❌ Por favor selecciona un método de pago");
        return;
    }
    
    // Preparar los datos del carrito para enviar
    const datosCarrito = carrito.map(item => ({
        id: item.id || null,
        nombre: item.nombre,
        cantidad: item.cantidad,
        precio: item.precio,
        talla: item.talla || null
    }));
    
    console.log("Enviando carrito:", datosCarrito); // Para depuración
    
    $.ajax({
        url: "/proyectopaginaescolar/ajax/comprar_carrito.php",
        type: "POST",
        contentType: "application/json", // Enviar como JSON
        data: JSON.stringify({ carrito: datosCarrito }),
        dataType: "json",
        
        success: function(respuesta) {
            console.log("Respuesta:", respuesta);
            
            if (respuesta.status === "success") {
                alert("✅ " + respuesta.message);
                // Vaciar carrito
                carrito = [];
                actualizarInterfazCarrito();
                cerrarModalPago();
                // Actualizar badge del carrito
                const contador = document.getElementById('contador-carrito');
                if(contador) contador.innerText = "0";
            } else {
                alert("❌ " + respuesta.message);
            }
        },
        
        error: function(xhr, status, error) {
            console.error("Error detallado:", {
                status: xhr.status,
                statusText: xhr.statusText,
                responseText: xhr.responseText,
                error: error
            });
            
            let mensajeError = "Error en la compra. ";
            try {
                const respuesta = JSON.parse(xhr.responseText);
                mensajeError += respuesta.message || "";
            } catch(e) {
                mensajeError += "Intenta nuevamente.";
            }
            alert("❌ " + mensajeError);
        }
    });
}

// ==================== CARRUSEL HERO ====================
let slideActual = 0;
const slides = document.querySelectorAll('.hero-slide');
const dots = document.querySelectorAll('.dot');
let intervaloAutomatico;

function mostrarSlide(index) {
    slides.forEach((slide, i) => {
        slide.classList.remove('active');
        if (dots[i]) dots[i].classList.remove('active');
    });
    
    slides[index].classList.add('active');
    if (dots[index]) dots[index].classList.add('active');
    slideActual = index;
}

function cambiarSlide(direccion) {
    let nuevaPosicion = slideActual + direccion;
    if (nuevaPosicion < 0) nuevaPosicion = slides.length - 1;
    if (nuevaPosicion >= slides.length) nuevaPosicion = 0;
    mostrarSlide(nuevaPosicion);
    reiniciarAutomatico();
}

function irASlide(index) {
    mostrarSlide(index);
    reiniciarAutomatico();
}

function iniciarAutomatico() {
    intervaloAutomatico = setInterval(() => {
        cambiarSlide(1);
    }, 5000);
}

function reiniciarAutomatico() {
    clearInterval(intervaloAutomatico);
    iniciarAutomatico();
}

// Iniciar carrusel automático
if (slides.length > 0) {
    iniciarAutomatico();
    
    // Pausar al hacer hover
    const heroBanner = document.querySelector('.hero-banner');
    if (heroBanner) {
        heroBanner.addEventListener('mouseenter', () => clearInterval(intervaloAutomatico));
        heroBanner.addEventListener('mouseleave', iniciarAutomatico);
    }
}

// ==================== ELIMINAR PRODUCTO CON SWEETALERT ====================
$(document).on("click", ".btn-eliminar", function() {
    const id = $(this).attr("data-id");
    const nombre = $(this).attr("data-nombre");
    
    Swal.fire({
        title: '¿Eliminar producto?',
        html: `Estás por eliminar <strong>${nombre}</strong><br>Esta acción no se puede deshacer.`,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#dc3545',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Sí, eliminar',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: "/proyectopaginaescolar/ajax/eliminar_producto.php",
                type: "POST",
                data: { id: id },
                dataType: "json",
                success: function(respuesta) {
                    if (respuesta.status === "success") {
                        Swal.fire({
                            title: '¡Eliminado!',
                            text: respuesta.message,
                            icon: 'success',
                            timer: 1500,
                            showConfirmButton: false
                        }).then(() => {
                            location.reload();
                        });
                    } else {
                        Swal.fire('Error', respuesta.message, 'error');
                    }
                },
                error: function() {
                    Swal.fire('Error', 'No se pudo eliminar el producto', 'error');
                }
            });
        }
    });
});

// ==================== BOTÓN DE INICIO CON SCROLL ====================
const btnInicio = document.querySelector('.btn-inicio-flotante');

if (btnInicio) {
    // Ocultar al inicio
    btnInicio.style.opacity = '0';
    btnInicio.style.visibility = 'hidden';
    btnInicio.style.transition = 'all 0.3s ease';
    
    // Mostrar después de scroll
    window.addEventListener('scroll', function() {
        if (window.scrollY > 300) {
            btnInicio.style.opacity = '1';
            btnInicio.style.visibility = 'visible';
        } else {
            btnInicio.style.opacity = '0';
            btnInicio.style.visibility = 'hidden';
        }
    });
}