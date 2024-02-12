
<?php
function mostrarError($errores,$campo){
    $alerta = "";
    if(isset($errores[$campo]) && !empty($campo)){
        $alerta = "<div class='alerta alerta-error'>".$errores[$campo]. '</div>';
    }
    return $alerta;
}

function borrarErrores(){
    

    if(isset($_SESSION['errores'])){
    $_SESSION['errores'] = null;
    unset($_SESSION['errores']);
    }
    
    if(isset($_SESSION['completado'])){
    $_SESSION['completado'] = null;
    unset($_SESSION['completado']);
    }
}  
function conseguirCategorias($conexion){
    $sql = 'SELECT * FROM categorias ORDER BY id asc';


    // Consulta SQL con prepared statement
  $stmt = $conexion->prepare($sql);
  $stmt->execute();
  $result = $stmt->get_result();
    return $result;
}

function conseguirUltimasEntradas($conexion){
        $entradas = "SELECT e.*,c.nombre as 'Categoría' FROM entradas e INNER JOIN categorias c ON e.categoria_id =c.id ORDER BY e.id DESC LIMIT 4";
    
    
        // Consulta SQL con prepared statement
      $stmt = $conexion->prepare($entradas);
      $stmt->execute();
      $result = $stmt->get_result();
        return $result;

}


