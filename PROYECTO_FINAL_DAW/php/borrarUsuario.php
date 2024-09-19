
<?php
// Incluye el imagen de conexión a la base de datos
include "conexion_proyecto.php";
// Verificar si se ha enviado el ID del usuario a eliminar
if (isset($_GET['id']) && !empty($_GET['id'])) {
    // Obtener el ID del usuario a eliminar
    $idUsuarioAEliminar = $_GET['id'];

    // Llamar a la función para eliminar al usuario
    borrarUsuario($idUsuarioAEliminar);
} else {
    echo "ID de usuario no proporcionado.";
}

function borrarUsuario($IdUsuario)
{
    $conexion = abrirConexion();

    // Validar la existencia del usuario
    $consultaUsuario = "SELECT * FROM usuarios WHERE IdUsuario = $IdUsuario";
    $resultadoUsuario = mysqli_query($conexion, $consultaUsuario);

    if (!$resultadoUsuario || mysqli_num_rows($resultadoUsuario) == 0) {
        cerrarConexion($conexion);
       echo "El usuario con ID $IdUsuario no existe.";
    }

    // Consulta para borrar un producto.
    $consultaBorrado = "DELETE FROM usuarios WHERE IdUsuario = $IdUsuario";
    $resultadoBorrado = mysqli_query($conexion, $consultaBorrado);

    if (!$resultadoBorrado) {
        // Agregar mensaje de error 
       echo "Error al borrar al usuario: " . mysqli_error($conexion);
    }

    $filasAfectadas = mysqli_affected_rows($conexion);
    cerrarConexion($conexion);

    if ($filasAfectadas > 0) {
        echo "Usuario borrado exitosamente. Filas afectadas: ". $filasAfectadas. "<br><a href='panelAdmin.php''>Volver a panel de usuarios</a>";
        
    } else {
        echo "No se borró ningún usuario. Filas afectadas: $filasAfectadas";
    }
}
?>
