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

// Funci�n para avanzar autom�ticamente las im�genes
function autoAvance() {
    intervalo = setInterval(avanceAdelante, 5000); // Cambia la imagen cada 5 segundos 
}

// Detener el avance autom�tico
function detenerAutoAvance() {
    clearInterval(intervalo);
}

// Funci�n para avanzar la imagen hacia adelante
function avanceAdelante() {
    if (contador >= imagenes.length - 1) {
        contador = 0;
    } else {
        contador += 1;
    }
    cambiarImagen();
}

// Funci�n para retroceder la imagen
function avanceAtras() {
    if (contador <= 0) {
        contador = imagenes.length - 1;
    } else {
        contador -= 1;
    }
    cambiarImagen();
}

// Funci�n para cambiar la imagen actual
function cambiarImagen() {
    var imagenActual = imagenes[contador];
    $(".gallery-item img").attr("src", imagenActual);
}

// Llamar a la funci�n de avance autom�tico al cargar la p�gina
$(document).ready(function () {
    autoAvance();
    //Eventos click de los botones del carrusel
    $('.prev-button').click(avanceAtras);
    $('.next-button').click(avanceAdelante);
});
