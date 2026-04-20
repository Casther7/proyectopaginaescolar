-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 20-04-2026 a las 17:59:36
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
-- Base de datos: `db_paginaescolar`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `informacion_escolar`
--

CREATE TABLE `informacion_escolar` (
  `id` int(11) NOT NULL,
  `seccion` varchar(50) NOT NULL,
  `slug` varchar(50) NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `contenido` text NOT NULL,
  `ultima_actualizacion` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `informacion_escolar`
--

INSERT INTO `informacion_escolar` (`id`, `seccion`, `slug`, `titulo`, `contenido`, `ultima_actualizacion`) VALUES
(1, 'nosotros', 'mision', 'Mision', 'Formar integralmente a los estudiantes, brindando educación académica de calidad junto con valores, habilidades críticas y socioemocionales. ', '2026-04-20 04:03:00'),
(2, 'nosotros', 'vision', 'Visión', 'Ser la institución educativa líder en innovación...', '2026-04-20 03:29:05'),
(3, 'nosotros', 'historia', 'Historia', 'Fundada hace más de 50 años...', '2026-04-20 03:29:05'),
(4, 'contacto', 'direccion', 'Dirección', 'Santa María Atzompa, Oaxaca, México.', '2026-04-20 03:29:05'),
(5, 'estadisticas', 'stat_experiencia', '50+', 'Años de experiencia', '2026-04-20 04:07:55'),
(6, 'estadisticas', 'stat_docentes', '60+', 'Docentes capacitados', '2026-04-20 04:07:55'),
(7, 'estadisticas', 'stat_egresados', '10,000+', 'Alumnos egresados', '2026-04-20 04:07:55'),
(8, 'nosotros', 'nosotros_desc_top', 'Descripción Principal', 'Institución pública de educación superior. Se ha consolidado como uno de los centros de formación profesional más importantes del estado y de la región sur-sureste del país.', '2026-04-20 04:21:29'),
(9, 'nosotros', 'nosotros_item1', 'Punto 1', '5 Ingenierías', '2026-04-20 04:21:29'),
(10, 'nosotros', 'nosotros_item2', 'Punto 2', '3 Laboratorios de cómputo', '2026-04-20 04:21:29'),
(11, 'nosotros', 'nosotros_item3', 'Punto 3', '6 Laboratorios especializados', '2026-04-20 04:21:29'),
(12, 'nosotros', 'nosotros_desc_bottom', 'Descripción Final', 'Contamos con 50 docentes, todos con especialidades en sus áreas', '2026-04-20 04:21:29');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `informacion_escolar`
--
ALTER TABLE `informacion_escolar`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `slug` (`slug`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `informacion_escolar`
--
ALTER TABLE `informacion_escolar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
