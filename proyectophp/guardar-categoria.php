<?php
if(isset($_POST)){
    require_once 'includes/conexion.php';
    $nombre= isset($_POST['nombre'])? mysqli_real_escape_string($db,$_POST['nombre']): false;
    
    $errores = array();

    //validar los datos antes de guardarlos en la base de datos
    //validar campo nombre
    if (!empty($nombre) && !is_numeric($nombre) && !preg_match("/[0-9]/", $nombre)) {
        $nombre_validate = true;
    } else {
        $nombre_validate = false;
        $errores['nombre'] = 'El nombre es invalido';
    }
    
    //Validacion de errores para saber si se pueden ingrsar los datos a la base de datos
    if (count($errores) == 0) {
        $sql = "INSERT INTO categorias VALUES(null,'$nombre')";
        $guardar = mysqli_query($db, $sql);
    }
}
header('Location: index.php');

