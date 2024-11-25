<?php
    session_name("LOGIN");
    session_start();
    include ("conexion.php");
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
<header>

        <img id="abrir" class="abrir-menu" src="./imagenes/fotoMenu.png" alt="Menú hamburguesa">
        <img class="logo" src="./imagenes/logo.png" alt="Logo de Laburapp">
        <nav class="nav-bar" id="nav">
        <img id="cerrar" class="cerrar-menu" src="./imagenes/cerrar.png" alt="Cruz para cerrar el menú">
                    <ul class="nav-list"> 
                    <li><a href="index.php" alt="indice">Principal</a></li>
                    <li><a href='perfil.php' alt="Ver Perfil">Ver Perfil</a></li>
                    <li><a href='cerrarlogin.php' alt="CERRAR SESIÓN">Cerrar sesión</a></li>            
                </ul>
            </nav>
            <div class="perfil"> 
            <?php
            if(isset($_SESSION['contador'])){
                header('Cache-Control: no-store, no-cache, must-revalidate');
                if (!empty($_SESSION['contador-fotoperfil']  && $_SESSION['info-foto-perfil']!='')){
                    echo "<img src='" . $_SESSION['info-foto-perfil'] . "' class='fotoperfil'>";
                    header('Cache-Control: no-store, no-cache, must-revalidate');
                } else {echo '<img src="imagenes/icono_usuario.png" class="fotoperfil">';}
                echo "<div class='nombre-botones-perfil'>";
                echo '<b>Bienvenido <br>'. $_SESSION['nombre'] .' ' .$_SESSION['apellido'].'</b>';
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

        <?php
        include("conexion.php");

        $busqueda = $_GET['busq']; 
        if(isset($_GET['Enviar']) && !empty($_GET['busq'])){ 
            $sql_usuarios = "SELECT * from usuarios where nombre like '%$busqueda%' or apellido like '%$busqueda%' order by id_usuario asc";//Busca resultados similares en la tabla usuarios
            $resultado = mysqli_query($conexion,$sql_usuarios);
            $cantfilas_u = mysqli_num_rows($resultado);
            if(mysqli_num_rows($resultado)==0){ //si no coincide ningun resultado, no se muestra nada

            }else{
                echo "<div class='seccion-general-busq'>";
                $filas_u = mysqli_fetch_assoc($resultado);
                
                echo "<div class='seccion-usuarios-busq'><h3>Usuarios</h3>";
                if(!empty($_SESSION['id_usuario'])){
                    if ($filas_u['id_usuario']==$_SESSION['id_usuario']){
                    echo "<a class='usuarios-busq' href='perfil.php'>";}
                    else{
                        echo "<a class='usuarios-busq' href='mostrar-perfil.php?id_usuario=".$filas_u['id_usuario']."'>";
                        }}
                else{
                    echo "<a class='usuarios-busq' href='mostrar-perfil.php?id_usuario=".$filas_u['id_usuario']."'>";
                    }
                if (!empty($filas_u['foto_perfil'])){
                    echo "<img src='".$filas_u['foto_perfil']."' id='foto-usuario-busq' ><h4>".$filas_u['nombre']. " ".$filas_u['apellido']."</h4> ";}
                else{
                    echo "<img src='imagenes/icono_usuario.png' id='foto-usuario-busq' ><h4>".$filas_u['nombre']. " ".$filas_u['apellido']."</h4> ";}
                    echo"</a>";
                    while($filas_u = mysqli_fetch_assoc($resultado)) { //se itera para q muestre mas resultado si hay
                        if(!empty($_SESSION['id_usuario'])){
                            if ($filas_u['id_usuario']==$_SESSION['id_usuario']){
                            echo "<a class='usuarios-busq' href='perfil.php'>";}
                            else{
                                echo "<a class='usuarios-busq' href='mostrar-perfil.php?id_usuario=".$filas_u['id_usuario']."'>";
                                }}
                        else{
                        echo "<a class='usuarios-busq' href='mostrar-perfil.php?id_usuario=".$filas_u['id_usuario']."'>";}
                        if (!empty($filas_u['foto_perfil'])){
                            echo "<img src='".$filas_u['foto_perfil']."' id='foto-usuario-busq' ><h4>".$filas_u['nombre']. " ".$filas_u['apellido']."</h4> ";}
                        else{
                            echo "<img src='imagenes/icono_usuario.png' id='foto-usuario-busq' ><h4>".$filas_u['nombre']. " ".$filas_u['apellido']."</h4> ";}
                            echo"</a>";
                        
                }
                echo "</div>";
            }
            $sql_publicaciones = "SELECT * from publicaciones where nombre_publicacion like '%$busqueda%' order by id_usuario asc";
            $resultado2 = mysqli_query($conexion,$sql_publicaciones);
            $cantfilas_p = mysqli_num_rows($resultado2);
            if(mysqli_num_rows($resultado2)==0){ //Busca resultados similares en la tabla de publicaciones
            }
            else{echo "<div class='seccion-busq'><h3>Publicaciones</h3>";
                echo "<div class='publicaciones-busqueda'>";
                $fila_p = mysqli_fetch_assoc($resultado2);
                $idp = $fila_p['id_publicaciones'];
                
                echo "<a href='publicacion.php?id_publicacion=".$idp."&value=2&busq=".$busqueda."' class='link-busq '> 
                <img src='". $fila_p['foto_portada'] ."' id='fotopubli-busq' >
                <h4> ". $fila_p['nombre_publicacion'] ." </h4> 
                </a>";
                while ($fila_p = mysqli_fetch_assoc($resultado2)){//se itera para mostrar mas resultado
                    $idp = $fila_p['id_publicaciones'];
                    echo "<a href='publicacion.php?id_publicacion=".$idp."&value=2&busq=".$busqueda."' class='link-busq '> 
                    <img src='". $fila_p['foto_portada'] ."' id='fotopubli-busq' >
                    <h4> ". $fila_p['nombre_publicacion'] ." </h4> 
                    </a>";
                }
                echo "</div>";  
            }
            if ($cantfilas_u == 0 && $cantfilas_p == 0){ // si no llega a ver ningun resultado, se muestra en pantalla un aviso de que no hay resultados
                echo "<h1>Sin resultados</h1>";
            }
        echo "</div>";
            
        
        }
        //else {header("location:index.php");}
        ?>

</div>
<input type='button' class='btn-busqueda' value='Volver' onclick="location='index.php'">
    <footer>
<h3 id="derecho"></h3>
        <a target="_blank" href="https://www.whatsapp.com/?lang=es_LA"><img class="btn-wsp" src="./imagenes/wsp.png" alt="Logo de wsp"> </a>
    </footer>
    <script src="./script.js"></script>
</body>
</html>