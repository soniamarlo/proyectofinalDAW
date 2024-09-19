<!DOCTYPE html>

<html lang="es" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acerca de</title>
    <!-- Inclusión hoja estilos -->
    <link rel="stylesheet" href="css/index_estilo.css">
    <link rel="stylesheet" href="css/acerca_de.css">
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
                    <li><a href="contacto.php">Contacto</a></li>

                </ul>
            </nav>
            <?php
            session_start();

            // Verificar si las variables de sesión están establecidas
            if (isset($_SESSION['nombreUsuario'])) {
            // El usuario ha iniciado sesión
            $nombreUsuario = $_SESSION['nombreUsuario'];
            ?>
            <!-- Mostrar el botón de cierre de sesión y ocultar los botones de inicio de sesión y registro -->
            <div class="session">
                <h4 id="sesion"><a href="php/cerrar_sesion.php">Cerrar sesión</a></h4>
            </div>
            <?php
            } else {
            // El usuario no ha iniciado sesión
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
    <div class="acercade-info">
        <section id="acercade">


            <h2>Acerca de:</h2><br>
                               <div class="txt_acercade">

                                   Nuestros clientes esperan de "Adogtion, la mejor opción" un compromiso genuino
                                   para encontrar hogares seguros para perros sin hogar. Esperan una plataforma confiable y dedicada que
                                   conecte a estos adorables animales con familias que los cuidarán y los amarán para siempre.<br>

                                   Misión y valores de tu empresa: En "Adogtion, la mejor opción", nuestra misión es abordar la crisis
                                   de perros sin hogar al proporcionar una plataforma accesible y eficiente para la adopción responsable
                                   de mascotas. Nos comprometemos a promover el bienestar animal, fomentar la adopción en lugar de la
                                   compra y educar a la comunidad sobre la importancia de brindar un hogar amoroso a los animales necesitados.<br>

                                   Valores fundamentales que guían nuestras acciones incluyen:<br>

                                   <b><u>-Compasión</u></b>: Creemos en tratar a todos los seres vivos con empatía y respeto.<br>
                                   <b><u>-Integridad</u></b> Nos comprometemos a actuar con honestidad y transparencia en todas nuestras operaciones.<br>
                                   <b><u>-Responsabilidad</u></b>: Asumimos la responsabilidad de asegurar que cada adopción sea adecuada y que tanto
                                   las mascotas como las familias estén preparadas para una vida feliz juntas.<br>
                                   

                                   La idea de "Adogtion, la mejor opción" nació de mi profundo amor y compromiso
                                   hacia los animales sin hogar. Durante años, he sido testigo de la triste realidad de los perros que
                                   permanecen en refugios, esperando desesperadamente encontrar un hogar donde sean queridos y cuidados.
                                   Inspirado por esta necesidad, decidí combinar mi pasión por la tecnología con mi amor por los animales
                                   para crear una plataforma que haga que la adopción de mascotas sea más accesible y efectiva.
                                   Mi objetivo es hacer una diferencia significativa en la vida de los perros sin hogar y en las familias que
                                   los adoptan, brindando felicidad y compañerismo a ambos lados. Con "Adogtion, la mejor opción",
                                   aspiro a construir un mundo donde cada perro tenga la oportunidad de encontrar un hogar  y
                                   cada persona tenga la oportunidad de experimentar la alegría de la adopción de mascotas.
                               </div>

        </section>

        <section id="img">
            <div class="image-container">
                <img src="imagenes/imgAcercade.jpg" alt="perro en césped">
            </div>
        </section>
    </div>
    <footer>
     
           <a href="index.php">Volver inicio</a>       
            
    </footer>
</body>
</html>