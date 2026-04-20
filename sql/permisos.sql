CREATE DATABASE IF NOT EXISTS db_paginaescolar;
USE db_paginaescolar;

DROP TABLE IF EXISTS permisos;

CREATE TABLE permisos (
  id INT AUTO_INCREMENT PRIMARY KEY,
  usuario_id INT NOT NULL UNIQUE,
  p_banner TINYINT(1) DEFAULT 0,
  p_nosotros TINYINT(1) DEFAULT 0,
  p_oferta TINYINT(1) DEFAULT 0,
  p_docentes TINYINT(1) DEFAULT 0,
  p_instalaciones TINYINT(1) DEFAULT 0,
  p_contacto TINYINT(1) DEFAULT 0,
  p_mensajes TINYINT(1) DEFAULT 0,
  p_tienda TINYINT(1) DEFAULT 0,
  p_usuarios_accesos TINYINT(1) DEFAULT 0
);