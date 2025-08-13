<?php
    // Llamando a cadena de conexion
    require_once("../config/conexion.php");
    // Llamando a la clase
    require_once("../models/Curso.php");
    // Inicializando clase
    $curso = new Curso();

    // Opcion de solicitud de controller
    switch($_GET["op"]) {
        // Guardar y editar cuando se tenga el id
        case "guardaryeditar":
            if (empty($_POST["cur_id"])) {
                $curso->insert_curso($_POST["cat_id"], $_POST["cur_nom"], $_POST["cur_descrip"], $_POST["cur_fech_ini"], $_POST["cur_fech_fin"], $_POST["inst_id"]);
            } else {
                $curso->update_curso($_POST["cat_id"], $_POST["cur_nom"], $_POST["cur_descrip"], $_POST["cur_fech_ini"], $_POST["cur_fech_fin"], $_POST["inst_id"], $_POST["cur_id"]);
            }
            break;
        // Creando JSON segun el id
        case "mostrar":
            $datos = $curso->get_curso_id($_POST["cur_id"]);
            // Si la variable datos no esta vacia, y esta formateada en forma de array, la recorremos
            if (is_array($datos) == true and count($datos) <> 0) {
                foreach ($datos as $row) {
                    $output["cur_id"] = $row["cur_id"];
                    $output["cat_id"] = $row["cat_id"];
                    $output["cur_nom"] = $row["cur_nom"];
                    $output["cur_descrip"] = $row["cur_descrip"];
                    $output["cur_fech_ini"] = $row["cur_fech_ini"];
                    $output["cur_fech_fin"] = $row["cur_fech_fin"];
                    $output["inst_id"] = $row["inst_id"];
                }
                // Almacenamos los datos dentro de un array y lo convertimos a formato JSON, para que pueda ser leido por JS
                echo json_encode($output);
            }
            break;
        // Eliminar segun id
        case "eliminar":
            $curso->delete_curso($_POST["cur_id"]);
            break;
        // Listar toda la informacion segun el formato de DataTable
        case "listar":
            $datos = $curso->get_curso();
            $data = Array();
            foreach($datos as $row) {
                $sub_array = array();
                $sub_array[] = $row["cat_nom"];
                // Guardar la entrada en mayuscula
                $sub_array[] = strtoupper($row["cur_nom"]);
                $sub_array[] = $row["cur_fech_ini"];
                $sub_array[] = $row["cur_fech_fin"];
                $sub_array[] = $row["inst_nombre"] ." ".$row["inst_apep"] ." ".$row["inst_apem"];
                $sub_array[] = '<button type="button" onClick="editar('.$row["cur_id"].');" id="'.$row["cur_id"].'" class="btn btn-outline-warning btn-icon"><div><i class="fa fa-edit"></i></div></button>';
                $sub_array[] = '<button type="button" onClick="eliminar('.$row["cur_id"].');" id="'.$row["cur_id"].'" class="btn btn-outline-danger btn-icon"><div><i class="fa fa-close"></i></div></button>';
                $data[] = $sub_array;
            }

            $results = array(
                "sEcho"=>1,
                "iTotalRecords"=>count($data),
                "iTotalDisplayRecords"=>count($data),
                "aaData"=>$data);
            echo json_encode($results);
            break;
    }
?>