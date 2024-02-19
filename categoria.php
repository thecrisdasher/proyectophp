<?php require_once 'includes/header.php';?> 
<?php require_once 'includes/sidebar.php';?> 

 <!-- Caja principal -->
 <?php
    $categoria = conseguirCategoria($db, $_GET['id']);
    ?>
    <div id="principal">
    <h1>Entradas de <?= $categoria['nombre'] ?></h1>


    <?php
    $entradas = conseguirEntradas($db, null, $_GET['id']);
    if(!empty($entradas)):
        foreach($entradas as $entrada):
    ?>
    <article class="entrada">
        <a href="index.php">
        <h2><?=$entrada['titulo'] ?></h2>
        <span class="fecha"><?= $entrada['Categoría']. ' | '.$entrada['fecha']?></span>
        <p>
        <?=substr($entrada['descripcion'], 0, 200) ?>
        </p>
        </a>
    </article>

    <?php
    endforeach;
    endif;
    ?>

    </div> <!--fin principal-->
      
  
  
 <?php require_once 'includes/footer.php';?> 