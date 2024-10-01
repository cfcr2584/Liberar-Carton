function mostrarDiv() {
    var div = document.getElementById("miDiv");
    if (div.style.display === "none" || div.style.display === "") {
        div.style.display = "block"; // Muestra el div
    } else {
        div.style.display = "none"; // Oculta el div (opcional)
    }
}