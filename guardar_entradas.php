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
    if(isset($_SESSION['usuario']) && isset($_GET['id'])){
        $usuario_id = $_SESSION['usuario']['id'];
        $entrada_id = $_GET['id']; // Define $entrada_id

        
        // Verifica si la conexión está establecida
        if ($db === null) {
            // Maneja el error adecuadamente, por ejemplo, con un mensaje y luego saliendo del script
            echo "Error: La conexión a la base de datos no está establecida.";
            exit;
        }
    
        if (isset($_GET['id']) && is_numeric($_GET['id'])) {
            $entrada_id = $_GET['id'];
    
            if(isset($_GET['editar'])){
                // Actualización de la entrada
                $sql = "UPDATE entradas SET titulo='$titulo', descripcion='$descripcion', categoria_id=$categoria"." WHERE id=$entrada_id AND usuario_id=$usuario_id";
                $stmt = $db->prepare($sql);
                //$stmt->bind_param("ssiis", $titulo, $descripcion, $categoria);
            } else {
                // Inserción de una nueva entrada
                $sql = "INSERT INTO entradas values(NULL, $usuario, $categoria, '$titulo', '$descripcion', CURRENT_DATE())";
                $stmt = $db->prepare($sql);
                $stmt->bind_param("iiss", $usuario_id, $categoria, $titulo, $descripcion);
            }
    
            // Ejecutar la consulta preparada
            $stmt->execute();
    
            // Verifica si se realizó la operación correctamente
            if ($stmt->affected_rows > 0) {
                // Operación exitosa, redirigir al usuario a la página principal
                header("Location: index.php");
                exit;
            } else {
                // Error al ejecutar la consulta SQL
                echo "Error al guardar la entrada.";
            }
    
            // Cierra la sentencia preparada
            $stmt->close();
        } else {
            echo "ID de entrada no válido.";
        }
    } else {
        echo "Datos de sesión o ID de entrada no proporcionados.";
    }
}



?>