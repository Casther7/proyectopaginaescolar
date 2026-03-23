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