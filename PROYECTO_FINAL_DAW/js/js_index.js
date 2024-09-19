// JavaScript source code
var contador = 0;
var imagenes = [
    "imagenes/2.jpg",
    "imagenes/3.jpg",
    "imagenes/4.jpg",
    "imagenes/5.jpg",
    "imagenes/6.jpg",
    "imagenes/7.jpg"
];
var intervalo;

// Función para avanzar automáticamente las imágenes
function autoAvance() {
    intervalo = setInterval(avanceAdelante, 5000); // Cambia la imagen cada 5 segundos 
}

// Detener el avance automático
function detenerAutoAvance() {
    clearInterval(intervalo);
}

// Función para avanzar la imagen hacia adelante
function avanceAdelante() {
    if (contador >= imagenes.length - 1) {
        contador = 0;
    } else {
        contador += 1;
    }
    cambiarImagen();
}

// Función para retroceder la imagen
function avanceAtras() {
    if (contador <= 0) {
        contador = imagenes.length - 1;
    } else {
        contador -= 1;
    }
    cambiarImagen();
}

// Función para cambiar la imagen actual
function cambiarImagen() {
    var imagenActual = imagenes[contador];
    $(".gallery-item img").attr("src", imagenActual);
}

// Llamar a la función de avance automático al cargar la página
$(document).ready(function () {
    autoAvance();
    //Eventos click de los botones del carrusel
    $('.prev-button').click(avanceAtras);
    $('.next-button').click(avanceAdelante);
});
