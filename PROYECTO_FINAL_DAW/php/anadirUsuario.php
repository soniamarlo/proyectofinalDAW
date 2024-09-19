<?php
// Incluye el imagen de conexión a la base de datos
include "conexion_proyecto.php";


// Definir el juego de caracteres
header('Content-Type: text/html; charset=UTF-8');



function anadirUsuario($nombre, $email, $password, $telefono, $direccion, $ciudad, $admin, $gestor)
{
    $conexion = abrirConexion();

    // Consulta para añadir un producto.
    $consulta = "INSERT INTO usuarios (nombreUsuario, email, password, telefono, direccion, ciudad, Admin, Gestor) 
                      VALUES ('$nombre','$email','$password', '$telefono',' $direccion', '$ciudad', $admin, $gestor)";
    $resultado = mysqli_query($conexion, $consulta);
    if ($resultado) {
                echo '
                        <div class="cuadro">
                            <div class="exitoAnadir">
                                <h3>Usuario añadido exitosamente</h3>
                                     
                                     <a href="panelAdmin.php" class="link">Volver a panel de administrador</a>
                            </div>
                        </div>
                        <style>
                            .cuadro {
                                display: flex;
                                justify-content: center;
                                align-items: center;
                                height: 100vh;
                            }
                            .exitoAnadir {
                                background-color: antiquewhite;
                                color: #252932;
                                font-size:18px;
                                border: 1px solid #c47c7c;
                                border-radius: 5px;
                                padding: 20px;
                                text-align: center;
                            }
                            .link {
                                display: block;
                                margin-top: 10px;
                                text-decoration: none;
                                background-color: #c47c7c;
                                color: #fff;
                                font-size:18px;
                                padding: 10px 20px;
                                border-radius: 5px;
                            }
                        </style>';
                        exit;

            } else {
            echo "Error al aañadir al nuevo usuario: " . mysqli_error($conexion);
            }
    

    cerrarConexion($conexion);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $conexion = abrirConexion();
        // Obtener los datos del usuario
        $nombre = $_POST["nombre"];
        $email = $_POST["email"];
        $password = $_POST["password"];
        $telefono = $_POST["telefono"];
        $direccion = $_POST["direccion"];
        $ciudad = $_POST["ciudad"];
        $admin = $_POST["admin"];
        $gestor = $_POST["gestor"];
         // Llamar a la función anadirUsuario() con los argumentos necesarios
        anadirUsuario($nombre, $email, $password, $telefono, $direccion, $ciudad, $admin, $gestor);
            

        } 
    
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Añadir Usuario</title>
    <!-- Inclusión hoja estilos -->
    <link rel="stylesheet" href="../css/frmEditarUsuario_estilo.css">
    
</head>
<body>
    <div class="container">
        <h1>Editar Usuario</h1>
        <form action="anadirUsuario.php" method="POST">
            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre"><br>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email"><br>
            <label for="password">Contraseña:</label>
            <input type="password" id="password" name="password"><br>
            <label for="telefono">Teléfono:</label>
            <input type="text" id="telefono" name="telefono"><br>
            <label for="direccion">Dirección:</label>
            <input type="text" id="direccion" name="direccion"><br>
            <label for="ciudad">Ciudad:</label>
            <input type="text" id="ciudad" name="ciudad"><br>
            <label for="admin">Admin:</label>
            <input type="text" id="admin" name="admin"><br>
            <label for="gestor">Gestor:</label>
            <input type="text" id="gestor" name="gestor"><br><br>
            <input type="submit" value="Guardar Cambios"><br>
        </form>
    </div>
</body>
</html>