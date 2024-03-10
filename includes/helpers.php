
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
    $borrado= true;
    }

    if(isset($_SESSION['errores_entradas'])){
      $_SESSION['errores_entradas'] = null;
      $borrado= true;
      }
    
    if(isset($_SESSION['completado'])){
    $_SESSION['completado'] = null;
    $borrado= true;
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


function conseguirEntradas($conexion, $limit = null, $id = null, $busqueda=null){
  if(!is_null($id)){
    $sql = "SELECT e.*,c.nombre as 'Categoría' FROM entradas e INNER JOIN categorias c ON e.categoria_id =c.id where c.id = $id ORDER BY e.id DESC";

  }else{
    $sql = "SELECT e.*,c.nombre as 'Categoría' FROM entradas e INNER JOIN categorias c ON e.categoria_id =c.id ORDER BY e.id DESC";
  }
  if(!empty($busqueda)){
    $sql .= " WHERE e.titulo LIKE '%$busqueda%'";
  }
  if($limit){
    $sql .= " LIMIT 4";
  }


  // Consulta SQL con prepared statement
$stmt = $conexion->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();
  return $result;

}

function conseguirCategoria($conexion, $id){
  if (!is_numeric($id)) {
    // Manejar el error: ID no válido
    exit();
  }
    // Prepara la consulta SQL usando sentencias preparadas para prevenir inyección SQL
    $stmt = $conexion->prepare("SELECT * FROM categorias WHERE id = ?");
    //$id = (int) $id; // Ejemplo asumiendo que el id viene del GET
    $stmt->bind_param("i", $id); // Vincula el valor del parámetro a la consulta
  
    // Ejecuta la consulta
    $stmt->execute();
  
    // Obtén el resultado como un objeto mysqli_result
    $resultado = $stmt->get_result();
  
    // Verifica si se encontró la categoría
    if ($resultado && $resultado->num_rows === 1) {
      // Obtén la primera fila (y única) del resultado como un array asociativo
      $categoria = $resultado->fetch_assoc();
  
      // Libera la memoria del resultado
      $resultado->free();
  
      return $categoria;
    } else {
      return []; // Devuelve un array vacío si no se encontró la categoría
    }
  }

function conseguirEntrada($conexion, $id){
  if (!is_numeric($id)) {
    // Manejar el error: ID no válido
    exit();
  }
  $stmt = $conexion->prepare("SELECT e.*, c.nombre AS 'categoria', CONCAT(u.nombre, ' ', u.apellidos) AS usuario FROM entradas e INNER JOIN categorias c ON e.categoria_id = c.id INNER JOIN usuarios u ON e.usuario_id = u.id WHERE e.id = $id");

  $stmt->execute();

  $resultado = $stmt->get_result();


  if ($resultado && $resultado->num_rows === 1) {
    // Obtén la primera fila (y única) del resultado como un array asociativo
    $entrada = $resultado->fetch_assoc();
  
  $resultado->free();
  
  return $entrada;
} else {
  return []; // Devuelve un array vacío si no se encontró la categoría
}
}
  



