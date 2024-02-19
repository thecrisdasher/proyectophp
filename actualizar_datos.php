<?php
if(isset($_POST)){

require_once "includes/conexion.php";

if(isset($_POST)){

    require_once "includes/conexion.php";

    
//recoger datos
    $nombre = isset($_POST['nombre']) ? mysqli_real_escape_string($db,$_POST['nombre']) : false;
    $apellidos = isset($_POST['apellidos']) ? mysqli_real_escape_string($db,$_POST['apellidos']) : false;
    $email = isset($_POST['email']) ? mysqli_real_escape_string($db,$_POST['email']) : false;
}


//error
$errores = array();

//validar

if(!empty($nombre) && !is_numeric($nombre) && !preg_match('/[0-9]/',$nombre)){
 $nombre_validate = true;

} else{
    $nombre_validate = false;
    $errores['nombre'] = "el campo nombre es invalido";
}

if(!empty($apellidos) && !is_numeric($apellidos) && !preg_match('/[0-9]/',$apellidos)){
    $apellido_validate = true;
    
   } else{
       $apellido_validate = false;
       $errores['apellidos'] = "el campo apellidos es invalido";
   }

   if(!empty($email) && filter_var($email,FILTER_VALIDATE_EMAIL)){
    $email_validate = true;
    
   } else{
       $email_validate = false;
       $errores['email'] = "el campo email es invalido";
   }

$guardar_usuario = false;

   if(count($errores) == 0){
    //insertar usuario en la base de datos }
    $usuario = $_SESSION['usuario'];

    $guardar_usuario= true;

    //COMPROBAR SI EXISTE EL email 
    $sql = "SELECT id, email from usuarios where email = '$email'";
    $isset_email = mysqli_query($db,$sql);
    $isset_user = mysqli_fetch_assoc($isset_email);

    if($isset_user['id'] == $usuario['id'] || empty($isset_user)){

     //Update datos en la base de datos
    $sql = "UPDATE usuarios SET
    nombre = '$nombre',
    apellidos = '$apellidos',
    email = '$email'
    WHERE id = " . $usuario['id'];
    $guardar = mysqli_query($db,$sql);

    if($guardar){
        $_SESSION['usuario']['nombre'] = $nombre;
        $_SESSION['usuario']['apellidos'] = $apellidos;
        $_SESSION['usuario']['email'] = $email;
        $_SESSION['completado'] = "Tus datos han sido actualizados con exito bro";
       
    }else
    $_SESSION['errores']['general'] = "Fallo al actualizar el usuario ";
}else{
    $_SESSION['errores']['general'] = "El usuario ya existe";
}
   }else{
    $_SESSION['errores'] = $errores;
   }
}
header ('Location: mis_datos.php');


?>