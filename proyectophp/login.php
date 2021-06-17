<?php

//iniciar la sesion  y la conexion a bd 
require_once 'includes/conexion.php';
//recoger los datos del formulario
if (isset($_POST)) {

    //Borrar error antigua
    if (isset($_SESSION['error_login'])) {
        session_unset($_SESSION['error_login']);
    }
    
    //Recojo datos del formulario
    $email = trim($_POST['email']);
    $contraseña = $_POST['pass'];

    //consulta para comprobar las credenciales del usuario
    $sql = "SELECT * FROM usuarios WHERE Email='$email'";
    $login = mysqli_query($db, $sql);

    if ($login && mysqli_num_rows($login) == 1) {
        //conversion a un arreglo asociativo
        $usuario = mysqli_fetch_assoc($login);

        //comprobar la contraseña/cifrar
        $verify = password_verify($contraseña, $usuario['Password']);

        if ($verify) {
            //Utilizar una sesion para guardar los datos de un usuario logueado
            $_SESSION['usuario'] = $usuario;
        } else {
            //Si algo falla enviar una sesion con el fallo
            $_SESSION['error_login'] = 'Login incorrecto';
        }
    } else {
        //mesaje error
        $_SESSION['error_login'] = 'Login incorrecto';
    }
}
//redirigir al index
header('Location: index.php');
?>

