<?php
require_once __DIR__ . '/../config/conexion.php';

class OfertaModel {
    // ... otras funciones ...

    public static function mdlGuardarOferta($datos) {
        // Ajustamos los nombres de las columnas a los de la nueva tabla
        $stmt = Conexion::conectar()->prepare("INSERT INTO oferta_academica 
        (nivel, titulo, descripcion_corta, imagen_principal, imagenes_galeria, mision, vision, objetivo, perfil_egreso, campo_laboral) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        
        return $stmt->execute([
            $datos['nivel'],
            $datos['titulo'],
            $datos['descripcion_corta'],
            $datos['imagen_principal'],
            $datos['imagenes_galeria'],
            $datos['mision'],
            $datos['vision'],
            $datos['objetivo'],
            $datos['perfil_egreso'],
            $datos['campo_laboral']
        ]) ? "ok" : "error";
    }

    public static function mdlListarOfertas() {
        $stmt = Conexion::conectar()->prepare("SELECT * FROM oferta_academica ORDER BY id DESC");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public static function mdlEliminarOferta($id) {
        $stmt = Conexion::conectar()->prepare("DELETE FROM oferta_academica WHERE id = ?");
        return $stmt->execute([$id]) ? "ok" : "error";
    }
}