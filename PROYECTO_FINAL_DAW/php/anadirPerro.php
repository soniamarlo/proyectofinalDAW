<?php
// Incluye el imagen de conexión a la base de datos
include "conexion_proyecto.php";


// Definir el juego de caracteres
header('Content-Type: text/html; charset=UTF-8');



function anadirPerro($nombre, $nombre_imagen, $descripcion, $usuario)
{
    $conexion = abrirConexion();

    
    $consulta = "INSERT INTO perros (NombrePerro, Imagen, Descripcion, Usuario) 
                      VALUES ('$nombre','$nombre_imagen', '$descripcion',$usuario)";
    $resultado = mysqli_query($conexion, $consulta);
    if ($resultado) {
        // Manejar la carga de imágenes
    $ruta = "../imagenes/";
    if (!empty($_FILES["imagen"]["name"])) {
        if ($_FILES["imagen"]["type"] == "image/jpg" || $_FILES["imagen"]["type"] == "image/png"
        || $_FILES["imagen"]["type"] == "image/jpeg") {
            if (file_exists($ruta) || @mkdir($ruta)) {
                $origen_imagen = $_FILES["imagen"]["tmp_name"];
                $destino_imagen = $ruta . $nombre_imagen;

                
                if (@move_uploaded_file($origen_imagen, $destino_imagen)) {
                    
                       echo '
                        <div class="cuadro">
                            <div class="exitoAnadir">
                                <h3>Perro añadido exitosamente</h3>
                                      <br>' . $nombre_imagen . ' movido correctamente<br>
                                    <br><a href="panelGestor.php" class="link">Volver a panel de gestiones</a>
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
                    echo "<br> La imagen " . $nombre_imagen . " no se ha guardado correctamente";
                }
            } else {
                echo "No se ha creado la carpeta correctamente";
            }
        } else {
            echo "<br>" . $_FILES["imagen"]["name"] . " No es un archivo de imagen establecido";
        }
    } else {
        //echo "<br> No se ha cargado ninguna imagen";
    }
             
                        

            } else {
            echo "Error al añadir al nuevo perro: " . mysqli_error($conexion);
            }
    

    cerrarConexion($conexion);
    
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $conexion = abrirConexion();
       // Recibir los datos del formulario
    $nombre = $_POST["nombre"];
    $imagen = $_FILES["imagen"]["name"];
    $descripcion = $_POST["descripcion"];
    $usuario = $_POST["usuario"];
    
    // Construir el nombre de la imagen
   $nombre_imagen = $nombre . "." . pathinfo($_FILES["imagen"]["name"], PATHINFO_EXTENSION);

    // Llamar a la función anadirPerro() con los argumentos necesarios
    anadirPerro($nombre, $nombre_imagen, $descripcion, $usuario);
   
    
}
?>




<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Añadir Perro</title>
    <!-- Inclusión hoja estilos -->
    <link rel="stylesheet" href="../css/frmEditarUsuario_estilo.css">
    
</head>
<body>
    <div class="container">
        <h1>Añadir Perro</h1>
        <form action="anadirPerro.php" method="POST" enctype="multipart/form-data">
            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre"><br>
            <label for="imagen">Imagen:</label>
            <input type="file" id="imagen" name="imagen"><br>
            <br><label for="descripcion">Descripcion:</label>
            <input type="text" id="descripcion" name="descripcion"><br>
            <label for="usuario">Usuario:</label>
            <input type="text" id="usuario" name="usuario"><br><br>
            <input type="submit" value="Guardar Cambios"><br>
        </form>
        
    </div>
       
        
</body>

</html>