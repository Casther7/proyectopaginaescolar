window.addEventListener('scroll', function() {
    const nav = document.querySelector('.navbar');
    if (window.scrollY > 50) {
        nav.style.backgroundColor = '#ffffff';
        nav.style.boxShadow = '0 2px 10px rgba(0,0,0,0.1)';
    } else {
        nav.style.backgroundColor = 'transparent';
        nav.style.boxShadow = 'none';
    }
}); // <-- AQUÍ DEBE CERRARSE EL SCROLL

// Función para abrir la ventana de login
function abrirModalAdmin() {
    // Cambia el display de 'none' a 'flex' para que se vea y se centre
    document.getElementById('modalAdmin').style.display = 'flex';
}

// Función para cerrar la ventana en la "x"
function cerrarModalAdmin() {
    // Lo vuelve a ocultar
    document.getElementById('modalAdmin').style.display = 'none';
}

// Opcional: Cerrar el modal si el administrador hace clic afuera del cuadro blanco
window.onclick = function(event) {
    let modal = document.getElementById('modalAdmin');
    if (event.target == modal) {
        modal.style.display = "none";
    }
}