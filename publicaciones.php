<?php
        session_name("LOGIN");
        session_start();

        
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="estilo.css">
    <link rel="icon" href="imagenes/logo.png" type="image/png">
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

                /*
                echo "<input type='button' class='boton' value='Ver Perfil' onclick='location=\"perfil.php\"'>";
                echo "<input type='button' class='boton' value='mis publicaciones' onclick='location=\"publicaciones.php\"'>";
                echo "<input type='submit' class='boton' value='ingresar/cambiar foto de perfil' onclick=location=\"foto_perfil.php\">";
                echo "<input type='button' class='boton' value='cerrar sesion' onclick='location=\"cerrarlogin.php\"'>";
                echo "</div>";
                */
            }
            ?>      
        </aside>
    <header class="cabeceraindex">
        <h1>mis publicaciones</h1>
        <form action="barra-buscador.php" method="get">
            <input type="search" name="busq" class="caja" placeholder="Buscar publicacion" required>
            <input type="submit" value="Enviar" class="boton" name="Enviar">
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
                $idp = $fila['id_publicaciones']; //se rescata la id de la publicacion, luego se envia por metodo get a publicacion.php con el href (por url)
                echo "
                
                <a href='publicacion.php?id_publicacion=".$idp."&value=1' class='link'> 
                    <img src='". $fila['foto_portada'] ."' id='fotopubli' >
                    <b> ". $fila['nombre_publicacion'] ." </b>
                    <input type='hidden' name='id_publicacion' value='".$idp."'>
                </a> ";
                
                //se itera las siguientes publicaciones con un while
               while($fila = mysqli_fetch_assoc($resultado)){
                    $idp = $fila['id_publicaciones'];
                    echo "<a href='publicacion.php?id_publicacion=".$idp."&value=1' class='link'>
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