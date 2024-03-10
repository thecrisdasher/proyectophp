<?php require_once 'includes/redireccion.php';?> 
<?php require_once 'includes/header.php';?> 
<?php require_once 'includes/sidebar.php';?> 

 <!-- Caja principal -->
 <?php
    $entrada_actual = conseguirEntrada($db, $_GET['id']);
    if(!isset($entrada_actual['id'])){
        header ("Location: index.php");
    }
    ?>
    <? require_once 'includes/cabecera.php'?>
    <? require_once 'includes/lateral.php'?>

    <div id="principal">
    <h1>Editar entrada</h1>
    <p>
        Edita tu entrada <?=$entrada_actual['titulo']?>.
    </p>
    <br/>
    <form action="guardar_entradas.php?id=<?=$entrada_actual['id']?>&editar=1" method= "POST">
        <label for="titulo">Titulo:</label>
        <input name= "titulo" type="text" value ="<?=$entrada_actual['titulo']?>"/><br/>
        <?php echo isset($_SESSION['errores_entradas']) ? mostrarError($_SESSION['errores_entradas'], 'titulo') : '';?>


        <label for="descripcion">Descripción:</label>
        <textarea name="descripcion"><?=$entrada_actual['descripcion']?></textarea><br/>
        <?php echo isset($_SESSION['errores_entradas']) ? mostrarError($_SESSION['errores_entradas'], 'descripcion') : '';?>


        <label for="categoria">Categoría:</label>
        <select name="categorias">
        <?php 
        $categorias = conseguirCategorias($db);
            if(!empty($categorias)):
            foreach($categorias as $categoria):
                ?>
                <option value="<?=$categoria['id']?>"<?=($categoria['id'] == $entrada_actual['categoria_id']) ? 'selected="selected"' : ''?>>
                    <?=$categoria['nombre']?>
                </option>
    
            <?php endforeach;
            endif;
            ?>  
        </select>  
        <?php echo isset($_SESSION['errores_entradas']) ? mostrarError($_SESSION['errores_entradas'], 'categorias') : '';?>


        <input type="submit" value ="Guardar">
    </form>
    <?php borrarErrores();?>

    
    </div> <!--fin principal-->
      



<?php require_once 'includes/footer.php';?> 