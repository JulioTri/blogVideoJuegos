
<!--CATEGORIAS EN EEL MENU BAJO EL LOGO-->
<?php require_once 'includes/cabecera.php'; ?><!--Aca esta la parte de arriba de la pagina e incluye conexion y helpers-->
<?php require_once 'includes/lateral.php'; ?><!--Mantiene la barra de la derecha

<!--Se consiguen las categorias por id y en caso de que el id no se encuetre
redirige la pagina al index-->
<?php
$entrada_actual = conseguirEntrada($db, $_GET['id']);
if (!isset($entrada_actual['Id'])) {
    header('Location: index.php');
}
?>

<!--Caja principal-->
<div id="principal">
    <h1><?= $entrada_actual['Titulo'] ?></h1>
    <a href="categoria.php?id=<?= $entrada_actual['Categoria_id'] ?>">
        <h2><?= $entrada_actual['categoria'] ?></h2>
    </a>
    <h4><?= $entrada_actual['Fecha'] ?> | <?= $entrada_actual['creador'] ?></h4>
    <p>
        <?= $entrada_actual['Descripcion'] ?> 
    </p>
    <?php if (isset($_SESSION['usuario']) && $_SESSION['usuario']['Id'] == $entrada_actual['Usuario_id']): ?>
        <br/><a href="editar-entrada.php?id=<?= $entrada_actual['Id'] ?>" class="boton boton-verde">Editar entrada</a>
        <a href="borrar-entrada.php?id=<?= $entrada_actual['Id'] ?>" class="boton">Borrar entrada</a>
    <?php endif; ?>
</div> <!--Fin caja principal-->

<?php require_once 'includes/footer.php'; ?>
