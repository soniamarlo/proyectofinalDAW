<?php
include "php/conexion_proyecto.php";
// Definir el juego de caracteres
header('Content-Type: text/html; charset=UTF-8');
// Crear la conexión
$conexion = abrirConexion();

// Definir una función para generar el contenido de cada perro
function generarContenidoPerro($conexion, $nombrePerro, $imagen, $descripcion, $linkAdopcion) {
    // Consultar si el perro tiene un usuario asignado
    $queryUsuarioPerro = "SELECT Usuario FROM perros WHERE NombrePerro = '$nombrePerro'";
    $resultadoUsuarioPerro = mysqli_query($conexion, $queryUsuarioPerro);

    if ($resultadoUsuarioPerro) {
        $filaUsuarioPerro = mysqli_fetch_assoc($resultadoUsuarioPerro);
        
        // Obtener el valor del usuario del perro
        $usuarioPerro = $filaUsuarioPerro['Usuario'];

        // Determinar si el perro está adoptado
        $adoptado = ($usuarioPerro != 0);

        // Cambiar el estilo de la imagen si el perro está adoptado
        $estiloImagen = $adoptado ? 'style="filter: grayscale(100%);"' : '';

        // Generar el contenido HTML para el perro
        echo '
        <div>
            <h3>' . $nombrePerro . '</h3>
            <img src="imagenes/' . $imagen . '" alt="' . $nombrePerro . '" name="' . $nombrePerro . '" ' . $estiloImagen . '>
            <p>' . $descripcion . '</p>';
        
        // Mostrar el botón de adoptar solo si el perro no está adoptado
        if (!$adoptado) {
            // Verificar si el usuario ha iniciado sesión
            if (isset($_SESSION['nombreUsuario'])) {
                // Si ha iniciado sesión, dirigir al formulario de adopción
                echo '<a href="' . $linkAdopcion . '?nombre_perro=' . $nombrePerro . '"><button>¡Adoptar!</button></a>';
            } else {
                // Si no ha iniciado sesión, dirigir a la página de inicio de sesión
                echo '<a href="php/inicio_sesion.php"><button>¡Adoptar!</button></a>';
            }
        }
        
        echo '</div>';
    } else {
        // En caso de error en la consulta, mostrar una imagen por defecto
        echo '
        <div>
            <h3>' . $nombrePerro . '</h3>
            <img src="imagenes/defecto.png" alt="' . $nombrePerro . '" name="' . $nombrePerro . '">
            <p>' . $descripcion . '</p>';
        
        // Mostrar el botón de adoptar solo si el perro no está adoptado
        if (!$adoptado) {
            echo '
                <a href="' . $linkAdopcion . '?nombre_perro=' . $nombrePerro . '"><button>¡Adoptar!</button></a>';
        }
        
        echo '
        </div>
        ';
    }
}

?>
<!DOCTYPE html>

<html lang="es" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perros disponibles para Adopción</title>
    <!-- Inclusión hoja estilos -->
    <link rel="stylesheet" href="css/index_estilo.css">
    <link rel="stylesheet" href="css/adoptar_estilo.css">

</head>
<body>
    <header>
        <div class="wrapper">
            <!-- Imagen en pequeño en el lateral izquierdo y arriba del header -->
            <div class="logoImg">
                <a href="index.html">
                    <img src="imagenes/logo3.png" alt="LogoImg">
                </a>
            </div>
            <div class="logo">Adogtion, la mejor opción</div>
            <nav>
                <ul>
                    <li><a href="index.php">Inicio</a></li>
                    <li><a href="donaciones.php">Donaciones</a></li>
                    <li><a href="contacto.php">Contacto</a></li>
                    <li><a href="acerca_de.php">Acerca de</a></li>
                </ul>
            </nav>
            <?php
            session_start();

              // Verificar si las variables de sesión estan establecidas
            if (isset($_SESSION['nombreUsuario'])) {
                // Si el usuario ha iniciado sesión
                $nombreUsuario = $_SESSION['nombreUsuario'];

                // Mostrar el botón de cierre de sesión y ocultar los botones de inicio de sesión y registro
                echo '<div class="session">';
                echo '<h4 id="sesion"><a href="php/cerrar_sesion.php">Cerrar sesión</a></h4>';
                echo '</div>';
            } else {
                // Si el usuario no ha iniciado sesión

                // Mostrar los botones de inicio de sesión y registro
                echo '<div class="session">';
                echo '<h4 id="sesion"><a href="php/inicio_sesion.php">Inicio sesión</a></h4>';
                echo '<h4 id="sesion"><a href="php/registro.php">Registrarse</a></h4>';
                echo '</div>';
            }
            ?>
        </div>
    </header>
    <?php
    // Comprobar si las variables de sesión están establecidas
    if (!isset($_SESSION['nombreUsuario'])) {
        // No mostrar contenido aviso
        echo '<p><img src="imagenes/alerta.png" id="aviso"></p><br>';
    }
    ?>
            
    <section id="adoptar">
        <h2>Perros Disponibles para Adopción</h2>
        <!-- Llamar a la función para cada perro -->
        <?php
                // Consultar la información de los perros disponibles para adopción
                $queryPerros = "SELECT NombrePerro, Imagen, Descripcion FROM perros";
                $resultadoPerros = mysqli_query($conexion, $queryPerros);

                if ($resultadoPerros) {
                    // Mostrar cada perro en la página
                    while ($filaPerro = mysqli_fetch_assoc($resultadoPerros)) {
                        $nombrePerro = $filaPerro['NombrePerro'];
                        $imagen = $filaPerro['Imagen'];
                        $descripcion = $filaPerro['Descripcion'];
                        

                        // Generar el contenido del perro
                        generarContenidoPerro($conexion, $nombrePerro, $imagen, $descripcion, "php/frmAdopcion.php");
                    }
                } else {
                    // En caso de error en la consulta, mostrar un mensaje de error
                    echo '<p>No se pudieron cargar los perros disponibles para adopción. Inténtalo de nuevo más tarde.</p>';
                }

                // Cerrar la conexión
                mysqli_close($conexion);
                ?>
            </div>
        </div>
    </section>
    <footer>
         <p>Imágenes cogidas en <a href="https://www.freepik.com" target="_blank">freepik</a></p>
    </footer>
</body>
</html>