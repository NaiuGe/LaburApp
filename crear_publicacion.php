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
<script>
    function fecha(){
        var fecha;
        fecha= new Date();
        
        var cadena1 = fecha.getDate() + '/' + (fecha.getMonth()+1) + '/' + fecha.getFullYear();
        document.getElementById("fecha").value=cadena1 ;
    }
    function hora(){
        var hora;
        fecha= new Date();
        var cadena = fecha.getHours() + '/' + fecha.getMinutes() + '/' + fecha.getSeconds();
        return cadena;
    }

    
</script>
    <header>
        <form action="crear_publicacion.php" method="POST" enctype="multipart/form-data">
            <h1>fotos</h1> <input type="file" name="imagen" required>
        
            <h1>titulo</h1><br><textarea name="nombre_publicacion" id="" placeholder="titulo" rows="2" cols="100" required></textarea><br><br>
            <h1>descripcion</h1><br><textarea name="descripcion" id="" placeholder="descripcion" rows="20" cols="100" required></textarea><br><br>
            <input type="hidden" value=" fecha" id="fecha" name="fecha1" >
            <h1>profeciones</h1> 
            <select name="profecion"  required>    
                <option value="" selected disabled > seleccionar rubro </option>
               <?php
                include("conexion.php");
                $consulta = "SELECT * FROM profesiones  ORDER BY id_profesion  ";        
                $resultado = mysqli_query($conexion, $consulta); 
                while($row = mysqli_fetch_array($resultado)){
                    $profecion = $row['nombre_profesion'];
                    $id_profecion = $row['id_profesion']; 
                    ?>  
                    <option value="<?php echo $id_profecion; ?>" ><?php echo $profecion;  ?></option>
                    <?php
                }
                ?> <br>
               </select><br><br>
            <input type="submit" name="enviar" onclick="fecha()">
        
        </form>
        <script>
            fecha();
        </script>
        <?php    
        
        include("conexion.php");
        
        if(!empty($_POST['enviar'])){
            $id = $_SESSION['id_usuario'];
            $nom = $_POST['nombre_publicacion'];
            $descripcion = $_POST['descripcion'];
            $profesion = $_POST['profecion'];
            $fecha = $_POST['fecha1'];
            $imagen=$_FILES['imagen']['tmp_name'];
            $nombreImg=$_FILES['imagen']['name'];
            $extImg=strtolower(pathinfo($nombreImg, PATHINFO_EXTENSION));
            $sizeImg=$_FILES['imagen']['size'];
            $dir="imagenes/fotos_portadas_publicaciones/";
            if($extImg=='jpg' or $extImg=='jpeg'){
                    
                $registro=$conexion->query("SELECT * from usuarios where id_usuario='$id' ");
                $fila= mysqli_fetch_assoc($registro);
                $id2=$fila['id_usuario'];
                $ruta=$dir.$_SESSION['nombre'].$id2."nombrepublicacion".$nom.".".$extImg;
                $sql= "INSERT INTO publicaciones (descripcion, id_profesion, id_usuario, fecha, nombre_publicacion, foto_portada) VALUES ('$descripcion','$profesion','$id', '$fecha', '$nom', '$ruta' )";
                mysqli_query($conexion, $sql);
                mysqli_close($conexion);
                
                
    
                if (move_uploaded_file($imagen,$ruta)){
                    
                }
                header ("location:publicaciones.php");
            }
            else{
            $sql = "INSERT INTO publicaciones (descripcion, id_profesion, id_usuario, fecha, nombre_publicacion) VALUES ('$descripcion','$profesion','$id', '$fecha', '$nom' )";
            }
            mysqli_query($conexion, $sql);
            mysqli_close($conexion);
            header ("location:publicaciones.php");
            
        }
        ?>
    </header>
    
    
        
    </div>
    <footer> 
        <h3> sajhdjsahd@</h3>
    </footer>
</body>
    
</html> 