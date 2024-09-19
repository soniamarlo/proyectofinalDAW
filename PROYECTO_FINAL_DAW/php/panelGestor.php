<?php
include "conexion_proyecto.php";
// Definir el juego de caracteres
header('Content-Type: text/html; charset=UTF-8');
session_start();

// Obtener datos guardados en sesión
$email = isset($_SESSION['email']) ? $_SESSION['email'] : '';

?>

<!DOCTYPE html>

<html lang="es" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de administrador</title>
    <!-- Inclusión hoja estilos -->
    <link rel="stylesheet" href="../css/index_estilo.css">
    <link rel="stylesheet" href="../css/panelAdmin_estilo.css">

    <!-- Inclusión de la biblioteca jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
   
</head>
<body>
    <header>
        <div class="wrapper">
            <!-- Imagen en pequeño en el lateral izquierdo y arriba del header -->
            <div class="logoImg">
                <a href="../index.php">
                    <img src="../imagenes/logo3.png" alt="LogoImg">
                </a>
            </div>
            <div class="logo">Adogtion, la mejor opción</div>
            <nav>
                <ul>
                    <li><a href="../index.php">Inicio</a></li>
                    <li><a href="../adoptar.php">Adoptar</a></li>
                    <li><a href="../donaciones.php">Donaciones</a></li>
                    <li><a href="../acerca_de.php">Acerca de</a></li>
                </ul>
            </nav>

            <div class="session">
                <h4 id="sesion"><a href="cerrar_sesion_Admin.php">Cerrar sesión</a></h4>
            </div>
            
        </div>

    </header>
    <div class="container">
        <h1>Panel de Gestor de contenidos - Perros</h1>
        <a href='anadirPerro.php'>
        <button type="button">Añadir perro</button>
        </a>
       <br> <table>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Imagen</th>
                <th>Descripción</th>
                <th>Usuario</th>                
                <th>Acciones</th>
            </tr>
            <?php
            // Conexión a la base de datos
            // Crear la conexión a la base de datos
            $conexion = abrirConexion();

            

            // Consulta SQL para obtener todos los usuarios
            $queryTablaPerros = "SELECT * FROM perros";
            $resultadoTablaPerros = mysqli_query($conexion, $queryTablaPerros);

            // Mostrar los usuarios en la tabla
            if ($resultadoTablaPerros->num_rows > 0) {
                while($row = $resultadoTablaPerros->fetch_assoc()) {
                    echo "<tr>
                            <td>".$row["IdPerro"]."</td>
                            <td>".$row["NombrePerro"]."</td>
                            <td>".$row["Imagen"]."</td>
                            <td>".$row["Descripcion"]."</td>
                            <td>".$row["Usuario"]."</td>                            
                            <td><a href='editarPerro.php?id=".$row["IdPerro"]."'>Editar / </a><a href='borrarPerro.php?id=".$row["IdPerro"]."'>Borrar</a></td>
                        </tr>";
                        }
            } else {
                echo "<tr><td colspan='9'>No se encontraron perros.</td></tr>";
            }
            // Cerrar la conexión a la base de datos
            cerrarConexion($conexion);
            ?>
        </table><br>
    </div>
</body>
</html>