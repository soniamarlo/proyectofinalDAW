<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adopción de Perros</title>

    <!-- Inclusión hoja estilos -->
    <link rel="stylesheet" href="css/index_estilo.css">
    <!-- Inclusión de la biblioteca jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    
</head>
<body>

    <header>
        <div class="wrapper">
            <div class="logoImg">
                <a href="index.php">
                    <img src="imagenes/logo3.png" alt="LogoImg">
                </a>
            </div>
            <div class="logo">Adogtion, la mejor opción</div>
            <nav>
                <ul>
                    <li><a href="adoptar.php">Adoptar</a></li>
                    <li><a href="donaciones.php">Donaciones</a></li>
                    <li><a href="contacto.php">Contacto</a></li>
                    <li><a href="acerca_de.php">Acerca de</a></li>
                </ul>
            </nav>
                     
            <?php
                    session_start();

                    // Verificar si las variables de sesión están establecidas
                    if (isset($_SESSION['nombreUsuario'])) {
                        //Si el usuario ha iniciado sesión
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
    <main>
        <section id="inicio">
            
            <p>
            Cada perro tiene una historia única y merece un final feliz. En Adogtion, nos dedicamos a conectar corazones
            humanos con compañeros caninos. Desde cachorros juguetones hasta sabios veteranos, nuestra familia de perros 
            en busca de hogar es tan diversa como las familias que esperan unirse a ellos.
            <br>
            Adoptar es un acto de amor y compromiso. Al abrir tu hogar a uno de nuestros perros, no solo estás salvando una
            vida, sino que también estás ganando un amigo leal para siempre. Nuestros perros están listos para llenar
            tu vida de alegría, risas y momentos inolvidables.
            <br>
            ¿Estás listo para encontrar a tu compañero perfecto? Conoce a nuestros perros y descubre cómo puedes cambiar su mundo, 
            y ellos el tuyo. ¡Adopta hoy y comienza una nueva aventura juntos!
            </p>
        </section>
    </main>
    <!-- carrusel de imágenes -->
    <section id="gallery">
        <div class="gallery-container">
            <figure class="gallery-item">
                <img src="imagenes/2.jpg" alt="Imagen 1">

            </figure>
            <figure class="gallery-item">
                <img src="imagenes/3.jpg" alt="Imagen 2">

            </figure>
            <figure class="gallery-item">
                <img src="imagenes/4.jpg" alt="Imagen 3">

            </figure>
            <figure class="gallery-item">
                <img src="imagenes/5.jpg" alt="Imagen 4">

            </figure>
            <figure class="gallery-item">
                <img src="imagenes/6.jpg" alt="Imagen 5">

            </figure>
            </figure>
            <figure class="gallery-item">
                <img src="imagenes/7.jpg" alt="Imagen 6">

            </figure>
        </div>
        <nav class="gallery-navigation">
            <button class="nav-button prev-button"><span>&#60;</span></button>
            <button class="nav-button next-button"><span>&#62;</span></button>
        </nav>
    </section>
    <!-- fin de carrusel de imágenes -->

    <footer>
        <p>Imágenes cogidas en <a href="https://www.freepik.com" target="_blank">freepik</a></p>

    </footer>
    <!-- Incluir referencia a jQuery -->
    <script src="js/jquery.min.js"></script>
    <!-- Inclusión del imagen JavaScript -->
    <script src="js/js_index.js"></script>


</body>

</html>
