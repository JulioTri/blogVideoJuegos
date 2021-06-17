<?php
error_reporting(0);
$server='localhost:3309';
$username='root';
$password='';
$database='blog_master';
$db= mysqli_connect($server,$username,$password,$database);

/*if(mysqli_connect_errno()){
   echo 'Error al conectar a la base de datos '.mysqli_connect_error().'<br/>'; 
} else {
    echo 'Conexion exitosa a la base de datos <br/>';
}*/
mysqli_query($db, "SET NAMES 'utf8'");

//iniciar sesion
if(!isset($_SESSION)){
    session_start();
} 
?>
