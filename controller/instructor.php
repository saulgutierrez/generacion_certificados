<?php
    // Llamando a cadena de conexion
    require_once("../config/conexion.php");
    // Llamando a la clase
    require_once("../models/Instructor.php");
    // Inicializando clase
    $instructor = new Instructor();

    // Opcion de solicitud de controller
    switch($_GET["op"]) {
        // Guardar y editar cuando se tenga el id
        case "guardaryeditar":
            if (empty($_POST["cur_id"])) {
                $instructor->insert_instructor($_POST["inst_nom"], $_POST["inst_apep"], $_POST["inst_apem"], $_POST["inst_correo"], $_POST["inst_sex"], $_POST["inst_tel"]);
            } else {
                $instructor->update_instructor($_POST["inst_id"], $_POST["inst_nom"], $_POST["inst_apep"], $_POST["inst_apem"], $_POST["inst_correo"], $_POST["inst_sex"], $_POST["inst_tel"]);
            }
            break;
        // Creando JSON segun el id
        case "mostrar":
            $datos = $instructor->get_instructor_id($_POST["inst_id"]);
            // Si la variable datos no esta vacia, y esta formateada en forma de array, la recorremos
            if (is_array($datos) == true and count($datos) <> 0) {
                foreach ($datos as $row) {
                    $output["inst_id"] = $row["inst_id"];
                    $output["inst_nom"] = $row["inst_nom"];
                    $output["inst_apep"] = $row["inst_apep"];
                    $output["inst_apem"] = $row["inst_apem"];
                    $output["inst_correo"] = $row["inst_correo"];
                    $output["inst_sex"] = $row["inst_sex"];
                    $output["inst_telf"] = $row["inst_telf"];
                }
                // Almacenamos los datos dentro de un array y lo convertimos a formato JSON, para que pueda ser leido por JS
                echo json_encode($output);
            }
            break;
        // Eliminar segun id
        case "eliminar":
            $instructor->delete_instructor($_POST["inst_id"]);
            break;
        // Listar toda la informacion segun el formato de DataTable
        case "listar":
            $datos = $instructor->get_instructor();
            $data = Array();
            foreach($datos as $row) {
                $sub_array = array();
                $sub_array[] = $row["inst_nom"];
                $sub_array[] = $row["inst_apep"];
                $sub_array[] = $row["inst_apem"];
                $sub_array[] = $row["inst_correo"];
                $sub_array[] = $row["inst_telf"];
                $sub_array[] = '<button type="button" onClick="editar('.$row["inst_id"].');" id="'.$row["inst_id"].'" class="btn btn-outline-warning btn-icon"><div><i class="fa fa-edit"></i></div></button>';
                $sub_array[] = '<button type="button" onClick="eliminar('.$row["inst_id"].');" id="'.$row["inst_id"].'" class="btn btn-outline-danger btn-icon"><div><i class="fa fa-close"></i></div></button>';
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
            $datos = $instructor->get_instructor();
            if (is_array($datos) == true and count($datos) > 0) {
                $html = "<option label='Seleccione'></option>";
                foreach ($datos as $row) {
                    // Concatenamos el contenido recuperado de la base de datos, para mostrarlo en el combobox
                    $html .= "<option value='".$row['inst_id']."'>".$row['inst_nombre']." ".$row['inst_apep']. " ".$row['inst_apem']."</option>";
                }
                echo $html;
            }
    }
?>