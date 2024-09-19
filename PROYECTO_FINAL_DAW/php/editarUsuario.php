<?php
// Incluye el imagen de conexión a la base de datos
include "conexion_proyecto.php";

// Inicia la sesión
session_start();

// Obtener datos guardados en sesión
$email = isset($_SESSION['email']) ? $_SESSION['email'] : '';

// Definir el juego de caracteres
header('Content-Type: text/html; charset=UTF-8');

// Verificar si se ha proporcionado un ID de usuario para editar
if(isset($_GET['id']) && !empty($_GET['id'])) {
    // Obtener el ID de usuario de la URL
    $usuario_id = $_GET['id'];

    // Crear la conexión a la base de datos
    $conexion = abrirConexion();

    // Consulta SQL para obtener los detalles del usuario
    $queryUsuario = "SELECT * FROM Usuarios WHERE IdUsuario = $usuario_id";
    $resultadoUsuario = mysqli_query($conexion, $queryUsuario);

    // Verificar si se encontró el usuario
    if(mysqli_num_rows($resultadoUsuario) == 1) {
        // Obtener los datos del usuario
        $usuario = mysqli_fetch_assoc($resultadoUsuario);
        $nombre = $usuario['nombreUsuario'];
        $email = $usuario['email'];
        $telefono = $usuario['telefono'];
        $direccion = $usuario['direccion'];
        $ciudad = $usuario['ciudad'];
        $admin = $usuario['Admin'];
        $gestor = $usuario['Gestor'];
    } else {
        echo "Usuario no encontrado.";
        exit();
    }

    // Cerrar la conexión a la base de datos
    cerrarConexion($conexion);
} else {
    echo "ID de usuario no proporcionado.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Usuario</title>
    <!-- Inclusión hoja estilos -->
    <link rel="stylesheet" href="../css/frmEditarUsuario_estilo.css">
    
</head>
<body>
    <div class="container">
        <h1>Editar Usuario</h1>
        <form action="actualizarCambios.php" method="POST">
            <input type="text" readonly name="usuario_id" value="<?php echo $usuario_id; ?>"><br>
            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" value="<?php echo $nombre; ?>"><br>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="<?php echo $email; ?>"><br>
            <label for="telefono">Teléfono:</label>
            <input type="text" id="telefono" name="telefono" value="<?php echo $telefono; ?>"><br>
            <label for="direccion">Dirección:</label>
            <input type="text" id="direccion" name="direccion" value="<?php echo $direccion; ?>"><br>
            <label for="ciudad">Ciudad:</label>
            <input type="text" id="ciudad" name="ciudad" value="<?php echo $ciudad; ?>"><br>
            <label for="admin">Admin:</label>
            <input type="text" id="admin" name="admin" value="<?php echo $admin; ?>"><br>
            <label for="gestor">Gestor:</label>
            <input type="text" id="gestor" name="gestor" value="<?php echo $gestor; ?>"><br>
            <input type="submit" value="Guardar Cambios">
        </form>
    </div>
</body>
</html>