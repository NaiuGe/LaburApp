<?php
include("conexion.php");
session_name("LOGIN");
session_start();

if(!empty($_GET['id_publicacion'])){
    $id_p = $_GET['id_publicacion'];
    $id_u = $_SESSION['id_usuario'];
  
    $consulta = "SELECT * from solicitudes WHERE id_publicaciones='$id_p' and id_usuario='$id_u'";
    $resultado = mysqli_query($conexion, $consulta);
    $cantfilas = mysqli_num_rows($resultado);
    if($cantfilas==0){
        $sql = "INSERT INTO solicitudes (id_publicaciones, id_usuario) VALUES ('$id_p', '$id_u')";
        mysqli_query($conexion, $sql);
        header("location:index.php");
    }
    else{header("location:index.php");}
    mysqli_close($conexion);
}
else{ header("location:index.php");}
?>