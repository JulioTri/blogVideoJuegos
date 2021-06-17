<?php

if (isset($_POST)) {
    //conexion a la base de datos 
    require_once 'includes/conexion.php';

    //utilizando el operador ternario se validan condiciones y se recogen
    //los valores del formulario
    /* cuando se agrega mysqli_escape_string() es para que no vaya a tomar caracteres 
      especiales ('',"") como partes de una consulta sql si no que todo lo que entre en
      este campo sea iterpetrado como string */
    $nombre = isset($_POST['nombre']) ? mysqli_escape_string($db, $_POST['nombre']) : false;
    $apellidos = isset($_POST['apellidos']) ? mysqli_escape_string($db, $_POST['apellidos']) : false;
    $email = isset($_POST['email']) ? mysqli_escape_string($db, trim($_POST['email'])) : false;

    //arreglo de errores
    $errores = array();

    //validar los datos antes de guardarlos en la base de datos
    //validar campo nombre
    if (!empty($nombre) && !is_numeric($nombre) && !preg_match("/[0-9]/", $nombre)) {
        $nombre_validate = true;
    } else {
        $nombre_validate = false;
        $errores['nombre'] = 'El nombre es invalido';
    }
    //validar campo apellidos
    if (!empty($apellidos) && !is_numeric($apellidos) && !preg_match("/[0-9]/", $apellidos)) {
        $apellidos_validate = true;
    } else {
        $apellidos_validate = false;
        $errores['apellidos'] = 'El apellido es invalido';
    }
    //validar campo email
    if (!empty($email) && filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $email_validate = true;
    } else {
        $email_validate = false;
        $errores['email'] = 'El email es invalido';
    }


    $guardar_usuario = false;
    //Validacion de errores para saber si se pueden ingrsar los datos a la base de datos
    if (count($errores) == 0) {
        $usuario = $_SESSION['usuario'];
        $guardar_usuario = true;

        //Comprobar si el email ya existe
        $sql = "SELECT id,email FROM usuarios WHERE email='$email'";
        $isset_email=mysqli_query($db, $sql);
        $isset_user= mysqli_fetch_assoc($isset_email);
        
        if($isset_user['id']==$usuario['Id'] ||empty($isset_user['id'])){
            //Actualizar usuario en la tabla de usuarios de la base de datos

            $sql = "UPDATE usuarios SET "
                    . "nombre='$nombre',"
                    . "apellidos='$apellidos',"
                    . "email='$email' "
                    . "WHERE id =" . $usuario['Id'];
            $guardar = mysqli_query($db, $sql);

            if ($guardar) {
                $_SESSION['usuario']['Nombre'] = $nombre;
                $_SESSION['usuario']['Apellidos'] = $apellidos;
                $_SESSION['usuario']['Email'] = $email;
                $_SESSION['completado'] = 'Los datos han sido actualizados con exito';
            } else {
                $_SESSION['errores']['general'] = "Fallo al actulizar tus datos";
            }
        } else {
             $_SESSION['errores']['general'] = "EL usuario ya existe";
             
        }
    } else {
        $_SESSION['errores'] = $errores;
    }
}
header('location: mis-datos.php');
?>

