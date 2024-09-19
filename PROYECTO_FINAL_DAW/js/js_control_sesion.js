
// Función para redirigir al usuario a la URL anterior o al índice si no hay una URL anterior definida
function redirigir() {
    // Obtener la URL anterior del navegador
    var urlAnterior = document.referrer;
    
    // Redirigir al usuario a la URL anterior si está definida, de lo contrario, redirigir al inicio
    if (urlAnterior !== '') {
      
        window.location.href = urlAnterior;
        
    } else {
        window.location.href = '../index.php';
    }
}

redirigir(); // Llama a la función para que se ejecute después de cargar el script
