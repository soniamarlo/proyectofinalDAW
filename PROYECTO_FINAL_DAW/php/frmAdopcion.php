<?php
include "conexion_proyecto.php";
// Definir el juego de caracteres
header('Content-Type: text/html; charset=UTF-8');
session_start();

// Obtener datos guardados en sesión
$nombrePerro = isset($_GET['nombre_perro']) ? $_GET['nombre_perro'] : '';
$email = isset($_SESSION['email']) ? $_SESSION['email'] : '';

?>
<!DOCTYPE html>

<html lang="es" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   
    <!-- Inclusión hoja estilos -->
    <link rel="stylesheet" href="../css/formulario_estilo.css">
    <link rel="stylesheet" href="../css/index_estilo.css">
    
    <title>Formulario</title>

</head>

<body>
    <p id="margen superior"></p>
   <h1>Formulario de Adopción de Perros</h1><br><br>
    <form action="frmAdopcion.php" method="POST" name="FormularioAdopcion">
        <!-- nombre del perro completado automáticamente -->
        <label for="nombrePerro">Nombre del perro:</label>
        <input type="text" id="nombrePerro" name="nombrePerro" readonly required value="<?php echo $nombrePerro; ?>"><br><br>

        <label for="nombre">Nombre completo:</label>
        <input type="text" id="nombre" name="nombre" required><br><br>

        <label for="email">Correo electrónico:</label>
        <!--Usar el correo electrónico para rellenar de forma automática el campo de correo electrónico en el formulario -->
        <input type="email" id="email" name="email" readonly required 
        value="<?php echo htmlspecialchars($email); ?>"><br><br>

        <label for="telefono">Teléfono de contacto:</label>
        <input type="tel" id="telefono" name="telefono" pattern="[0-9]{9}"required><br><br>

        <label for="direccion">Dirección de residencia:</label>
        <input type="text" id="direccion" name="direccion" required><br><br>

        <label for="ciudad">Ciudad:</label>
        <input type="text" id="ciudad" name="ciudad" required><br><br>

        <label for="razon">Motivo de la adopción:</label>
        <textarea id="razon" name="razon" rows="4" required></textarea><br><br>

        <label for="experiencia">Experiencia previa con mascotas:</label>
        <textarea id="experiencia" name="experiencia" rows="4" required></textarea><br><br>

        <label for="tipo_vivienda">Tipo de vivienda:</label>
        <select id="tipo_vivienda" name="tipo_vivienda" required>
            <option value="casa">Casa</option>
            <option value="apartamento">Apartamento</option>
            <option value="finca">Finca</option>
        </select><br><br>

        <label for="horas_solos">¿Cuántas horas estará solo el perro al día?:</label>
        <input type="number" id="horas_solos" name="horas_solos" min="0" required><br><br>

        <label for="convivencia_mascotas">¿Convivirá con otras mascotas?</label><br>
        <span>
            <label class="radio-label" for="convivencia_mascotas_si">Si</label>
            <input type="radio" id="convivencia_mascotas_si" name="convivencia_mascotas" value="si" required>
        </span>
        <span>
            <label class="radio-label" for="convivencia_mascotas_no">No</label>
            <input type="radio" id="convivencia_mascotas_no" name="convivencia_mascotas" value="no" required>

        </span><br><br>
        <span id="spanOculto">
            <label for="tipo_mascotas">¿Con qué mascotas convivirán?:</label>
            <input type="text" id="tipo_mascotas" name="tipo_mascotas"><br><br>
        </span>


        <input type="submit" value="Enviar" class="boton-enviar">
        <a href="../index.php">Volver página anterior</a>
    </form>
    <!-- Incluir referencia a jQuery -->
    <script src="../js/jquery.min.js"></script>
    <!-- Inclusión del imagen JavaScript -->
    <script src="../js/js_formulario.js"></script>
    <script src="../js/js_index.js"></script>

</body>
</html>

<?php
// Definir el juego de caracteres
header('Content-Type: text/html; charset=UTF-8');

// Verificar si se han recibido los datos del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recibir los datos del formulario
    $nombrePerro = $_POST["nombrePerro"];
    $nombre = $_POST["nombre"];
    $email = $_POST["email"];
    $telefono = $_POST["telefono"];
    $direccion = $_POST["direccion"];
    $ciudad = $_POST["ciudad"];
    $razon = $_POST["razon"];
    $experiencia = $_POST["experiencia"];
    $tipo_vivienda = $_POST["tipo_vivienda"];
    $horas_solos = $_POST["horas_solos"];
    $convivencia_mascotas = $_POST["convivencia_mascotas"];
    $tipo_mascotas = isset($_POST["tipo_mascotas"]) ? $_POST["tipo_mascotas"] : "";

        //Construir el mensaje de correo
    $mensaje = "Nombre del perro: $nombrePerro\n";
    $mensaje .= "Nombre completo: $nombre\n";
    $mensaje .= "Correo electrónico: $email\n";
    $mensaje .= "Teléfono de contacto: $telefono\n";
    $mensaje .= "Dirección de residencia: $direccion\n";
    $mensaje .= "Ciudad: $ciudad\n";
    $mensaje .= "Motivo de la adopción: $razon\n";
    $mensaje .= "Experiencia previa con mascotas: $experiencia\n";
    $mensaje .= "Tipo de vivienda: $tipo_vivienda\n";
    $mensaje .= "¿Cuántas horas estará solo el perro al día?: $horas_solos\n";
    $mensaje .= "¿Convivirá con otras mascotas?: $convivencia_mascotas\n";
    if ($convivencia_mascotas == "si") {
        $mensaje .= "¿Con qué mascotas convivirán?: $tipo_mascotas\n";
    }

    // Destinatario del correo
    $para = "jslocal@localhost.com";

    // Asunto del correo
    $asunto = "Formulario de Adopción de Perros";


    $cabeceras = "MIME-Version: 1.0\r\n";
    $cabeceras .= "Content-Type: text/plain; charset=\"UTF-8\"\r\n";
    $cabeceras .= "Content-Transfer-Encoding: 8bit\r\n";
    
    // Enviar el correo electrónico
if (mail($para, $asunto, $mensaje, $cabeceras)) {

    // Guardar los datos del formulario en sesiones
    $_SESSION['datos_formulario'] = $_POST;
   
    
    // Redirigir al usuario a la página de éxito
    header('Location: frmAdopcionExito.php?nombre_perro=' . urlencode($nombrePerro));
    exit;
    } else {
    echo "Lo sentimos, ha ocurrido un error al enviar el formulario. Por favor, inténtalo de nuevo más tarde.";
    }

}

?>



