<?php
include "conexion_proyecto.php";
session_start();

// validar el formato de correo electrónico
function validarCorreo($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}
// Comprobar si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener y escapar los datos del formulario
    $nombreUsuario = $_POST["nombreUsuario"];
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Validar los campos del formulario
    if (empty($nombreUsuario) || empty($email) || empty($password)) {
        echo "Por favor, completa todos los campos del formulario.";
    } elseif (!validarCorreo($email)) {
        echo "El formato del correo electrónico no es válido.";
    } else {
        // Crear la conexión
        $conexion = abrirConexion();

        // Verificar si el usuario ya está registrado
        $query = "SELECT COUNT(*) AS numUsuarios FROM usuarios WHERE email = '$email'";
        $result = mysqli_query($conexion, $query);

        if (!$result) {
            die("Error en la consulta: " . mysqli_error($conexion));
        }

        // Obtener el resultado de la consulta
        $row = mysqli_fetch_assoc($result);
        $numUsuarios = $row['numUsuarios'];

        // Si el usuario no está registrado, proceder con el registro
        if ($numUsuarios == 0) {
            // Insertar el nuevo usuario en la base de datos
            $query = "INSERT INTO usuarios (nombreUsuario, email, password) 
            VALUES ('$nombreUsuario', '$email', '$password')";
            $result = mysqli_query($conexion, $query);

            if (!$result) {
                die("Error al registrar el usuario: " . mysqli_error($conexion));
            }
               // Guardar información del usuario en la sesión
                    $_SESSION['nombreUsuario'] = $nombreUsuario;
                    $_SESSION['email'] = $email;
               // Verificar si hay un nombre de perro en la sesión
                if (isset($_GET['nombre_perro']) && ($_SESSION['email'])) {
                // Guardar el nombre del perro en la sesión
                 $_SESSION['nombre_perro'] = $_GET['nombre_perro'];
                 
                    header("Location: frmAdopcion.php?nombre_perro=" .
                    (isset($_SESSION['nombre_perro']) ? $_SESSION['nombre_perro'] : ""));
                
                } else{

                // Redirigir al índice para actualizar la cabecera
                    header("Location: ../index.php");   
                }
                exit;       
        } else {
            // Mostrar mensaje de usuario ya registrado
            echo "El usuario ya está registrado. <a href='inicio_sesion.php'>Iniciar sesión</a>";
            
            exit;
        }   
    }
}
?>
<!-- Formulario de registro -->
 <!-- Inclusión hoja estilos -->
    <link rel="stylesheet" href="../css/usuarios-registro.css">
      
   <p id="margen superior"></p>
   <h1>Registrarse</h1><br><br>
   <br>
<form action="registro.php" method="post">
    <label for="nombreUsuario">Nombre de Usuario:</label>
    <input type="text" id="nombreUsuario" name="nombreUsuario" required>
    <br><br>
    <label for="email">Correo Electrónico:</label>
    <input type="email" id="email" name="email" required>
    <br><br>
    <label for="password">Contraseña:</label>
    <input type="password" id="password" name="password" required>
    <br><br>
    <input type="submit" value="Registrarse">
</form>
<br>

