document.addEventListener('DOMContentLoaded', () => {

    // --- 1. PREVISUALIZACIÓN DE MEDIOS (BANNER Y FOTO DE PERFIL) ---
    function activarPreview(idInput, isVideo = false) {
        const input = document.getElementById(idInput);
        if (!input) return;

        input.addEventListener('change', (event) => {
            const archivo = event.target.files[0];
            const reader = new FileReader();
            
            // Busca el contenedor circular hermano
            const previewCircle = input.parentElement.parentElement.querySelector('.banner-preview-circle, .avatar-preview-container');
            
            if(!previewCircle) return;

            reader.onload = function(e) {
                previewCircle.innerHTML = ''; // Limpia el emoji placeholder
                let medioElemento = document.createElement(isVideo ? 'video' : 'img');
                
                if(isVideo){
                    medioElemento.autoplay = true;
                    medioElemento.muted = true;
                    medioElemento.loop = true;
                }
                
                medioElemento.src = e.target.result;
                previewCircle.appendChild(medioElemento);
            }
            if(archivo) reader.readAsDataURL(archivo);
        });
    }

    // Activar inputs
    activarPreview('banner_imagen', false);
    activarPreview('banner_video', true);
    activarPreview('foto_perfil', false);

});

// --- 2. MOTOR DE CAMBIO DE VISTAS ---
// Esta función va FUERA del DOMContentLoaded para que el HTML la pueda llamar
function cambiarVista(vistaDestino) {
    const todasLasVistas = ['inicio', 'diseno', 'mensajes', 'tienda', 'usuarios', 'accesos'];
    
    // Apagar todas
    todasLasVistas.forEach(vista => {
        let divVista = document.getElementById('vista-' + vista);
        let btnMenu = document.getElementById('btn-' + vista);
        
        if (divVista) divVista.style.display = 'none';
        if (btnMenu) btnMenu.classList.remove('active');
    });

    // Prender solo la elegida
    let vistaMostrar = document.getElementById('vista-' + vistaDestino);
    let btnActivar = document.getElementById('btn-' + vistaDestino);

    if (vistaMostrar) {
        vistaMostrar.style.display = 'block';
    } else {
        console.warn("La vista " + vistaDestino + " no existe.");
    }

    if (btnActivar) {
        btnActivar.classList.add('active');
    }

    // --- LÓGICA DE GESTIÓN DE OFERTA ACADÉMICA ---
    const selectorCarrera = document.getElementById('selector-carrera');
    if (selectorCarrera) {
        
        // Elementos del formulario a actualizar
        const inputsCarrera = {
            icono: document.getElementById('edit_icono'),
            nivel: document.getElementById('edit_nivel'),
            nombre: document.getElementById('edit_nombre'),
            descCorta: document.getElementById('edit_desc_corta'),
            descLarga: document.getElementById('edit_desc_larga'),
            ext1: document.getElementById('edit_extra_1'),
            ext2: document.getElementById('edit_extra_2'),
            ext3: document.getElementById('edit_extra_3')
        };

        // Bases de datos simulada (El backend lo hará con PHP/MySQL)
        const bdSimulada = {
            "1": { icon: "🤖", niv: "Ingeniería", nom: "Robótica", dc: "Diseña, construye y programa sistemas automatizados y robóticos para la industria 4.0.", dl: "El programa de Ingeniería en Robótica te prepara para el futuro tecnológico...", e1: "Duración: 8 Semestres", e2: "Modalidad: Presencial / Híbrida", e3: "Titulación Directa disponible" },
            "2": { icon: "💻", niv: "Licenciatura", nom: "Negocios Digitales", dc: "Domina el e-commerce, marketing digital y gestión de proyectos tecnológicos.", dl: "Domina el mundo del comercio electrónico. Aprenderás a crear estrategias de marketing...", e1: "Duración: 9 Semestres", e2: "Modalidad: 100% Online", e3: "Prácticas Profesionales incluidas" },
            "3": { icon: "👨‍💻", niv: "Ingeniería", nom: "Desarrollo de Software", dc: "Crea aplicaciones web, móviles y sistemas de información de alto rendimiento.", dl: "Conviértete en un experto en código. Aprende lenguajes modernos como Python, JavaScript y Java...", e1: "Duración: 8 Semestres", e2: "Modalidad: Presencial", e3: "Certificaciones AWS/Azure" }
        };

        selectorCarrera.addEventListener('change', (e) => {
            const idSeleccionado = e.target.value;

            if (idSeleccionado === 'nueva') {
                // Si elige "Agregar nueva...", limpiamos todos los campos
                for (let key in inputsCarrera) {
                    inputsCarrera[key].value = '';
                }
                inputsCarrera.icono.focus(); // Ponemos el cursor en el primer campo
            } else {
                // Si elige una existente, cargamos sus datos simulados
                const datos = bdSimulada[idSeleccionado];
                if (datos) {
                    inputsCarrera.icono.value = datos.icon;
                    inputsCarrera.nivel.value = datos.niv;
                    inputsCarrera.nombre.value = datos.nom;
                    inputsCarrera.descCorta.value = datos.dc;
                    inputsCarrera.descLarga.value = datos.dl;
                    inputsCarrera.ext1.value = datos.e1;
                    inputsCarrera.ext2.value = datos.e2;
                    inputsCarrera.ext3.value = datos.e3;
                }
            }
        });
    }
}