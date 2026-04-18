CREATE DATABASE IF NOT EXISTS db_paginaescolar;
USE db_paginaescolar;

CREATE TABLE administradores (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    usuario VARCHAR(50) NOT NULL,
    password VARCHAR(50) NOT NULL
);
-- Insertamos tu usuario de prueba
INSERT INTO administradores (nombre, usuario, password) 
VALUES ('Director General', 'admin', '12345');

CREATE TABLE IF NOT EXISTS usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(150) NOT NULL,
    email VARCHAR(150) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    rol ENUM('admin','editor','docente') NOT NULL DEFAULT 'docente',
    foto_perfil VARCHAR(255) DEFAULT NULL,
    fecha_creacion DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
);

---ejecuten este en su BD para agregar un usuario de prueba
INSERT INTO usuarios (nombre, email, password, rol)
VALUES
('sara', 'sara@gmail.com', '12345', 'docente');