<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="./imagenes/logo.png" type="image/png">
    <link rel="stylesheet" type="text/css" href="estilo.css">
    <title>Perfil de usuario</title>
</head>
<body>
<header>
<img id="abrir" class="abrir-menu" src="./imagenes/fotoMenu.png" alt="Menú hamburguesa">
        <img class="logo" src="./imagenes/logo.png" alt="Logo de Laburapp">
        <nav class="nav-bar" id="nav">
        <img id="cerrar" class="cerrar-menu" src="./imagenes/cerrar.png" alt="Cruz para cerrar el menú">
                    <ul class="nav-list"> 
                    <li><a href="index.php" alt="indice">Principal</a></li>
                    <li><a href='#' alt="Ver Perfil">Ver Perfil</a></li>
                    <li><a href="grafico.php">Ver gráfico</a></li>
                    <li><a href='cerrarlogin.php' alt="CERRAR SESIÓN">Cerrar sesión</a></li>            
                </ul>
            </nav>
</header>
<main>
    <?php
        session_name("LOGIN");
        session_start();
        include ("conexion.php");

        if (isset($_SESSION['contador'])) {
            $id_usuario = $_SESSION['id_usuario'];
            $consulta = "SELECT usuarios.* FROM usuarios WHERE usuarios.id_usuario = '$id_usuario';"; 
            $resultado = mysqli_query($conexion, $consulta);
            
            echo "<div class='barra-arriba'>";
            echo "<div class='bloque-perfil'>
                    <form id='contenedor-foto-perfil' action='info_perfil.php' method='POST'>";
            if (!empty($_SESSION['contador-fotoperfil']) && $_SESSION['info-foto-perfil'] != '') {
                echo "<img src='" . $_SESSION['info-foto-perfil'] . "' class='fotoperfil'>";
                header('Cache-Control: no-store, no-cache, must-revalidate');
            } else {
                echo '<img src="imagenes/icono_usuario.png">';
            }
            echo "<input class='boton' type='button' value='Modificar perfil' onClick='location=\"info_perfil.php\"'>";
            echo "<input class='boton' type='button' value='Ver solicitudes' onClick='location=\"solicitudes.php\"'>";
            echo '</div>';

            echo "<div class='info'><h1>" . $_SESSION['nombre'] . ' ' . $_SESSION['apellido'] . "</h1>";
            echo "<div class='contenedor-datos'><h3>Información</h3>";
            while ($fila = mysqli_fetch_assoc($resultado)) {
                echo "<p>" . $fila['informacion'] . "</p> </div>";
                echo "<div class='contenedor-datos'> <h4>Número de Teléfono:</h4><p>" . $fila['telefono'] . "</p> </div>";
                echo "<div class='contenedor-datos'> <h4>Correo Electrónico:</h4><p>" . $fila['mail'] . "</p> </div>";
                echo "<div class='contenedor-datos'> <h4>Domicilio:</h4><p>" . $fila['domicilio'] . "</p> </div>";
                $id_localidad = $fila['id_localidad'];
                $consulta2 = "SELECT * FROM `localidades` WHERE id_localidad = '$id_localidad';";
                $resultado2 = mysqli_query($conexion, $consulta2);
                $localidad1 = mysqli_fetch_assoc($resultado2);
                echo "<div class='contenedor-datos'> <h4>Localidad:</h4><p>" . $localidad1['nombre_localidad'] . "</p> </div>";
            }
            echo "</div></div>";
            echo '<div class="seccion">';
            echo '<h2>Mis publicaciones</h2>';
            echo '<div class="publicaciones"> ' ;
            echo '<a href="crear_publicacion.php" class="link"> ' ;
            echo '<img src="imagenes/icono_trabajo.png" id="fotopubli"> ';
            echo '<b>Crear una publicación</b> ';
            echo '</a> ';
            include("conexion.php");
            $id=$_SESSION['id_usuario'];
            $consulta = "SELECT * FROM publicaciones WHERE id_usuario='$id' ";
            $resultado = mysqli_query($conexion, $consulta);
            $cantfilas= mysqli_num_rows($resultado);
            if($cantfilas>=1){
                $fila = mysqli_fetch_assoc($resultado);
                echo "<a href='publicacion.php?id_publicacion=".$fila['id_publicaciones']."&value=5' class='link'>
                    <img src='". $fila['foto_portada'] ."' id='fotopubli' c>
                    <b> ". $fila['nombre_publicacion'] ." </b>
                </a>";
            while($fila = mysqli_fetch_assoc($resultado)){
                    echo "<a href='publicacion.php?id_publicacion=".$fila['id_publicaciones']."&value=5' class='link'>
                    <img src='".$fila['foto_portada']."' id='fotopubli' >
                    <b> ". $fila['nombre_publicacion'] ." </b>
                    </a>";
            }
            }
            

        echo '  </div> ';
    echo '  </div> ';
        } else {
            echo "<div class='contenedor-no-sesion'>";
            echo "No tienes una cuenta ingresada. Inicia sesión e inténtalo de nuevo.";
            echo '<br><input  class="btn-busqueda" type="button" value="Iniciar sesión" onclick="location=\'login.html\'">';
            echo "</div>";
            }

    
    ?>
</main>
<footer> 
    <div class="paginacion">
    </div>
        <h3 id="derecho"></h3>
    </footer>
    <script src="./script.js"></script> 
</body>
</html>