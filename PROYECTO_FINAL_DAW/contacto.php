<!DOCTYPE html>

<html lang="es" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contacto</title>
    <!-- Inclusión hoja estilos -->
    <link rel="stylesheet" href="css/index_estilo.css">
    <link rel="stylesheet" href="css/contacto_estilo.css">

    <!-- Inclusión de la biblioteca jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
   
</head>
<body>
    <header>
        <div class="wrapper">
            <!-- Imagen en pequeño en el lateral izquierdo y arriba del header -->
            <div class="logoImg">
                <a href="index.php">
                    <img src="imagenes/logo3.png" alt="LogoImg">
                </a>
            </div>
            <div class="logo">Adogtion, la mejor opción</div>
            <nav>
                <ul>
                    <li><a href="index.php">Inicio</a></li>
                    <li><a href="adoptar.php">Adoptar</a></li>
                    <li><a href="donaciones.php">Donaciones</a></li>
                    <li><a href="acerca_de.php">Acerca de</a></li>
                </ul>
            </nav>

            <?php
            session_start();

            // Verificar si las variables de sesión están establecidas
            if (isset($_SESSION['nombreUsuario'])) {
            // Si el usuario ha iniciado sesión
            $nombreUsuario = $_SESSION['nombreUsuario'];
            ?>
            <!-- Mostrar el botón de cierre de sesión y ocultar los botones de inicio de sesión y registro -->
            <div class="session">
                <h4 id="sesion"><a href="php/cerrar_sesion.php">Cerrar sesión</a></h4>
            </div>
            <?php
            } else {
            // Si el usuario no ha iniciado sesión
            ?>
            <!-- Mostrar los botones de inicio de sesión y registro -->
            <div class="session">
                <h4 id="sesion"><a href="php/inicio_sesion.php">Inicio sesión</a></h4>
                <h4 id="sesion"><a href="php/registro.php">Registrarse</a></h4>
            </div>
            <?php
            }
            ?>
        </div>

    </header>

    <section id="contacto">
        <div class="contacto-info">
            <h2>Contacto</h2>
            <!-- Información de contacto -->
            <p>Para más información sobre la adopción de perros, contáctanos:</p>
            <address>
                <p>Información de contacto:</p>
                Dirección: Calle de los Peludos Felices, nº 123, Ciudad Canina, CP 00000<br>
                Teléfono: +123 456 789<br>
                Correo electrónico: info@adogtion.com<br>
            </address>
            <!-- Horario de atención -->
            <p>Horario de atención:</p>
            <p>Lunes a viernes: 9:00 am - 6:00 pm</p>
            <p>Sábados y domingos: Cerrado</p>
        </div>
        <div class="redes-y-formulario">
            <!-- Redes sociales y formulario -->
            <h2>Redes sociales</h2>
            <p class="redes">Facebook: <img src="imagenes/logo_fb.png" alt="facebook" ></p>
            <p class="redes">Instagram: <img src="imagenes/logo_instagram.png" alt="instagram" ></p>
            <p class="redes">Twitter: <img src="imagenes/logo_twitter.png" alt="twitter" ></p><br>
            <!-- Formulario de contacto -->
            <h2>Formulario de contacto</h2>
            <p>¿Prefieres enviarnos un mensaje directo? Completa el siguiente formulario y nos pondremos en contacto contigo lo antes posible.</p>
            <form action="php/frmContacto.php" method="POST" name="FormularioContacto">
                <label for="nombre">Nombre:</label><br>
                <input type="text" id="nombre" name="nombre" required><br>

                <label for="email">Email:</label><br>
                <input type="email" id="email" name="email" required><br>

                <label for="mensaje">Mensaje:</label><br>
                <textarea id="mensaje" name="mensaje" rows="4" required></textarea><br>

                <input type="submit" value="Enviar">
            </form>
        </div>
    </section>
        <br><h3>¡Gracias por elegir "Adogtion, la mejor opción" para encontrar a tu compañero de vida!</h3><br><br><br>
     <footer>
     
           <a href="index.php">Volver inicio</a>       
            
    </footer>
 </body>
</html>