// 1. Variables globales
let carrito = [];

// 2. Funciones del Modal de Detalles
function abrirModal(titulo, precio, desc, imagen, tieneTalla) {
    
    const modal = document.getElementById('modalProducto');
    
    document.getElementById('tituloModal').innerText = titulo;
    document.getElementById('precioModal').innerText = precio;
    document.getElementById('descModal').innerText = desc;
    document.getElementById('imgModal').src = imagen;

const contenedorTalla = document.getElementById('contenedorTalla');

    if (contenedorTalla) {
    if (tieneTalla) {
        contenedorTalla.style.display = 'block';
    } else {
        contenedorTalla.style.display = 'none';
    }

    // Resetear selección
    const inputTalla = document.getElementById('tallaSeleccionada');
    if (inputTalla) inputTalla.value = '';

    document.querySelectorAll('.talla-btn').forEach(btn => {
        btn.classList.remove('active');
    });
}

    // SOLUCIÓN DILEMA 1: Resetear el input de cantidad a 1 siempre que se abra el modal
    const inputCant = document.querySelector('#modalProducto input[type="number"]');
    if(inputCant) inputCant.value = 1;
    
    modal.style.display = 'block';
}

function cerrarModal() {
    document.getElementById('modalProducto').style.display = 'none';
}

// 3. Funciones del Carrito Lateral
function toggleCarrito(event) {
    if (event) event.stopPropagation(); // Evita que el clic llegue a la ventana 'window'
    
    const elementoCarrito = document.getElementById('carrito-lateral');
    if (elementoCarrito) {
        elementoCarrito.classList.toggle('active');
        console.log("Clase active aplicada:", elementoCarrito.classList.contains('active'));
    } else {
        console.error("No se encontró el ID 'carrito-lateral'");
    }
}

function agregarAlCarrito() {
    // Obtenemos los datos actuales del modal
    const titulo = document.getElementById('tituloModal').innerText;
    const precioTexto = document.getElementById('precioModal').innerText;
    const precio = parseFloat(precioTexto.replace(/[^\d.]/g, '')); // Limpieza más segura del precio
    const imagen = document.getElementById('imgModal').src;
    
    // SOLUCIÓN DILEMA 2: Obtener la cantidad real del input
    const cantidad = parseInt(document.querySelector('#modalProducto input[type="number"]').value) || 1;

    const talla = document.getElementById('tallaSeleccionada')?.value;

const contenedorTalla = document.getElementById('contenedorTalla');

if (contenedorTalla && contenedorTalla.style.display !== 'none' && !talla) {
    alert("Selecciona una talla");
    return;
}

    // Buscamos si el producto ya existe para no duplicar filas
    const indiceExistente = carrito.findIndex(prod => prod.titulo === titulo);

    if (indiceExistente !== -1) {
        // Si ya existe, sumamos la cantidad seleccionada a la que ya teníamos
        carrito[indiceExistente].cantidad += cantidad;
    } else {
        // Si es nuevo, lo agregamos con la propiedad cantidad
        const producto = { titulo, precio, imagen, cantidad: cantidad };
        carrito.push(producto);
    }

    // Actualizamos la vista
    actualizarInterfazCarrito();
    cerrarModal();
    toggleCarrito(); 
}

function actualizarInterfazCarrito() {
    const lista = document.getElementById('lista-carrito');
    const contador = document.getElementById('contador-carrito');
    const totalElem = document.getElementById('total-carrito');
    
    lista.innerHTML = '';
    let totalPrecio = 0;
    let totalUnidades = 0;

    if (carrito.length === 0) {
        lista.innerHTML = '<p class="carrito-vacio">Tu carrito está vacío.</p>';
    } else {
        carrito.forEach((prod, index) => {
            const subtotal = prod.precio * prod.cantidad;
            totalPrecio += subtotal;
            totalUnidades += prod.cantidad; // El contador de la navbar sumará unidades totales

            lista.innerHTML += `
                <div class="item-carrito" style="display: flex; align-items: center; gap: 10px; margin-bottom: 15px; border-bottom: 1px solid #eee; padding-bottom: 10px;">
                    <img src="${prod.imagen}" width="50" height="50" style="object-fit: cover; border-radius: 4px;">
                    <div style="flex: 1;">
                        <p style="margin:0; font-weight:bold; font-size: 0.9rem;">${prod.titulo}</p>
                        <p style="margin:0; color: #666; font-size: 0.8rem;">
                            ${prod.cantidad} x $${prod.precio.toFixed(2)} = <strong>$${subtotal.toFixed(2)}</strong>
                        </p>
                    </div>
                    <button onclick="eliminarDelCarrito(${index})" style="background:none; border:none; color:red; cursor:pointer; font-size: 1.2rem;">&times;</button>
                </div>
            `;
        });
    }

    // Actualizamos el número en la Navbar (unidades totales) y el total monetario
    if(contador) contador.innerText = totalUnidades;
    if(totalElem) totalElem.innerText = totalPrecio.toFixed(2);
}

function eliminarDelCarrito(index) {
    carrito.splice(index, 1);
    actualizarInterfazCarrito();
}

// 4. Cerrar modal o carrito de forma segura
window.addEventListener('click', function(event) {
    const modal = document.getElementById('modalProducto');
    const carrito = document.getElementById('carrito-lateral');
    
    // Cerrar modal si se hace clic fuera del contenido
    if (event.target == modal) {
        cerrarModal();
    }
    
    // Cerrar carrito si se hace clic fuera de él mientras está activo
    if (carrito && carrito.classList.contains('active') && !carrito.contains(event.target)) {
        // Solo cerramos si el clic NO fue en el botón que lo abre (para evitar conflicto)
        if (!event.target.closest('.icono-carrito') && !event.target.closest('#carrito-lateral')) {
            carrito.classList.remove('active');
        }
    }
});

// =========================
// FUNCIONES DE PAGO
// =========================

let metodoPago = "";

// Abrir modal
function abrirModalPago() {
    document.getElementById('modalPago').style.display = 'block';
}

// Cerrar modal
function cerrarModalPago() {
    document.getElementById('modalPago').style.display = 'none';
}

// Seleccionar método
function seleccionarPago(metodo) {
    metodoPago = metodo;
    document.getElementById('metodoSeleccionado').innerText = "Seleccionado: " + metodo;
}

// Confirmar compra
function confirmarCompra() {
    if (!metodoPago) {
        alert("Selecciona un método de pago");
        return;
    }

    alert("Compra realizada con " + metodoPago);

    carrito = [];
    actualizarInterfazCarrito();
    cerrarModalPago();
}