
<!--CATEGORIAS EN EL MENU BAJO EL LOGO-->
<?php require_once 'includes/cabecera.php'; ?><!--Aca esta la parte de arriba de la pagina e incluye conexion y helpers-->
<?php require_once 'includes/lateral.php'; ?><!--Mantiene la barra de la derecha

<!--Se consiguen las categorias por id y en caso de que el id no se encuetre
redirige la pagina al index-->
<?php
$categoria = conseguirCategoria($db, $_GET['id']);
if (!isset($categoria['Id'])) {
    header('Location: index.php');
}
?>

<!--Caja principal-->
<div id="principal">

    <h1>Entradas de <?= $categoria['Nombre'] ?></h1>
    <?php
    $entradas = conseguirEntradas($db, null, $_GET['id']);
    if (!empty($entradas) && mysqli_num_rows($entradas)>=1):
        while ($entrada = mysqli_fetch_assoc($entradas)):
            ?>
            <article class="entrada">
                <a href="entrada.php?id=<?=$entrada['Id']?>">
                    <h2><?= $entrada['Titulo'] ?></h2>
                    <span class="fecha"><?= $entrada['categoria'] . ' | ' . $entrada['Fecha'] ?></span>
                    <p>
                        <?=
                        substr($entrada['Descripcion'], 0, 200) . ' ...'
                        //si se usa substr se toma un parte del texto en este caso 201 palabras
                        ?>
                    </p>
                </a>
            </article>
            <?php
        endwhile;
    else:
        ?>
        <div class="alerta">No hay entradas en esta categoria</div>
<?php endif; ?>

</div> <!--Fin caja principal-->

<?php require_once 'includes/footer.php'; ?>

