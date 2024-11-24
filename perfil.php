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
            echo "<h3>Información</h3>";
            while ($fila = mysqli_fetch_assoc($resultado)) {
                echo "<p>" . $fila['informacion'] . "</p>";
                echo "<h4>Número de Teléfono:</h4><p>" . $fila['telefono'] . "</p>";
                echo "<h4>Correo Electrónico:</h4><p>" . $fila['mail'] . "</p>";
                echo "<h4>Domicilio:</h4><p>" . $fila['domicilio'] . "</p>";
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
            if (isset($_GET['pagina'])){
                $pagina = $_GET['pagina'];
            } else {
                $pagina = 1;
            }
            $rango_publi = 2;
            $desde = ($pagina-1)*$rango_publi;             
            $registro_publicaciones = "SELECT * from publicaciones where id_usuario='$id'";
            $resultado = mysqli_query($conexion, $registro_publicaciones);
            $cantf = mysqli_num_rows($resultado);
            $cant_publi= ceil($cantf/$rango_publi);
            $sql = "SELECT * from publicaciones where id_usuario='$id' limit $desde, $rango_publi";
            $resultado = mysqli_query($conexion, $sql);
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
            } else {echo "no hay publicaciones";}
            

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
    <?php
        echo "<h2> Pág:</h2>";
        for ($i=1;$i<=$cant_publi;$i++){ // un for para carga los indice de paginas que se cargaran segun  la cantidad de publicaciones (cada pagina carga 6 publi)
            echo "<a href='?pagina=".$i."'class='pag'>".$i."</a> ";
        }
        ?>
    </div>
        <h3 id="derecho"></h3>
    </footer>
    <script src="./script.js"></script> 
</body>
</html>