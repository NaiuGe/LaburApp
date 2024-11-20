
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
    <div class="centrar">
    <div class="cuadro-ver-publicacion">
    <?php
        include('conexion.php');

        if(isset($_GET['id_publicacion'])){
            include("conexion.php");
            $id= $_GET['id_publicacion'];
            $sql = "SELECT * from publicaciones where id_publicaciones='$id'";
            $resultado = mysqli_query($conexion,$sql);
            $fila=mysqli_fetch_assoc($resultado);
            $id_usuario= $fila['id_usuario'];
            $buscar_usuario ="SELECT * from usuarios where id_usuario='$id_usuario'";
            $resultado2=mysqli_query($conexion,$buscar_usuario);
            $fila_usuario= mysqli_fetch_assoc($resultado2);
            echo "";
            echo "<h1>".$fila['nombre_publicacion']."</h1>";
            echo "
                <h2>Descripción de la publicación:</h2>
                <p> ".$fila['descripcion']." </p>
                <div><img src='".$fila['foto_portada']."'></div>
                <div class='footer-ver-publicacion'>
                <h4>Publicado el: ".$fila['fecha'].".</h4>
                <a href='mostrar-perfil.php?id_usuario=".$id_usuario."'>
                <h4>Por: ".$fila_usuario['nombre']. " ".$fila_usuario['apellido'].".</h4></a>
                </div>";
                
            
            
        } else {echo "<h1> ERROR INESPERADO </h1>";}
        $value = $_GET['value'];
        if($value==1){ //si entra desde publicaciones, se devuelve a la misma pagina por el metodo get, gracias a la variable value que se envia por el mismo metodo
        echo "<input type='button' class='btn-busqueda' value='volver' onclick='location=\"publicaciones.php\"'>";}
        else if($value==2){ //si entra desde la pagina de los resultados, se arma un formulario para rescatar las variables (el historial de busqueda y la variable "Enviar")
        $busq = $_GET['busq'];
        echo "<form action='barra-buscador.php' method='get'>";
        echo "<input type='hidden' value='".$busq."'name='busq'>";
        echo "<input type='hidden' value='Enviar' name='Enviar'>";
        echo "<input type='submit' class='btn-busqueda' value='volver'>";
        echo "</form>";
        }
        else if ($value==3){ //si se ingresa desde index, directamente no entra por ningun value y se hace un onclick para index
        echo "<input type='button' class='btn-busqueda' value='volver' onclick='location=\"index.php\"'>";
        }
        ?>
        </div>
        </div>
</body>