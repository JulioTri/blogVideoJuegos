<?php require_once 'includes/redireccion.php';?><!--Para saber si el usuario esta logueado o a creado sesion-->
<?php require_once 'includes/cabecera.php'; ?><!--Aca esta la parte de arriba de la pagina e incluye conexion y helpers-->
<?php require_once 'includes/lateral.php'; ?><!--Mantiene la barra de la derecha 

<!--Caja principal-->
<div id="principal">
    <h1>Mis datos</h1>
    
    <?php if (isset($_SESSION['completado'])): ?><!--Si se genera la cesion completado es por que si 
                                                 hubo registro y se muestra en pantalla-->
        <div class="alerta alerta-exito">
            <?= $_SESSION['completado'] ?>
        </div>
    <?php elseif (isset($_SESSION['errores']['general'])): ?><!--En caso de errores al registrarse 
                                                             imprime errores en pantalla-->
        <div class="alerta alerta-error">
            <?= $_SESSION['errores']['general'] ?>
        </div>
    <?php endif; ?>
    
    <form action="actualizar-usuario.php" method="POST"><!--Se envian los datos del formulario-->
            <label for="nombre">Nombre</label>
            <input type="text" name="nombre" value="<?=$_SESSION['usuario']['Nombre']?>"/>
            <?php echo isset($_SESSION['errores']) ? mostrar_error($_SESSION['errores'], 'nombre') : '' ?>
            <label for="apellidos">Apellidos</label>
            <input type="text" name="apellidos" value="<?=$_SESSION['usuario']['Apellidos']?>"/>
            <?php echo isset($_SESSION['errores']) ? mostrar_error($_SESSION['errores'], 'apellidos') : '' ?>
            <label for="email">Email</label>
            <input type="email" name="email" value="<?=$_SESSION['usuario']['Email']?>"/>
            <?php echo isset($_SESSION['errores']) ? mostrar_error($_SESSION['errores'], 'email') : '' ?>
            
            <input type="submit" value="Actualizar" name="submit"/>
        </form>
   
    <?php borrar_errores()?>
</div> <!--Fin caja principal-->

<?php require_once 'includes/footer.php'; ?>