const botonModo = document.getElementById("modoOscuro");

if (localStorage.getItem("modoOscuro") === "activado") {
    document.body.classList.add("oscuro");
}

if (botonModo) {
    botonModo.addEventListener("click", function () {
        document.body.classList.toggle("oscuro");

        if (document.body.classList.contains("oscuro")) {
            localStorage.setItem("modoOscuro", "activado");
            botonModo.textContent = "☀️ Modo claro";
        } else {
            localStorage.setItem("modoOscuro", "desactivado");
            botonModo.textContent = "🌙 Modo oscuro";
        }
    });

    if (document.body.classList.contains("oscuro")) {
        botonModo.textContent = "☀️ Modo claro";
    }
}