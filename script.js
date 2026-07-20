//* alert("Bienvenido a mi web de aprendizaje!!");

console.log("Bienvenido a la consola de mi web de aprendizaje!!");

const boton = document.getElementById("saludar");
const mensaje = document.getElementById("mensaje");
const contadorTexto = document.getElementById("contadorTexto");

boton.addEventListener("click", async function () {

    boton.disabled = true;

    try {

        const respuesta = await fetch(
            "api/incrementar_contador.php",
            {
                method: "POST"
            }
        );

        if (!respuesta.ok) {
            throw new Error("No se ha podido actualizar el contador");
        }

        const datos = await respuesta.json();

        mensaje.hidden = false;

        if (datos.valor === 1) {
            contadorTexto.textContent =
                "Este botón se ha pulsado 1 vez.";
        } else {
            contadorTexto.textContent =
                "Este botón se ha pulsado " +
                datos.valor +
                " veces.";
        }

        console.log(
            "El botón se ha pulsado " +
            datos.valor +
            " veces en total."
        );

    } catch (error) {

        contadorTexto.textContent =
            "No se ha podido actualizar el contador.";

        console.error(error);

    } finally {

        boton.disabled = false;

    }

});


const reloj = document.getElementById("reloj");
const fecha = document.getElementById("fecha");

function actualizarReloj() {
    const ahora = new Date();

    reloj.textContent = ahora.toLocaleTimeString("es-ES");

    fecha.textContent = ahora.toLocaleDateString("es-ES", {
        weekday: "long",
        day: "numeric",
        month: "long",
        year: "numeric"
    });
}

actualizarReloj();

setInterval(actualizarReloj, 1000);

const saludoTiempo = document.getElementById("saludoTiempo");
const datosTiempo = document.getElementById("datosTiempo");

async function obtenerTiempo() {
    try {
        const respuesta = await fetch(
            "https://api.open-meteo.com/v1/forecast" +
            "?latitude=38.99" +
            "&longitude=-3.37" +
            "&current=temperature_2m,weather_code,is_day" +
            "&timezone=Europe%2FMadrid"
        );

        if (!respuesta.ok) {
            throw new Error("No se ha podido consultar el tiempo");
        }

        const datos = await respuesta.json();

        const temperatura = datos.current.temperature_2m;
        const codigoTiempo = datos.current.weather_code;
        const hora = new Date().getHours();

        const momentoDia = obtenerMomentoDia(hora);
        const estadoTiempo = obtenerEstadoTiempo(
            codigoTiempo,
            temperatura
        );

        saludoTiempo.textContent =
            estadoTiempo + " " + momentoDia + " en Manzanares.";

        datosTiempo.textContent =
            "Ahora mismo hay " +
            temperatura +
            " °C y " +
            obtenerDescripcionTiempo(codigoTiempo) +
            ".";
    } catch (error) {
        saludoTiempo.textContent =
            "No hemos podido consultar el tiempo.";

        datosTiempo.textContent =
            "Inténtalo de nuevo dentro de unos minutos.";

        console.error(error);
    }
}

function obtenerMomentoDia(hora) {
    if (hora < 12) {
        return "mañana";
    } else if (hora < 21) {
        return "tarde";
    } else {
        return "noche";
    }
}

function obtenerEstadoTiempo(codigo, temperatura) {
    if (codigo >= 95) {
        return "Tormentosa";
    } else if (
        codigo === 51 ||
        codigo === 53 ||
        codigo === 55 ||
        codigo === 61 ||
        codigo === 63 ||
        codigo === 65 ||
        codigo === 80 ||
        codigo === 81 ||
        codigo === 82
    ) {
        return "Lluviosa";
    } else if (temperatura >= 32) {
        return "Calurosa";
    } else if (temperatura <= 10) {
        return "Fresca";
    } else {
        return "Agradable";
    }
}

function obtenerDescripcionTiempo(codigo) {
    if (codigo === 0) {
        return "el cielo está despejado";
    } else if (codigo === 1 || codigo === 2) {
        return "hay algunas nubes";
    } else if (codigo === 3) {
        return "el cielo está cubierto";
    } else if (codigo === 45 || codigo === 48) {
        return "hay niebla";
    } else if (codigo >= 51 && codigo <= 67) {
        return "está lloviendo";
    } else if (codigo >= 71 && codigo <= 77) {
        return "está nevando";
    } else if (codigo >= 80 && codigo <= 82) {
        return "hay chubascos";
    } else if (codigo >= 95) {
        return "hay tormenta";
    } else {
        return "el tiempo es variable";
    }
}

obtenerTiempo();