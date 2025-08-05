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

        // Mostrar todos los cursos en los cuales esta inscrito un usuario
        public function get_cursos_por_usuario($usu_id) {
            $conectar = parent::Conexion();
            parent::set_names();
            $sql = "SELECT 
                    td_curso_usuario.curd_id, 
                    tm_curso.cur_id, 
                    tm_curso.cur_nom, 
                    tm_curso.cur_descrip, 
                    tm_curso.cur_fech_ini, 
                    tm_curso.cur_fech_fin, 
                    tm_usuario.usu_id, 
                    tm_usuario.usu_nom, 
                    tm_usuario.usu_apep, 
                    tm_usuario.usu_apem, 
                    tm_instructor.inst_id, 
                    tm_instructor.inst_nombre, 
                    tm_instructor.inst_apep, 
                    tm_instructor.inst_apem 
                    FROM td_curso_usuario INNER JOIN 
                    tm_curso ON td_curso_usuario.cur_id = tm_curso.cur_id INNER JOIN 
                    tm_usuario ON td_curso_usuario.usu_id = tm_usuario.usu_id INNER JOIN 
                    tm_instructor ON tm_curso.inst_id = tm_instructor.inst_id 
                    WHERE 
                    td_curso_usuario.usu_id = ?";
            $sql = $conectar->prepare($sql);
            $sql->bindValue(1, $usu_id);
            $sql->execute();
            return $resultado = $sql->fetchAll();
        }

        public function get_cursos_por_usuario_top10($usu_id) {
            $conectar = parent::Conexion();
            parent::set_names();
            $sql = "SELECT 
                    td_curso_usuario.curd_id, 
                    tm_curso.cur_id, 
                    tm_curso.cur_nom, 
                    tm_curso.cur_descrip, 
                    tm_curso.cur_fech_ini, 
                    tm_curso.cur_fech_fin, 
                    tm_usuario.usu_id, 
                    tm_usuario.usu_nom, 
                    tm_usuario.usu_apep, 
                    tm_usuario.usu_apem, 
                    tm_instructor.inst_id, 
                    tm_instructor.inst_nombre, 
                    tm_instructor.inst_apep, 
                    tm_instructor.inst_apem 
                    FROM td_curso_usuario INNER JOIN 
                    tm_curso ON td_curso_usuario.cur_id = tm_curso.cur_id INNER JOIN 
                    tm_usuario ON td_curso_usuario.usu_id = tm_usuario.usu_id INNER JOIN 
                    tm_instructor ON tm_curso.inst_id = tm_instructor.inst_id 
                    WHERE 
                    td_curso_usuario.usu_id = ?
                    LIMIT 10";
            $sql = $conectar->prepare($sql);
            $sql->bindValue(1, $usu_id);
            $sql->execute();
            return $resultado = $sql->fetchAll();
        }

        // Mostrar todos los datos de un curso por su id de detalle
        public function get_curso_por_id_detalle($curd_id) {
            $conectar = parent::Conexion();
            parent::set_names();
            $sql = "SELECT 
                    td_curso_usuario.curd_id, 
                    tm_curso.cur_id, 
                    tm_curso.cur_nom, 
                    tm_curso.cur_descrip, 
                    tm_curso.cur_fech_ini, 
                    tm_curso.cur_fech_fin, 
                    tm_usuario.usu_id, 
                    tm_usuario.usu_nom, 
                    tm_usuario.usu_apep, 
                    tm_usuario.usu_apem, 
                    tm_instructor.inst_id, 
                    tm_instructor.inst_nombre, 
                    tm_instructor.inst_apep, 
                    tm_instructor.inst_apem 
                    FROM td_curso_usuario INNER JOIN 
                    tm_curso ON td_curso_usuario.cur_id = tm_curso.cur_id INNER JOIN 
                    tm_usuario ON td_curso_usuario.usu_id = tm_usuario.usu_id INNER JOIN 
                    tm_instructor ON tm_curso.inst_id = tm_instructor.inst_id 
                    WHERE 
                    td_curso_usuario.curd_id = ?";
            $sql = $conectar->prepare($sql);
            $sql->bindValue(1, $curd_id);
            $sql->execute();
            return $resultado = $sql->fetchAll();
        }

        // Cantidad de cursos por usuario
        public function get_total_cursos_por_usuario($usu_id) {
            $conectar = parent::Conexion();
            parent::set_names();
            $sql = "SELECT count(*) as total FROM td_curso_usuario WHERE usu_id = ?";
            $sql = $conectar->prepare($sql);
            $sql->bindValue(1, $usu_id);
            $sql->execute();
            return $resultado = $sql->fetchAll();
        }

        // Mostrar los datos del usuario segun el id
        public function get_usuario_por_id($usu_id) {
            $conectar = parent::Conexion();
            parent::set_names();
            $sql = "SELECT * FROM tm_usuario WHERE estado = 1 AND usu_id = ?";
            $sql = $conectar->prepare($sql);
            $sql->bindValue(1, $usu_id);
            $sql->execute();
            return $resultado = $sql->fetchAll();
        }
    }
?>