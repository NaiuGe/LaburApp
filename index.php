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

                echo "</div>";
                    //barra lateral
                    //checkbox para controlar a la barra lateral
                    echo "<input type='checkbox' id='activar-barra' class='activar-checkbox'>";
                    //etiqueta de botón para abrir y cerrar la barra
                    echo "<label for='activar-barra' class='boton-activar'>☰ Menú</label>";

                //barra lateral
                    echo"<div class='barra-lateral'>
                    <a href='perfil.php'>Ver Perfil</a>
                    <a href='publicaciones.php'>Mis Publicaciones</a>
                    <a href='foto_perfil.php'>Foto de Perfil</a>
                    <a href='cerrarlogin.php'>CERRAR SESIÓN</a>
                    </div>";

                //echo "<input type='button' class='boton' value='Ver Perfil' onclick='location=\"perfil.php\"'>";
                //echo "<input type='button' class='boton' value='mis publicaciones' onclick='location=\"publicaciones.php\"'>";
                //echo "<input type='submit' class='boton' value='ingresar/cambiar foto de perfil' onclick=location=\"foto_perfil.php\">";
                //echo "<input type='button' class='boton' value='cerrar sesion' onclick='location=\"cerrarlogin.php\"'>";
            } else {
                echo '<img src="imagenes/icono_usuario.png" class="fotoperfil">';
                echo '<input type="button" class="boton2" value="Iniciar sesion" onclick="location=\'login.html\'">';}
            header('Cache-Control: no-store, no-cache, must-revalidate');
            ?>
            <br></br>

     
        </aside>
    <header class="cabeceraindex">
        <h1>Ponete a laburar</h1>
        <form>
            <input type="search" name="busq" class="caja" placeholder="Buscar profesión">
            <input type="submit" value="Enviar" class="boton">
        </form>
    </header>
    
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
                    $registro_usuarios = "SELECT * from usuarios where id_usuario = '$id'";
                    $resultado2 = mysqli_query($conexion, $registro_usuarios);
                    $fila_u = mysqli_fetch_assoc($resultado2);  
                    echo "<a href='' class='link'>
                    <img src='". $fila_p['foto_portada'] ."' id='fotopubli' >
                    <b> ". $fila_p['nombre_publicacion'] ." </b> 
                     <b> ". $fila_u['nombre']. " " .$fila_u['apellido']. "</b>
                    </a>";
                    while ($fila_p = mysqli_fetch_assoc($resultado1) ){ //itera para q cargue las demas publicaciones
                        $id = $fila_p['id_usuario'];
                        $registro_usuarios = "SELECT * from usuarios where id_usuario = '$id'";
                        $resultado2 = mysqli_query($conexion, $registro_usuarios);
                        $fila_u = mysqli_fetch_assoc($resultado2);  
                        echo "<a href='' class='link'>
                        <img src='". $fila_p['foto_portada'] ."' id='fotopubli' >
                        <b> ". $fila_p['nombre_publicacion'] ." </b>
                        <b> ". $fila_u['nombre']. " " .$fila_u['apellido']. "</b>
                        </a>";
                        
                    }

                } else {//Se carga una imagen default si no hay registro de publicaciones
                    echo '<a href="" class="link">
                            <img src="imagenes/icono_trabajo.png" id="fotopubli">
                        </a>';
                }
            ?>
        </div>
    </div>
    <?php
        echo "<h2> Pág.:</h2>";
        for ($i=1;$i<=$cant_publi;$i++){ // un for para carga los indice de paginas que se cargaran segun  la cantidad de publicaciones (cada pagina carga 6 publi)
            echo "<a href='?pagina=".$i."'>".$i."</a> ";
        }
    ?>
    <footer> 
        <h3> sajhdjsahd@</h3>
    </footer>
</body>
    
</html>