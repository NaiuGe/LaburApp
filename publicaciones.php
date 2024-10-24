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
    <meta name="description" content="Trabajos y emprendimientos">
    <meta name="keywords" content="Trabajo, empleo, rubro, emprendimiento, laburo">
</head>
<body>
    <div class="grupo">
        <aside class="perfil" href=""> 
            <?php
            if(isset($_SESSION['contador'])){
                header('Cache-Control: no-store, no-cache, must-revalidate');
                if (!empty($_SESSION['contador-fotoperfil']  && $_SESSION['info-foto-perfil']!='')){
                    echo "<img src='" . $_SESSION['info-foto-perfil'] . "' class='fotoperfil'>";
                    header('Cache-Control: no-store, no-cache, must-revalidate');
                } else {echo '<img src="imagenes/icono_usuario.png" class="fotoperfil">';}
                echo "<div class='nombre-botones-perfil'>";
                echo '<b>Bienvenido '. $_SESSION['nombre'] .' ' .$_SESSION['apellido'].'</b>';
                echo "<br></br>";
                echo "<input type='button' class='boton' value='Ver Perfil' onclick='location=\"perfil.php\"'>";
                echo "<input type='button' class='boton' value='mis publicaciones' onclick='location=\"publicaciones.php\"'>";
                echo "<input type='submit' class='boton' value='ingresar/cambiar foto de perfil' onclick=location=\"foto_perfil.php\">";
                echo "<input type='button' class='boton' value='cerrar sesion' onclick='location=\"cerrarlogin.php\"'>";
                echo "</div>";
            }
            ?>      
        </aside>
    <header class="cabeceraindex">
        <h1>mis publicaciones</h1>
        <form>
            <input type="search" name="busq" class="caja" placeholder="Buscar publicacion">
            <input type="submit" value="Enviar" class="boton">
        </form>
    </header>
    
    <div class="seccion">
        <div class="publicaciones"> 
            <a href="crear_publicacion.php" class="link">
                <img src="imagenes/icono_trabajo.png" id="fotopubli">
                <b>crear publicación</b>
            </a>
            <?php
            include("conexion.php");
            $id=$_SESSION['id_usuario'];
            $consulta = "SELECT * FROM publicaciones WHERE id_usuario='$id' ";
            $resultado = mysqli_query($conexion, $consulta);
            $cantfilas= mysqli_num_rows($resultado);
            if($cantfilas>=1){
                $fila = mysqli_fetch_assoc($resultado);
                echo "<a href='' class='link'>
                    <img src='". $fila['foto_portada'] ."' id='fotopubli' c>
                    <b> ". $fila['nombre_publicacion'] ." </b>
                </a>";
               while($fila = mysqli_fetch_assoc($resultado)){
                    echo "<a href='' class='link'>
                    <img src='".$fila['foto_portada']."' id='fotopubli' >
                    <b> ". $fila['nombre_publicacion'] ." </b>
                    </a>";
               }
            } else {echo "no hay publicaciones";}
            
            ?>

        </div>
        
    </div>
    <input type="button" value="volver" onclick="location='index.php'">
    <footer> 
        <h3> sajhdjsahd@</h3>
    </footer>
</body>
    
</html> 