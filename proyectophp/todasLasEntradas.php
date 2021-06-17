<?php require_once 'includes/cabecera.php'; ?><!--Aca esta la parte de arriba de la pagina e incluye conexion y helpers-->
<?php require_once 'includes/lateral.php'; ?><!--Mantiene la barra de la derecha
<!--Caja principal-->
<div id="principal">
    <h1>Todas las entradas</h1>
    <?php 
        $entradas= conseguirEntradas($db);
        if(!empty($entradas)):
            while($entrada= mysqli_fetch_assoc($entradas)):              
    ?>
    <article class="entrada">
        <a href="entrada.php?id=<?=$entrada['Id']?>">
            <h2><?=$entrada['Titulo']?></h2>
            <span class="fecha"><?=$entrada['categoria'].' | '.$entrada['Fecha']?></span>
            <p>
                <?= substr($entrada['Descripcion'], 0,200).' ...'
                //si se usa substr se toma un parte del texto en este caso 201 palabras?>
            </p>
        </a>
    </article>
    <?php
        endwhile;
        endif;
    ?>
    
</div> <!--Fin caja principal-->

<?php require_once 'includes/footer.php'; ?>
