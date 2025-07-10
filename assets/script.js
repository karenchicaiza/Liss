document.addEventListener('DOMContentLoaded', function() {
    // Función de validación del formulario de login
    // Se hace global para que pueda ser llamada directamente desde el atributo onsubmit del HTML
    window.validarFormulario = function() {
        const usuario = document.getElementById('usuario').value.trim();
        const clave = document.getElementById('clave').value.trim();
        const mensajeLogin = document.getElementById('mensaje-login'); // Elemento para mensajes de login

        if (!usuario || !clave) {
            mensajeLogin.innerText = "Por favor, completa todos los campos para iniciar sesión.";
            return false;
        }
        mensajeLogin.innerText = ""; // Limpiar mensaje si la validación pasa
        return true;
    };

    // --- Lógica para el formulario de registro desplegable ---

    // Obtener referencias a los elementos HTML
    const btnMostrarFormularioRegistro = document.getElementById('btnMostrarFormularioRegistro');
    const formularioRegistroDiv = document.getElementById('formularioRegistro'); // El div que contiene el formulario de registro
    const btnCerrarFormularioRegistro = document.getElementById('btnCerrarFormularioRegistro');
    const loginFormDiv = document.getElementById('loginFormDiv'); // El div que contiene el formulario de login
    const mensajeGlobal = document.getElementById('mensaje-global'); // El elemento <p> para mensajes globales

    // Función para mostrar el formulario de registro
    function mostrarFormularioRegistro() {
        formularioRegistroDiv.classList.remove('formulario-oculto'); // Quita la clase que lo oculta visualmente
        formularioRegistroDiv.classList.add('formulario-visible');   // Añade la clase que lo muestra y anima
        btnMostrarFormularioRegistro.style.display = 'none';         // Oculta el botón "Registrar Nuevo Usuario"
        loginFormDiv.style.display = 'none';                         // Oculta el div del formulario de login
        if (mensajeGlobal) mensajeGlobal.style.display = 'none';     // Oculta el mensaje global si existe
    }

    // Función para ocultar el formulario de registro
    function ocultarFormularioRegistro() {
        formularioRegistroDiv.classList.remove('formulario-visible'); // Quita la clase de visibilidad
        formularioRegistroDiv.classList.add('formulario-oculto');     // Añade la clase que lo oculta y anima
        btnMostrarFormularioRegistro.style.display = 'block';         // Muestra el botón "Registrar Nuevo Usuario"
        loginFormDiv.style.display = 'block';                         // Muestra el div del formulario de login
        if (mensajeGlobal) mensajeGlobal.style.display = 'block';     // Muestra el mensaje global de nuevo
    }

    // Añadir event listeners a los botones
    // Se verifica si los elementos existen antes de añadir el listener para evitar errores si no están en la página
    if (btnMostrarFormularioRegistro) {
        btnMostrarFormularioRegistro.addEventListener('click', mostrarFormularioRegistro);
    }
    if (btnCerrarFormularioRegistro) {
        btnCerrarFormularioRegistro.addEventListener('click', ocultarFormularioRegistro);
    }

    // Lógica para mostrar el formulario de registro automáticamente
    // Esto es útil si el servidor redirige con un mensaje de éxito/error de registro.
    const urlParams = new URLSearchParams(window.location.search);
    const accion = urlParams.get('accion');

    if (accion === 'registrar_error' || accion === 'registrar_exito') {
        mostrarFormularioRegistro();
        // Si tienes un elemento de mensaje específico para el formulario de registro, puedes actualizarlo aquí
        // const mensajeRegistro = document.getElementById('mensaje-registro');
        // if (mensajeRegistro) mensajeRegistro.innerText = "Mensaje del servidor sobre el registro.";
    }
});