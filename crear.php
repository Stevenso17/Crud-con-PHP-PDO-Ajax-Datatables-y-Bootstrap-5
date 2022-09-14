<?php

include('conexion.php');
include('funciones.php');

if($_POST["operacion"] == "crear"){
    $imagen =  '' ;
    if($_FILES["imagen_usuario"]["name"] != ''){
        $imagen = subir_imagen();

    }
    $stmt = $conexion->prepare("INSERT INTO usuarios(nombre,apellido,imagen,telefono,email)VALUES(:nombre,:apellido,:imagen,:telefono,:email)");

    $resultado = $stmt->execute(
        array(
            ':nombre' =>$_POST["nombre"],
            ':apellido' => $_POST["apellido"],
            ':telefono'=> $_POST['telefono'],
            ':email' => $_POST["email"],
            ':nombre' => $imagen



        )
     );

     if(!empty($resultado)){
        echo 'Registrado';
     }
}

