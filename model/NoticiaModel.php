<?php
require_once __DIR__ . '/../config/conexion.php';

class NoticiaModel {
    public static function mdlListarNoticias() {
        $stmt = Conexion::conectar()->prepare("SELECT * FROM noticias ORDER BY fecha DESC");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function mdlGuardarNoticia($datos) {
        $stmt = Conexion::conectar()->prepare("INSERT INTO noticias (titulo, descripcion, categoria, imagen, fecha) VALUES (?, ?, ?, ?, ?)");
        return $stmt->execute([$datos['titulo'], $datos['descripcion'], $datos['categoria'], $datos['imagen'], $datos['fecha']]) ? "ok" : "error";
    }

    public static function mdlEliminarNoticia($id) {
        $stmt = Conexion::conectar()->prepare("DELETE FROM noticias WHERE id = ?");
        return $stmt->execute([$id]) ? "ok" : "error";
    }
}