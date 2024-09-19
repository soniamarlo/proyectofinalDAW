<?php
// Incluye el imagen de conexión a la base de datos
include "conexion_proyecto.php";

// Inicia la sesión
session_start();

// Definir el juego de caracteres
header('Content-Type: text/html; charset=UTF-8');

// Verificar si se ha proporcionado un ID de perro para editar
if(isset($_GET['id']) && !empty($_GET['id'])) {
    // Obtener el ID de perro de la URL
    $perro_id = $_GET['id'];

    // Crear la conexión a la base de datos
    $conexion = abrirConexion();

    // Consulta SQL para obtener los detalles del perro
    $queryPerro = "SELECT * FROM Perros WHERE IdPerro = $perro_id";
    $resultadoPerro = mysqli_query($conexion, $queryPerro);

    // Verificar si se encontró el perro
    if(mysqli_num_rows($resultadoPerro) == 1) {
        // Obtener los datos del perro
        $perro = mysqli_fetch_assoc($resultadoPerro);
        $nombre = $perro['NombrePerro'];
        $imagen = $perro['Imagen'];
        $descripcion = $perro['Descripcion'];
        $usuario = $perro['Usuario'];
        
    } else {
        echo "Perro no encontrado.";
        exit();
    }

    // Cerrar la conexión a la base de datos
    cerrarConexion($conexion);
} 




//Recuperar datos del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recibir los datos del formulario
    $perro_id = $_POST["perro_id"];
    $nombre = $_POST["nombre"];
    $imagen = $_POST["imagen"];
    $descripcion = $_POST["descripcion"];
    $usuario = $_POST["usuario"];
     
    // Crear la conexión a la base de datos
    $conexion = abrirConexion();

    // Actualizar los datos en la tabla perros
    $queryRellenarDatos = "UPDATE perros 
                       SET NombrePerro = '$nombre', Imagen = '$imagen',
                           Descripcion = '$descripcion', Usuario = '$usuario'
                       WHERE IdPerro = $perro_id";
    $resultadoRellenarDatos = mysqli_query($conexion, $queryRellenarDatos);

    if ($resultadoRellenarDatos) {
    } else {
    echo "Error al actualizar los datos del perro: " . mysqli_error($conexion);
    }


    cerrarConexion($conexion);
    echo '
                        <div class="cuadro">
                            <div class="exitoActualizar">
                                <h3>Datos actualizados exitosamente</h3>
                                     
                                     <a href="panelGestor.php" class="link">Volver a panel de gestión</a>
                            </div>
                        </div>
                        <style>
                            .cuadro {
                                display: flex;
                                justify-content: center;
                                align-items: center;
                                height: 100vh;
                            }
                            .exitoActualizar {
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

}
?>




  
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Perro</title>
    <!-- Inclusión hoja estilos -->
    <link rel="stylesheet" href="../css/frmEditarUsuario_estilo.css">
    
</head>
<body>
    <div class="container">
        <h1>Editar Perro</h1>
        <form action="editarPerro.php" method="POST">
            <input type="text" readonly name="perro_id" value="<?php echo $perro_id; ?>"><br>
            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" value="<?php echo $nombre; ?>"><br>
            <label for="imagen">Imagen:</label>
            <input type="text" id="imagen" name="imagen" value="<?php echo $imagen; ?>"><br>
            <label for="descripcion">Descripción:</label>
            <input type="text" id="descripcion" name="descripcion" value="<?php echo $descripcion; ?>"><br>
            <label for="usuario">Usuario:</label>
            <input type="text" id="usuario" name="usuario" value="<?php echo $usuario; ?>"><br>          
            <input type="submit" value="Guardar Cambios">
        </form>
    </div>
</body>
</html>