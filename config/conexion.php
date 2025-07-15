<?php
    // Inicializando la sesion del usuario
    session_start();
    // Clase Conectar
    class Conectar {
        protected $dbh;

        // Funcion protegida de la cadena de conexion
        protected function Conexion() {
            try {
                // Cadena de conexion
                $conectar = $this->dbh = new PDO("mysql:local=localhost;dbname=diplomas_certificados","root","");
                return $conectar;
            } catch (Exception $e) {
                // En caso de error en cadena de conexion
                print "¡Error BD!: ". $e->getMessage() . "<br>";
                die();
            }
        }

        // Impedir que tengamos problemas con los tildes
        public function set_names() {
            return $this->dbh->query("set names 'utf8'");
        }

        // Ruta principal del proyecto
        public static function ruta() {
            return "http://localhost/generacion_certificados/";
        }
    }
?>