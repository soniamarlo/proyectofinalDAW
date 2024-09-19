<?php
include "conexion_proyecto.php";
session_start();
// Verificar si el'nombre_perro' está presente en la URL
if (isset($_GET['nombre_perro'])) {
    // Guardar el nombre del perro en la sesión
    $_SESSION['nombre_perro'] = $_GET['nombre_perro'];
}

// Verificar si existen variables de sesión
if (isset($_SESSION['nombreUsuario'])) {
// El usuario ha iniciado sesión
// Obtener el correo electrónico del usuario
            $email = $_SESSION['email'] ;  
           // Redirigir al formulario de adopción con el correo electrónico del usuario como parámetro GET
           header("Location: frmAdopcion.php?email=" . urlencode($email));
            
            
            exit;                       
                        
} else {
// El usuario no ha iniciado sesión
                        
// Función para validar el formato de correo electrónico
function validarCorreo($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}
// Comprobar si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Validar que los campos no estén vacíos
    if (empty($email) || empty($password)) {
        echo "Por favor, completa todos los campos del formulario.";
    } elseif (!validarCorreo($email)) {
        echo "El formato del correo electrónico no es válido.";
    } else {
        // Crear la conexión
        $conexion = abrirConexion();

        // Consultar si el usuario ya está registrado
        $query = "SELECT COUNT(*) AS numUsuarios, nombreUsuario, password FROM usuarios WHERE email = '$email'";
        $result = mysqli_query($conexion, $query);

        if (!$result) {
            die("Error en la consulta: " . mysqli_error($conexion));
        }

        // Obtener el resultado de la consulta
        
        $row = mysqli_fetch_assoc($result);
        $numUsuarios = $row['numUsuarios'];
        $nombreUsuario = $row['nombreUsuario'];
        $passwordquery = $row['password'];
  
   if ($numUsuarios > 0) {
       if($passwordquery == $password) {

           $_SESSION['nombreUsuario'] = $nombreUsuario;
           $_SESSION['email'] = $email;
           
            header("Location: frmAdopcion.php?nombre_perro=" .
            (isset($_SESSION['nombre_perro']) ? $_SESSION['nombre_perro'] : ""));

            
            exit;
        } else {
            
            echo "La contraseña introducida es incorrecta";

            exit;
        }
    }
    else{
        // Mostrar el mensaje de 'usuario no registrado'y enlace a la página de registro
            echo "El usuario no está registrado. <a href='registro.php'>Registrarse</a>";
            exit;
    }
    }
}
}
?>                                                                        
<!-- Creación formulario -->
 <!-- Inclusión hoja estilos -->
    <link rel="stylesheet" href="../css/usuarios-registro.css">
     
   <p id="margen superior"></p>
   <h1>Inicio de sesión</h1><br><br>
<br>
<form action="usuarios.php" method="post"> 
    <label for="email">Correo Electrónico:</label>
    <input type="email" id="email" name="email" required>
    <br><br>
    <label for="password">Contraseña:</label>
    <input type="password" id="password" name="password" required>
    <br><br>
    <input type="submit" value="Iniciar sesión">
</form>
<br>


