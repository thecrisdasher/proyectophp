<?php

if(isset($_POST)){
    require_once "includes/conexion.php";

    $nombre_category = isset($_POST['nombre_categoria']) ? mysqli_real_escape_string($db,$_POST['nombre_categoria']) : false;
}



//error
$errores = array();

//validar

if(!empty($nombre_category) && !is_numeric($nombre_category) && !preg_match('/[0-9]/',$nombre_category)){
    $nombre_validate = true;

} else{
    $nombre_validate = false;
    $errores['nombre_categoria'] = "el campo nombre es invalido";
}

if(count($errores) == 0){
    //insertar usuario en la base de datos 
    $sql= "INSERT INTO categorias values(NULL, '$nombre_category')";
    $guardar = mysqli_query($db,$sql);

}


header("Location: index.php")
?>