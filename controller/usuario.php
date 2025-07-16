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
                $sub_array[] = '<button type="button" onClick="certificado('.$row["curd_id"].');" id="'.$row["curd_id"].'" class="btn btn-outline-warning btn-icon"><div><i class="fa fa-edit"></i></div></button>';
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