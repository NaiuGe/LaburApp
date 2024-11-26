<?php
        session_name("LOGIN");
        session_start();

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="estilo.css">
    <link rel="icon" href="./imagenes/logo.png" type="image/png">
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
                    <li><a href="grafico.php">Ver gráfico</a></li>
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
    
<script>
    function fecha(){
    var fecha;
    fecha= new Date();
    
    var cadena1 = fecha.getDate() + '/' + (fecha.getMonth()+1) + '/' + fecha.getFullYear();
    document.getElementById("fecha").value=cadena1 ;
}
</script>

        <main>
        <div class="centrar">
        <form class="cuadro-crear-formulario" action="crear_publicacion.php" method="POST" enctype="multipart/form-data">
            <h1>Crear publicación</h1>
            <h3>Título de la publicación</h3>
            <textarea class="titulo-publicacion" type="text" name="nombre_publicacion"  required> </textarea>
            <h3>Descripcion de la publicación</h3><br>            
            <textarea type="text" name="descripcion"  required> </textarea> 
            <h3>Seleccione una foto</h3> 
            <input type="file" name="imagen" required>
            <input type="hidden" value="fecha" id="fecha" name="fecha1" >
            <h3>Seleccionar profesión</h3> 
            <select class="seleccion-localidad" name="profesion"  required>    
                <option value="" selected disabled > Seleccionar profesión </option>
            <?php
                include("conexion.php");
                $consulta = "SELECT * FROM profesiones  ORDER BY id_profesion  ";        
                $resultado = mysqli_query($conexion, $consulta); 
                while($row = mysqli_fetch_array($resultado)){
                    $profesion = $row['nombre_profesion'];
                    $id_profesion = $row['id_profesion']; 
                    ?>  
                    <option value="<?php echo $id_profesion; ?>" ><?php echo $profesion;  ?></option>
                    <?php
                }
                ?> <br>
            </select><br><br>
            <input class="btn-busqueda" type="submit" value="Crear publicación" name="enviar" onclick="fecha()">
        
        </form>

        </div>

        <script>
            fecha();
        </script>
        <?php    
        
        include("conexion.php");
        
        if(!empty($_POST['enviar'])){ //llegan los datos del formulario al if
            $id = $_SESSION['id_usuario'];
            $nom = $_POST['nombre_publicacion'];
            $descripcion = $_POST['descripcion'];
            $profesion = $_POST['profesion'];
            $fecha = $_POST['fecha1'];
            $imagen=$_FILES['imagen']['tmp_name']; //$_FILES es una variable global que cumple las funciones necesarias para cargar las imagenes (tmp_name es nombre temporal)
            $nombreImg=$_FILES['imagen']['name']; //se guarda el nombre del archivo
            $extImg=strtolower(pathinfo($nombreImg, PATHINFO_EXTENSION)); //la extension con PATHINFO
            $sizeImg=$_FILES['imagen']['size']; //el tamaño del archivo
            $dir="imagenes/fotos_portadas_publicaciones/"; //se crea el directorio donde estara la imagen
            if($extImg=='jpg' or $extImg=='jpeg'){
                    
                $registro=$conexion->query("SELECT * from usuarios where id_usuario='$id' ");
                $fila= mysqli_fetch_assoc($registro);
                $id2=$fila['id_usuario'];
                $ruta=$dir.$_SESSION['nombre'].$id2."nombrepublicacion".$nom.".".$extImg; //es crea la variable ruta que guarda el nombre final del archivo, mas el directorio para que la base de datos tenga de referencia donde encontrar la imagen
                echo $ruta;
                $sql= "INSERT INTO publicaciones (descripcion, id_profesion, id_usuario, fecha, nombre_publicacion, foto_portada) VALUES ('$descripcion','$profesion','$id', '$fecha', '$nom', '$ruta' )";
                mysqli_query($conexion, $sql);
                mysqli_close($conexion);
                
                
    
                if (move_uploaded_file($imagen,$ruta)){ //mueve el archivo hacia la ruta
                    
                }
                header ("location:perfil.php");
            }
            else{
            $sql = "INSERT INTO publicaciones (descripcion, id_profesion, id_usuario, fecha, nombre_publicacion,) VALUES ('$descripcion','$profesion','$id', '$fecha', '$nom' )";
            }
            mysqli_query($conexion, $sql);
            mysqli_close($conexion);
            header ("location:perfil.php");
            
        }
        ?>
        </main> 
    </div>
    <footer> 
    <div class="paginacion">
    </div>
        <h3 id="derecho"></h3>
    </footer>
    <script src="script.js"></script> 
</body>
</html> 