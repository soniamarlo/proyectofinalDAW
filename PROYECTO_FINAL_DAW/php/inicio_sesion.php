<?php
include "conexion_proyecto.php";
session_start();

// Función para validar el formato de correo electrónico
function validarCorreo($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

// Comprobar si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Comprobar que los campos no están vacíos
    if (empty($email) || empty($password)) {
        echo "Por favor, completa todos los campos del formulario.";
    } elseif (!validarCorreo($email)) {
        echo "El formato del correo electrónico no es válido.";
    } else {
        // Crear la conexión
        $conexion = abrirConexion();

        // Consultar si el usuario ya está registrado
        $query = "SELECT COUNT(*) AS numUsuarios, nombreUsuario, password, Admin, Gestor FROM usuarios WHERE email = '$email'";
        $result = mysqli_query($conexion, $query);

        if (!$result) {
            die("Error en la consulta: " . mysqli_error($conexion));
        }

        // Obtener el resultado de la consulta
        
        $row = mysqli_fetch_assoc($result);
        $numUsuarios = $row['numUsuarios'];
        $nombreUsuario = $row['nombreUsuario'];
        $passwordquery = $row['password'];  
        $esAdmin = $row['Admin'];
        $esGestor = $row['Gestor'];
   if($esAdmin == 1){
       // Guardar información del usuario en la sesión
       $_SESSION['nombreUsuario'] = $nombreUsuario;
       $_SESSION['email'] = $email;
       echo "Hola Administrador. <br><a href='panelAdmin.php'>Ir al panel de administrador</a>";
       exit;
   }elseif($esGestor == 1){
       $_SESSION['nombreUsuario'] = $nombreUsuario;
       $_SESSION['email'] = $email;
       echo "Hola Gestor de contenidos.<br> <a href='panelGestor.php'>Ir al panel de gestor de contenidos</a>";
       exit;
   }
   else{

           if ($numUsuarios > 0) {
               if($passwordquery == $password) {
           
                        // Guardar información del usuario en la sesión
                        $_SESSION['nombreUsuario'] = $nombreUsuario;
                        $_SESSION['email'] = $email;
            
     
                    // Redireccionar al inicio 
                    header("Location: ../index.php");
           
                    exit;
                } else {
                    // Mostrar mensaje de contraseña incorrecta
                    echo "La contraseña introducida es incorrecta";

                    exit;
                }
            }
            else{
                // Mostrar el mensaje de usuario no registrado y el enlace a la página de registro
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
<form action="inicio_sesion.php" method="post">
    
    <label for="email">Correo Electrónico:</label>
    <input type="email" id="email" name="email" required>
    <br><br>
    <label for="password">Contraseña:</label>
    <input type="password" id="password" name="password" required>
    <br><br>
    <input type="submit" value="Iniciar sesión"><br>
    Si no estas registrado, pulsa <a href="registro.php" id="enlaceRegistro">aquí</a>
</form>
<br>



