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
    $id_usuario = $_POST['id_usuario'];

    $consulta = "SELECT * FROM usuarios";

    echo" " .$_SESSION['id_usuario']."";


    ?>
</body>
</html>