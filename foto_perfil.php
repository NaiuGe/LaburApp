<?php
        session_name("LOGIN");
        session_start();
        
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="estilo.css">
    <title>Laburapp</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Trabajos y emprendimientos">
    <meta name="keywords" content="Trabajo, empleo, rubro, emprendimiento, laburo">
</head>

<body>
    <div class="pagina-centrar">
    <h1 id="bloque-texto">Modificar foto de perfil</h1>
        <div class="foto-de-perfil-pagina-centrar">
            <?php
            include ("conexion.php");
            if (!empty($_SESSION['contador-fotoperfil'] && $_SESSION['info-foto-perfil']!='')){
                echo "<img src='" . $_SESSION['info-foto-perfil']  . "' width='200px'>";
                echo '<form method="post" action="foto_perfil.php" enctype="multipart/form-data">
                <input type="file" class="boton-fotoperfil" name="imagen"> 
                <input type="submit" class="boton-fotoperfil" name="btnregistrar">
            </form>';
            header('Cache-Control: no-store, no-cache, must-revalidate');}
            else {
                echo "<img src='imagenes/icono_usuario.png' width='200px'>";
                echo '<form method="post" action="foto_perfil.php" enctype="multipart/form-data">
                <input type="file" class="boton-fotoperfil" name="imagen"> 
                <input type="submit" class="boton-fotoperfil"name="btnregistrar">
            </form>';
            header('Cache-Control: no-store, no-cache, must-revalidate');
            }
            if(!empty($_POST['btnregistrar'])){
                $imagen=$_FILES['imagen']['tmp_name'];
                $nombreImg=$_FILES['imagen']['name'];
                $extImg=strtolower(pathinfo($nombreImg, PATHINFO_EXTENSION));
                $sizeImg=$_FILES['imagen']['size'];
                $dir="imagenes/fotos_perfiles/";
                $id=$_SESSION['id_usuario'];
                if($extImg=='jpg' or $extImg=='jpeg'){
                    
                    $registro=$conexion->query("SELECT * from usuarios where id_usuario='$id' ");
                    $fila= mysqli_fetch_assoc($registro);
                    $id2=$fila['id_usuario'];
                    $ruta=$dir.$_SESSION['nombre'].$id2.".".$extImg;
                    $actualizarImg=$conexion->query("UPDATE usuarios set foto_perfil= '$ruta' where id_usuario='$id2'");
        
                    if (move_uploaded_file($imagen,$ruta)){
                        
                    }
                    $_SESSION['info-foto-perfil']=$ruta;
                    header('Cache-Control: no-store, no-cache, must-revalidate');
                } else { 
                    echo"No se admite ese tipo de archivos, solo jpg o jpeg";}
                    
                }
                header('Cache-Control: no-store, no-cache, must-revalidate');

                
                //barra lateral
                //checkbox para controlar a la barra lateral
                echo "<input type='checkbox' id='activar-barra' class='activar-checkbox'>";
                //etiqueta de botón para abrir y cerrar la barra
                echo "<label for='activar-barra' class='boton-activar'>☰ Menú</label>";

                //barra lateral
                echo"<div class='barra-lateral'>
                <a href='index.php'>Inicio</a>
                <a href='perfil.php'>Ver Perfil</a>
                <a href='publicaciones.php'>Mis Publicaciones</a>
                <a href='foto_perfil.php'>Foto de Perfil</a>
                <a href='cerrarlogin.php'>CERRAR SESIÓN</a>
                </div>";
            ?>
        </div>
        <input type="button" class="boton" value="volver" onclick="location='index.php'">
</body>
</html>