<?php

if (isset($_POST)) {
    require_once 'includes/conexion.php';
    $titulo = isset($_POST['titulo']) ? mysqli_real_escape_string($db, $_POST['titulo']) : false;
    $descripcion = isset($_POST['descripcion']) ? mysqli_real_escape_string($db, $_POST['descripcion']) : false;
    $categoria = isset($_POST['categoria']) ? (int) $_POST['categoria'] : false;
    $usuario = $_SESSION['usuario']['Id'];


    $errores = array();

    //validar los datos antes de guardarlos en la base de datos
    //validar campo titulo
    if (empty($titulo)) {
        $errores['titulo'] = 'El titulo es invalido';
    }
    //validar campo descripcion
    if (empty($descripcion)) {
        $errores['descripcion'] = 'Agrega algo a la descripcion';
    }
    //validar categoria
    if (empty($categoria) && !is_numeric($categoria)) {
        $errores['categoria'] = 'Categoria invalida';
    }

    //Validacion de errores para saber si se pueden ingrsar los datos a la base de datos
    if (count($errores) == 0) {
        //cuando se detecta un 1 en el id obtenido por el get actualiza los datos de la entrada 
        //de esta forma se reutiliza algo de codigo
        if (isset($_GET['editar'])) {
            $entrada_id = $_GET['editar'];
            $sql = "UPDATE entradas SET titulo='$titulo', descripcion='$descripcion',categoria_id=$categoria "
                    . "WHERE id=$entrada_id AND usuario_id=$usuario";
        } else {
            $sql = "INSERT INTO entradas VALUES(null,$usuario,$categoria,'$titulo','$descripcion',CURDATE())";
        }
        $guardar = mysqli_query($db, $sql);
        header('Location: index.php');
    } else {
        $_SESSION['errores_entrada'] = $errores;
        if (isset($_GET['editar'])) {
            header('Location: editar-entrada.php?id='.$_GET['editar']);
        } else {
            header('Location: crear-entradas.php');
        }
    }
}
?>

