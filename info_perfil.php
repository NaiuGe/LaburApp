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

    $id_usuario = $_SESSION['id_usuario'];

    $consulta = "SELECT usuarios.* FROM usuarios WHERE usuarios.id_usuario = '$id_usuario';";

    $resultado = mysqli_query($conexion, $consulta);

    if ($row = mysqli_fetch_row($resultado)) {
        echo "<h2>Modificar Perfil </h2>";
        echo "<br>";
        echo "<form method='post' action='actualizar_perfil.php'>";
        echo "<input name='id_usuario' value='".$row[0]."'hidden>";
        echo "<h3>Nombre y Apellido</h3> <p>".$row[1]. " ".$row[2]."</p>";
        echo "<h3> Correo Electrónico </h3>";
        echo "<input type='text' name='mail' value='".$row[3]."'>";
        echo "<h3> Domicilio </h3>";
        echo "<input type='text' name='domicilio' value='".$row[4]."'>";
        echo "<h3> CONTRASEÑA </h3>";
        echo "<input type='text' name='pass' value='".$row[7]."'>";
        echo "<h3> Número de Telefono </h3>";
        echo "<input type='tel' name='telefono' value='".$row[8]."'>";
        echo "<h3> Descripción personal </h3>";
        echo "<input type='text' name='informacion' value='".$row[9]."'>";
        echo "<br><br>";
        echo"<input class='boton' type='submit' value='Enviar'> ";
        echo "&nbsp;&nbsp;&nbsp;&nbsp;";
        echo "<input class='boton' type='button' value='Cancelar' onClick='location=\"perfil.php\"'> ";
        echo "</form>";
    }


    ?>
</body>
</html>