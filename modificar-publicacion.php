<?php

        session_name("LOGIN");
        session_start();
        ob_start();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
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
        function volver() {
            
            window.location.href = 'perfil.php'; }
    </script>
<script>
    // Función para mostrar la vista previa de la imagen seleccionada 
    function previewImage(event) {
        const file = event.target.files[0];
        
        // Verificar si el archivo es una imagen
        if (file && file.type.startsWith('image/')) {
            const reader = new FileReader();
            
            reader.onload = function(e) {
                // Mostrar la imagen de vista previa
                const image = document.getElementById('imagenPreview');
                image.src = e.target.result;
                image.style.display = 'block'; // Mostrar la imagen
            };
            
            reader.readAsDataURL(file);
        } else {
            alert('Por favor selecciona un archivo de imagen');
        }
    }
    function fecha(){
    var fecha;
    fecha= new Date();
    
    var cadena1 = fecha.getDate() + '/' + (fecha.getMonth()+1) + '/' + fecha.getFullYear();
    document.getElementById("fecha").value=cadena1 ;
}
</script>

<?php  

include("conexion.php");
        
        $id_publicacion_get= $_GET['id_publicacion'];
        $sql = "SELECT * from publicaciones where id_publicaciones='$id_publicacion_get'";
        $resultado = mysqli_query($conexion, $sql);
        $fila= mysqli_fetch_assoc($resultado);


        echo '<main>
        <div class="centrar">
        <form class="cuadro-crear-formulario" action="modificar-publicacion.php" method="POST" enctype="multipart/form-data">
            <h1>modificar publicación</h1>
            <h3>cambiar Título de la publicación</h3>
            <input class="titulo-publicacion" type="text" name="nombre_publicacion"  required value="'.$fila["nombre_publicacion"].'"> 
            <h3>Descripcion de la publicación</h3><br>            
            <textarea type="text" name="descripcion"  required>'.$fila['descripcion'].' </textarea>  
            <h3>cambiar foto</h3> 
            <div class="contenedor-foto">
            <img id="imagenPreview" src="' .$fila["foto_portada"]. '" class="fotoperfil" >
            </div>
            <input type="file" accept="imagen/*" onchange="previewImage(event)" name="imagen" width="50vh" >
            <input type="hidden" value="fecha" id="fecha" name="fecha1" >
            <input type="hidden" value="'.$id_publicacion_get.'" name="id">
            <h3>Profesión</h3> ';
                $consulta = "SELECT * FROM profesiones  where id_profesion='".$fila['id_profesion']."'";         
                $resultado = mysqli_query($conexion, $consulta); 
                $row = mysqli_fetch_array($resultado);
                echo "<input type='text' disabled value='".$row['nombre_profesion']."'>";   
           echo'<br></br> 
                 <input class="btn-busqueda" type="submit" value="Actualizar" name="enviar" onclick="fecha()"> 
                
        
        </form>

        </div>';
        if(isset($_POST['enviar'])){ 
            if(!empty($_POST['id'])){
            $id_publicacion=$_POST['id'];//llegan los datos del formulario al if
            $id = $_SESSION['id_usuario'];
            $nom = $_POST['nombre_publicacion'];
            $descripcion = $_POST['descripcion'];
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
                $sql = "UPDATE publicaciones SET nombre_publicacion='$nom', descripcion='$descripcion', fecha='$fecha', foto_portada='$ruta' WHERE id_publicaciones=$id_publicacion";
                mysqli_query($conexion, $sql);
                if (move_uploaded_file($imagen,$ruta)){;//mueve el archivo hacia la ruta                 
                }
                else{echo "error en subir la imagen";}
                header("location:perfil.php");
               
            }
            else{
            $sql = "UPDATE publicaciones SET nombre_publicacion='$nom', descripcion='$descripcion', fecha='$fecha' WHERE id_publicaciones=$id_publicacion";
            mysqli_query($conexion, $sql);
            header("location:perfil.php");
            ?>
             <script>
            //volver();
            </script>   
          <?php  
            }
        
        }header("location:perfil.php");
        }
        
        ?>
        </main> 
    </div>
    <script>
            fecha();
        </script>
    <footer> 
    <div class="paginacion">
    </div>
        <h3 id="derecho"></h3>
    </footer>
    <script src="script.js"></script> 
</body>
</html> 
