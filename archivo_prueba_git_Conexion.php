<?php
include('parametros.php');

$conexion=mysqli_connect($db_host, $db_user, $db_pass);
if(mysqli_connect_errno()){
    echo 'No se pudo conectar a la base de datos';
    exit();
}
mysqli_select_db($conexion, $db_name) or die;
mysqli_set_charset($conexion, 'utf8');
?>