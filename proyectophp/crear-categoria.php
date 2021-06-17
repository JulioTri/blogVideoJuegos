<?php require_once 'includes/redireccion.php';?><!--Para saber si el usuario esta logueado o a creado sesion-->
<?php require_once 'includes/cabecera.php'; ?><!--Aca esta la parte de arriba de la pagina e incluye conexion y helpers-->
<?php require_once 'includes/lateral.php'; ?><!--Mantiene la barra de la derecha 
<!--Caja principal-->
<div id="principal">
    <h1>Crear categorias</h1>
    <p>
        Añade nuevas categorias al blog para que los usuarios puedan usarlas
        al crear sus entradas
    </p>
    <br/>
    <form action="guardar-categoria.php" method="POST">
        <label for="nombre">Nombre de la categoria:</label>
        <input type="text" name="nombre"/>
        
        <input type="submit" value="Guardar"/>
    </form>
</div> <!--Fin caja principal-->

<?php require_once 'includes/footer.php'; ?>