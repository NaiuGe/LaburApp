<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil de usuario </title>
</head>
<body>

    <?php
        session_name("LOGIN");
        session_start();

        include ("conexion.php");
        if (isset($_SESSION['contador'])){
            
            $consulta = "SELECT * FROM usuarios, publicaciones;"; 
        
            $resultado= mysqli_query($conexion, $consulta);
            $cantfilas= mysqli_num_rows($resultado);
            echo '<br></br>';
                echo '<b>'. $_SESSION['nombre'].'</b>';
                echo '<br></br>';
        } else {
            echo "No tenes una cuenta ingresada. Inicia Sesión e intentalo de nuevo.";
            echo '<br><input type="button" value="Iniciar sesion" onclick="location=\'login.html\'">';
        }
        
    ?>


</body>
</html>