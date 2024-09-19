<?php
// Inicia la sesión
session_start();

// Destruye todas las variables de sesión
session_destroy();



 // Redirige al usuario a la página de inicio de sesión o a cualquier otra página deseada
header('Location: ../index.php');
exit(); // Asegúrate de terminar el script después de la redirección
?>   