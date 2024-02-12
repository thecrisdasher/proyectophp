<?php require_once 'conexion.php'; ?>
<?php require_once 'helpers.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog de música</title>
    <link rel="stylesheet" type="text/css" href="./assets/css/styles.css"/>
</head>
<body>
    <!-- Cabecera -->
    <header id="header">
        <!-- Logo -->
        <div id= 'Logo'>
            <a href="index.php">
                Blog de música
            </a>
    </div>  
    

    <!-- Menu -->
    
    <nav id="nav">
        <ul style="list-style: none;">
            <li>
                <a href="index.php">Inicio</a>
            </li>
            <li>
            <?php $categorias = conseguirCategorias($db);
            if(!empty($categorias)):
            foreach($categorias as $categoria):
                ?>     
                <li>
                    <a href="categorias.php?id=<?=$categoria['id']?>"><?= $categoria['nombre']?></a>
                </li>
            <?php endforeach;
            endif;
            ?>    
            <li>
                <a href="index.php">Sobre mí</a>
            </li>
            <li>
                <a href="index.php">Contacto</a>
            </li>
        </ul>

    </nav>
    <div class="clearfix"></div>
    </header>

    <div id="container">
