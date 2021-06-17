<?php require_once 'conexion.php'; ?> 
<?php require_once 'includes/helpers.php'; ?>
<!DOCTYPE HTML>
<html lang="es">
    <head>
        <meta charset="utf-8"/>
        <title>Blog de Videojuegos</title>
        <link rel="stylesheet" type="text/css" href="./assets/css/style.css"/>
    </head>
    <body>
        <!--Cabecera-->
        <header id="cabecera">
            <!--Logo-->
            <div id="logo">
                <a href="index.php">
                    Blog de videojuegos
                </a>
            </div>

            <!--Menu bajo el logo-->
            <nav id="menu">
                <ul>
                    <li>
                        <a href="index.php">Inicio</a>
                    </li>
                    <?php
                    $categorias = conseguirCategorias($db);
                    if(!empty($categorias)):
                        while ($categoria = mysqli_fetch_assoc($categorias)):
                            ?><!--Aca se mandan las categorias obtenidas de la base de datos a el menu 
                              bajo el logo de manera iterativa-->
                            <li>
                                <a href="categoria.php?id=<?= $categoria['Id'] ?>"><?= $categoria['Nombre'] ?></a>
                            </li>                    
                    <?php 
                        endwhile;
                        endif;
                    ?><!--Fin de la iteracion de las categorias-->
                    <li>
                        <a href="index.php">Sobre mi</a>
                    </li>
                    <li>
                        <a href="index.php">Contacto</a>
                    </li>
                </ul>
            </nav>
            <div class="clearfix"></div>
        </header>
        <div id="contenedor">
