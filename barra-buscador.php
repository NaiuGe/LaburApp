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
        } else {
            echo '<img src="imagenes/icono_usuario.png" class="fotoperfil">';
            echo '<input type="button" class="boton2" value="Iniciar sesion" onclick="location=\'login.html\'">';}
        header('Cache-Control: no-store, no-cache, must-revalidate');
        ?>
        <br></br>

    </aside>
    <header class="cabeceraindex">
        <h1>Ponete a laburar</h1>
        <form action="barra-buscador.php" method="get">
            <input type="search" name="busq" class="caja" placeholder="Buscar profesión" required>
            <input type="submit" value="Enviar" class="boton" name="Enviar">
        </form>
    </header>
    <div class="seccion-publicaciones">
        <?php
        include("conexion.php");

        $busqueda = $_GET['busq']; 
        if(isset($_GET['Enviar']) && !empty($_GET['busq'])){ 
            $sql_usuarios = "SELECT * from usuarios where nombre like '%$busqueda%' or apellido like '%$busqueda%' order by id_usuario asc";//Busca resultados similares en la tabla usuarios
            $resultado = mysqli_query($conexion,$sql_usuarios);
            $cantfilas_u = mysqli_num_rows($resultado);
            if(mysqli_num_rows($resultado)==0){ //si no coincide ningun resultado, no se muestra nada

            }else{
                echo "<div class='div-resultados-users'>";
                $filas_u = mysqli_fetch_assoc($resultado);
                echo "<h1>Usuarios</h1>";
                echo "<div class='div-usuario'>"; 
                echo "<img src='".$filas_u['foto_perfil']."' class='foto-usuario-busq-resultado'>".$filas_u['nombre']. " ".$filas_u['apellido']." "; //se hace un fetch assoc para mostrar el nombre o apellido que haya coincido con la busqueda
                echo"</div>";
                while($filas_u = mysqli_fetch_assoc($resultado)) { //se itera para q muestre mas resultado si hay
                    echo "<div class='div-usuario'>"; 
                    echo "<img src='".$filas_u['foto_perfil']."' class='foto-usuario-busq-resultado' >".$filas_u['nombre']. " ".$filas_u['apellido']." ";
                    echo"</div>";
                }
                echo "</div>";
            }
            $sql_publicaciones = "SELECT * from publicaciones where nombre_publicacion like '%$busqueda%' order by id_usuario asc";
            $resultado2 = mysqli_query($conexion,$sql_publicaciones);
            $cantfilas_p = mysqli_num_rows($resultado2);
            if(mysqli_num_rows($resultado2)==0){ ////Busca resultados similares en la tabla de publicaciones
            }
            else{
                echo "<div class='div-resultados-publicacion'>";
                $fila_p = mysqli_fetch_assoc($resultado2);
                echo "<h1>Publicaciones</h1>";
                echo "<div class='div-publicacion'>"; 
                echo "<h2>".$fila_p['nombre_publicacion']."</h2>"." <img src='".$fila_p['foto_portada']."' class='foto-publicacion-busq-resultado'>";//se hace un fetch assoc para mostrar el nombre de la publicacion que haya coincido con la busqueda
                echo "</div>";
                while ($fila_p = mysqli_fetch_assoc($resultado2)){//se itera para mostrar mas resultado
                    echo "<div class='div-publicacion'>"; 
                    echo "<h2>".$fila_p['nombre_publicacion']."</h2>"." <img src='".$fila_p['foto_portada']."' class='foto-publicacion-busq-resultado'>";
                    echo "</div>";
                }
                echo "</div>";  
            }
            if ($cantfilas_u == 0 && $cantfilas_p == 0){ // si no llega a ver ningun resultado, se muestra en pantalla un aviso de que no hay resultados
                echo "<h1>Sin resultados</h1>";
            }
        echo "</div>";
        echo "<input type='button' class='boton' value='volver' onclick='location=\"index.php\"'";
        }
        else {header("location:index.php");}
        ?>
    
</div>
</body>
</html>