
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
    <div class="seccion-publicacion">
    <?php
        include('conexion.php');

        if(isset($_GET['id_publicacion'])){
            $busq = $_GET['busq'];
            include("conexion.php");
            $id= $_GET['id_publicacion'];
            $sql = "SELECT * from publicaciones where id_publicaciones='$id'";
            $resultado = mysqli_query($conexion,$sql);
            $fila=mysqli_fetch_assoc($resultado);
            $id_usuario= $fila['id_usuario'];
            $buscar_usuario ="SELECT * from usuarios where id_usuario='$id_usuario'";
            $resultado2=mysqli_query($conexion,$buscar_usuario);
            $fila_usuario= mysqli_fetch_assoc($resultado2);
            echo "<div class='titulo-publicacion'> <h1>".$fila['nombre_publicacion']."</h1> </div>";
            echo "<div class='elementos-publicacion'> 
                <h2>".$fila['descripcion']."</h2>
                <div class='foto-portada-en-publicacion'><img class='foto-portada-en-publicacion' src='".$fila['foto_portada']."'></div>
                <h4>Publicado el: ".$fila['fecha'].".</h4>
                <h4>Por: ".$fila_usuario['nombre']. " ".$fila_usuario['apellido'].".</h4>
                </div>";
                
            
            
        } else {echo "<h1> ERROR INESPERADO </h1>";}
        $value = $_GET['value'];
        if($value==1){
        echo "<input type='button' class='boton2' value='volver' onclick='location=\"publicaciones.php\"'>";}
        else if($value==2){
        echo "<form action='barra-buscador.php' method='get'>";
        echo "<input type='hidden' value='".$busq."'name='busq'>";
        echo "<input type='hidden' value='Enviar' name='Enviar'>";
        echo "<input type='submit' class='boton2' value='volver'>";
        echo "</form>";
        }
        else {
        echo "<input type='button' class='boton2' value='volver' onclick='location=\"index.php\"'>";
        }
        ?>
        
    </div>
</body>