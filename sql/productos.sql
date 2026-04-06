CREATE TABLE `productos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `tallas` varchar(50) DEFAULT NULL,
  `stock` int(11) DEFAULT 0,
  `precio` decimal(10,2) DEFAULT NULL,
  `imagen` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `nombre`, `tallas`, `stock`, `precio`, `imagen`) VALUES
(1, 'Playera Institucional', 'S, M, L', 20, 350.00, 'view/img_tienda/playera.jpg'),
(4, 'Gorra', '', 30, 200.00, 'view/img_tienda/gorra.jpg'),
(5, 'Sudadera', 'S, M, L, XL', 11, 450.00, 'view/img_tienda/sudadera.jpg'),
(6, 'Termo', '', 12, 250.00, 'view/img_tienda/termo.jpg'),
(8, 'Libro de español', '', 5, 150.00, 'view/img_tienda/1775436093_Libro.jpg'),
(10, 'Pluma', '', 15, 100.00, 'view/img_tienda/1775444894_Pluma.png');

