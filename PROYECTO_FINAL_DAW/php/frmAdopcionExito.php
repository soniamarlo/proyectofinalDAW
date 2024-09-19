<?php
include "conexion_proyecto.php"; 
session_start();

// Obtener el nombre del perro de la URL
$nombrePerro = isset($_GET['nombre_perro']) ? $_GET['nombre_perro'] : '';

// Verificar si hay datos del formulario en la sesión
if(isset($_SESSION['datos_formulario'])) {
    $datosFormulario = $_SESSION['datos_formulario'];

    // Extraer los datos del formulario
    $nombre = $datosFormulario['nombre'];
    $email = $datosFormulario['email'];
    $telefono = $datosFormulario['telefono'];
    $direccion = $datosFormulario['direccion'];
    $ciudad = $datosFormulario['ciudad'];

    // Crear la conexión a la base de datos
    $conexion = abrirConexion();

    // Actualizar los datos del usuario en la tabla usuarios
    $queryRellenarDatos = "UPDATE usuarios 
                       SET telefono = '$telefono', direccion = '$direccion', ciudad = '$ciudad'
                       WHERE email = '$email'";
    $resultadoRellenarDatos = mysqli_query($conexion, $queryRellenarDatos);

    if ($resultadoRellenarDatos) {
    } else {
    echo "Error al actualizar los datos del usuario: " . mysqli_error($conexion);
    }

    // Conseguir el ID del usuario a través del correo electrónico
    $queryUsuario = "SELECT IdUsuario FROM usuarios WHERE email = '$email'";
    $resultadoUsuario = mysqli_query($conexion, $queryUsuario);
    // Verificar si se encontró el usuario
    if ($resultadoUsuario && mysqli_num_rows($resultadoUsuario) > 0) {
        // Obtener el ID del usuario
        $filaUsuario = mysqli_fetch_assoc($resultadoUsuario);
        $idUsuario = $filaUsuario['IdUsuario'];

        // Actualizar el campo Usuario en la tabla perros con el ID del usuario
        $queryPerro = "UPDATE perros SET Usuario = '$idUsuario' WHERE NombrePerro = '$nombrePerro'";

        // Ejecutar la consulta para actualizar el perro
        if (mysqli_query($conexion, $queryPerro)) {
        } else {
            echo "Error al actualizar el campo Usuario en la tabla perros: " . mysqli_error($conexion);
        }

        // Insertar la adopción en la tabla historial_adopciones
        $fecha = date("Y-m-d"); // Obtener la fecha actual
        $queryPerroId = "SELECT IdPerro FROM perros WHERE NombrePerro = '$nombrePerro'";
        $resultadoPerroId = mysqli_query($conexion, $queryPerroId);

        if ($resultadoPerroId && mysqli_num_rows($resultadoPerroId) > 0) {
            $filaPerroId = mysqli_fetch_assoc($resultadoPerroId);
            $idPerro = $filaPerroId['IdPerro'];

            $queryAdopcion = "INSERT INTO historial_adopciones (IdPerro, IdUsuario, fecha) VALUES ('$idPerro', '$idUsuario', '$fecha')";

            // Ejecutar la consulta para insertar la adopción
            if (mysqli_query($conexion, $queryAdopcion)) {
                echo '
                        <div class="cuadro">
                            <div class="exitoFrm">
                                <h3>Formulario enviado exitosamente</h3>
                                     <p>El formulario de adopción ha sido enviado correctamente, la adopción de ' . $nombrePerro . ' está en curso</p>
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
                            .exitoFrm {
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

            } else {
                echo "Error al registrar la adopción en el historial: " . mysqli_error($conexion);
            }
        } else {
            echo "No se encontró el ID del perro en la base de datos.";
        }
    } else {
        echo "No se encontró el ID del usuario en la base de datos.";
    }

    // Cerrar la conexión a la base de datos
    cerrarConexion($conexion);

    // Limpiar los datos del formulario de la sesión
    unset($_SESSION['datos_formulario']);
} else {
    echo "No se han recibido datos del formulario.";
}
?>
