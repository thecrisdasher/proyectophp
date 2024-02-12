<?php

if(isset($_POST)){
    require_once "includes/conexion.php";

    $titulo = isset($_POST['titulo']) ? mysqli_real_escape_string($db,$_POST['titulo']) : false;
    $descripcion = isset($_POST['descripcion']) ? mysqli_real_escape_string($db,$_POST['descripcion']) : false;
    $categoria = isset($_POST['categorias']) ? (int) $_POST['categorias'] : false;
    $usuario = $_SESSION['usuario']['id'];
}



//error
$errores = array();

//validar

if(!empty($titulo)){
    $titulo_validate = true;
}else{
    $titulo_validate = false;
    $errores['titulo'] = "El titulo no es valido parcero";
} 
if(!empty($descripcion)){
    $descrip = true;
}else{
    $descrip = false;
    $errores['descripcion'] = "La descripcion no es valida parcero";

} 

if(!empty($categoria) && is_numeric($categoria)){
    $categoria_validada = true;
}else{
    $categoria_validada = false;
    $errores['categoria'] = "La categoria no es valida parcero";
} 

if(count($errores) == 0){
    //insertar usuario en la base de datos 
    $sql= "INSERT INTO entradas values(NULL, $usuario, $categoria, '$titulo', '$descripcion', CURRENT_DATE())";
    $guardar = mysqli_query($db,$sql);

}else{
    $_SESSION["errores_entradas"] = $errores;
}


header("Location: index.php")
?>