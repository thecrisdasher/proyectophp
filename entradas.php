<?php require_once 'includes/header.php';?> 
<?php require_once 'includes/sidebar.php';?> 
    <!-- Caja principal -->
    <div id="principal">
    <h1>Todas las entradas</h1>


    <?php
    $entradas = conseguirEntradas($db, null);
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