<?php
class Conexion {
    private static $instancia = null;
    
    static public function conectar() {
        // Si ya existe una conexión, la reutiliza
        if (self::$instancia !== null) {
            return self::$instancia;
        }
        
        $host = "localhost";
        $db   = "db_paginaescolar";
        $user = "root";
        $pass = "";
        $port = "3306";

        try {
            $link = new PDO("mysql:host={$host};port={$port};dbname={$db}", $user, $pass);
            $link->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $link->exec("set names utf8");
            
            // Guardar la instancia para reutilizarla
            self::$instancia = $link;
            
            return $link;
        } catch (PDOException $e) {
            // Registrar el error en un log en lugar de mostrar mensaje genérico
            error_log("Error de conexión a BD: " . $e->getMessage());
            die("Error al conectar con la base de datos. Por favor, contacte al administrador.");
        }
    }
    
    // Método opcional para cerrar la conexión manualmente
    static public function cerrarConexion() {
        self::$instancia = null;
    }
}
?>