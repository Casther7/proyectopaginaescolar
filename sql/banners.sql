CREATE DATABASE IF NOT EXISTS db_paginaescolar;
USE db_paginaescolar;

DROP TABLE IF EXISTS banners;

CREATE TABLE banners (
  id INT AUTO_INCREMENT PRIMARY KEY,
  seccion VARCHAR(50) NOT NULL DEFAULT 'principal',
  tipo ENUM('imagen','video') NOT NULL DEFAULT 'imagen',
  ruta VARCHAR(255) NOT NULL,
  titulo VARCHAR(255),
  subtitulo VARCHAR(255),
  activo TINYINT(1) NOT NULL DEFAULT 1,
  orden INT NOT NULL DEFAULT 0,
  fecha_subida TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO banners (seccion, tipo, ruta, titulo, subtitulo, activo, orden) VALUES
('laboratorios', 'imagen', 'view/img_banners/inst_69e5883908c41.jpg', 'Laboratorio de ciencias', 'Lugar en donde la experimentación no tiene fin', 0, 0),
('general', 'imagen', 'view/img_banners/banner_69e5938e2767f_8576f422d55c1142.jpg', 'Cancha de basquetbol', 'El deporte es energía y vida.', 1, 0),
('general', 'imagen', 'view/img_banners/banner_69e5992524b6e_76ad475e85080711.webp', 'Laboratorio de alimentos', 'Experimentación con alimentos de forma segura', 1, 0),
('hero', 'video', 'view/img_banners/1776663105_video_prueba.mp4', 'Formando a los líderes del mañana', 'Somos una institución que forma los líderes más exitosos.', 1, 0);