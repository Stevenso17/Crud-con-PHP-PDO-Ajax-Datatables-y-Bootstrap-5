<?php

    include('conexion.php');
    include('funciones.php');


    $query = "";
    $salida = array();
    $query  = "SELECT * FROM usuario ";

    if (isset($_POST["search"]["value"])) {
        $query .='WHERE nombre LIKE "%'.$_POST["search"]["value"] .'%"';

        $query .='OR apellido LIKE "%'.$_POST["search"]["value"] .'%"';
    }
    if(isset($_POST["order"])){
        $query.= 'ORDER BY'.$_POST['order']['0']['column'].' '.
        $_POST['order']['0']['dir'].'';

    }else{
        $query.= ' ORDER  BY ID DESC';
    }

    if($_POST["length"] != -1){
        $query .='LIMIT' . $_POST['start'].','.$_POST["length"];
    }
    $stmt = $conexion->prepare($query);
    $stmt->excute();
    $resultado = $stmt->fetchALL();
    foreach($resultado as $r){
        $imagen = '';
        if($r){
            if($r["imagen"]!=''){
                $imagen = '<img src="img/'.$r["imagen"].'"class="img-thumbnail"" 
                width="50" heigt="50"';
            }else{
                $imagen = '';
            }
            $sub_array = array();
            $sub_array[] = $r["id"];
            $sub_array[] = $r["nombre"];
            $sub_array[] = $r["apellido"];
            $sub_array[] = $r["telefono"];
            $sub_array[] = $r["email"];
            $sub_array[] = $imagen;
            $sub_array[] = $r["fecha_creacion"];
            $sub_array[] = '<button type="button" name="editar" id="'.$r.'"class="btn btn-warning btn-xs editar">editar</button>';
            $sub_array[] = '<button type="button" name="borrar" id="'.$r.'"class="btn btn-warning btn-xs borrar">borrar</button>';
            



        }
        $salida = array(
            "draw"                =>intval($_POST["draw"]),
            "recordsTotal"        =>$filtered_rows,
            "recordsFiltered"     => obtener_todos_registros(),
            "data"                => $datos

        );

        echo json_encode($salida);

    }


