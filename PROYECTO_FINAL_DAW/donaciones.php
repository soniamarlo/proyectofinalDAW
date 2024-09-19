<!DOCTYPE html>

<html lang="es" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Donaciones</title>
    <!-- Inclusión hoja estilos -->
    <link rel="stylesheet" href="css/index_estilo.css">
    <link rel="stylesheet" href="css/donaciones_estilo.css">
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

    <div class="container">
        <h2>¡Ayúdanos a encontrar hogares para perros sin hogar!</h2>
        <p>Tu donación nos permite continuar con nuestra misión de rescatar, rehabilitar y encontrar hogares permanentes 
            para perros necesitados. Cada pequeña contribución hace una gran diferencia en la vida de estos animales.</p>

        <form action="donation_process.php" method="POST">
            <label for="amount">Cantidad a donar:</label>
            <div class="input-container">
                <input type="number" id="amount" name="amount" min="1" placeholder="Ingresa la cantidad" required>
                <span class="currency">€</span>
            </div>
            <button type="submit">Donar</button>
        </form>
    </div>
    <br>
    <br>
    <br>
    <footer>
        <p>&copy; 2024 Adogtion - Todos los derechos reservados</p>
         
     
    </footer>

</body>
</html>