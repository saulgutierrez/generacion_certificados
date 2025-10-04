<?php
    class Curso extends Conectar {
        public function insert_curso($cat_id, $cur_nom, $cur_descrip, $cur_fech_ini, $cur_fech_fin, $inst_id) {
            $conectar = parent::Conexion();
            parent::set_names();
            $sql = "INSERT INTO tm_curso (cur_id, cat_id, cur_nom, cur_descrip, cur_fech_ini, cur_fech_fin, inst_id, cur_img, fech_crea, est) VALUES (NULL,?,?,?,?,?,?,'../../public/1.png',now(),'1');";
            $sql = $conectar->prepare($sql);
            $sql->bindValue(1, $cat_id);
            $sql->bindValue(2, $cur_nom);
            $sql->bindValue(3, $cur_descrip);
            $sql->bindValue(4, $cur_fech_ini);
            $sql->bindValue(5, $cur_fech_fin);
            $sql->bindValue(6, $inst_id);
            $sql->execute();
            return $resultado = $sql->fetchAll();
        }

        public function update_curso($cur_id,$cat_id, $cur_nom, $cur_descrip, $cur_fech_ini, $cur_fech_fin, $inst_id) {
            $conectar = parent::Conexion();
            parent::set_names();
            $sql = "UPDATE tm_curso
                    SET
                        cat_id = ?,
                        cur_nom = ?,
                        cur_descrip = ?,
                        cur_fech_ini = ?,
                        cur_fech_fin = ?,
                        inst_id = ?
                    WHERE
                        cur_id = ?";
            $sql = $conectar->prepare($sql);
            $sql->bindValue(1, $cat_id);
            $sql->bindValue(2, $cur_nom);
            $sql->bindValue(3, $cur_descrip);
            $sql->bindValue(4, $cur_fech_ini);
            $sql->bindValue(5, $cur_fech_fin);
            $sql->bindValue(6, $inst_id);
            $sql->bindValue(7, $cur_id);
            $sql->execute();
            return $resultado = $sql->fetchAll();
        }

        public function delete_curso($cur_id) {
            $conectar = parent::Conexion();
            parent::set_names();
            $sql = "UPDATE tm_curso SET est = 0 WHERE cur_id = ?";
            $sql = $conectar->prepare($sql);
            $sql->bindValue(1, $cur_id);
            $sql->execute();
            return $resultado = $sql->fetchAll();
        }

        public function get_curso() {
            $conectar = parent::Conexion();
            parent::set_names();
            $sql = "SELECT 
                tm_curso.cur_id,
                tm_curso.cur_nom,
                tm_curso.cur_descrip,
                tm_curso.cur_fech_ini,
                tm_curso.cur_fech_fin,
                tm_curso.cat_id,
                tm_categoria.cat_nom,
                tm_curso.inst_id,
                tm_instructor.inst_nombre,
                tm_instructor.inst_apep,
                tm_instructor.inst_apem,
                tm_instructor.inst_correo,
                tm_instructor.inst_correo,
                tm_instructor.inst_sex,
                tm_instructor.inst_telf
                FROM tm_curso 
                INNER JOIN tm_categoria ON tm_curso.cat_id = tm_categoria.cat_id
                INNER JOIN tm_instructor ON tm_curso.inst_id = tm_instructor.inst_id
                WHERE tm_curso.est = 1";
            $sql = $conectar->prepare($sql);
            $sql->execute();
            return $resultado = $sql->fetchAll();
        }

        public function get_curso_id($cur_id) {
            $conectar = parent::Conexion();
            parent::set_names();
            $sql = "SELECT * FROM tm_curso WHERE est = 1 AND cur_id = ?";
            $sql = $conectar->prepare($sql);
            $sql->bindValue(1, $cur_id);
            $sql->execute();
            return $resultado = $sql->fetchAll();
        }

        // Funcion para queitar el aceso a un usuario de su certificado de curso desde la ventana
        // Detalle certificado
        public function delete_curso_usuario($curd_id) {
            $conectar = parent::Conexion();
            parent::set_names();
            $sql = "UPDATE td_curso_usuario SET est = 0 WHERE curd_id = ?";
            $sql = $conectar->prepare($sql);
            $sql->bindValue(1, $curd_id);
            $sql->execute();
            return $resultado = $sql->fetchAll();
        }

        // Funcion para otorgar acceso a un usuario a un certificado
        public function insert_curso_usuario($cur_id, $usu_id) {
            $conectar = parent::Conexion();
            parent::set_names();
            $sql = "INSERT INTO td_curso_usuario(curd_id, cur_id, usu_id, fecha_crea, est) VALUES (NULL, ?, ?, now(), 1);";
            $sql = $conectar->prepare($sql);
            $sql->bindValue(1, $cur_id);
            $sql->bindValue(2, $usu_id);
            $sql->execute();
            return $resultado = $sql->fetchAll();
        }

        public function update_imagen_curso($cur_id, $cur_img) {
            $conectar = parent::Conexion();
            parent::set_names();
            require_once('Curso.php');
            $curx = new Curso();
            $cur_img = '';
            // Cuando se halla establecido el campo name en el input cur_img, es decir, cuando se halla subido la imagen
            // se llama a la funcion upload file, que es la que se encargara de almacenar el archivo, crear la ruta de acceso,
            // y almacenar esta ruta en la base de datos
            if ($_FILES["cur_img"]["name"] != '') {
                $cur_img = $curx->upload_file();
            }
            $sql = "UPDATE tm_curso SET cur_img = ? WHERE cur_id = ?";
            $sql = $conectar->prepare($sql);
            $sql->bindValue(1, $cur_img);
            $sql->bindValue(2, $cur_id);
            $sql->execute();
            return $resultado = $sql->fetchAll();
        }

        public function upload_file() {
            if (isset($_FILES["cur_img"])) {
                // Extraer extension del archivo
                $extension = explode('.', $_FILES['cur_img']['name']);
                // Cambiamos el nombre del archivo por un nombre aleatorio y agregamos la extension
                $new_name = rand() . '.' . $extension[1];
                // Creamos la ruta donde se almacenara el archivo
                $destination = '../public/' . $new_name;
                // Movemos el archivo subido a la ruta de destino donde se almecenara
                move_uploaded_file($_FILES['cur_img']['tmp_name'], $destination);
                // Retornamos la ruta del archivo, la cual se almacenara en la base de datos
                return "../../public/".$new_name;
            }
        }
    }
?>