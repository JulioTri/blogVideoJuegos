<?php require_once 'includes/redireccion.php';?><!--Para saber si el usuario esta logueado o a creado sesion-->
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
    <h1>Editar entradas</h1>
    <p>
        Edita tu entrada <?=$entrada_actual['Titulo']?>.
    </p>
    <br/>
    <form action="guardar-editar-entrada.php?editar=<?=$entrada_actual['Id']?>" method="POST">
        <label for="titulo">Titulo:</label>
        <input type="text" name="titulo" value="<?=$entrada_actual['Titulo']?>"/>
        <?php echo isset($_SESSION['errores_entrada']) ? mostrar_error($_SESSION['errores_entrada'], 'titulo') : '' ?>
        
        <label for="descripcion">Descripcion:</label>
        <textarea name="descripcion" ><?=$entrada_actual['Descripcion']?></textarea>
        <?php echo isset($_SESSION['errores_entrada']) ? mostrar_error($_SESSION['errores_entrada'], 'descripcion') : '' ?>

        <label for="categoria">Categoria</label>
        <select name="categoria">
        <?php echo isset($_SESSION['errores_entrada']) ? mostrar_error($_SESSION['errores_entrada'], 'categoria') : '' ?>

            <?php
                $categorias = conseguirCategorias($db);
                if(!empty($categorias)):
                    while ($categoria = mysqli_fetch_assoc($categorias)):
            ?><!--se crea una iteracion para obtener todas las categorias 
              en la base de datos y alojarlas en un menu desplegable-->
                    <option value="<?=$categoria['Id']?>"       
                     <?=($categoria['Id']==$entrada_actual['Categoria_id']) ? 'selected="selected"':''
                        /*Condicion dentro de la opcion para que cuando se recorra la categoria y encuentre
                         * el id de la categoria de la entrada_actual seleccione dicha categoria */?>
                     >
                    <?=$categoria['Nombre']?></option>
            <?php 
                endwhile;
                endif;
            ?><!--Fin de la iteracion de categorias-->
        </select>
        
        <input type="submit" value="Actualizar"/>
    </form>
    <?php borrar_errores()?>
</div> <!--Fin caja principal-->

<?php require_once 'includes/footer.php'; ?>