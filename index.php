<?php
    session_name("LOGIN");
    session_start();
    include ("conexion.php");


?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <link rel="icon" href="./imagenes/logo.png" type="image/png">
    <link rel="stylesheet" type="text/css" href="estilo.css">
    <title>Laburapp</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Trabajos y emprendimientos">
    <meta name="keywords" content="Trabajo, empleo, rubro, emprendimiento, laburo">
</head>
<body>
<header>
    <img id="abrir" class="abrir-menu" src="./imagenes/fotoMenu.png" alt="Menú hamburguesa">
        <img class="logo" src="./imagenes/logo.png" alt="Logo de Laburapp">
        <nav class="nav-bar" id="nav">
            <button id="cerrar" class="cerrar-menu">X</button>
                    <ul class="nav-list"> 
                    <li><a href="#" alt="indice">Principal</a></li>
                    <li><a href='perfil.php' alt="Ver Perfil">Ver Perfil</a></li>
                    <li><a href="grafico.php">Ver gráfico</a></li>
                    <li><a href='cerrarlogin.php' alt="CERRAR SESIÓN">Cerrar sesión</a></li>            
                </ul>
            </nav>
            <div class="perfil"> 
            <?php
            if(isset($_SESSION['contador'])){
                header('Cache-Control: no-store, no-cache, must-revalidate');
                if (!empty($_SESSION['contador-fotoperfil']  && $_SESSION['info-foto-perfil']!='')){
                    echo "<a href='perfil.php'><img src='" . $_SESSION['info-foto-perfil'] . "' id='logeado' class='fotoperfil'>";
                    header('Cache-Control: no-store, no-cache, must-revalidate');
                } else {echo '<img src="imagenes/icono_usuario.png" class="fotoperfil">';}
                echo "<div class='nombre-botones-perfil'>";
                echo '<b>Bienvenido <br>'. $_SESSION['nombre'] .' ' .$_SESSION['apellido'].'</b></a>';
                echo "<br></br>";
                echo "</div>";

            } else {
                echo '<img src="imagenes/icono_usuario.png" class="fotoperfil">';
                echo '<input type="button" class="btn-busqueda" value="Iniciar sesion" onclick="location=\'login.html\'">';}
            header('Cache-Control: no-store, no-cache, must-revalidate');
            ?>
            <br></br>
        </div>
    </header>

    <div class="grupo">
    <main class="cabeceraindex">
        <h1 class="titulo">Ponete a laburar</h1>
        <form class="busqueda" action="barra-buscador.php">
            <input class="cajaDeBusqueda" type="search" name="busq" class="caja" placeholder="Busqueda por palabra">
            <input class="btn-busqueda" type="submit" value="Enviar" class="boton" name="Enviar">
        </form>
    
    <div class="seccion">
        <div class="publicaciones"> 
            <?php
                include ('conexion.php');
                //Paginacion, parte logica
                if (isset($_GET['pagina'])){
                    $pagina = $_GET['pagina'];
                } else {
                    $pagina = 1;
                }
                $rango_publi = 6;
                $desde = ($pagina-1)*$rango_publi;             
                $registro_publicaciones = "SELECT * from publicaciones";
                $resultado1 = mysqli_query($conexion, $registro_publicaciones);
                $cantf = mysqli_num_rows($resultado1);
                $cant_publi= ceil($cantf/$rango_publi);
                $sql = "SELECT * from publicaciones limit $desde, $rango_publi";
                $resultado1 = mysqli_query($conexion, $sql);
                $cantfilas = mysqli_num_rows($resultado1);
                if ($cantfilas>=1){ //carga la primera publicacion, fila_p es publicaciones, fila_u es de usuarios
                    $fila_p = mysqli_fetch_assoc($resultado1);
                    $id = $fila_p['id_usuario'];
                    $idp = $fila_p['id_publicaciones'];
                    $registro_usuarios = "SELECT * from usuarios where id_usuario = '$id'";
                    $resultado2 = mysqli_query($conexion, $registro_usuarios);
                    $fila_u = mysqli_fetch_assoc($resultado2);  
                    echo "<a href='publicacion.php?id_publicacion=".$idp."&value=3' class='link'>
                    <img src='". $fila_p['foto_portada'] ."' id='fotopubli' >
                    <b> ". $fila_p['nombre_publicacion'] ." </b> 
                    <p> ". $fila_u['nombre']. " " .$fila_u['apellido']. "</p>
                    </a>";
                    while ($fila_p = mysqli_fetch_assoc($resultado1) ){ //itera para q cargue las demas publicaciones
                        $id = $fila_p['id_usuario'];
                        $idp = $fila_p['id_publicaciones'];
                        $registro_usuarios = "SELECT * from usuarios where id_usuario = '$id'";
                        $resultado2 = mysqli_query($conexion, $registro_usuarios);
                        $fila_u = mysqli_fetch_assoc($resultado2);  
                        echo "<a href='publicacion.php?id_publicacion=".$idp."&value=3' class='link'>
                        <img src='". $fila_p['foto_portada'] ."' id='fotopubli' >
                        <b> ". $fila_p['nombre_publicacion'] ." </b>
                        <p> ". $fila_u['nombre']. " " .$fila_u['apellido']. "</p>
                        </a>";
                        
                    }

                } else {//Se carga una imagen default si no hay registro de publicaciones
                    echo '<a href="" class="link">
                            <img src="imagenes/icono_trabajo.png" id="fotopubli">
                        </a>';
                }
            ?>
        </div>
        <div class="paginacion">
            <?php
                echo "<h2> Pág:</h2>";
                for ($i=1;$i<=$cant_publi;$i++){ // un for para carga los indice de paginas que se cargaran segun  la cantidad de publicaciones (cada pagina carga 6 publi)
                    echo "<a href='?pagina=".$i."'class='pag'>".$i.","."</a> ";
                }
            ?>
        </div>
    </div>
    </main>   
    <footer> 
        
    
        <h3 id="derecho"></h3>
        <a target="_blank" href="https://www.whatsapp.com/?lang=es_LA"><img class="btn-wsp" src="./imagenes/wsp.png" alt="Logo de wsp"> </a>
    </footer>
    <script src="script.js"></script>
    
    <script>
        
    </script>
</body>
</html>