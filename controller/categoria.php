<?php
    // Llamando a cadena de conexion
    require_once("../config/conexion.php");
    // Llamando a la clase
    require_once("../models/Categoria.php");
    // Inicializando clase
    $categoria = new Categoria();

    // Opcion de solicitud de controller
    switch($_GET["op"]) {
        // Guardar y editar cuando se tenga el id
        case "guardaryeditar":
            if (empty($_POST["cat_id"])) {
                $categoria->insert_categoria($_POST["cat_nom"]);
            } else {
                $categoria->update_categoria($_POST["cat_id"], $_POST["cat_nom"]);
            }
            break;
        // Creando JSON segun el id
        case "mostrar":
            $datos = $categoria->get_categoria_id($_POST["cat_id"]);
            // Si la variable datos no esta vacia, y esta formateada en forma de array, la recorremos
            if (is_array($datos) == true and count($datos) <> 0) {
                foreach ($datos as $row) {
                    $output["cat_id"] = $row["cat_id"];
                    $output["cat_nom"] = $row["cat_nom"];
                }
                // Almacenamos los datos dentro de un array y lo convertimos a formato JSON, para que pueda ser leido por JS
                echo json_encode($output);
            }
            break;
        // Eliminar segun id
        case "eliminar":
            $categoria->delete_categoria($_POST["cat_id"]);
            break;
        // Listar toda la informacion segun el formato de DataTable
        case "listar":
            $datos = $categoria->get_categoria();
            $data = Array();
            foreach($datos as $row) {
                $sub_array = array();
                $sub_array[] = $row["cat_nom"];
                $sub_array[] = '<button type="button" onClick="editar('.$row["cat_id"].');" id="'.$row["cat_id"].'" class="btn btn-outline-warning btn-icon"><div><i class="fa fa-edit"></i></div></button>';
                $sub_array[] = '<button type="button" onClick="eliminar('.$row["cat_id"].');" id="'.$row["cat_id"].'" class="btn btn-outline-danger btn-icon"><div><i class="fa fa-close"></i></div></button>';
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
            $datos = $categoria->get_categoria();
            if (is_array($datos) == true and count($datos) > 0) {
                $html = "<option label='Seleccione'></option>";
                foreach ($datos as $row) {
                    // Concatenamos el contenido recuperado de la base de datos, para mostrarlo en el combobox
                    $html .= "<option value='".$row['cat_id']."'>".$row['cat_nom']."</option>";
                }
                echo $html;
            }
    }
?>