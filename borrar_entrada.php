<?php
require_once 'includes/conexion.php';

if(isset($_SESSION['usuario']) && isset($_GET['id'])){
    $entrada_id = $_GET['id'];
    $usuario_id = $_SESSION['usuario']['id'];
    
    // Verifica si la conexión está establecida
    if ($db === null) {
        // Maneja el error adecuadamente, por ejemplo, con un mensaje y luego saliendo del script
        echo "Error: La conexión a la base de datos no está establecida.";
        exit;
    }

    // Prepara la consulta de eliminación
    $stmt = $db->prepare("DELETE FROM entradas WHERE usuario_id = ? AND id = ?");
    if ($stmt === false) {
        // Maneja el error si la preparación de la consulta falla
        echo "Error: No se pudo preparar la consulta.";
        exit;
    }

    // Enlaza los parámetros y ejecuta la consulta
    $stmt->bind_param("ii", $usuario_id, $entrada_id);
    $stmt->execute();  

    // Verifica si se realizó la eliminación correctamente
    if ($stmt->affected_rows > 0) {
        echo "La entrada ha sido eliminada exitosamente.";
    } else {
        echo "No se pudo eliminar la entrada.";
    }

    // Cierra la sentencia preparada
    $stmt->close();
}

header("Location: index.php");
exit;
?>
