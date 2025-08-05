<?php
    // Llamando a cadena de conexion
    require_once("../config/conexion.php");
    // Llamando a la clase
    require_once("../models/Usuario.php");
    // Inicializando clase
    $usuario = new Usuario();

    // Opcion de solicitud de controller
    switch($_GET["op"]) {
        // Microservicio para poder mostrar el listado de cursos de un usuario con certificado
        case "listar_cursos":
            $datos = $usuario->get_cursos_por_usuario($_SESSION["usu_id"]);
            $data = Array();
            foreach($datos as $row) {
                $sub_array = array();
                $sub_array[] = $row["cur_nom"];
                $sub_array[] = $row["cur_fech_ini"];
                $sub_array[] = $row["cur_fech_fin"];
                $sub_array[] = $row["inst_nombre"] ." ".$row["inst_apep"];
                $sub_array[] = '<button type="button" onClick="certificado('.$row["curd_id"].');" id="'.$row["curd_id"].'" class="btn btn-outline-primary btn-icon"><div><i class="fa fa-id-card-o"></i></div></button>';
                $data[] = $sub_array;
            }

            $results = array(
                "sEcho"=>1,
                "iTotalRecords"=>count($data),
                "iTotalDisplayRecords"=>count($data),
                "aaData"=>$data);
            echo json_encode($results);
            break;

        case "listar_cursos_top10":
            $datos = $usuario->get_cursos_por_usuario_top10($_SESSION["usu_id"]);
            $data = Array();
            foreach($datos as $row) {
                $sub_array = array();
                $sub_array[] = $row["cur_nom"];
                $sub_array[] = $row["cur_fech_ini"];
                $sub_array[] = $row["cur_fech_fin"];
                $sub_array[] = $row["inst_nombre"] ." ".$row["inst_apep"];
                $sub_array[] = '<button type="button" onClick="certificado('.$row["curd_id"].');" id="'.$row["curd_id"].'" class="btn btn-outline-primary btn-icon"><div><i class="fa fa-id-card-o"></i></div></button>';
                $data[] = $sub_array;
            }

            $results = array(
                "sEcho"=>1,
                "iTotalRecords"=>count($data),
                "iTotalDisplayRecords"=>count($data),
                "aaData"=>$data);
            echo json_encode($results);
            break;
        
        // Microservicio para mostrar informacion del certificado con el curd_id
        case "mostrar_curso_detalle":
            $datos = $usuario->get_curso_por_id_detalle($_POST["curd_id"]);
            // Si la variable datos no esta vacia, y esta formateada en forma de array, la recorremos
            if (is_array($datos) == true and count($datos) <> 0) {
                foreach ($datos as $row) {
                    $output["curd_id"] = $row["curd_id"];
                    $output["cur_nom"] = $row["cur_nom"];
                    $output["cur_descrip"] = $row["cur_descrip"];
                    $output["cur_fech_ini"] = $row["cur_fech_ini"];
                    $output["cur_fech_fin"] = $row["cur_fech_fin"];
                    $output["usu_id"] = $row["usu_id"];
                    $output["usu_nom"] = $row["usu_nom"];
                    $output["usu_apep"] = $row["usu_apep"];
                    $output["usu_apem"] = $row["usu_apem"];
                    $output["inst_id"] = $row["inst_id"];
                    $output["inst_nombre"] = $row["inst_nombre"];
                    $output["inst_apep"] = $row["inst_apep"];
                    $output["inst_apem"] = $row["inst_apem"];
                }
                // Almacenamos los datos dentro de un array y lo convertimos a formato JSON, para que pueda ser leido por JS
                echo json_encode($output);
            }
            break;
        // Total de cursos por usuario para el dashboard
        case "total":
            $datos = $usuario->get_total_cursos_por_usuario($_POST["usu_id"]);
            if (is_array($datos) == true and count($datos) <> 0) {
                foreach ($datos as $row) {
                    $output["total"] = $row["total"];
                }
                echo json_encode($output);
            }
            break;
        
        case "mostrar":
            $datos = $usuario->get_usuario_por_id($_POST["usu_id"]);
            // Si la variable datos no esta vacia, y esta formateada en forma de array, la recorremos
            if (is_array($datos) == true and count($datos) <> 0) {
                foreach ($datos as $row) {
                    $output["usu_id"] = $row["usu_id"];
                    $output["usu_nom"] = $row["usu_nom"];
                    $output["usu_apep"] = $row["usu_apep"];
                    $output["usu_apem"] = $row["usu_apem"];
                    $output["usu_correo"] = $row["usu_correo"];
                    $output["usu_sex"] = $row["usu_sex"];
                    $output["usu_pass"] = $row["usu_pass"];
                    $output["usu_telf"] = $row["usu_telf"];
                }
                // Almacenamos los datos dentro de un array y lo convertimos a formato JSON, para que pueda ser leido por JS
                echo json_encode($output);
            }
            break;
    }
?>