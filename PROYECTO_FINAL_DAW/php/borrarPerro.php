
<?php
// Incluye el imagen de conexión a la base de datos
include "conexion_proyecto.php";
// Verificar si se ha enviado el ID del perro a eliminar
if (isset($_GET['id']) && !empty($_GET['id'])) {
    // Obtener el ID del usuario a eliminar
    $idPerroAEliminar = $_GET['id'];

    // Llamar a la función para eliminar al usuario
    borrarPerro($idPerroAEliminar);
} else {
    echo "ID de perro no proporcionado.";
}

function borrarPerro($IdPerro)
{
    $conexion = abrirConexion();

    // Validar la existencia del usuario
    $consultaPerro = "SELECT * FROM perros WHERE IdPerro = $IdPerro";
    $resultadoPerro = mysqli_query($conexion, $consultaPerro);

    if (!$resultadoPerro || mysqli_num_rows($resultadoPerro) == 0) {
        cerrarConexion($conexion);
       echo "El usuario con ID $IdPerro no existe.";
    }

    // Consulta para borrar un producto.
    $consultaBorrado = "DELETE FROM perros WHERE IdPerro = $IdPerro";
    $resultadoBorrado = mysqli_query($conexion, $consultaBorrado);

    if (!$resultadoBorrado) {
        // Agregar mensaje de error 
       echo "Error al borrar al perro: " . mysqli_error($conexion);
    }

    $filasAfectadas = mysqli_affected_rows($conexion);
    cerrarConexion($conexion);

    if ($filasAfectadas > 0) {
        echo "Perro borrado exitosamente. Filas afectadas: ". $filasAfectadas. "<br><a href='panelGestor.php''>Volver a panel de perros</a>";
        
    } else {
        echo "No se borró ningún perro. Filas afectadas: $filasAfectadas";
    }
}
?>
