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
                $registro_publicaciones = "SELECT * from publicaciones";
                $resultado1 = mysqli_query($conexion, $registro_publicaciones);
                $cantfilas = mysqli_num_rows($resultado1);
                if ($cantfilas>=1){
                    $fila_p = mysqli_fetch_assoc($resultado1);
                    $id = $fila_p['id_usuario'];
                    $registro_usuarios = "SELECT * from usuarios where id_usuario = '$id'";
                    $resultado2 = mysqli_query($conexion, $registro_usuarios);
                    $fila_u = mysqli_fetch_assoc($resultado2);  
                    echo "<a href='' class='link'>
                    <img src='". $fila_p['foto_portada'] ."' id='fotopubli' c>
                    <b> ". $fila_p['nombre_publicacion'] ." </b> 
                     <b> ". $fila_u['nombre']. " " .$fila_u['apellido']. "</b>
                    </a>";
                    while ($fila_p = mysqli_fetch_assoc($resultado1) ){
                        $id = $fila_p['id_usuario'];
                        $registro_usuarios = "SELECT * from usuarios where id_usuario = '$id'";
                        $resultado2 = mysqli_query($conexion, $registro_usuarios);
                        $fila_u = mysqli_fetch_assoc($resultado2);  
                        echo "<a href='' class='link'>
                        <img src='". $fila_p['foto_portada'] ."' id='fotopubli' c>
                        <b> ". $fila_p['nombre_publicacion'] ." </b>
                        <b> ". $fila_u['nombre']. " " .$fila_u['apellido']. "</b>
                        </a>";
                    
                }
                } else {
                    echo '<a href="" class="link">
                            <img src="imagenes/icono_trabajo.png" id="fotopubli">
                        </a>';
                }
            ?>
        </div>
    </div>
    <footer> 
        <h3> sajhdjsahd@</h3>
    </footer>
</body>
    
</html>