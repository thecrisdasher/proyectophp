<?php require_once 'includes/redireccion.php';?> 
<?php require_once 'includes/header.php';?> 
<?php require_once 'includes/sidebar.php';?> 


 <!-- Caja principal -->
 <div id="principal">
    <h1>Crear entradas</h1>
    <p>
        Añade nuevas entradas para que los usuarios puedan verlas y pasarla meloso.
    </p>
    <br/>
    <form action="guardar_entradas.php" method= "POST">
        <label for="titulo">Titulo:</label>
        <input name= "titulo" type="text" value =""/><br/>

        <label for="descripcion">Descripción:</label>
        <textarea name="descripcion"></textarea><br/>

        <label for="categoria">Categoría:</label>
        <select name="categorias">
        <?php 
        $categorias = conseguirCategorias($db);
            if(!empty($categorias)):
            foreach($categorias as $categoria):
                ?>
                <option value="<?=$categoria['id']?>">
                    <?=$categoria['nombre']?>
                </option>
    
            <?php endforeach;
            endif;
            ?>    

        <input type="submit" value ="Crear categoría">
    </form>

    
    </div> <!--fin principal-->
      
  
  
 <?php require_once 'includes/footer.php';?> 
