<?php
class Conexion {
    static public function conectar() {
        // Parámetros
        $host = "localhost";
        $db = "db_paginaescolar"; 
        $user = "root";     
        $pass = "casther748";
        $port = "3307";

        try {
            // ¡AQUÍ ESTÁ LA MAGIA! Le agregamos el ;port= a la conexión
            $link = new PDO("mysql:host=".$host.";port=".$port.";dbname=".$db, $user, $pass);
            $link->exec("set names utf8");
            return $link;
        } catch (PDOException $e) {
            die("Error crítico al conectar con la Base de Datos: " . $e->getMessage());
        }
    }
}
?>