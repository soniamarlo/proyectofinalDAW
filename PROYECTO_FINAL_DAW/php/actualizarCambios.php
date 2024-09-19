<?php
// Incluye el imagen de conexión a la base de datos
include "conexion_proyecto.php";

// Inicia la sesión
session_start();

//Recuperar datos del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recibir los datos del formulario
    $usuario_id = $_POST["usuario_id"];
    $nombre = $_POST["nombre"];
    $email = $_POST["email"];
    $telefono = $_POST["telefono"];
    $direccion = $_POST["direccion"];
    $ciudad = $_POST["ciudad"];
    $admin = $_POST["admin"];
    $gestor = $_POST["gestor"];
    

    // Crear la conexión a la base de datos
    $conexion = abrirConexion();

    // Actualizar los datos en la tabla usuarios
    $queryRellenarDatos = "UPDATE usuarios 
                       SET nombreUsuario = '$nombre', email = '$email',
                           telefono = '$telefono', direccion = '$direccion', ciudad = '$ciudad',
                           Admin = '$admin', Gestor = '$gestor'
                       WHERE IdUsuario = $usuario_id";
    $resultadoRellenarDatos = mysqli_query($conexion, $queryRellenarDatos);

    if ($resultadoRellenarDatos) {
    } else {
    echo "Error al actualizar los datos del usuario: " . mysqli_error($conexion);
    }


    cerrarConexion($conexion);
    echo '
                        <div class="cuadro">
                            <div class="exitoActualizar">
                                <h3>Datos actualizados exitosamente</h3>
                                     
                                     <a href="../index.php" class="link">Volver a inicio</a>
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

}
?>




  