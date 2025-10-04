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
                $curso->update_curso($_POST["cur_id"], $_POST["cat_id"], $_POST["cur_nom"], $_POST["cur_descrip"], $_POST["cur_fech_ini"], $_POST["cur_fech_fin"], $_POST["inst_id"]);
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
                $sub_array[] = '<a href="'.$row["cur_img"].'" target="_blank">'.strtoupper($row["cur_nom"]).'</a>';
                $sub_array[] = $row["cur_fech_ini"];
                $sub_array[] = $row["cur_fech_fin"];
                $sub_array[] = $row["inst_nombre"] ." ".$row["inst_apep"] ." ".$row["inst_apem"];
                $sub_array[] = '<button type="button" onClick="editar('.$row["cur_id"].');" id="'.$row["cur_id"].'" class="btn btn-outline-warning btn-icon"><div><i class="fa fa-edit"></i></div></button>';
                $sub_array[] = '<button type="button" onClick="eliminar('.$row["cur_id"].');" id="'.$row["cur_id"].'" class="btn btn-outline-danger btn-icon"><div><i class="fa fa-close"></i></div></button>';
                $sub_array[] = '<button type="button" onClick="imagen('.$row["cur_id"].');" id="'.$row["cur_id"].'" class="btn btn-outline-success btn-icon"><div><i class="fa fa-file"></i></div></button>';
                $data[] = $sub_array;
            }

            $results = array(
                "sEcho"=>1,
                "iTotalRecords"=>count($data),
                "iTotalDisplayRecords"=>count($data),
                "aaData"=>$data);
            echo json_encode($results);
            break;
        // Listar toda la información según formato de DataTable
        case "combo":
            $datos = $curso->get_curso();
            if (is_array($datos) == true and count($datos) > 0) {
                $html = "<option label='Seleccione'></option>";
                foreach ($datos as $row) {
                    // Concatenamos el contenido recuperado de la base de datos, para mostrarlo en el combobox
                    $html .= "<option value='".$row['cur_id']."'>".$row['cur_nom']."</option>";
                }
                echo $html;
            }

        case "eliminar_curso_usuario":
            $curso->delete_curso_usuario($_POST["curd_id"]);
            break;
        
        // Otorgar acceso a un usuario a un certificado
        case "insert_curso_usuario":
            var_dump($_POST);
            // Separamos cada elemento del array usu_id por un delimitador, en este caso, la coma
            $datos = explode(',', $_POST['usu_id']);
            foreach ($datos as $row) {
                // Insertamos en la base de datos, cada id del curso seleccionado, junto con el id del
                // usuario al que se le ha otorgado el acceso
                $curso->insert_curso_usuario($_POST["cur_id"], $row);
            }
            break;
        
        case "update_imagen_curso":
            var_dump($_POST);
            var_dump($_FILES);
            $curso->update_imagen_curso($_POST['curx_idx'], $_FILES['cur_img']);
            break;
    }
?>