<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="estilo.css">
    <title>Perfil de usuario</title>
</head>
<body>
<header>
    <input type="checkbox" id="btn_menu">
    <label for="btn_menu">
        <img src="./imagenes/fotoMenu.png" alt="Menu">
    </label>
    <nav class="nav-bar">
        <ul>
            <div>
                <img class="logo-hidden" src="./imagenes/logo.png" alt="logo-Laburapp">
            </div>
            <li><a href="index.php" alt="indice">Principal</a></li>
            <li><a href="#" alt="Ver Perfil">Ver Perfil</a></li>
            <li><a href="cerrarlogin.php" alt="CERRAR SESIÓN">CERRAR SESIÓN</a></li>            
        </ul>
    </nav>
</header>
<main>
<div class="centrar">
<div class="seccion-solicitudes">
<?php
include("conexion.php");
session_name("LOGIN");
session_start();
    $id_u = $_SESSION['id_usuario'];

    $consulta = "SELECT * from publicaciones WHERE id_usuario='$id_u'";
    $resultado = mysqli_query($conexion, $consulta);
    if (mysqli_num_rows($resultado)>=1){
       while( $fila_p = mysqli_fetch_assoc($resultado)){
        $id_p = $fila_p['id_publicaciones'];
        $sql = "SELECT * from solicitudes WHERE id_publicaciones = '$id_p'";
        $resultado_solicitudes = mysqli_query($conexion, $sql);
        if (mysqli_num_rows($resultado_solicitudes)>=1){
            while ($solicitudes = mysqli_fetch_assoc($resultado_solicitudes)){
                $id_solicitud = $solicitudes['id_solicitudes'];
                $id_cliente = $solicitudes ['id_usuario'];
                $sql2 ="SELECT * from usuarios WHERE id_usuario='$id_cliente'";
                $resultado = mysqli_query($conexion, $sql2);
                $fila_user= mysqli_fetch_assoc($resultado);
                echo "<div class='bloque-solicitud'>
                <h3>Tienes una solicitud de ".$fila_user['nombre']." ".$fila_user['apellido']. " para ''".$fila_p['nombre_publicacion']."''</h3>
                <a href='publicacion.php?id_publicacion=".$id_p."&value=6'>
                <img src='".$fila_p['foto_portada']."' class='foto-publicacion-solicitudes'>
                </a>
            </div>";
        }}
           
            
    }


        
    }        
            
        
       
    

?>
</div>
</div>
</main>
<footer> 
    <div class="paginacion">
    </div>
        <h3 id="derecho"></h3>
    </footer>
    <script src="./script.js"></script> 
</body>