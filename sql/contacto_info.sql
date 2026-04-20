-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 20-04-2026 a las 17:59:07
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
-- Estructura de tabla para la tabla `contacto_info`
--

CREATE TABLE `contacto_info` (
  `id` int(11) NOT NULL DEFAULT 1,
  `telefono` varchar(20) DEFAULT NULL,
  `correo` varchar(100) DEFAULT NULL,
  `ubicacion` text DEFAULT NULL,
  `horario` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `contacto_info`
--

INSERT INTO `contacto_info` (`id`, `telefono`, `correo`, `ubicacion`, `horario`) VALUES
(1, '951 517 0444', 'informes@tuinstitucion.edu.mx', 'Av. Universidad S/N, Ex-Hacienda de Cinco Señores, C.P. 68120, Oaxaca de Juárez, Oax.', 'Lunes a Viernes: 08:00 AM - 4:00 PM');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `contacto_info`
--
ALTER TABLE `contacto_info`
  ADD PRIMARY KEY (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
