<?php

if (isset($_POST)) {
    //conexion a la base de datos 
    require_once 'includes/conexion.php';

    //Iniciar sesion
    if(!isset($_SESSION)){
        session_start();
    }

    //utilizando el operador ternario se validan condiciones y se recogen
    //los valores del formulario
    /*cuando se agrega mysqli_escape_string() es para que no vaya a tomar caracteres 
    especiales ('',"") como partes de una consulta sql si no que todo lo que entre en
    este campo sea iterpetrado como string       */
    $nombre = isset($_POST['nombre']) ? mysqli_escape_string($db,$_POST['nombre']) : false;
    $apellidos = isset($_POST['apellidos']) ? mysqli_escape_string($db,$_POST['apellidos']) : false;
    $email = isset($_POST['email']) ? mysqli_escape_string($db,trim($_POST['email'])) : false;
    $contraseña = isset($_POST['pass']) ? mysqli_escape_string($db,$_POST['pass']) : false;

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
    //validar contraseña
    if (!empty($contraseña)) {
        $contraseña_validate = true;
    } else {
        $contraseña_validate = false;
        $errores['contraseña'] = 'La contraseña es invalida';
    }

    $guardar_usuario = false;
    //Validacion de errores para saber si se pueden ingrsar los datos a la base de datos
    if (count($errores) == 0) {
        $guardar_usuario = true;
        //Cifrar la contraseña 4 veces 
        $contraseña_segura = password_hash($contraseña, PASSWORD_BCRYPT, ['cost' => 4]);
        /* de esta forma se puede verificar la contraseña sin tener que verla solo utilizando el hash
          var_dump(password_verify($contraseña, $contraseña_segura));
         */

        //Insertar usuarios en la tabla de usuarios de la base de datos
        $sql = "INSERT INTO usuarios VALUES(null,'$nombre','$apellidos','$email','$contraseña_segura',CURDATE())";
        $guardar = mysqli_query($db, $sql);

        if ($guardar) {
            $_SESSION['completado'] = 'El registro se ha completado con exito';
        } else {
            $_SESSION['errores']['general'] = "Fallo al guardar el usuario!!";
        }
    } else {
        $_SESSION['errores'] = $errores;
    }
}
header('location: index.php');
?>

