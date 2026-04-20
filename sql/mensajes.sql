CREATE DATABASE IF NOT EXISTS db_paginaescolar;
USE db_paginaescolar;

CREATE TABLE mensajes (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nombre VARCHAR(255) NOT NULL,
  email VARCHAR(255) NOT NULL,
  telefono VARCHAR(20),
  asunto VARCHAR(255) NOT NULL,
  mensaje TEXT NOT NULL,
  fecha_envio TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  estado ENUM('no_leido','leido','respondido') DEFAULT 'no_leido'
);

INSERT INTO mensajes (nombre, email, telefono, asunto, mensaje, estado) VALUES
('Juan Pérez', 'juan@example.com', '555-123-4567', 'Información sobre secundaria', 'Me gustaría obtener más información sobre las inscripciones para secundaria.', 'no_leido'),
('Sandra García López', 'sagarlo15del2@gmail.com', '987-656-785', 'secundaria', 'mas info', 'no_leido');