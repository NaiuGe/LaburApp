<?php

include("conexion.php");

$user = $_POST["nombre"];
$apellido = $_POST['apellido'];
$pass = $_POST["pass"];
$mail = $_POST["mail"];
$telefono = $_POST["telefono"];

$consulta = "SELECT * FROM usuarios WHERE mail='$mail'";
$resultado = mysqli_query($conexion, $consulta);
$cantfilas = mysqli_num_rows($resultado);
if ($cantfilas == 1) {
    echo "<h3> El usuario ya se encuentra registrado. </h3>";
} else {
    $sql = "INSERT INTO usuarios (nombre, apellido, contraseña, mail, telefono) VALUES ('$user', '$apellido', '$pass', '$mail', '$telefono' )";
    mysqli_query($conexion, $sql);
    echo "registrado con éxito.";
    echo "<br> <br>";
    mysqli_close($conexion);
}
echo "<input type='button' value='Volver' onClick='location=\"index.php\"'> ";