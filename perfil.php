<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil de usuario </title>
</head>
<body>

    <?php
        include ("conexion.php");

        $user = $_POST['nombre'];
        $pass = $_POST['contraseña'];
        
        $consulta = "SELECT * FROM usuarios WHERE nombre='$user' AND contraseña='$pass'";

        $consulta = "SELECT * FROM usuarios, publicaciones WHERE usuariosb.nombre='$user' AND usuarios.contraseña='$pass'";

        $resultado= mysqli_query($conexion, $consulta);

        $cantfilas= mysqli_num_rows($resultado);
        
    ?>
</body>
</html>