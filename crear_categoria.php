<?php require_once 'includes/redireccion.php';?> 
<?php require_once 'includes/header.php';?> 
<?php require_once 'includes/sidebar.php';?> 


 <!-- Caja principal -->
 <div id="principal">
    <h1>Crear categorias</h1>
    <p>
        Añade nuevas categorias para que los usuarios puedan usarlas al crear sus entradas.
    </p>
    <br/>
    <form action="guardar_categoria.php" method= "POST">
        <label for="nombre_categoria">Nombre de la categoría:</label>
        <input name= "nombre_categoria" type="text" value =""/>
        <input type="submit" value ="Crear categoría">
    </form>

    
    </div> <!--fin principal-->
      
  
  
 <?php require_once 'includes/footer.php';?> 
