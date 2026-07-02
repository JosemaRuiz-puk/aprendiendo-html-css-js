//* alert("Bienvenido a mi web de aprendizaje!!");

console.log("Bienvenido a la consola de mi web de aprendizaje!!");

const boton = document.getElementById("saludar");
const mensaje = document.getElementById("mensaje");
let contador = 0;
const contadorTexto = document.getElementById("contadorTexto");
boton.addEventListener("click", function () {
    contador = contador + 1;
    console.log("Has pulsado el botón " + contador + " veces.");
    mensaje.hidden = false;
    contadorTexto.textContent = "Has pulsado el botón " + contador + " veces.";
});