
<!--Barra lateral-->
<aside id="sidebar">
    <!--BUSCADOR-->
    <div id="buscador" class="bloque">
        <h3>Buscar</h3>
      
        <form action="buscar.php" method="POST">
            <input type="text" name="busqueda"/>
            <input type="submit" value="Buscar"/>
        </form>
    </div>
    <?php if (isset($_SESSION['usuario'])): ?><!--cuando se loguea el usuario se crea la session usuario y aparece este bloque-->
        <!--BLOQUE DE USUARIO LOGUEADO-->
        <div id="usuario-logueado" class="bloque">
            <h3>Bienvenido, <?= $_SESSION['usuario']['Nombre'] . ' ' . $_SESSION['usuario']['Apellidos']; ?></h3>
            <!--Botones-->
            <a href="crear-entradas.php" class="boton boton-verde">Crear entradas</a>
            <a href="crear-categoria.php" class="boton">Crear categoria</a>
            <a href="mis-datos.php" class="boton boton-naranja">Mis datos</a>
            <a href="cerrar.php" class="boton boton-rojo">Cerrar cesion</a>
        </div>
    <?php endif; ?><!--Fin del bloque de session de usuario-->
    
    <?php if (!isset($_SESSION['usuario'])): ?><!--Si se crea una session de usuario es decir hay login se esconden los bloques-->
    
    <!--BLOQUE LOGIN DE USUARIO-->
    <div id="login" class="bloque">
        <h3>Identificate</h3>
        <?php if (isset($_SESSION['error_login'])): ?><!--Si se crea una cesion de error de logueo 
                                                      se muestra en pantalla-->
            <div class="alerta alerta-error">
                <?=$_SESSION['error_login'];?>
            </div>
        <?php endif; ?>

        <form action="login.php" method="POST">
            <label for="email">Email</label>
            <input type="email" name="email"/>

            <label for="pass">Password</label>
            <input type="password" name="pass"/>
            <input type="submit" value="Entrar"/>
        </form>
    </div>
    <!--BLOQUE REGISTRO DE USUARIO-->
    <div id="register" class="bloque">
        <h3>Registrate</h3>
        <!--Mostrar errores-->

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

        <form action="registro.php" method="POST"><!--Se envian los datos del formulario-->
            <label for="nombre">Nombre</label>
            <input type="text" name="nombre"/>
            <?php echo isset($_SESSION['errores']) ? mostrar_error($_SESSION['errores'], 'nombre') : '' ?>
            <label for="apellidos">Apellidos</label>
            <input type="text" name="apellidos"/>
            <?php echo isset($_SESSION['errores']) ? mostrar_error($_SESSION['errores'], 'apellidos') : '' ?>
            <label for="email">Email</label>
            <input type="email" name="email"/>
            <?php echo isset($_SESSION['errores']) ? mostrar_error($_SESSION['errores'], 'email') : '' ?>
            <label for="pass">Password</label>
            <input type="password" name="pass"/>
            <?php echo isset($_SESSION['errores']) ? mostrar_error($_SESSION['errores'], 'contraseña') : '' ?>
            <input type="submit" value="Registrar" name="submit"/>
        </form>
        <?php isset($_SESSION['errores']) ? borrar_errores() : ''; ?><!--Se borran los errores de la sesion de errores-->
    </div>
    <?php endif;?>
</aside>