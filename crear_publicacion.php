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

    <header>
        
            
            
            <?php   
            echo "<form action='nueva-foto-publi.php' method='GET' enctype='multipart/from-data'>
                <h1>fotos</h1> <input class='boton' type='file' name='foto-publicacion' multiple>
                <input type='submit' name='nuevafoto' value='foto nueva'>";
            echo "</form>";

            ?>




        <form action="crear_publicacion.php" method="GET" enctype='multipart/from-data'>


           <h1>descripcion</h1><br><textarea name="descripcion" id="" placeholder="descripcion" rows="20" cols="100"></textarea><br><br>
           
           <h1></h1> <input type="text" placeholder="fecha"><br><br>

           <h1>profeciones</h1> 
            <select name="profecion">
            
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
           <input type="submit" name="enviar">


        </form>
        <?php                         

        if(isset($_GET['enviar'])){
            include("conexion.php");
            $descripcion = $_GET['descripcion'];
            $profesion = $_GET['profecion'];
            
            $sql = "INSERT INTO publicaciones (descripcion, id_profesion) VALUES ('$descripcion', $profesion )";
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