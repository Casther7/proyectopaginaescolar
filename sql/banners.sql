-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 20-04-2026 a las 17:58:17
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
-- Estructura de tabla para la tabla `banners`
--

CREATE TABLE `banners` (
  `id` int(11) NOT NULL,
  `seccion` varchar(50) NOT NULL DEFAULT 'principal',
  `tipo` enum('imagen','video') NOT NULL DEFAULT 'imagen',
  `ruta` varchar(255) NOT NULL,
  `titulo` varchar(255) DEFAULT NULL,
  `subtitulo` varchar(255) DEFAULT NULL,
  `activo` tinyint(1) NOT NULL DEFAULT 1,
  `orden` int(11) NOT NULL DEFAULT 0,
  `fecha_subida` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `banners`
--

INSERT INTO `banners` (`id`, `seccion`, `tipo`, `ruta`, `titulo`, `subtitulo`, `activo`, `orden`, `fecha_subida`) VALUES
(3, 'laboratorios', 'imagen', 'view/img_banners/inst_69e5883908c41.jpg', 'Laboratorio de ciencias', 'Lugar en donde la experimentación no tiene fin', 0, 0, '2026-04-20 01:58:17'),
(4, 'general', 'imagen', 'view/img_banners/banner_69e5938e2767f_8576f422d55c1142.jpg', 'Cancha de basquetbol', 'El deporte es energía y vida.', 1, 0, '2026-04-20 02:46:38'),
(5, 'general', 'imagen', 'view/img_banners/banner_69e5992524b6e_76ad475e85080711.webp', 'Laboratorio de alimentos', 'Experimentación con alimentos de forma segura', 1, 0, '2026-04-20 03:10:29'),
(6, 'hero', 'video', 'view/img_banners/1776663105_video_prueba.mp4', 'Formando a los líderes del mañana', 'Somos una institución que forma los líderes más exitosos.', 1, 0, '2026-04-20 05:31:45');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `banners`
--
ALTER TABLE `banners`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `banners`
--
ALTER TABLE `banners`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
