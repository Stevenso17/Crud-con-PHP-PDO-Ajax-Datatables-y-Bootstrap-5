<?php

   function subir_imagen(){

    if(isset($_FILES["archivo"])){

        $extesion = explode('.',$_FILES["archivo"]['name']);
        $nuevo_nombre = rand().'.'.$extesion[1];
        $ubicacion = './img'.$nuevo_nombre;
        move_uploaded_file($_FILES["archivo"]['tmp_name'],$ubicacion);
    }

    return $nuevo_nombre;

}

  function obtener_nombre_imagen($id_usuario){

    include('conexion.php');
    $stmt = $conexion->prepare("SELECT imagen FROM usuario WHERE  id =  '$id_usuario'");
    $stmt->excute();
    $resultado = $stmt->fetchALL();
    foreach($resultado  as $f){
        return $f['imagen'];
    }
  }

  function obtener_todos_registros(){
    
    include('conexion.php');
    $stmt = $conexion->prepare("SELECT *  FROM usuario ");
    $stmt->excute();
    $resultado = $stmt->fetchALL();

    return $stmt->rowCount();
  }