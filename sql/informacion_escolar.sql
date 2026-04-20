CREATE DATABASE IF NOT EXISTS db_paginaescolar;
USE db_paginaescolar;

DROP TABLE IF EXISTS informacion_escolar;

CREATE TABLE informacion_escolar (
  id INT AUTO_INCREMENT PRIMARY KEY,
  seccion VARCHAR(50) NOT NULL,
  slug VARCHAR(50) NOT NULL UNIQUE,
  titulo VARCHAR(255) NOT NULL,
  contenido TEXT NOT NULL,
  ultima_actualizacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

INSERT INTO informacion_escolar (seccion, slug, titulo, contenido) VALUES
('nosotros', 'mision', 'Mision', 'Formar integralmente a los estudiantes, brindando educación académica de calidad junto con valores, habilidades críticas y socioemocionales.'),
('nosotros', 'vision', 'Visión', 'Ser la institución educativa líder en innovación...'),
('nosotros', 'historia', 'Historia', 'Fundada hace más de 50 años...'),
('contacto', 'direccion', 'Dirección', 'Santa María Atzompa, Oaxaca, México.'),
('estadisticas', 'stat_experiencia', '50+', 'Años de experiencia'),
('estadisticas', 'stat_docentes', '60+', 'Docentes capacitados'),
('estadisticas', 'stat_egresados', '10,000+', 'Alumnos egresados'),
('nosotros', 'nosotros_desc_top', 'Descripción Principal', 'Institución pública de educación superior. Se ha consolidado como uno de los centros de formación profesional más importantes del estado y de la región sur-sureste del país.'),
('nosotros', 'nosotros_item1', 'Punto 1', '5 Ingenierías'),
('nosotros', 'nosotros_item2', 'Punto 2', '3 Laboratorios de cómputo'),
('nosotros', 'nosotros_item3', 'Punto 3', '6 Laboratorios especializados'),
('nosotros', 'nosotros_desc_bottom', 'Descripción Final', 'Contamos con 50 docentes, todos con especialidades en sus áreas');