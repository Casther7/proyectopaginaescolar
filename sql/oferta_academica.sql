-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 24-04-2026 a las 15:49:06
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
-- Estructura de tabla para la tabla `oferta_academica`
--

CREATE TABLE `oferta_academica` (
  `id` int(11) NOT NULL,
  `nivel` varchar(50) DEFAULT 'Ingeniería',
  `titulo` varchar(255) NOT NULL,
  `descripcion_corta` text DEFAULT NULL,
  `imagen_principal` varchar(255) DEFAULT NULL,
  `imagenes_galeria` text DEFAULT NULL,
  `mision` text DEFAULT NULL,
  `vision` text DEFAULT NULL,
  `objetivo` text DEFAULT NULL,
  `perfil_egreso` text DEFAULT NULL,
  `campo_laboral` text DEFAULT NULL,
  `fecha_creacion` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `oferta_academica`
--

INSERT INTO `oferta_academica` (`id`, `nivel`, `titulo`, `descripcion_corta`, `imagen_principal`, `imagenes_galeria`, `mision`, `vision`, `objetivo`, `perfil_egreso`, `campo_laboral`, `fecha_creacion`) VALUES
(1, 'Ingeniería', 'Ing. en Administración', 'Logramos lideres fuertes y del mañana.', 'view/img_oferta/1776665716_principal_administración.jpg', 'view/img_oferta/1776665716_gal_imagen_prueba.jfif', 'Formar profesionales líderes, éticos y emprendedores, capaces de planear, organizar, dirigir y controlar los recursos de una organización', 'Formar líderes estratégicos y emprendedores capaces de dirigir organizaciones de manera eficiente, ética y sostenible', 'Desarrollar habilidades para gestionar y mejorar la toma de decisiones en diversos contextos organizacionales.', ' Planear, organizar, dirigir y controlar recursos (humanos, financieros, materiales y tecnológicos) en organizaciones públicas o privadas. ', 'Puede trabajar en casi cualquier sector, desempeñando roles clave en áreas como recursos humanos, finanzas, marketing, operaciones y consultoría. ', '2026-04-20 06:15:16'),
(2, 'Ingeniería', 'Tecnologías de la Información', 'Buscamos líderes de empresas tecnológicas.', 'view/img_oferta/1776732170_principal_tics_1.jpg', 'view/img_oferta/1776732170_gal_tics_2.jpg', 'Formar profesionales capaces de integrar, administrar y desarrollar tecnologías de vanguardia para mejorar la productividad y competitividad de las organizaciones.', 'Formar profesionales líderes, innovadores y con alta capacidad técnica para transformar el entorno digital. ', 'Gestionar la infraestructura tecnológica, redes, telecomunicaciones y sistemas informáticos de las empresas.', 'Diseñar, instalar y administrar redes de cómputo, comunicaciones y seguridad informática bajo estándares internacionales.', 'Desarrolladores de software, expertos en ciberseguridad, administradores de redes, analistas de datos, consultores tecnológicos, inteligencia artificial y gestión de proyectos, tanto en empresas públicas como privadas.', '2026-04-21 00:42:50'),
(3, 'Ingeniería', 'Ing. en innovación Agrícola', 'Formamos ingenieros especialistas en el área de agricultura.', 'view/img_oferta/1776737138_principal_IIAS_1.jpg', 'view/img_oferta/1776737138_gal_IIAS_3.jpg,view/img_oferta/1776737138_gal_IIAS_2.jpg', 'Formar profesionales capaces de transformar el sector agrícola mediante la investigación, el desarrollo tecnológico y la sustentabilidad.', 'Modernización del campo mediante prácticas sostenibles, tecnologías avanzadas y agricultura protegida', 'Tiene una visión laboral enfocada en la modernización del campo mediante prácticas sostenibles, tecnologías avanzadas y agricultura protegida, con el objetivo de elevar la productividad y competitividad a nivel regional, nacional e internacional.', 'Profesional capacitado para diseñar, gestionar e innovar sistemas de producción agrícola bajo un enfoque de sustentabilidad, inocuidad y competitividad económica.', 'Gestión y diseño de invernaderos, macro túneles, casas sombra y sistemas hidropónicos.', '2026-04-21 02:05:38');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `oferta_academica`
--
ALTER TABLE `oferta_academica`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `oferta_academica`
--
ALTER TABLE `oferta_academica`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
