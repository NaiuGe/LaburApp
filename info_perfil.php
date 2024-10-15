<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edición de Perfil</title>
</head>
<body>
    <?php
    
    session_name("LOGIN");
    session_start();
    include ("conexion.php");

    $consulta = "SELECT * FROM usuarios";
    echo "<h1>Modificar Perfil </h1>";
    echo"" .$_SESSION['id_usuario']."";


    ?>
</body>
</html>