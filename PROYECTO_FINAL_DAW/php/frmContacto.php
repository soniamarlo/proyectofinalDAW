<?php
// Definir el juego de caracteres
header('Content-Type: text/html; charset=UTF-8');

// Verificar si se han recibido los datos del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recibir los datos del formulario
    $nombre = $_POST["nombre"];
    $email = $_POST["email"];
    $mensaje = $_POST["mensaje"];

    // Dirección de correo a la que se enviará el formulario
    $para = "jslocal@localhost.com";

    // Asunto del correo
    $asunto = "Formulario de Contacto";

    // Construir el mensaje
    $mensajeCompleto = "Nombre: $nombre\n";
    $mensajeCompleto .= "Email: $email\n";
    $mensajeCompleto .= "Mensaje: $mensaje\n";

    $cabeceras = "MIME-Version: 1.0\r\n";
    $cabeceras .= "Content-Type: text/plain; charset=\"UTF-8\"\r\n";
    $cabeceras .= "Content-Transfer-Encoding: 8bit\r\n";

    // Enviar el correo electrónico
    if (mail($para, $asunto, $mensajeCompleto, $cabeceras)) {
        
        echo '
                        <div class="cuadro">
                            <div class="exitoFrm">
                                <h3>Formulario enviado exitosamente</h3>
                                     <p>"¡Gracias ' . $nombre . ' por completar el formulario! Tu solicitud ha sido enviada correctamente."</p>
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
        echo "Lo sentimos, ha ocurrido un error al enviar el formulario. Por favor, inténtalo de nuevo más tarde.";
    }
}
?>
