const names = document.getElementById('names')
const lastNames = document.getElementById('lastNames')
const email = document.getElementById('email')
const password = document.getElementById('password')
const confirmPassword = document.getElementById('confirmPassword')
const button = document.getElementById('button')
const registerForm = document.getElementById('registerForm')
const mensajeFlotante = document.getElementById('mensaje-flotante');
const textoMensaje = document.getElementById('texto-mensaje');
const botonAceptar = document.getElementById('boton-aceptar');

button.addEventListener('click', (e) => {
    e.preventDefault()
    let warnings = "";
    let register = false;
    /*expresiónes regulares*/
    let validarNombre = /^[a-zA-ZñÑáéíóúÁÉÍÓÚ\s]{3,}$/;
    let validarEmail = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
    let vaidarTelefono = /^\d+$/;

    if(!validarNombre.test(names.value)){
        warnings += `El nombre ingresado no es correcto <br>`;
        register = true;
    }

    if (!vaidarTelefono.test(phone.value)) {
        warnings += `El teléfono solo puede contener números <br>`;
        register = true;
    }

    if(!validarEmail.test(email.value)){
        warnings += `Correo electrónico no válido <br>`;
        register = true;
    }
    if(password.value.trim().length < 8){
        warnings += `La contraseña debe tener 8 caracteres como mínimo <br>`;
        register = true;
    }
    if(confirmPassword.value.trim() !== password.value.trim()){
        warnings += `Las contraseñas no coinciden <br>`;
        register = true;
    }

    if(register){
        textoMensaje.innerHTML = warnings; // Advertencias en el mensaje flotante
        mensajeFlotante.style.display = 'block'; // Mostrar el mensaje flotante

    } else {
        textoMensaje.innerHTML = `Cuenta creada exitosamente<br>`; // Éxito
        mensajeFlotante.style.display = 'block'; // Mostrar el mensaje flotante
    }
})

botonAceptar.addEventListener('click', () => {
    mensajeFlotante.style.display = 'none'; // Ocultar el mensaje flotante al aceptar
    if (textoMensaje.innerHTML === `Cuenta creada exitosamente<br>`) {
        registerForm.submit(); // Enviar el formulario solo si se acepta el mensaje de éxito
    } 
});
