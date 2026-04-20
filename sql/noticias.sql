CREATE DATABASE IF NOT EXISTS db_paginaescolar;
USE db_paginaescolar;

DROP TABLE IF EXISTS noticias;

CREATE TABLE noticias (
  id INT AUTO_INCREMENT PRIMARY KEY,
  titulo VARCHAR(255) NOT NULL,
  descripcion TEXT NOT NULL,
  categoria VARCHAR(100) NOT NULL,
  imagen VARCHAR(255) NOT NULL,
  fecha DATE NOT NULL,
  fecha_creacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO noticias (titulo, descripcion, categoria, imagen, fecha) VALUES
(
  'Acto cívico',
  'Se llevó a cabo el Acto Cívico conmemorativo del mes de abril, con el propósito de fortalecer los valores cívicos en nuestra comunidad estudiantil.',
  'Cultura',
  'view/img_noticias/1776660844_acto_civico.jpg',
  '2026-04-20'
),
(
  '¡ATENCIÓN ESTUDIANTES DE EDUCACIÓN MEDIA SUPERIOR!',
  '-> Ingeniería en Tecnologías de la Información y Comunicaciones\n-> Prepárate para desarrollarte en el mundo digital y tecnológico.',
  'Académico',
  'view/img_noticias/1776661204_inscribete.jpg',
  '2026-04-21'
);