-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 23-04-2024 a las 12:58:01
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `proyecto_final_daw`
--

-- --------------------------------------------------------
CREATE DATABASE `proyecto_final_daw`;
USE `proyecto_final_daw`;
--
-- Estructura de tabla para la tabla `historial_adopciones`
--

CREATE TABLE `historial_adopciones` (
  `IdAdopcion` int(11) NOT NULL,
  `IdPerro` int(11) NOT NULL,
  `IdUsuario` int(11) NOT NULL,
  `fecha` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `perros`
--

CREATE TABLE `perros` (
  `IdPerro` int(11) NOT NULL,
  `NombrePerro` varchar(50) NOT NULL,
  `Imagen` varchar(50) NOT NULL,
  `Descripcion` varchar(500) NOT NULL,
  `Usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `perros`
--

INSERT INTO `perros` (`IdPerro`, `NombrePerro`, `Imagen`, `Descripcion`, `Usuario`) VALUES
(1, 'Jack', 'Jack.jpg', 'Jack es un pastor alemán de 3 años. Es macho. Es protector, obediente y cariñoso. Se lleva muy bien con niños, además ejerce de hermano mayor. Se lleva bien con los perros, sobre todo con las hembras.', 0),
(2, 'Loli', 'Loli.jpg', 'Loli es una perrita teckel pelo corto de 4 años de edad. Es muy cariñosa y tranquila. Le gustan mucho las personas, juguetona con pelotas. Con perros se lleva bien pero no interactúa mucho.', 0),
(3, 'Tony', 'Tony.png', 'Tony es un perro mestizo de 8 años. Es macho. Es un perro muy sociable con otros perros. Su madurez hace que sea un perro tranquilo y muy fácil de llevar. Le gustan mucho las pelotas y meterse en el agua.', 0),
(4, 'Ricky', 'Ricky.jpg', 'Ricky es un schnauzer miniatura de 5 años. Tiene carácter con otros perros, pero es muy cariñoso con los humanos. Le encanta comer y pasear por el césped. No le gustan las pelotas pero si le encantan las salchichas.', 0),
(5, 'Pimpa', 'Pimpa.jpg', 'Pimpa es una hembra jack russell terrier de 4 años. Es muy protectora, sobre todo en el hogar. Se lleva muy bien con niños. Los ruidos muy fuertes le asustan, pero se está trabajando con los cuidadores ese aspecto.', 0),
(6, 'Jako', 'Jako.jpg', 'Jako es un doberman de 2 años. Es macho. A pesar de su tamaño, es un perro muy fácil de gestionar. Por su edad, todavía tiene mucha energía y necesita descargarla a diario. Le encanta correr y estar con personas.', 0),
(7, 'Valentín', 'Valentin.jpg', 'Valentín es un jack russel terrier de 6 años. Es macho. Es un perro muy activo y ágil. Le encanta la comida y jugar con cualquier juguete. A pesar de su edad, tiene mucha energía que necesita gestionarla a diario.', 0),
(8, 'Timy', 'Timy.jpg', 'Timy es un labrador de 5 años. Es macho. Perro muy comilón y juguetón. Le encanta jugar tanto con perros como con personas. Le encantan las pelotas. Hay que darle buena actividad física por su tendencia a coger peso.', 0),
(9, 'Popi', 'Popi.jpg', 'Popi es una hembra golden retriever de 2 años. Es una perra muy activa y muy cariñosa. No extraña a nadie. Le encanta jugar con palos y siempre la verás con uno en la boca.', 0),
(10, 'Sira', 'sira2.png', 'Sira es una perra mestiza de 6 años. Le encantan los humanos y jugar con ellos con la pelota, balones, etc. Con perros no es muy sociable pero no se lleva mal. Le encanta meterse en el agua y nadar.', 0),
(11, 'Paco', 'Paco.jpg', 'Paco es un carlino de 5 años. No es muy activo pero hay que animarle a moverse para no coger peso. Es muy sociable con perros y con personas. Le encanta dormir, lo malo es que ronca.', 0),
(12, 'Brus', 'Brus.jpg', 'Brus es un perro de aguas de 3 años. Es macho. Es un perro que demanda mucha actividad. Al principio es desconfiado con perros y personas pero después es todo amor. Le encanta meterse en el agua.', 0),
(13, 'Canela', 'Canela.png', 'Canela es un labrador de color chocolate. Es hembra. Tiene 6 años y es muy cariñosa. Le encanta jugar pero también es muy glotona, siempre mira con ojos de hambrienta. Hay que tener cuidado con el control de su peso.', 0),
(14, 'Jango', 'Jango.jpg', 'Jango es un beagle macho de 8 meses. Es juguetón y enérgico debido a su corta edad. Para jugar con perros les ladra pero después es muy cariñoso. Tiene mucha inteligencia y necesita juegos para estimularla.', 0),
(15, 'Lara', 'Lara.jpg', 'Lara es un husky siberiano de 3 meses. Esta en la época de morderlo todo. Es muy inteligente y traviesa. Le encanta conocer a más perros y jugar a todas horas, sobre todo con palos y pelotas.', 0),
(16, 'Jimba', 'Jimba.jpg', 'Jimba es una perrita mestiza de mastín. Es hembra y tiene 5 meses. Es muy tranquila y cariñosa. Es un poco cabezota pero también debido a su corta edad. Es muy protectora con sus dueños.', 0),
(17, 'Linda', 'Linda.jpg', 'Linda es un braco de weimar de 8 meses. Es hembra. Necesita cuidados especiales para la piel. Es un perro muy enérgico y atlético, necesita descargar energía para estar equilibrado.', 0),
(18, 'Rex', 'Rex.jpg', 'Rex es un chihuahua de 7 años de edad. Es macho. Es un perro protector pero muy cariñoso. Es muy tranquilo y le encanta dormir. Le gustan mucho las personas mayores y acurrucarse encima.', 0),
(19, 'Roco', 'Roco.jpg', 'Roco es un cocker spaniel de 4 años. Es macho. Le encanta salir a la calle y oler todo. Es sociable con perros y con personas. Le gustan los juegos de olfateo y rastrear otros animales.', 0),
(20, 'Leia', 'Leia.png', 'Leia es una perra mestiza de 2 años. Es hembra. Es una perra muy cariñosa, sobre todo con los humanos. Es un poco asustadiza de los ruidos fuertes. No es muy sociable con otros perros.', 0),
(21, 'Pongo', 'Pongo.jpg', 'Pongo es un dálmata de 3 años. Es macho. Es un perro protector, sobre todo con los niños. Es un perro muy activo y le encanta jugar con otros perros. En el hogar es muy dormilón.', 0),
(22, 'Anita', 'Anita.jpg', 'Anita es un chihuahua de 1 año. Es hembra. Es muy cariñosa con las personas que conoce. Es muy asustadiza y al principio es desconfiada, tanto con personas como con otros animales.', 0),
(23, 'Loki', 'Loki.jpg', 'Loki es un perro mestizo de 7 años. Es macho. A pesar de su edad, sigue teniendo mucha energía y ganas de jugar. Se porta muy bien, tanto con personas nuevas como con perros. Le encantan las chuches.', 0),
(24, 'Akira', 'Akira.jpg', 'Akira es un akita inu de 5 años. Es hembra. En la relación con otros perros podría asumir el papel dominante, pero no buscará enfrentamiento. Es una perra muy tranquila y noble.', 0),
(25, 'Soma', 'Soma.jpg', 'Soma es un basenji de 1 año. Es hembra. Consigue todo lo que quiere con su mirada. Le encanta seguir rastros y perseguir otros animales. En el hogar es muy tranquila y dormilona.', 0),
(26, 'Lana', 'Lana.jpg', 'Lana es mestiza de jack russel y bodeguero. Tiene 4 años. Es una perra muy tranquila. Le gusta jugar en la calle con pelotas y cualquier otro juguete. Le encanta bañarse en cualquier lado.', 0),
(27, 'Max', 'Max.jpg', 'Max es un buldog francés de 7 años. Es un perro muy tranquilo y cariñoso. Por la noche hace algunos ruidos al dormir. Le encanta que le acaricien la tripa y saludar a otros perros.', 0),
(28, 'Ragnar', 'Ragnar.jpg', 'Ragnar es un pomeranian de 2 años. Es macho. Es un poco desconfiado al principio con humanos y perros, pero muy cariñoso cuando les empieza a conocer. Consigue muchas cosas con su mirada.', 0),
(29, 'Tupac', 'Tupac.png', 'Tupac es un yorkshire terrier de 3 años. Es macho. Tiene carácter con otros perros pero solo al principio. Le encantan los humanos y está pidiendo todo el rato mimos. En la calle es un perro muy activo y le encanta correr.', 0),
(30, 'Fina', 'Fina.png', 'Fina es una perra mestiza de 4 años. Es hembra. Tiene una personalidad tímida con otros perros. Es muy afectuosa con los humanos y busca atención constantemente. En la calle disfruta explorando con tranquilidad su entorno.', 0),
(31, 'Homer', 'Homer.jpg', 'Homer es un galgo de 3 años. Es macho. Tiene temperamento reservado con otros perros, pero solo inicialmente. En exteriores, es un perro extremadamente enérgico y disfruta correr.', 0),
(32, 'Lisa', 'Lisa.png', 'Lisa es una perra mestiza de border collie de 2 años. Es hembra. Tiene una actitud enérgica y amigable con otros perros. Demuestra un cariño incondicional hacia los humanos y siempre está buscando interacción.', 0),
(33, 'Rober', 'Rober.jpg', 'Rober es un carlino de 10 años. Es macho. Disfruta de la compañía humana y busca atención constantemente. En sus paseos, prefiere caminar tranquilamente y explorar su entorno con curiosidad.', 0),
(34, 'Lusi', 'Lusi.png', 'Lusi es un pinscher enano de 3 años. Es macho. Tiene carácter con otros perros pero solo al principio. Le encantan los humanos y está pidiendo todo el rato mimos. En la calle es un perro muy activo y le encanta correr.', 0),
(35, 'Angus', 'Angus.jpg', 'Angus es un staffordshire bull terrier de 3 años. Es macho. A pesar de su fuerza es un perro muy tranquilo y sociable. Hay que tener cuidado con otros machos. Le encanta jugar con los niños, además da muchos lametazos.', 0),
(36, 'Lidia', 'Lidia.jpg', 'Lidia es una cachorro de welsh corgi de 3 meses. Es hembra. Es muy inquieta por su edad, pero le encanta dormir y recibir cariño. Se acerca mucho a otros perros pero de momento le da miedo jugar con ellos.', 0),
(37, 'Benji', 'Benji.png', 'Benji es un perro mestizo de 4 años, seguramente tenga descendencia de perro pastor. Es macho. Es un perro muy inteligente y sociable con humanos, no tanto con perros. Le encanta seguir ratros y animales, sin cazarlos.', 0),
(38, 'Carli', 'Carli.png', 'Carli es un mestizo de carlino y buldog francés de 9 años. Es macho. A pesar de su edad, es bastante activo. Le encantan los sitios tranquilos y poco ruidosos. En la calle pasea con tranquilidad, pero puede estar mucho tiempo.', 0),
(39, 'Fred', 'Fred.png', 'Fred es un rottweiler de 4 años. Es macho. A pesar de su tamaño, es un perro muy tranquilo y sociable. Es muy protector con sus dueños, sobre todo si tienen niños pequeños. Le encantan los juguetes de morder.', 0),
(40, 'Marwin', 'Marwin.png', 'Marwin es un breton de 3 años. Es macho. Es muy familiar, tranquilo y amable. Sociable con la gente y con el resto de perros. Exuberante, activo y energético, le gustan mucho los grandes espacios abiertos.', 0),
(41, 'Inka', 'Inka.jpg', 'Inka es un pastor ovejero australiano de 1 año. Es hembra. Tiene un temperamento seguro y muy enérgico. Posee instintos guardianes y de pastoreo, además de ser muy curiosa e inteligentes. Le encantan las personas.', 0),
(42, 'Rita', 'Rita.png', 'Rita es una cachorro mastín de 4 meses. Es hembra. Es muy juguetona pero muy torpe, todavía le cuesta coordinarse al correr. Siempre esta dando mimos y lametones. Le encanta comer de todo, hay que tener cuidado con ella.', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `IdUsuario` int(11) NOT NULL,
  `nombreUsuario` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `telefono` int(9) DEFAULT NULL,
  `direccion` varchar(50) DEFAULT NULL,
  `ciudad` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `historial_adopciones`
--
ALTER TABLE `historial_adopciones`
  ADD PRIMARY KEY (`IdAdopcion`);

--
-- Indices de la tabla `perros`
--
ALTER TABLE `perros`
  ADD PRIMARY KEY (`IdPerro`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`IdUsuario`),
  ADD UNIQUE KEY `IdUsuarios` (`IdUsuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `historial_adopciones`
--
ALTER TABLE `historial_adopciones`
  MODIFY `IdAdopcion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `perros`
--
ALTER TABLE `perros`
  MODIFY `IdPerro` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `IdUsuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
