SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";



--
-- Base de datos: `db_paginaescolar`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `instalaciones_galeria`
--

CREATE TABLE `instalaciones_galeria` (
  `id` int(11) NOT NULL,
  `categoria` enum('laboratorios','deportes','biblioteca') NOT NULL,
  `titulo` varchar(100) NOT NULL,
  `subtitulo` varchar(255) DEFAULT NULL,
  `ruta_archivo` varchar(255) NOT NULL,
  `fecha_registro` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `instalaciones_galeria`
--
ALTER TABLE `instalaciones_galeria`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `instalaciones_galeria`
--
ALTER TABLE `instalaciones_galeria`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

