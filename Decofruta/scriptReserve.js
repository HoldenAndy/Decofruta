const dateSel = document.getElementById('dateSel');
const timeMeet = document.getElementById('timeMeet');
const eventType = document.getElementById('eventType');
const ctp = document.getElementById('ctp');
const messagebtn = document.getElementById('messagebtn');
const reserveForm = document.getElementById('reserveForm');
const mensajeFlotante = document.getElementById('mensaje-flotante');
const textoMensaje = document.getElementById('texto-mensaje');
const botonAceptar = document.getElementById('boton-aceptar');



messagebtn.addEventListener('click', (e) => {
    e.preventDefault()
    let warnings = phpMessage ? `${phpMessage}<br>` : '';
    let register = false;
    /*expresiónes regulares*/
    
    const valueDateSel = new Date(dateSel.value); //fecha seleccionada por el usuario
    const today = new Date(); //fecha actual
    today.setHours(0, 0, 0, 0); // Establecer la hora a las 00:00:00 para comparar solo la fecha

    if (isNaN(valueDateSel) || valueDateSel.getDay() === 6 || valueDateSel < today) { //verifica si la fecha de reserva es invalida, si es un sábado o si es menor al día actual
        warnings += `No se permite reservar para el día seleccionado <br>`;
        register = true;
    }

    if (timeMeet.value < '08:30' || timeMeet.value > '20:00') { //Verifica la fecha de registro no esté dentro de las horas establecidas
        warnings += `La hora debe estar en un rango de 8:30 AM a 8:00 PM <br>`;
        register = true;
    }

    if (eventType.value === "") { //Es una cadena vacía (""), significa que el usuario no ha seleccionado ningún tipo de evento.
        warnings += `Por favor seleccione el tipo de evento<br>`;
        register = true;
    } else if ( //Verifica si no coincide con los siguientes eventos válidos:
        eventType.value !== "Cumpleaños" &&
        eventType.value !== "Reunión de amigos" &&
        eventType.value !== "Cena familiar" &&
        eventType.value !== "Boda"
    ) {
        warnings += `Seleccione un tipo de evento válido<br>`;
        register = true;
    }

    const valueCtp = parseInt(ctp.value);
    if (isNaN(valueCtp) || valueCtp < 2 || valueCtp > 16) { //verifica si la cantidad de personas para la reserva es invalida, si es menor a uno o si es mayor al número permitido
        warnings += `La cantidad de personas debe ser entre 1 y 8 <br>`;
        register = true;
    }

    if (register) {
        textoMensaje.innerHTML = warnings; //Advertencias en el mensaje flotante //establece el contenido html del elemento textoMensaje con las advertencias acumuladas en warnings
        mensajeFlotante.style.display = 'block'; // Mostrar el mensaje flotante //bloque visible
        //alert(warnings);
    } else {
        textoMensaje.innerHTML = `Los datos son correctos<br>`; // Éxito
        mensajeFlotante.style.display = 'block'; // Mostrar el mensaje flotante
    }

});

botonAceptar.addEventListener('click', () => {
    mensajeFlotante.style.display = 'none'; // Ocultar el mensaje flotante al aceptar
    if (textoMensaje.innerHTML === `Los datos son correctos<br>`) {
        reserveForm.submit(); // Enviar el formulario solo si se acepta el mensaje de éxito
    }
});



