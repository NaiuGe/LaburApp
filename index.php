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
            <img src="imagenes/icono_usuario.png" id="fotoperfil">
            <?php
            if(isset($_SESSION['contador'])){
                echo '<br></br>';
                echo '<b>Bienvenido '. $_SESSION['nombre'].'</b>';
                echo '<br></br>';
                echo "<input type='button' value='cerrar sesion' onclick='location=\"cerrarlogin.php\"'>";
            } else {echo '<br><input type="button" value="Iniciar sesion" onclick="location=\'login.html\'">';}
            ?>      
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
            <a href="" class="link">
                <img src="imagenes/icono_trabajo.png" id="fotopubli">
            </a>
        </div>
        <div class="publicaciones"> 
            <a href="" class="link">
                <img src="imagenes/icono_trabajo.png" id="fotopubli">
            </a>
        </div>
        <div class="publicaciones"> 
            <a href="" class="link">
                <img src="imagenes/icono_trabajo.png" id="fotopubli">
            </a>
        </div>
        <div class="publicaciones"> 
            <a href="" class="link">
                <img src="imagenes/icono_trabajo.png" id="fotopubli">
            </a>
        </div>
        <div class="publicaciones"> 
            <a href="" class="link">
                <img src="imagenes/icono_trabajo.png" id="fotopubli">
            </a>
        </div>
        <div class="publicaciones"> 
            <a href="" class="link">
                <img src="imagenes/icono_trabajo.png" id="fotopubli">
            </a>
        </div>
    </div>
    <footer> 
        <h3> sajhdjsahd@</h3>
    </footer>
</body>
    
</html>