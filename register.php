<?php

if(isset($_POST)){

    require_once "includes/conexion.php";

    if(!isset($_SESSION)){
        session_start();
    }
    
//recoger datos
    $nombre = isset($_POST['nombre']) ? mysqli_real_escape_string($db,$_POST['nombre']) : false;
    $apellidos = isset($_POST['apellidos']) ? mysqli_real_escape_string($db,$_POST['apellidos']) : false;
    $email = isset($_POST['email']) ? mysqli_real_escape_string($db,$_POST['email']) : false;
    $password = isset($_POST['password']) ? mysqli_real_escape_string($db,$_POST['password']) : false;
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

   if(!empty($password)){
    $password_validate = true;
    
   } else{
       $password_validate = false;
       $errores['password'] = "la contraseña está vacía";
   }

$guardar_usuario = false;

   if(count($errores) == 0){
    //insertar usuario en la base de datos 
    $guardar_usuario= true;

    //cifrar contraseña 

    $password_cifrada = password_hash($password, PASSWORD_BCRYPT, ['cost=>4']); 
     //Insertar datos en la base de datos

    $sql = "INSERT INTO usuarios values(NULL, '$nombre','$apellidos','$email','$password_cifrada', CURRENT_DATE())";
    $guardar = mysqli_query($db,$sql);

    if (mysqli_error($db)) {
        var_dump(mysqli_error($db));
        die();
      } else {
        header('Location: index.php');
      }
    if($guardar){
        $_SESSION['completado'] = "El registro ha sido un exito bro";
    }else
    $_SESSION['errores']['general'] = "Fallo al guardar el usuario ";
}else{
    $_SESSION['errores'] = $errores;
   }

header('Location: index.php');

?>