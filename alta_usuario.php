<?php

include("conexion.php");

$user = $_POST["nombre"];
$apellido = $_POST["apellido"];
$pass = $_POST["pass"];
$mail = $_POST["mail"];
$telefono = $_POST["telefono"];

$consulta = "SELECT * FROM usuarios WHERE nombre='$user'";
$resultado = mysqli_query($conexion, $consulta);
$cantfilas = mysqli_num_rows($resultado);
if ($cantfilas == 1) {
    echo "<h3> El nombre " .$user. "ya existe. </h3>";
} else {
    $sql = "INSERT INTO usuarios (nombre, apellido, mail, contraseña, telefono) VALUES ('$user', '$apellido', '$mail', '$pass', '$telefono')";
    mysqli_query($conexion, $sql);
    echo "Su usuario con nombre: <b>" .$user. "</b> fue registrado con éxito.";
    echo "<br> <br>";
    mysqli_close($conexion);
}
echo "<input type='button' value='Volver' onClick='location=\"index.php\"'> ";