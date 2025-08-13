<?php
    class Curso extends Conectar {
        public function insert_curso($cat_id, $cur_nom, $cur_descrip, $cur_fech_ini, $cur_fech_fin, $inst_id) {
            $conectar = parent::Conexion();
            parent::set_names();
            $sql = "INSERT INTO tm_curso (cur_id, cat_id, cur_nom, cur_descrip, cur_fech_ini, cur_fech_fin, inst_id, fech_crea, est) VALUES (NULL,?,?,?,?,?,?,now(),'1');";
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
    }
?>