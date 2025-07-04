<?php
    // Herencia para poder utilizar las funciones dentro de la clase Conectar en la clase Usuario
    class Usuario extends Conectar {
        // Función para login de acceso del usuario
        public function login () {
            // Invocamos a una funcion de la clase Padre
            $conectar = parent::Conexion();
            parent::set_names();
            // Al presionar el boton enviar en el formulario, recogemos sus campos
            if ($_POST["enviar"]) {
                $correo = $_POST["usu_correo"];
                $pass = $_POST["usu_pass"];
                // Mostramos un error en caso de que alguno de los campos este vacio, devolver al index con mensaje = 2
                if (empty($correo) and empty($pass)) {
                    header("Location:".Conectar::ruta()."index.php?m=2");
                    exit();
                } else {
                    // Buscamos al usuario en base de datos en caso de que los campos esten llenos
                    $sql = "SELECT * FROM tm_usuario WHERE usu_correo = ? AND usu_pass = ? and estado = 1";
                    $stmt = $conectar->prepare($sql);
                    $stmt->bindValue(1, $correo);
                    $stmt->bindValue(2, $pass);
                    $stmt->execute();
                    $resultado = $stmt->fetch();
                    // Preguntamos si la consulta dio resultado, en este caso, debe ser un array de longitud mayor a 0
                    if (is_array($resultado) and count($resultado) > 0) {
                        // Guardar los datos en variables de sesión
                        $_SESSION["usu_id"] = $resultado["usu_id"];
                        $_SESSION["usu_nom"] = $resultado["usu_nom"];
                        $_SESSION["usu_ape"] = $resultado["usu_ape"];
                        $_SESSION["usu_correo"] = $resultado["usu_correo"];
                        // Redireccionamos a la pantalla de Home
                        header("Location: ".Conectar::ruta()."view/UsuHome/");
                        exit();
                    } else {
                        // En caso no coincidan el usuario o la contraseña
                        header("Location:".Conectar::ruta()."index.php?m=1");
                        exit();
                    }
                }
            }
        }
    }
?>