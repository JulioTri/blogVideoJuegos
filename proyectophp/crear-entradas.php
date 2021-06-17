<?php require_once 'includes/redireccion.php';?><!--Para saber si el usuario esta logueado o a creado sesion-->
<?php require_once 'includes/cabecera.php'; ?><!--Aca esta la parte de arriba de la pagina e incluye conexion y helpers-->
<?php require_once 'includes/lateral.php'; ?><!--Mantiene la barra de la derecha 

<!--Caja principal-->
<div id="principal">
    <h1>Crear entradas</h1>
    <p>
        Añade nuevas entradas al blog para  que los usuarios puedan leerlas 
        y disfrutar de nuestro contenido. 
    </p>
    <br/>
    <form action="guardar-editar-entrada.php" method="POST">
        <label for="titulo">Titulo:</label>
        <input type="text" name="titulo"/>
        <?php echo isset($_SESSION['errores_entrada']) ? mostrar_error($_SESSION['errores_entrada'], 'titulo') : '' ?>
        
        <label for="descripcion">Descripcion:</label>
        <textarea name="descripcion"></textarea>
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
                    <option value="<?=$categoria['Id']?>">
                    <?=$categoria['Nombre']?></option>
            <?php 
                endwhile;
                endif;
            ?><!--Fin de la iteracion de categorias-->
        </select>
        
        <input type="submit" value="Guardar"/>
    </form>
    <?php borrar_errores()?>
</div> <!--Fin caja principal-->

<?php require_once 'includes/footer.php'; ?>