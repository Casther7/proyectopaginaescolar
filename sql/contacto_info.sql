CREATE DATABASE IF NOT EXISTS db_paginaescolar;
USE db_paginaescolar;

DROP TABLE IF EXISTS contacto_info;

CREATE TABLE contacto_info (
  id INT PRIMARY KEY DEFAULT 1,
  telefono VARCHAR(20),
  correo VARCHAR(100),
  ubicacion TEXT,
  horario VARCHAR(255)
);

INSERT INTO contacto_info (id, telefono, correo, ubicacion, horario) VALUES (
  1,
  '951 517 0444',
  'informes@tuinstitucion.edu.mx',
  'Av. Universidad S/N, Ex-Hacienda de Cinco Señores, C.P. 68120, Oaxaca de Juárez, Oax.',
  'Lunes a Viernes: 08:00 AM - 4:00 PM'
);