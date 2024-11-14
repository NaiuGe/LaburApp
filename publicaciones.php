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
    
    <!-- barra lateral -->
    <header> 
        <nav class="nav-bar">
        <ul>
            <div>
                <img class="logo-hidden"  src="./imagenes/logo.png" alt="logo-Laburapp">
            </div>
            <li><a href="index.php" alt="indice">Principal</a></li>
            <li><a href="publicaciones.php" alt="Mis publicaciones">Mis publicaciones</a></li>
            <li><a href="perfil.php" alt="Ver Perfil">Ver Perfil</a></li>
            <li><a href="cerrarlogin.php" alt="CERRAR SESIÓN">CERRAR SESIÓN</a></li>            
            </ul>
        </nav> 
        <aside class="perfil" href=""> 
            <?php
            if(isset($_SESSION['contador'])){
                header('Cache-Control: no-store, no-cache, must-revalidate');
                if (!empty($_SESSION['contador-fotoperfil']  && $_SESSION['info-foto-perfil']!='')){
                    echo "<img src='" . $_SESSION['info-foto-perfil'] . "' class='fotoperfil'>";
                    header('Cache-Control: no-store, no-cache, must-revalidate');
                } else {echo '<img src="imagenes/icono_usuario.png" class="fotoperfil">';}
                echo "<div class='nombre-botones-perfil'>";
                echo ' <b>'. $_SESSION['nombre'] .' ' .$_SESSION['apellido'].'</b>';
                echo "<br></br>";
                
            }
            ?>      
        </aside>
    </header>

    <div class="grupo">
    <div class="cabeceraindex">
        <h1 class="titulo">Mis Publicaciones</h1>
        <form class="busqueda">
            <input class="cajaDeBusqueda" type="search" name="busq" class="caja" placeholder="Búsqueda por palabra">
            <input class="btn-busqueda" type="submit" value="Buscar" class="boton">
        </form>
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
    </div>
    
    <input type="button" value="volver" onclick="location='index.php'">
    <footer> 
        <h3> sajhdjsahd@</h3>
    </footer>
</body>
    
</html> 